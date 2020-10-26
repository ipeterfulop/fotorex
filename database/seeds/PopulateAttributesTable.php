<?php

namespace Database\Seeders;

use App\DatabaseSeedingAction;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PopulateAttributesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addOrUpdateAttributes();
    }

    private function addOrUpdateAttributes()
    {
        $dataSet = $this->getRawDataSet();
        $this->addOrUpdateRecords($dataSet);
    }

    private function addOrUpdateRecords(array $dataSet)
    {
        $table = 'attributes';
        $fields = [
            'id',
            'attribute_value_set_id',
            'attributegroup_id',
            'name',
            'label',
            'is_computed',
            'position_at_product_comparison',
            'variable_name',
            'created_at',
            'updated_at',
        ];
        DatabaseSeedingAction::insertOrUpdateMultipleRecords($table, $dataSet, $fields);
    }

    private function getRawDataSet()
    {
        $dataSet = [
            [
                'id'                             => '1',
                'name'                           => 'Nyomtatás',
                'label'                          => 'Print',
                'variable_name'                  => 'printing',
                'attribute_value_set_id'         => '3',
                'attribute_category_id'          => '1',
                'is_computed'                    => '0',
                'position_at_product_comparison' => 'null',
            ],
            [
                'id'                             => '2',
                'name'                           => 'Másolás',
                'label'                          => 'Copy',
                'variable_name'                  => 'copying',
                'attribute_value_set_id'         => '3',
                'attribute_category_id'          => '1',
                'is_computed'                    => '0',
                'position_at_product_comparison' => 'null',
            ],
            [
                'id'                             => '3',
                'name'                           => 'Szkennelés',
                'label'                          => 'Scan',
                'variable_name'                  => 'scanning',
                'attribute_value_set_id'         => '3',
                'attribute_category_id'          => '1',
                'is_computed'                    => '0',
                'position_at_product_comparison' => 'null',
            ],
            [
                'id'                             => '4',
                'name'                           => 'Fax',
                'label'                          => '',
                'variable_name'                  => 'faxing',
                'attribute_value_set_id'         => '4',
                'attribute_category_id'          => '1',
                'is_computed'                    => '0',
                'position_at_product_comparison' => 'null',
            ],
            [
                'id'                             => '10',
                'name'                           => 'Technológia',
                'label'                          => '',
                'variable_name'                  => 'technology',
                'attribute_value_set_id'         => '6',
                'attribute_category_id'          => '2',
                'is_computed'                    => '0',
                'position_at_product_comparison' => '1',
            ],
            [
                'id'                             => '11',
                'name'                           => 'Színkezelés',
                'label'                          => '',
                'variable_name'                  => 'color_management',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '2',
                'is_computed'                    => '1',
                'position_at_product_comparison' => '2',
            ],
            [
                'id'                             => '9',
                'name'                           => 'Helyi / Hálózatos',
                'label'                          => '',
                'variable_name'                  => 'networked',
                'attribute_value_set_id'         => '5',
                'attribute_category_id'          => '2',
                'is_computed'                    => '0',
                'position_at_product_comparison' => '3',
            ],
            [
                'id'                             => '6',
                'name'                           => 'Sebesség fekete-fehér max.(A4)',
                'label'                          => '',
                'variable_name'                  => 'printing_speed_a4_bw',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '2',
                'is_computed'                    => '0',
                'position_at_product_comparison' => '4',
            ],
            [
                'id'                             => '7',
                'name'                           => 'Sebesség színes max.(A4)',
                'label'                          => '',
                'variable_name'                  => 'printing_speed_a4_color',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '2',
                'is_computed'                    => '0',
                'position_at_product_comparison' => '5',
            ],
            [
                'id'                             => '12',
                'name'                           => 'Kétoldalas nyomtatás (Duplex)',
                'label'                          => '',
                'variable_name'                  => 'duplex',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '2',
                'is_computed'                    => '0',
                'position_at_product_comparison' => '6',
            ],
            [
                'id'                             => '13',
                'name'                           => 'Automatikus dokumentum adagoló',
                'label'                          => '',
                'variable_name'                  => 'automatic_document_feeder',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '2',
                'is_computed'                    => '0',
                'position_at_product_comparison' => '7',
            ],
            [
                'id'                             => '14',
                'name'                           => 'Szortírozás',
                'label'                          => '',
                'variable_name'                  => 'sorting',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '2',
                'is_computed'                    => '0',
                'position_at_product_comparison' => '8',
            ],
            [
                'id'                             => '15',
                'name'                           => 'Finisher funkciók',
                'label'                          => '',
                'variable_name'                  => 'finisher_functions',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '2',
                'is_computed'                    => '0',
                'position_at_product_comparison' => '9',
            ],
            [
                'id'                             => '16',
                'name'                           => 'Papíradagoló kapacitás',
                'label'                          => '',
                'variable_name'                  => 'paper_feed_capacity',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '2',
                'is_computed'                    => '0',
                'position_at_product_comparison' => '10',
            ],
            [
                'id'                             => '17',
                'name'                           => 'Hardveres felbontás',
                'label'                          => '',
                'variable_name'                  => 'printing_resolution',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '2',
                'is_computed'                    => '0',
                'position_at_product_comparison' => '11',
            ],
            [
                'id'                             => '5',
                'name'                           => 'Nyomtatási méret max.',
                'label'                          => '',
                'variable_name'                  => 'max_papersize',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '2',
                'is_computed'                    => '1',
                'position_at_product_comparison' => '12',
            ],
            [
                'id'                             => '18',
                'name'                           => 'Memória',
                'label'                          => '',
                'variable_name'                  => 'memory',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '2',
                'is_computed'                    => '0',
                'position_at_product_comparison' => '13',
            ],
            [
                'id'                             => '19',
                'name'                           => 'Csatlakozók',
                'label'                          => '',
                'variable_name'                  => 'connectors',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '2',
                'is_computed'                    => '0',
                'position_at_product_comparison' => '14',
            ],
            [
                'id'                             => '20',
                'name'                           => 'Beépített merevlemez',
                'label'                          => '',
                'variable_name'                  => 'builtin_hard_drive',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '2',
                'is_computed'                    => '0',
                'position_at_product_comparison' => '15',
            ],
            [
                'id'                             => '21',
                'name'                           => 'Kijelző- / kezelőfelület',
                'label'                          => '',
                'variable_name'                  => 'display_user_interface',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '2',
                'is_computed'                    => '0',
                'position_at_product_comparison' => '16',
            ],
            [
                'id'                             => '22',
                'name'                           => 'Lapleíró nyelv',
                'label'                          => '',
                'variable_name'                  => 'descriptive_language',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '2',
                'is_computed'                    => '0',
                'position_at_product_comparison' => '17',
            ],
            [
                'id'                             => '23',
                'name'                           => 'Ajánlott terhelhetőség/hó (max.)',
                'label'                          => '',
                'variable_name'                  => 'recommended_load_per_month',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '2',
                'is_computed'                    => '0',
                'position_at_product_comparison' => '18',
            ],
            [
                'id'                             => '24',
                'name'                           => 'Opciók',
                'label'                          => '',
                'variable_name'                  => 'options',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '2',
                'is_computed'                    => '0',
                'position_at_product_comparison' => '19',
            ],
            [
                'id'                             => '25',
                'name'                           => 'Adatlap',
                'label'                          => '',
                'variable_name'                  => 'specification_sheet',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '3',
                'is_computed'                    => '0',
                'position_at_product_comparison' => 'null',
            ],
            [
                'id'                             => '26',
                'name'                           => 'Általános',
                'label'                          => '',
                'variable_name'                  => 'tsp_general',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '4',
                'is_computed'                    => '0',
                'position_at_product_comparison' => 'null',
            ],
            [
                'id'                             => '27',
                'name'                           => 'Másoló',
                'label'                          => '',
                'variable_name'                  => 'tsp_copier',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '4',
                'is_computed'                    => '0',
                'position_at_product_comparison' => 'null',
            ],
            [
                'id'                             => '28',
                'name'                           => 'Nyomtató',
                'label'                          => '',
                'variable_name'                  => 'tsp_printer',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '4',
                'is_computed'                    => '0',
                'position_at_product_comparison' => 'null',
            ],
            [
                'id'                             => '29',
                'name'                           => 'Szkenner',
                'label'                          => '',
                'variable_name'                  => 'tsp_scanner',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '4',
                'is_computed'                    => '0',
                'position_at_product_comparison' => 'null',
            ],
            [
                'id'                             => '30',
                'name'                           => 'Fax',
                'label'                          => '',
                'variable_name'                  => 'tsp_fax',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '4',
                'is_computed'                    => '0',
                'position_at_product_comparison' => 'null',
            ],
            [
                'id'                             => '31',
                'name'                           => 'Lapadagoló',
                'label'                          => '',
                'variable_name'                  => 'tsp_sheet_feeder',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '4',
                'is_computed'                    => '0',
                'position_at_product_comparison' => 'null',
            ],
            [
                'id'                             => '32',
                'name'                           => 'Finishing',
                'label'                          => '',
                'variable_name'                  => 'tsp_finishing',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '4',
                'is_computed'                    => '0',
                'position_at_product_comparison' => 'null',
            ],
            [
                'id'                             => '33',
                'name'                           => 'Dokumentum tárolás',
                'label'                          => '',
                'variable_name'                  => 'tsp_document_storage',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '4',
                'is_computed'                    => '0',
                'position_at_product_comparison' => 'null',
            ],
            [
                'id'                             => '34',
                'name'                           => 'Leírás',
                'label'                          => '',
                'variable_name'                  => 'description',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '2',
                'is_computed'                    => '0',
                'position_at_product_comparison' => 'null',
            ],
            [
                'id'                             => '35',
                'name'                           => 'MFP',
                'label'                          => '',
                'variable_name'                  => 'is_multifunctional',
                'attribute_value_set_id'         => '1',
                'attribute_category_id'          => '1',
                'is_computed'                    => '1',
                'position_at_product_comparison' => 'null',
            ],

            [
                'id'                             => '36',
                'name'                           => 'Link a gyártó oldalára',
                'label'                          => '',
                'variable_name'                  => 'product_url_on_manufacturer_website',
                'attribute_value_set_id'         => 'null',
                'attribute_category_id'          => '2',
                'is_computed'                    => '0',
                'position_at_product_comparison' => 'null',
            ],
        ];

        /**
         * @todo Ide további attribútumokat kell felvenni
         */

        foreach ($dataSet as &$dataRow) {
            $dataRow['created_at'] = Carbon::now();
            $dataRow['updated_at'] = Carbon::now();
            if ($dataRow['attribute_value_set_id'] == 'null') {
                $dataRow['attribute_value_set_id'] = null;
            }
            if ($dataRow['position_at_product_comparison'] == 'null') {
                $dataRow['position_at_product_comparison'] = null;
            }
        }

        return $dataSet;
    }
}
