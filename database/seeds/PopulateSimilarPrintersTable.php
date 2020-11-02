<?php

namespace Database\Seeders;

use App\Printer;
use App\SimilarPrinter;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;

class PopulateSimilarPrintersTable extends Seeder
{
    /**
     * @throws Exception
     */
    public function run()
    {
        $dataSet = $this->getRawDataSet();
        $this->addOrUpdateMultipleRecords($dataSet);
    }

    private function getRawDataSet()
    {
        $dataSetToReturn = [];
        $dataSet = [
            ['MX6071' => ['MX4071', 'MX5051', 'MX5071',],],
            ['MX6051' => ['MX5051', 'MX5071', 'MX6071',],],
            ['MX5071' => ['MX5051', 'MX6051', 'MX6071',],],
            ['MX5051' => ['MX4051', 'MX6051', 'MX5071',],],
            ['MX4141N' => ['MX4051', 'MX4061', 'MX5051',],],
            ['MX4071' => ['MX4051', 'MX5071', 'MX6071',],],
            ['MX4061' => ['MX4051', 'MX4071', 'MX5071',],],
            ['MX4051' => ['MX3051', 'MX3571', 'MX4071',],],
            ['MX3571' => ['MX3551', 'MX3071', 'MX4071',],],
            ['MX3561' => ['MX3551', 'MX3571', 'MX4071',],],
            ['MX3551' => ['MX2651', 'MX4051', 'MX4071',],],
            ['MX3140N' => ['MX2651', 'MX3051', 'MX3071',],],
            ['MX3071' => ['MX3551', 'MX4071', 'MX5071',],],
            ['MX3061' => ['MX2651', 'MX3051', 'MX4061',],],
            ['MX3051' => ['MX2651', 'MX3551', 'MX3561',],],
            ['MX2651' => ['MX3051', 'MX3551', 'MX3061',],],
            ['MX2614N' => ['MX2651', 'MX3051', 'MX3071',],],
            ['MXC304W' => ['MXC303W', 'CX622ade', 'MX3551',],],
            ['MXC303W' => ['MXC304W', 'CX522ade', 'MX3051',],],
            ['MXC607P' => ['MXC407P', 'MXC507P', 'MX6071',],],
            ['MXC507P' => ['MXC407P', 'MXC607P', 'MX5071',],],
            ['MXC407P' => ['MXC507P', 'MXC607P', 'MX4071',],],
            ['MXM904' => ['MXM7570', 'MX6071', 'MXM6570',],],
            ['MXM7570' => ['MXM6071', 'MXM6570', 'MX6071',],],
            ['MXM6570' => ['MXM5071', 'MXM6071', 'MX6071',],],
            ['MXM6071' => ['MXM5071', 'MXM6051', 'MX6071',],],
            ['MXM6051' => ['MXM5051', 'MXM6071', 'MX6051',],],
            ['MXM564N' => ['MXM5051', 'MXM6071', 'MX5071',],],
            ['MXM5071' => ['MXM5051', 'MXM6071', 'MX5071',],],
            ['MXM5051' => ['MXM4051', 'MXM5071', 'MX5051',],],
            ['MXM503U' => ['MXM4051', 'MXM5051', 'MX5051',],],
            ['MXM465N' => ['MXM4051', 'MXM4071', 'MX4071',],],
            ['MXM464N' => ['MXM3051', 'MXM3071', 'MX3561',],],
            ['MXM452N' => ['MXM4051', 'MXM4071', 'MX4071',],],
            ['MXM453U' => ['MXM3051', 'MXM3071', 'MX3561',],],
            ['MXM4071' => ['MXM3071', 'MXM5071', 'MX4071',],],
            ['MXM4051' => ['MXM3051', 'MXM4071', 'MX4051',],],
            ['MXM4050' => ['MXM4051', 'MXM3571', 'MX3051',],],
            ['MXM365N' => ['MXM2651', 'MXM4051', 'MX3061',],],
            ['MXM364N' => ['MXM2651', 'MXM3550', 'MX3051',],],
            ['MXM3571' => ['MXM2651', 'MXM4071', 'MX3061',],],
            ['MXM3570' => ['MXM2651', 'MXM3571', 'MX3551',],],
            ['MXM3551' => ['MXM2651', 'MXM4071', 'MX3551',],],
            ['MXM3550' => ['MXM2651', 'MXM3051', 'MX3551',],],
            ['MXM356NV' => ['MXM2651', 'MXM3051', 'MX3051',],],
            ['MXM316NV' => ['MXM2651', 'MXM3051', 'MX2651',],],
            ['MXM3071' => ['MXM2651', 'MXM4071', 'MX3071',],],
            ['MXM3070' => ['MXM2651', 'MXM3071', 'MX3551',],],
            ['MXM3051' => ['MXM2651', 'MXM3551', 'MX3051',],],
            ['MXM3050' => ['MXM2651', 'MXM3071', 'MX2651',],],
            ['MXM2651' => ['MXM3051', 'MXM3551', 'MX2651',],],
            ['MXM2630' => ['MXM2651', 'MXM3071', 'MX2651',],],
            ['MXM266NV' => ['AR6023NV', 'MXM2651', 'MX2651',],],
            ['AR6023NV' => ['AR6020NV', 'MXM266NV', 'MX2651',],],
            ['AR6020NV' => ['AR6023NV', 'MXM266NV', 'MXM2651',],],
            ['AR6020DV' => ['AR6020NV', 'AR6023NV', 'MXM266NV',],],
            ['AR6020V' => ['AR6020DV', 'AR6020NV', 'AR6023NV',],],
            ['MXB456W' => ['MXB450W', 'MXB356W', 'MXC304W',],],
            ['MXB450W' => ['MXB450P', 'MXB456W', 'MXC304W',],],
            ['MXB356W' => ['MXB350W', 'MXB456W', 'MXC304W',],],
            ['MXB350W' => ['MXB350P', 'MXB356W', 'MXC304W',],],
            ['MXB707P' => ['MXB557P', 'MXB456W', 'MXC304W',],],
            ['MXB557P' => ['MXB450P', 'MXB450W', 'MXC304W',],],
            ['MXB450P' => ['MXB350P', 'MXB450W', 'MXC304W',],],
            ['MXB350P' => ['MXB450P', 'MXB350W', 'MXC303W',],],
            ['MS521dn' => ['MS621dn', 'MX521de', 'CX522ade',],],
            ['MS621dn' => ['MS621dn', 'MS711dn', 'MX521de',],],
            ['MS711dn' => ['MS823dn', 'MX722ade', 'CS622de',],],
            ['MS823dn' => ['MS711dn', 'MX722ade', 'CS622de',],],
            ['CS622de' => ['CX522ade', 'CX622ade', 'MS621dn',],],
            ['MX521de' => ['MX521ade', 'MX622adhe', 'CX522ade',],],
            ['MX521ade' => ['MX521de', 'MX622adhe', 'CX522ade',],],
            ['MX522adhe' => ['MX521ade', 'MX622adhe', 'CX522ade',],],
            ['MX622adhe' => ['MX521ade', 'MX722ade', 'CX622ade',],],
            ['MX722ade' => ['MX521ade', 'MX622adhe', 'CX622ade',],],
            ['CX522ade' => ['CX622ade', 'CX725de', 'MXB356W',],],
            ['CX622ade' => ['CX522ade', 'CX725de', 'MXB456W',],],
            ['CX725de' => ['CX622ade', 'CX522ade', 'MXB456W',],],
            ['CX725dhe' => ['CX622ade', 'CX725de', 'MX6071',],],
        ];

        foreach ($dataSet as $dataRow) {
            $modelNumber = array_keys($dataRow)[0];
            $printer = Printer::findByModelNumber($modelNumber);
            if (is_null($printer)) {
                throw new Exception('Printer with <' . $modelNumber . '> model number can not be found!');
            }
            foreach ($dataRow[$modelNumber] as $index => $similarModeNumber) {
                $relatedPrinter = Printer::findByModelNumber($similarModeNumber);
                if (is_null($relatedPrinter)) {
                    throw new Exception(
                        'Similar printer with <' . $similarModeNumber . '> model number can not be found!'
                    );
                }
                $dataSetToReturn[] = [
                    'printer_id'         => $printer->id,
                    'similar_printer_id' => $relatedPrinter->id,
                ];
            }
        }

        return $dataSetToReturn;
    }

