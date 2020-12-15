<?php

namespace Database\Seeders;

use App\DatabaseSeedingAction;
use App\Display;
use App\Printer;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PopulateHighlightedPrintersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataSet = $this->getRawDataSet();
        $this->addOrUpdateRecords($dataSet);
    }

    private function addOrUpdateRecords(array $dataSet)
    {
        $table = 'highlightedprinters';
        $fields = [
            'id',
            'printer_id',
            'position',
            'created_at',
        ];
        DatabaseSeedingAction::insertOrUpdateMultipleRecords($table, $dataSet, $fields);
    }

    private function getRawDataSet()
    {
        $modelnumbers = [
            'MS521dn',
            'MX521de',
            'CX622ade',
            'MXB350W',
            'MXM266NV',
            'MX2651',
        ];

        $dataSet = [];
        $position = 0;
        foreach ($modelnumbers as $modelnumber) {
            $printer = Printer::findByModelNumber($modelnumber);
            if (!is_null($printer)) {
                $dataset[] = [
                    'id'         => $printer->id,
                    'printer_id' => $printer->id,
                    'position'   => (++$position),
                    'created_at' => Carbon::now(),
                ];
            } else {
                $display = Display::findByModelNumber($modelnumber);
                if (!is_null($display)) {
                    $dataset[] = [
                        'id'         => $display->id,
                        'printer_id' => $display->id,
                        'position'   => (++$position),
                        'created_at' => Carbon::now(),
                    ];
                }
            }
        }

        return $dataSet;
    }
}
