<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Printer;
use App\PrinterAttribute;
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

            foreach (array_keys($res['attributes']) as $attribute) {
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
}
