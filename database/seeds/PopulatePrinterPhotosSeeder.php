<?php

namespace Database\Seeders;

use App\Helpers\PrinterPhotoManager;
use Illuminate\Database\Seeder;
use App\Scrapers\SharpScraper;
use App\Printer;

class PopulatePrinterPhotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addOrUpdateSharpProductImages();
    }

    private function addOrUpdateSharpProductImages()
    {
        $scraper = new SharpScraper();
        $printers = Printer::where('manufacturer_id', 1)
                           ->get();

        foreach ($printers as $printer) {
            $url = $printer->getPrinterAttributeValue("product_url_on_manufacturer_website");

            $imageURLs = array_unique(@($scraper->scrapeProductPage($url)['images']));
            foreach ($imageURLs as $remoteImage) {
                $remoteImage = "http:" . $remoteImage;
                $filename = pathinfo($remoteImage, PATHINFO_BASENAME);
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

                PrinterPhotoManager::createPrinterPhotoWithCustomizationsFromFile($printer, $imageFullPath);
            }
        }
    }
}
