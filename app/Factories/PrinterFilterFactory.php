<?php


namespace App\Factories;


use App\Searching\CheckboxgroupSearchField;
use App\Searching\TextSearchField;
use App\UsergroupSize;
use Illuminate\Database\Eloquent\Builder;

class PrinterFilterFactory
{
    public static function createFilters()
    {
        $result = [];
        $result[] = (new TextSearchField())->setLabel('Keresés')->setField('description');
        $result[] = (new CheckboxgroupSearchField())->setLabel('Funkciók')
            ->setField('modes')
            ->setValueset([
                1 => 'Nyomtatás',
                2 => 'Másolás',
                3 => 'Lapolvasás',
            ]);

        $result[] = (new CheckboxgroupSearchField())->setLabel('Csoportméret')
            ->setField('usergroup_size_id')
            ->setValueset(UsergroupSize::orderBy('position', 'asc')->get()->pluck('name', 'id'));

        return $result;
    }
}
