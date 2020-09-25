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
            'use_at_product_comparison',
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
                'id'                        => '1',
                'name'                      => 'Nyomtatás',
                'label'                     => 'Print',
                'variable_name'             => 'printing',
                'attribute_value_set_id'    => '3',
                'attribute_category_id'     => '1',
                'is_computed'               => '0',
                'use_at_product_comparison' => '0',
            ],
            [
                'id'                        => '2',
                'name'                      => 'Másolás',
                'label'                     => 'Copy',
                'variable_name'             => 'copying',
                'attribute_value_set_id'    => '3',
                'attribute_category_id'     => '1',
                'is_computed'               => '0',
                'use_at_product_comparison' => '0',
            ],
            [
                'id'                        => '3',
                'name'                      => 'Szkennelés',
                'label'                     => 'Scan',
                'variable_name'             => 'scanning',
                'attribute_value_set_id'    => '3',
                'attribute_category_id'     => '1',
                'is_computed'               => '0',
                'use_at_product_comparison' => '0',
            ],
            [
                'id'                        => '4',
                'name'                      => 'Fax',
                'label'                     => null,
                'variable_name'             => 'faxing',
                'attribute_value_set_id'    => '1',
                'attribute_category_id'     => '1',
                'is_computed'               => '0',
                'use_at_product_comparison' => '0',
            ],
            [
                'id'                        => '10',
                'name'                      => 'Technológia',
                'label'                     => null,
                'variable_name'             => 'technology',
                'attribute_value_set_id'    => '6',
                'attribute_category_id'     => '2',
                'is_computed'               => '0',
                'use_at_product_comparison' => '1',
            ],
            [
                'id'                        => '11',
                'name'                      => 'Színkezelés',
                'label'                     => null,
                'variable_name'             => 'color_management',
                'attribute_value_set_id'    => '2',
                'attribute_category_id'     => '2',
                'is_computed'               => '0',
                'use_at_product_comparison' => '1',
            ],
            [
                'id'                        => '9',
                'name'                      => 'Helyi / Hálózatos',
                'label'                     => null,
                'variable_name'             => 'networked',
                'attribute_value_set_id'    => '5',
                'attribute_category_id'     => '2',
                'is_computed'               => '0',
                'use_at_product_comparison' => '1',
            ],
            [
                'id'                        => '6',
                'name'                      => 'Sebesség fekete-fehér max.(A4)',
                'label'                     => null,
                'variable_name'             => 'printing_speed_a4_bw',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '2',
                'is_computed'               => '0',
                'use_at_product_comparison' => '1',
            ],
            [
                'id'                        => '7',
                'name'                      => 'Sebesség színes max.(A4)',
                'label'                     => null,
                'variable_name'             => 'printing_speed_a4_color',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '2',
                'is_computed'               => '0',
                'use_at_product_comparison' => '1',
            ],
            [
                'id'                        => '12',
                'name'                      => 'Kétoldalas nyomtatás (Duplex)',
                'label'                     => null,
                'variable_name'             => 'duplex',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '2',
                'is_computed'               => '0',
                'use_at_product_comparison' => '1',
            ],
            [
                'id'                        => '13',
                'name'                      => 'Automatikus dokumentum adagoló',
                'label'                     => null,
                'variable_name'             => 'automatic_document_feeder',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '2',
                'is_computed'               => '0',
                'use_at_product_comparison' => '1',
            ],
            [
                'id'                        => '14',
                'name'                      => 'Szortírozás',
                'label'                     => null,
                'variable_name'             => 'sorting',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '2',
                'is_computed'               => '0',
                'use_at_product_comparison' => '1',
            ],
            [
                'id'                        => '15',
                'name'                      => 'Finisher funkciók',
                'label'                     => null,
                'variable_name'             => 'finisher_functions',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '2',
                'is_computed'               => '0',
                'use_at_product_comparison' => '1',
            ],
            [
                'id'                        => '16',
                'name'                      => 'Papíradagoló kapacitás',
                'label'                     => null,
                'variable_name'             => 'paper_feed_capacity',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '2',
                'is_computed'               => '0',
                'use_at_product_comparison' => '1',
            ],
            [
                'id'                        => '17',
                'name'                      => 'Hardveres felbontás',
                'label'                     => null,
                'variable_name'             => 'printing_resolution',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '2',
                'is_computed'               => '0',
                'use_at_product_comparison' => '1',
            ],
            [
                'id'                        => '5',
                'name'                      => 'Nyomtatási méret max.',
                'label'                     => null,
                'variable_name'             => 'papersize',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '2',
                'is_computed'               => '1',
                'use_at_product_comparison' => '1',
            ],
            [
                'id'                        => '18',
                'name'                      => 'Memória',
                'label'                     => null,
                'variable_name'             => 'memory',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '2',
                'is_computed'               => '0',
                'use_at_product_comparison' => '1',
            ],
            [
                'id'                        => '18',
                'name'                      => 'Csatlakozók',
                'label'                     => null,
                'variable_name'             => 'connectors',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '2',
                'is_computed'               => '0',
                'use_at_product_comparison' => '1',
            ],
            [
                'id'                        => '18',
                'name'                      => 'Beépített merevlemez',
                'label'                     => null,
                'variable_name'             => 'builtin_hard_drive',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '2',
                'is_computed'               => '0',
                'use_at_product_comparison' => '1',
            ],
            [
                'id'                        => '18',
                'name'                      => 'Kijelző- / kezelőfelület',
                'label'                     => null,
                'variable_name'             => 'display_user_interface',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '2',
                'is_computed'               => '0',
                'use_at_product_comparison' => '1',
            ],
            [
                'id'                        => '18',
                'name'                      => 'Lapleíró nyelv',
                'label'                     => null,
                'variable_name'             => 'descriptive_language',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '2',
                'is_computed'               => '0',
                'use_at_product_comparison' => '1',
            ],
            [
                'id'                        => '18',
                'name'                      => 'Ajánlott terhelhetőség/hó (max.)',
                'label'                     => null,
                'variable_name'             => 'recommended_load_per_month',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '2',
                'is_computed'               => '0',
                'use_at_product_comparison' => '1',
            ],
            [
                'id'                        => '18',
                'name'                      => 'Opciók',
                'label'                     => null,
                'variable_name'             => 'options',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '2',
                'is_computed'               => '0',
                'use_at_product_comparison' => '1',
            ],
            [
                'id'                        => '19',
                'name'                      => 'Adatlap',
                'label'                     => null,
                'variable_name'             => 'specification_sheet',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '3',
                'is_computed'               => '0',
                'use_at_product_comparison' => '0',
            ],
            [
                'id'                        => '20',
                'name'                      => 'Általános',
                'label'                     => null,
                'variable_name'             => 'tsp_general',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '4',
                'is_computed'               => '0',
                'use_at_product_comparison' => '0',
            ],
            [
                'id'                        => '21',
                'name'                      => 'Másoló',
                'label'                     => null,
                'variable_name'             => 'tsp_copier',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '4',
                'is_computed'               => '0',
                'use_at_product_comparison' => '0',
            ],
            [
                'id'                        => '22',
                'name'                      => 'Nyomtató',
                'label'                     => null,
                'variable_name'             => 'tsp_printer',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '4',
                'is_computed'               => '0',
                'use_at_product_comparison' => '0',
            ],
            [
                'id'                        => '23',
                'name'                      => 'Szkenner',
                'label'                     => null,
                'variable_name'             => 'tsp_scanner',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '4',
                'is_computed'               => '0',
                'use_at_product_comparison' => '0',
            ],
            [
                'id'                        => '24',
                'name'                      => 'Fax',
                'label'                     => null,
                'variable_name'             => 'tsp_fax',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '4',
                'is_computed'               => '0',
                'use_at_product_comparison' => '0',
            ],
            [
                'id'                        => '25',
                'name'                      => 'Lapadagoló',
                'label'                     => null,
                'variable_name'             => 'tsp_sheet_feeder',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '4',
                'is_computed'               => '0',
                'use_at_product_comparison' => '0',
            ],
            [
                'id'                        => '26',
                'name'                      => 'Finishing',
                'label'                     => null,
                'variable_name'             => 'tsp_finishing',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '4',
                'is_computed'               => '0',
                'use_at_product_comparison' => '0',
            ],
            [
                'id'                        => '27',
                'name'                      => 'Dokumentum tárolás',
                'label'                     => null,
                'variable_name'             => 'tsp_document_storage',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '4',
                'is_computed'               => '0',
                'use_at_product_comparison' => '0',
            ],
            [
                'id'                        => '28',
                'name'                      => 'Leírás',
                'label'                     => null,
                'variable_name'             => 'description',
                'attribute_value_set_id'    => null,
                'attribute_category_id'     => '2',
                'is_computed'               => '0',
                'use_at_product_comparison' => '0',
            ],
        ];

        /**
         * @todo Ide további attribútumokat kell felvenni
         */

        foreach ($dataSet as &$dataRow) {
            $dataRow['created_at'] = Carbon::now();
            $dataRow['updated_at'] = Carbon::now();
        }

        return $dataSet;
    }
}