    private function addOrUpdateMultipleRecords($dataSet)
    {
        $positions = [];
        foreach ($dataSet as $dataRow) {
            $printer = Printer::find($dataRow['printer_id']);
            if (is_null($printer)) {
                throw new Exception('Printer with id <' . $dataRow['printer_id'] . '> can not be found!');
            }

            $relatedPrinter = Printer::find($dataRow['similar_printer_id']);
            if (is_null($relatedPrinter)) {
                throw new Exception(
                    'Similar printer with id <' . $dataRow['similar_printer_id'] . '> can not be found!'
                );
            }

            $similarprinter = SimilarPrinter::where('printer_id', $printer->id)
                                            ->where('similar_printer_id', $relatedPrinter->id)
                                            ->get()
                                            ->first();
            if (!array_key_exists($printer->id, $positions)) {
                $positions[$printer->id] = 1;
            } else {
                $positions[$printer->id]++;
            }
            $similarprinterArr = [
                'printer_id'         => $printer->id,
                'similar_printer_id' => $relatedPrinter->id,
                'position'           => $positions[$printer->id],
                'relationtype'       => Printer::RELATIONTYPE_SIMILAR,
            ];

            if (is_null($similarprinter)) {
                $similarprinterArr['created_at'] = Carbon::now();
                SimilarPrinter::create($similarprinterArr);
            } else {
                $similarprinterArr['updated_at'] = Carbon::now();
                $similarprinter->update($similarprinterArr);
            }
        }
    }

}
