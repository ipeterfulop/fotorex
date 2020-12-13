<?php

namespace Database\Seeders;

use App\Display;
use App\File;
use App\Helpers\PrinterPhotoManager;
use App\Helpers\Productfamily;
use App\Scrapers\LexmarkScraper;
use Illuminate\Database\Seeder;
use App\Scrapers\SharpScraper;
use App\Printer;
use Illuminate\Support\Facades\DB;

class PopulatePrinterPhotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addOrUpdateProductImages();
    }

    private function addOrUpdateProductImages()
    {
        $printers = DB::table('printers')
                      ->where('id', '>', 0)
                      ->get();

        foreach ($printers as $printer) {
            $printer = ($printer->productfamily == Productfamily::PRINTERS_ID)
                ? Printer::find($printer->id)
                : Display::find($printer->id);

            print "\n Processing printer <#{$printer->id}> {$printer->manufacturer->name} {$printer->model_number}";

            $imageIndex = 1;
            $url = $printer->getPrinterAttributeValue("product_url_on_manufacturer_website");
            $scraper = ($printer->manufacturer_id == 1)
                ? (new SharpScraper())
                : (new LexmarkScraper());
            $imageURLs = array_unique(@($scraper->scrapeProductPage($url)['images']));

            foreach ($imageURLs as $remoteImage) {
                $remoteImage = ltrim($remoteImage, '\//');
                $remoteImage = ($printer->manufacturer_id == 1)
                    ? "http://" . $remoteImage
                    : $remoteImage;
                print "\n Processing: " . $remoteImage;
                $file = File::where('original_url', $remoteImage)
                            ->get()
                            ->first();

                if (is_null($file)) {
                    $filename = $printer->getBasePhotoFilename()
                        . str_pad(($imageIndex++), 2, '0', STR_PAD_LEFT)
                        . '.' . pathinfo($remoteImage, PATHINFO_EXTENSION);

                    $imageFullPath = storage_path('app/' . $filename);
                    $fp = fopen($imageFullPath, 'w+');
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $remoteImage);
                    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                    curl_setopt($ch, CURLOPT_FILE, $fp);
                    curl_exec($ch);
                    curl_close($ch);
                    fclose($fp);

                    $printerphoto = (filesize($imageFullPath) > 0)
                        ? PrinterPhotoManager::createPrinterPhotoWithCustomizationsFromFile(
                            $printer,
                            $imageFullPath
                        )
                        : null;

                    if (is_object($printerphoto)) {
                        $printerphoto->customized_printer_photos
                            ->first()
                            ->photo
                            ->file
                            ->update(['original_url' => $remoteImage]);
                    }
                }
            }
        }
    }

}
