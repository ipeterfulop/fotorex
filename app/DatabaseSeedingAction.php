<?php

namespace App;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class DatabaseSeedingAction
{
    /**
     * @param string $table
     * @param array $source
     */
    public static function insertOrUpdateRecord(string $table, array $source)
    {
        try {
            $itemsFound = DB::table($table)
                            ->where('id', $source['id'])
                            ->get()
                            ->count();

            if ($itemsFound > 0) {
                DB::table($table)->where('id', $source['id'])->update($source);
            } else {
                DB::table($table)->insert($source);
            }
        } catch (\Exception $ex) {
            print "\n Database operation failed while adding to table <" . $table . "> the values below withe the exception: ".$ex->getMessage()." \n"
                . print_r($source, true);
        }
    }

    /**
     * @param string $table
     * @param array $dataSet
     * @param array $onlyFields
     */
    public static function insertOrUpdateMultipleRecords(string $table, array $dataSet, array $onlyFields): void
    {
        foreach ($dataSet as $dataRow) {
            $source = (count($onlyFields) > 0)
                ? collect($dataRow)->only($onlyFields)->all()
                : $dataRow;
            self::insertOrUpdateRecord($table, $source);
        }
    }

}
