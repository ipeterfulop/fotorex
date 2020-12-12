<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\File;
use App\Helpers\PrinterPhotoManager;
use App\Printer;
use App\PrinterAttribute;
use App\Scrapers\LexmarkScraper;
use App\Scrapers\SharpScraper;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OldDataMigrationController extends Controller
{
    public function index()
    {
        $printers = Printer::all();
        $codeString = '';
        foreach ($printers as $printer) {
            $url = $printer->getPrinterAttributeValue('product_url_on_manufacturer_website');
            $scraper = new SharpScraper();
            $data = $scraper->scrapeProductPage($url);
            $res = SharpScraper::parseScrapedData($data);
            //$codestr .= "\n" . "[ \n'modelnumber' => '" . $printer->model_number . "',\n 'description'=>'" . $res['description'] . "',\n ], ";

            $attributesToCheck = [
                // 'printing_speed_a3_color'
                // 'printing_speed_a4_color'
                "printing_speed_a4_bw",
                "printing_speed_a3_bw",
                "paper_feed_capacity",
                "memory",
                "builtin_hard_drive",
                "duplex",
                "sorting",

            ];
            foreach ($attributesToCheck as $attribute) {
                $codeString .= "\n" . "[ \n"
                    . "'model_number' => '" . $printer->model_number . "',\n "
                    . "'attribute_name'=>'" . $attribute . "',\n"
                    . "'attribute_value'=>'" . $res["attributes"][$attribute] . "',\n"
                    . " ], ";
            }
        }
        $filename = "/home/vagrant/Code/printerattributes_" . Carbon::now()->format('Y_m_d_h_i_s');
        $myfile = fopen($filename, "w") or die("Unable to open file!");
        fwrite($myfile, $codeString);
        fclose($myfile);
    }

    public function downloadGivenPrinterImages(Printer $printer, string $targetDir = null)
    {
        if (is_null($targetDir)) {
            $targetDir = storage_path() . '/app/productimages/';
        }

        $imageIndex = 1;

        $url = $printer->getPrinterAttributeValue("product_url_on_manufacturer_website");
        $scraper = ($printer->manufacturer_id == 1)
            ? (new SharpScraper())
            : (new LexmarkScraper());
        $imageURLs = array_unique(@($scraper->scrapeProductPage($url)['images']));

        foreach ($imageURLs as $remoteImage) {
            $remoteImage = ltrim($remoteImage, "//");
            print "Processing " . $remoteImage;

            $remoteImage = ($printer->manufacturer_id == 1)
                ? "http:" . $remoteImage
                : $remoteImage;
            $file = File::where('original_url', $remoteImage)
                        ->get()
                        ->first();

            if (is_null($file)) {
                $filename = $printer->getBasePhotoFilename()
                    . str_pad(($imageIndex++), 2, '0', STR_PAD_LEFT)
                    . '.' . pathinfo($remoteImage, PATHINFO_EXTENSION);

                $filenameWithFullPath = $targetDir . $filename;
                $this->downloadRemoteImage($remoteImage, $filenameWithFullPath);
            }
        }
    }

    public function downloadRemoteImage(string $remoteImage, string $targetImage)
    {
        $fp = fopen($targetImage, 'w+');

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
    }

    public function processProductImages()
    {
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
