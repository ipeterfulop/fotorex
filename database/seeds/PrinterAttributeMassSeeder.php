<?php

namespace Database\Seeders;

use App\Printer;
use App\PrinterAttribute;
use App\Attribute;
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
            $attribute = Attribute::findByVariableName($dataItem['attribute_name']);
            if ((!is_null($printer)) && (!is_null($attribute))) {
                PrinterAttribute::addOrUpdate($printer->id, $dataItem['attribute_name'], $dataItem['attribute_value']);
            }
        }
    }

    private function getRawDataSet(): array
    {
        $dataSet = [

            /*
               "printing_speed_a4_bw",
               "printing_speed_a3_bw",
               "paper_feed_capacity" ,
               "memory"              ,
               "builtin_hard_drive"  ,
               "duplex"              ,
               "sorting"             ,
            */
            [
                'model_number'    => 'MX6071',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '60',
            ],
            [
                'model_number'    => 'MX6071',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '30',
            ],
            [
                'model_number'    => 'MX6071',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MX6071',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MX6071',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MX6071',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MX6071',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MX6051',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '60',
            ],
            [
                'model_number'    => 'MX6051',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX6051',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MX6051',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MX6051',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MX6051',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MX6051',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MX5071',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '50',
            ],
            [
                'model_number'    => 'MX5071',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '26',
            ],
            [
                'model_number'    => 'MX5071',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MX5071',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MX5071',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MX5071',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MX5071',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MX5051',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '50',
            ],
            [
                'model_number'    => 'MX5051',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX5051',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MX5051',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MX5051',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MX5051',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MX5051',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MX4141N',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '41',
            ],
            [
                'model_number'    => 'MX4141N',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '19',
            ],
            [
                'model_number'    => 'MX4141N',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '1100',
            ],
            [
                'model_number'    => 'MX4141N',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX4141N',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '320',
            ],
            [
                'model_number'    => 'MX4141N',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MX4141N',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MX4071',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '40',
            ],
            [
                'model_number'    => 'MX4071',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '20',
            ],
            [
                'model_number'    => 'MX4071',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MX4071',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MX4071',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MX4071',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MX4071',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MX4061',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '40',
            ],
            [
                'model_number'    => 'MX4061',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '20',
            ],
            [
                'model_number'    => 'MX4061',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MX4061',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MX4061',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MX4061',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MX4061',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MX4051',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '40',
            ],
            [
                'model_number'    => 'MX4051',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '20',
            ],
            [
                'model_number'    => 'MX4051',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MX4051',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MX4051',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MX4051',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MX4051',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MX3571',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '35',
            ],
            [
                'model_number'    => 'MX3571',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '18',
            ],
            [
                'model_number'    => 'MX3571',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MX3571',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MX3571',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MX3571',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MX3571',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MX3561',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '35',
            ],
            [
                'model_number'    => 'MX3561',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '18',
            ],
            [
                'model_number'    => 'MX3561',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MX3561',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX3561',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MX3561',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MX3561',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MX3551',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '35',
            ],
            [
                'model_number'    => 'MX3551',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '20',
            ],
            [
                'model_number'    => 'MX3551',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MX3551',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MX3551',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MX3551',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MX3551',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MX3140N',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '31',
            ],
            [
                'model_number'    => 'MX3140N',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '15',
            ],
            [
                'model_number'    => 'MX3140N',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '600',
            ],
            [
                'model_number'    => 'MX3140N',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX3140N',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '320',
            ],
            [
                'model_number'    => 'MX3140N',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MX3140N',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MX3071',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '30',
            ],
            [
                'model_number'    => 'MX3071',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '16',
            ],
            [
                'model_number'    => 'MX3071',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MX3071',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MX3071',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MX3071',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MX3071',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MX3061',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '30',
            ],
            [
                'model_number'    => 'MX3061',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '16',
            ],
            [
                'model_number'    => 'MX3061',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MX3061',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX3061',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MX3061',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MX3061',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MX3051',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '30',
            ],
            [
                'model_number'    => 'MX3051',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '16',
            ],
            [
                'model_number'    => 'MX3051',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MX3051',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MX3051',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MX3051',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MX3051',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MX2651',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '26',
            ],
            [
                'model_number'    => 'MX2651',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '15',
            ],
            [
                'model_number'    => 'MX2651',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MX2651',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MX2651',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MX2651',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MX2651',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MX2614N',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '26',
            ],
            [
                'model_number'    => 'MX2614N',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '14',
            ],
            [
                'model_number'    => 'MX2614N',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '600',
            ],
            [
                'model_number'    => 'MX2614N',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX2614N',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '320',
            ],
            [
                'model_number'    => 'MX2614N',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MX2614N',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXC304W',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '30',
            ],
            [
                'model_number'    => 'MXC304W',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXC304W',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '300',
            ],
            [
                'model_number'    => 'MXC304W',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXC304W',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXC304W',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXC304W',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXC303W',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '30',
            ],
            [
                'model_number'    => 'MXC303W',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXC303W',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '300',
            ],
            [
                'model_number'    => 'MXC303W',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXC303W',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXC303W',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXC303W',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXC607P',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '57',
            ],
            [
                'model_number'    => 'MXC607P',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXC607P',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MXC607P',
                'attribute_name'  => 'memory',
                'attribute_value' => '1 / 3',
            ],
            [
                'model_number'    => 'MXC607P',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXC607P',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXC607P',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXC507P',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '47',
            ],
            [
                'model_number'    => 'MXC507P',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXC507P',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MXC507P',
                'attribute_name'  => 'memory',
                'attribute_value' => '3',
            ],
            [
                'model_number'    => 'MXC507P',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXC507P',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXC507P',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXC407P',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '38',
            ],
            [
                'model_number'    => 'MXC407P',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXC407P',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '251',
            ],
            [
                'model_number'    => 'MXC407P',
                'attribute_name'  => 'memory',
                'attribute_value' => '1',
            ],
            [
                'model_number'    => 'MXC407P',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXC407P',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXC407P',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXM904',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '90',
            ],
            [
                'model_number'    => 'MXM904',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '47',
            ],
            [
                'model_number'    => 'MXM904',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '3100',
            ],
            [
                'model_number'    => 'MXM904',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXM904',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '1024',
            ],
            [
                'model_number'    => 'MXM904',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM904',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM7570',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '75',
            ],
            [
                'model_number'    => 'MXM7570',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '37',
            ],
            [
                'model_number'    => 'MXM7570',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '3200',
            ],
            [
                'model_number'    => 'MXM7570',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXM7570',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXM7570',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM7570',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM6570',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '65',
            ],
            [
                'model_number'    => 'MXM6570',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '34',
            ],
            [
                'model_number'    => 'MXM6570',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '3200',
            ],
            [
                'model_number'    => 'MXM6570',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXM6570',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXM6570',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM6570',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM6071',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '60',
            ],
            [
                'model_number'    => 'MXM6071',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '28',
            ],
            [
                'model_number'    => 'MXM6071',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MXM6071',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXM6071',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXM6071',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM6071',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM6051',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '60',
            ],
            [
                'model_number'    => 'MXM6051',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '28',
            ],
            [
                'model_number'    => 'MXM6051',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MXM6051',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXM6051',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXM6051',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM6051',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM564N',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '56',
            ],
            [
                'model_number'    => 'MXM564N',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '26',
            ],
            [
                'model_number'    => 'MXM564N',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '600',
            ],
            [
                'model_number'    => 'MXM564N',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXM564N',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '320',
            ],
            [
                'model_number'    => 'MXM564N',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM564N',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM5071',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '50',
            ],
            [
                'model_number'    => 'MXM5071',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '24',
            ],
            [
                'model_number'    => 'MXM5071',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MXM5071',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXM5071',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXM5071',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM5071',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM5051',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '50',
            ],
            [
                'model_number'    => 'MXM5051',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '24',
            ],
            [
                'model_number'    => 'MXM5051',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MXM5051',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXM5051',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXM5051',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM5051',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM503U',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '50',
            ],
            [
                'model_number'    => 'MXM503U',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '22',
            ],
            [
                'model_number'    => 'MXM503U',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '1100',
            ],
            [
                'model_number'    => 'MXM503U',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXM503U',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '80',
            ],
            [
                'model_number'    => 'MXM503U',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM503U',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM465N',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '46',
            ],
            [
                'model_number'    => 'MXM465N',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '22',
            ],
            [
                'model_number'    => 'MXM465N',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '600',
            ],
            [
                'model_number'    => 'MXM465N',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXM465N',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '320',
            ],
            [
                'model_number'    => 'MXM465N',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM465N',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM464N',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '46',
            ],
            [
                'model_number'    => 'MXM464N',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '22',
            ],
            [
                'model_number'    => 'MXM464N',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '600',
            ],
            [
                'model_number'    => 'MXM464N',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXM464N',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '320',
            ],
            [
                'model_number'    => 'MXM464N',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM464N',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM452N',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '45',
            ],
            [
                'model_number'    => 'MXM452N',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '20',
            ],
            [
                'model_number'    => 'MXM452N',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '1100',
            ],
            [
                'model_number'    => 'MXM452N',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXM452N',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '80',
            ],
            [
                'model_number'    => 'MXM452N',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM452N',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM453U',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '45',
            ],
            [
                'model_number'    => 'MXM453U',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '20',
            ],
            [
                'model_number'    => 'MXM453U',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '1100',
            ],
            [
                'model_number'    => 'MXM453U',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXM453U',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '80',
            ],
            [
                'model_number'    => 'MXM453U',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM453U',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM4071',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '40',
            ],
            [
                'model_number'    => 'MXM4071',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '19',
            ],
            [
                'model_number'    => 'MXM4071',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MXM4071',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXM4071',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXM4071',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM4071',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM4051',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '40',
            ],
            [
                'model_number'    => 'MXM4051',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '19',
            ],
            [
                'model_number'    => 'MXM4051',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MXM4051',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXM4051',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXM4051',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM4051',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM4050',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '40',
            ],
            [
                'model_number'    => 'MXM4050',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '19',
            ],
            [
                'model_number'    => 'MXM4050',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MXM4050',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXM4050',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXM4050',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM4050',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM365N',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '36',
            ],
            [
                'model_number'    => 'MXM365N',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '17',
            ],
            [
                'model_number'    => 'MXM365N',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '600',
            ],
            [
                'model_number'    => 'MXM365N',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXM365N',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '320',
            ],
            [
                'model_number'    => 'MXM365N',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM365N',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM364N',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '36',
            ],
            [
                'model_number'    => 'MXM364N',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '17',
            ],
            [
                'model_number'    => 'MXM364N',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '600',
            ],
            [
                'model_number'    => 'MXM364N',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXM364N',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '320',
            ],
            [
                'model_number'    => 'MXM364N',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM364N',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM3571',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '35',
            ],
            [
                'model_number'    => 'MXM3571',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '17',
            ],
            [
                'model_number'    => 'MXM3571',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MXM3571',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXM3571',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXM3571',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM3571',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM3570',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '35',
            ],
            [
                'model_number'    => 'MXM3570',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '17',
            ],
            [
                'model_number'    => 'MXM3570',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MXM3570',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXM3570',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXM3570',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM3570',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM3551',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '35',
            ],
            [
                'model_number'    => 'MXM3551',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '17',
            ],
            [
                'model_number'    => 'MXM3551',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MXM3551',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXM3551',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXM3551',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM3551',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM3550',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '35',
            ],
            [
                'model_number'    => 'MXM3550',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '17',
            ],
            [
                'model_number'    => 'MXM3550',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MXM3550',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXM3550',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXM3550',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM3550',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM356NV',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '35',
            ],
            [
                'model_number'    => 'MXM356NV',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '20',
            ],
            [
                'model_number'    => 'MXM356NV',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '1100',
            ],
            [
                'model_number'    => 'MXM356NV',
                'attribute_name'  => 'memory',
                'attribute_value' => '2',
            ],
            [
                'model_number'    => 'MXM356NV',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '250',
            ],
            [
                'model_number'    => 'MXM356NV',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM356NV',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM316NV',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '31',
            ],
            [
                'model_number'    => 'MXM316NV',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '17',
            ],
            [
                'model_number'    => 'MXM316NV',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '1100',
            ],
            [
                'model_number'    => 'MXM316NV',
                'attribute_name'  => 'memory',
                'attribute_value' => '2',
            ],
            [
                'model_number'    => 'MXM316NV',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '250',
            ],
            [
                'model_number'    => 'MXM316NV',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM316NV',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM3071',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '30',
            ],
            [
                'model_number'    => 'MXM3071',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '15',
            ],
            [
                'model_number'    => 'MXM3071',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MXM3071',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXM3071',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXM3071',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM3071',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM3070',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '30',
            ],
            [
                'model_number'    => 'MXM3070',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '15',
            ],
            [
                'model_number'    => 'MXM3070',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MXM3070',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXM3070',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXM3070',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM3070',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM3051',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '30',
            ],
            [
                'model_number'    => 'MXM3051',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '15',
            ],
            [
                'model_number'    => 'MXM3051',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MXM3051',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXM3051',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXM3051',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM3051',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM3050',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '30',
            ],
            [
                'model_number'    => 'MXM3050',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '15',
            ],
            [
                'model_number'    => 'MXM3050',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MXM3050',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXM3050',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXM3050',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM3050',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM2651',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '26',
            ],
            [
                'model_number'    => 'MXM2651',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '15',
            ],
            [
                'model_number'    => 'MXM2651',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MXM2651',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXM2651',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXM2651',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM2651',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM2630',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '26',
            ],
            [
                'model_number'    => 'MXM2630',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '15',
            ],
            [
                'model_number'    => 'MXM2630',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MXM2630',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXM2630',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXM2630',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM2630',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXM266NV',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '26',
            ],
            [
                'model_number'    => 'MXM266NV',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '15',
            ],
            [
                'model_number'    => 'MXM266NV',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '1100',
            ],
            [
                'model_number'    => 'MXM266NV',
                'attribute_name'  => 'memory',
                'attribute_value' => '2',
            ],
            [
                'model_number'    => 'MXM266NV',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '250',
            ],
            [
                'model_number'    => 'MXM266NV',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXM266NV',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'AR6023NV',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '23',
            ],
            [
                'model_number'    => 'AR6023NV',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '12',
            ],
            [
                'model_number'    => 'AR6023NV',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '350',
            ],
            [
                'model_number'    => 'AR6023NV',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'AR6023NV',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'AR6023NV',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'AR6023NV',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'AR6020NV',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '20',
            ],
            [
                'model_number'    => 'AR6020NV',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '11',
            ],
            [
                'model_number'    => 'AR6020NV',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '350',
            ],
            [
                'model_number'    => 'AR6020NV',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'AR6020NV',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'AR6020NV',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'AR6020NV',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'AR6020DV',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '20',
            ],
            [
                'model_number'    => 'AR6020DV',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '11',
            ],
            [
                'model_number'    => 'AR6020DV',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '350',
            ],
            [
                'model_number'    => 'AR6020DV',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'AR6020DV',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'AR6020DV',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'AR6020DV',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'AR6020V',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '20',
            ],
            [
                'model_number'    => 'AR6020V',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '11',
            ],
            [
                'model_number'    => 'AR6020V',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '350',
            ],
            [
                'model_number'    => 'AR6020V',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'AR6020V',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'AR6020V',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'AR6020V',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXB456W',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '45',
            ],
            [
                'model_number'    => 'MXB456W',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXB456W',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '550',
            ],
            [
                'model_number'    => 'MXB456W',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXB456W',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXB456W',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXB456W',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXB450W',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '45',
            ],
            [
                'model_number'    => 'MXB450W',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXB450W',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '550',
            ],
            [
                'model_number'    => 'MXB450W',
                'attribute_name'  => 'memory',
                'attribute_value' => '1',
            ],
            [
                'model_number'    => 'MXB450W',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXB450W',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXB450W',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXB356W',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '35',
            ],
            [
                'model_number'    => 'MXB356W',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXB356W',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '550',
            ],
            [
                'model_number'    => 'MXB356W',
                'attribute_name'  => 'memory',
                'attribute_value' => '5',
            ],
            [
                'model_number'    => 'MXB356W',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXB356W',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXB356W',
                'attribute_name'  => 'sorting',
                'attribute_value' => 'Igen',
            ],
            [
                'model_number'    => 'MXB350W',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '35',
            ],
            [
                'model_number'    => 'MXB350W',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXB350W',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '550',
            ],
            [
                'model_number'    => 'MXB350W',
                'attribute_name'  => 'memory',
                'attribute_value' => '1',
            ],
            [
                'model_number'    => 'MXB350W',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXB350W',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXB350W',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXB707P',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '66',
            ],
            [
                'model_number'    => 'MXB707P',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXB707P',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MXB707P',
                'attribute_name'  => 'memory',
                'attribute_value' => '1 / 5',
            ],
            [
                'model_number'    => 'MXB707P',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXB707P',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXB707P',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXB557P',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '52',
            ],
            [
                'model_number'    => 'MXB557P',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXB557P',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '650',
            ],
            [
                'model_number'    => 'MXB557P',
                'attribute_name'  => 'memory',
                'attribute_value' => '1 / 5',
            ],
            [
                'model_number'    => 'MXB557P',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '500',
            ],
            [
                'model_number'    => 'MXB557P',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXB557P',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXB450P',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '45',
            ],
            [
                'model_number'    => 'MXB450P',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXB450P',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '550',
            ],
            [
                'model_number'    => 'MXB450P',
                'attribute_name'  => 'memory',
                'attribute_value' => '1',
            ],
            [
                'model_number'    => 'MXB450P',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXB450P',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXB450P',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXB350P',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '35',
            ],
            [
                'model_number'    => 'MXB350P',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXB350P',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '550',
            ],
            [
                'model_number'    => 'MXB350P',
                'attribute_name'  => 'memory',
                'attribute_value' => '1',
            ],
            [
                'model_number'    => 'MXB350P',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MXB350P',
                'attribute_name'  => 'duplex',
                'attribute_value' => 'STD',
            ],
            [
                'model_number'    => 'MXB350P',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS521dn',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS521dn',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS521dn',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS521dn',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS521dn',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS521dn',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS521dn',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS621dn',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS621dn',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS621dn',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS621dn',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS621dn',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS621dn',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS621dn',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS711dn',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS711dn',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS711dn',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS711dn',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS711dn',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS711dn',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS711dn',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS823dn',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS823dn',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS823dn',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS823dn',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS823dn',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS823dn',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MS823dn',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CS622de',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CS622de',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CS622de',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CS622de',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CS622de',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CS622de',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CS622de',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX521de',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX521de',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX521de',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX521de',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX521de',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX521de',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX521de',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX521ade',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX521ade',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX521ade',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX521ade',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX521ade',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX521ade',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX521ade',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX522adhe',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX522adhe',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX522adhe',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX522adhe',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX522adhe',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX522adhe',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX522adhe',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX622adhe',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX622adhe',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX622adhe',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX622adhe',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX622adhe',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX622adhe',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX622adhe',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX722ade',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX722ade',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX722ade',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX722ade',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX722ade',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX722ade',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'MX722ade',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX522ade',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX522ade',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX522ade',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX522ade',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX522ade',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX522ade',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX522ade',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX622ade',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX622ade',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX622ade',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX622ade',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX622ade',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX622ade',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX622ade',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX725de',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX725de',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX725de',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX725de',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX725de',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX725de',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX725de',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX725dhe',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX725dhe',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX725dhe',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX725dhe',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX725dhe',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX725dhe',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'CX725dhe',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PNCD701',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PNCD701',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PNCD701',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PNCD701',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PNCD701',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PNCD701',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PNCD701',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN85TH1',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN85TH1',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN85TH1',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN85TH1',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN85TH1',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN85TH1',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN85TH1',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN75TH1',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN75TH1',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN75TH1',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN75TH1',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN75TH1',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN75TH1',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN75TH1',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN65TH1',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN65TH1',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN65TH1',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN65TH1',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN65TH1',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN65TH1',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN65TH1',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN80TH5',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN80TH5',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN80TH5',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN80TH5',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN80TH5',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN80TH5',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN80TH5',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN70TH5',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN70TH5',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN70TH5',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN70TH5',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN70TH5',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN70TH5',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN70TH5',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN60TB3',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN60TB3',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN60TB3',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN60TB3',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN60TB3',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN60TB3',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN60TB3',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN86HC1',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN86HC1',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN86HC1',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN86HC1',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN86HC1',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN86HC1',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN86HC1',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN75HC1',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN75HC1',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN75HC1',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN75HC1',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN75HC1',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN75HC1',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN75HC1',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN70HC1E',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN70HC1E',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN70HC1E',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN70HC1E',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN70HC1E',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN70HC1E',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN70HC1E',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN50TC1',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN50TC1',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN50TC1',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN50TC1',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN50TC1',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN50TC1',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN50TC1',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN40TC1',
                'attribute_name'  => 'printing_speed_a4_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN40TC1',
                'attribute_name'  => 'printing_speed_a3_bw',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN40TC1',
                'attribute_name'  => 'paper_feed_capacity',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN40TC1',
                'attribute_name'  => 'memory',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN40TC1',
                'attribute_name'  => 'builtin_hard_drive',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN40TC1',
                'attribute_name'  => 'duplex',
                'attribute_value' => '',
            ],
            [
                'model_number'    => 'PN40TC1',
                'attribute_name'  => 'sorting',
                'attribute_value' => '',
            ],

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
