<?php

namespace Database\Seeders;

use App\Attribute;
use App\Display;
use App\Helpers\Productfamily;
use App\Helpers\Productsubfamily;
use App\Manufacturer;
use App\Printer;
use App\PrinterAttribute;
use App\PrinterPapersize;
use App\UsergroupSize;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PopulateDisplayProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataSet = $this->getRawDataSet();
        $this->addOrUpdateMultipleRecords($dataSet);
    }

    private function addOrUpdateMultipleRecords($dataSet)
    {
        foreach ($dataSet as $dataRow) {
            $printerArr = $this->createDisplayDataSet($dataRow);
            $printerId = $printerArr['fields']['id'];
            if (!is_null($printerId)) {
                DB::table('printers')
                  ->where('id', $printerArr['fields']['id'])
                  ->update($printerArr['fields']);
            } else {
                $printerId = (Display::create($printerArr['fields']))->id;
            }

            PrinterAttribute::addOrUpdateMultipleRecordsFromAttributeArray($printerId, $printerArr['attributes']);
        }
    }

    /**
     * @param $dataSet
     * @return array[]
     * @throws Exception
     */
    private function createDisplayDataSet($dataSet): array
    {
        $fieldsToCheckForNullValues = [
            'manufacturer_id',
            'productfamily',
            'productsubfamily',
        ];
        $attributesToAdd = [
            'product_url_on_manufacturer_website',
            'specification_sheet',
        ];


        $printerDataSet = [
            'attributes' => [],
            'fields'     => [
                'id'                => null,
                'name'              => '',
                'description'       => '',
                'usergroup_size_id' => null,
                'is_enabled'        => 1,
                'request_for_price' => 1,
            ],

        ];

        $printerDataSet['fields']['model_number'] = $dataSet['model_number'];
        $printerDataSet['fields']['model_number_displayed'] = $dataSet['model_number_displayed'];
        $printerDataSet['fields']['productfamily'] = $dataSet['productfamily'];
        $printerDataSet['fields']['productsubfamily'] = $dataSet['productsubfamily'];

        $printerDataSet['fields']['id'] = is_null(Display::findByModelNumber($dataSet['model_number']))
            ? null
            : Display::findByModelNumber($dataSet['model_number'])->id;
        $printerDataSet['fields']['manufacturer_id'] = is_null(Manufacturer::findByName($dataSet['manufacturer']))
            ? null
            : Manufacturer::findByName($dataSet['manufacturer'])->id;
        $printerDataSet['fields']['slug'] = strtolower($dataSet['manufacturer'])
            . '-'
            . strtolower($dataSet['model_number']);
        $printerDataSet['fields']['html_page_title'] = $dataSet['manufacturer']
            . ' '
            . $dataSet['model_number_displayed']
            . ' '
            . $dataSet['name'];
        $printerDataSet['fields']['html_page_meta_description'] = $printerDataSet['fields']['html_page_title'];


        foreach ($fieldsToCheckForNullValues as $field) {
            if (is_null($printerDataSet['fields'][$field])) {
                throw new Exception('Display <' . $field . '> cannot be null!' . print_r($dataSet, true));
            }
        }

        $dataSet['specification_sheet'] = '/files/specification_sheet/'
            . Manufacturer::findByName($dataSet['manufacturer'])->name
            . '_' . strtoupper($dataSet['model_number'])
            . '_adatlap_hu.pdf';
        foreach ($attributesToAdd as $attributeVariableName) {
            $attribute = Attribute::findByVariableName($attributeVariableName);
            if (is_null($attribute)) {
                throw new Exception(
                    'Invalid attribute name <' . $attributeVariableName . '>'
                );
            }

            if ($attribute->takesValueFromSet()) {
                if (!$attribute->hasLabelInSet($dataSet[$attributeVariableName])) {
                    throw new Exception(
                        'Invalid value <' . $dataSet[$attributeVariableName] . '>'
                        . ' for attribute <' . $attributeVariableName . '>'
                    );
                } else {
                    $printerDataSet['attributes'][$attributeVariableName] = $attribute->getAttributeValueFromSetByLabel(
                        $dataSet[$attributeVariableName]
                    )->value;
                }
            } else {
                $printerDataSet['attributes'][$attributeVariableName] = $dataSet[$attributeVariableName];
            }
            $printerDataSet['attributes']['specification_sheet'] = '/files/specification_sheet/'
                . Manufacturer::findByName($dataSet['manufacturer'])->name
                . '_' . strtoupper($dataSet['model_number'])
                . '_adatlap_hu.pdf';
        }

        $printerDataSet['papersize'][] = null;


        return $printerDataSet;
    }

    private function getRawDataSet()
    {
        $dataSet = [
            [
                "manufacturer"                        => "Sharp",
                "model_number"                        => "PNCD701",
                "name"                                => "",
                "model_number_displayed"              => "PN-CD701",
                "product_url_on_manufacturer_website" => "https://www.sharp.hu/cps/rde/xchg/hu/hs.xsl/-/html/product-details-interactive-models.htm?product=PNCD701",
                "productfamily"                       => Productfamily::DISPLAYS_ID,
                "productsubfamily"                    => Productsubfamily::INTERACTIVE_DISPLAYS_ID,
            ],

            [
                "manufacturer"                        => "Sharp",
                "model_number"                        => "PN85TH1",
                "name"                                => "",
                "model_number_displayed"              => "PN-85TH1",
                "product_url_on_manufacturer_website" => "https://www.sharp.hu/cps/rde/xchg/hu/hs.xsl/-/html/product-details-interactive-models.htm?product=PN85TH1",
                "productfamily"                       => Productfamily::DISPLAYS_ID,
                "productsubfamily"                    => Productsubfamily::INTERACTIVE_DISPLAYS_ID,
            ],

            [
                "manufacturer"                        => "Sharp",
                "model_number"                        => "PN75TH1",
                "name"                                => "",
                "model_number_displayed"              => "PN-75TH1",
                "product_url_on_manufacturer_website" => "https://www.sharp.hu/cps/rde/xchg/hu/hs.xsl/-/html/product-details-interactive-models.htm?product=PN75TH1",
                "productfamily"                       => Productfamily::DISPLAYS_ID,
                "productsubfamily"                    => Productsubfamily::INTERACTIVE_DISPLAYS_ID,
            ],

            [
                "manufacturer"                        => "Sharp",
                "model_number"                        => "PN65TH1",
                "name"                                => "",
                "model_number_displayed"              => "PN-65TH1",
                "product_url_on_manufacturer_website" => "https://www.sharp.hu/cps/rde/xchg/hu/hs.xsl/-/html/product-details-interactive-models.htm?product=PN65TH1",
                "productfamily"                       => Productfamily::DISPLAYS_ID,
                "productsubfamily"                    => Productsubfamily::INTERACTIVE_DISPLAYS_ID,
            ],

            [
                "manufacturer"                        => "Sharp",
                "model_number"                        => "PN80TH5",
                "name"                                => "",
                "model_number_displayed"              => "PN-80TH5",
                "product_url_on_manufacturer_website" => "https://www.sharp.hu/cps/rde/xchg/hu/hs.xsl/-/html/product-details-interactive-models.htm?product=PN80TH5",
                "productfamily"                       => Productfamily::DISPLAYS_ID,
                "productsubfamily"                    => Productsubfamily::INTERACTIVE_DISPLAYS_ID,
            ],

            [
                "manufacturer"                        => "Sharp",
                "model_number"                        => "PN70TH5",
                "name"                                => "",
                "model_number_displayed"              => "PN-70TH5",
                "product_url_on_manufacturer_website" => "https://www.sharp.hu/cps/rde/xchg/hu/hs.xsl/-/html/product-details-interactive-models.htm?product=PN70TH5",
                "productfamily"                       => Productfamily::DISPLAYS_ID,
                "productsubfamily"                    => Productsubfamily::INTERACTIVE_DISPLAYS_ID,
            ],

            [
                "manufacturer"                        => "Sharp",
                "model_number"                        => "PN60TB3",
                "name"                                => "",
                "model_number_displayed"              => "PN-60TB3",
                "product_url_on_manufacturer_website" => "https://www.sharp.hu/cps/rde/xchg/hu/hs.xsl/-/html/product-details-interactive-models.htm?product=PN60TB3",
                "productfamily"                       => Productfamily::DISPLAYS_ID,
                "productsubfamily"                    => Productsubfamily::INTERACTIVE_DISPLAYS_ID,
            ],

            [
                "manufacturer"                        => "Sharp",
                "model_number"                        => "PN86HC1",
                "name"                                => "",
                "model_number_displayed"              => "PN-86HC1",
                "product_url_on_manufacturer_website" => "https://www.sharp.hu/cps/rde/xchg/hu/hs.xsl/-/html/product-details-interactive-models.htm?product=PN86HC1",
                "productfamily"                       => Productfamily::DISPLAYS_ID,
                "productsubfamily"                    => Productsubfamily::INTERACTIVE_DISPLAYS_ID,
            ],

            [
                "manufacturer"                        => "Sharp",
                "model_number"                        => "PN75HC1",
                "name"                                => "",
                "model_number_displayed"              => "PN-75HC1",
                "product_url_on_manufacturer_website" => "https://www.sharp.hu/cps/rde/xchg/hu/hs.xsl/-/html/product-details-interactive-models.htm?product=PN75HC1",
                "productfamily"                       => Productfamily::DISPLAYS_ID,
                "productsubfamily"                    => Productsubfamily::INTERACTIVE_DISPLAYS_ID,
            ],

            [
                "manufacturer"                        => "Sharp",
                "model_number"                        => "PN70HC1E",
                "name"                                => "",
                "model_number_displayed"              => "PN-70HC1E",
                "product_url_on_manufacturer_website" => "https://www.sharp.hu/cps/rde/xchg/hu/hs.xsl/-/html/product-details-interactive-models.htm?product=PN70HC1E",
                "productfamily"                       => Productfamily::DISPLAYS_ID,
                "productsubfamily"                    => Productsubfamily::INTERACTIVE_DISPLAYS_ID,
            ],

            [
                "manufacturer"                        => "Sharp",
                "model_number"                        => "PN50TC1",
                "name"                                => "",
                "model_number_displayed"              => "PN-50TC1",
                "product_url_on_manufacturer_website" => "https://www.sharp.hu/cps/rde/xchg/hu/hs.xsl/-/html/product-details-interactive-models.htm?product=PN50TC1",
                "productfamily"                       => Productfamily::DISPLAYS_ID,
                "productsubfamily"                    => Productsubfamily::INTERACTIVE_DISPLAYS_ID,
            ],

            [
                "manufacturer"                        => "Sharp",
                "model_number"                        => "PN40TC1",
                "name"                                => "",
                "model_number_displayed"              => "PN-40TC1",
                "product_url_on_manufacturer_website" => "https://www.sharp.hu/cps/rde/xchg/hu/hs.xsl/-/html/product-details-interactive-models.htm?product=PN40TC1",
                "productfamily"                       => Productfamily::DISPLAYS_ID,
                "productsubfamily"                    => Productsubfamily::INTERACTIVE_DISPLAYS_ID,
            ],

        ];

        return $dataSet;
    }
}
