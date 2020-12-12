<?php

namespace Database\Seeders;

use App\Printer;
use App\PrinterAttribute;
use Illuminate\Database\Seeder;

class PrinterAttributeMassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addOrUpdatePrinterAndDisplayAttributes();
    }

    private function addOrUpdatePrinterAndDisplayAttributes()
    {
        $dataSet = $this->getRawDataSet();
        $this->addOrUpdateRecords($dataSet);
    }

    private function addOrUpdateRecords($dataSet)
    {
        foreach ($dataSet as $dataItem) {
            $printer = Printer::findByModelNumber($dataItem['model_number']);
            if (!is_null($printer)) {
                PrinterAttribute::addOrUpdate($printer->id, $dataItem['attribute_name'], $dataItem['attribute_value']);
            }
        }
    }

    private function getRawDataSet(): array
    {
        $dataSet = [
            //'printing_speed_a3_color', 'printing_speed_a4_color'
            [
                'model_number'    => 'MX6071',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '60',
            ],
            [
                'model_number'    => 'MX6071',
                'attribute_name'  => 'printing_speed_a3_color',
                'attribute_value' => '30',
            ],
            [
                'model_number'    => 'MX6051',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '60',
            ],
            [
                'model_number'    => 'MX6051',
                'attribute_name'  => 'printing_speed_a3_color',
                'attribute_value' => '30',
            ],
            [
                'model_number'    => 'MX5071',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '50',
            ],
            [
                'model_number'    => 'MX5071',
                'attribute_name'  => 'printing_speed_a3_color',
                'attribute_value' => '26',
            ],
            [
                'model_number'    => 'MX5051',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '50',
            ],
            [
                'model_number'    => 'MX5051',
                'attribute_name'  => 'printing_speed_a3_color',
                'attribute_value' => '26',
            ],
            [
                'model_number'    => 'MX4141N',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '41',
            ],
            [
                'model_number'    => 'MX4141N',
                'attribute_name'  => 'printing_speed_a3_color',
                'attribute_value' => '19',
            ],
            [
                'model_number'    => 'MX4071',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '40',
            ],
            [
                'model_number'    => 'MX4071',
                'attribute_name'  => 'printing_speed_a3_color',
                'attribute_value' => '20',
            ],
            [
                'model_number'    => 'MX4061',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '40',
            ],
            [
                'model_number'    => 'MX4061',
                'attribute_name'  => 'printing_speed_a3_color',
                'attribute_value' => '20',
            ],
            [
                'model_number'    => 'MX4051',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '40',
            ],
            [
                'model_number'    => 'MX4051',
                'attribute_name'  => 'printing_speed_a3_color',
                'attribute_value' => '20',
            ],
            [
                'model_number'    => 'MX3571',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '35',
            ],
            [
                'model_number'    => 'MX3571',
                'attribute_name'  => 'printing_speed_a3_color',
                'attribute_value' => '18',
            ],
            [
                'model_number'    => 'MX3561',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '35',
            ],
            [
                'model_number'    => 'MX3561',
                'attribute_name'  => 'printing_speed_a3_color',
                'attribute_value' => '18',
            ],
            [
                'model_number'    => 'MX3551',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '35',
            ],
            [
                'model_number'    => 'MX3551',
                'attribute_name'  => 'printing_speed_a3_color',
                'attribute_value' => '20',
            ],
            [
                'model_number'    => 'MX3140N',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '31',
            ],
            [
                'model_number'    => 'MX3140N',
                'attribute_name'  => 'printing_speed_a3_color',
                'attribute_value' => '15',
            ],
            [
                'model_number'    => 'MX3071',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '30',
            ],
            [
                'model_number'    => 'MX3071',
                'attribute_name'  => 'printing_speed_a3_color',
                'attribute_value' => '16',
            ],
            [
                'model_number'    => 'MX3061',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '30',
            ],
            [
                'model_number'    => 'MX3061',
                'attribute_name'  => 'printing_speed_a3_color',
                'attribute_value' => '16',
            ],
            [
                'model_number'    => 'MX3051',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '30',
            ],
            [
                'model_number'    => 'MX3051',
                'attribute_name'  => 'printing_speed_a3_color',
                'attribute_value' => '16',
            ],
            [
                'model_number'    => 'MX2651',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '26',
            ],
            [
                'model_number'    => 'MX2651',
                'attribute_name'  => 'printing_speed_a3_color',
                'attribute_value' => '15',
            ],
            [
                'model_number'    => 'MX2614N',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '26',
            ],
            [
                'model_number'    => 'MX2614N',
                'attribute_name'  => 'printing_speed_a3_color',
                'attribute_value' => '14',
            ],
            [
                'model_number'    => 'MXC304W',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '30',
            ],
            [
                'model_number'    => 'MXC303W',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '30',
            ],
            [
                'model_number'    => 'MXC607P',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '57',
            ],
            [
                'model_number'    => 'MXC507P',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '47',
            ],
            [
                'model_number'    => 'MXC407P',
                'attribute_name'  => 'printing_speed_a4_color',
                'attribute_value' => '38',
            ],

        ];

        return $dataSet;
    }

}
