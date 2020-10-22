<?php


namespace App;


use Illuminate\Support\Collection;

class CollectionUtility
{

    /**
     * @param Collection $collectionOfObjects
     * @param $field
     * @return Collection
     */
    public static function getFieldValuesOfObjectCollection(Collection $collectionOfObjects, $field)
    {
        return $collectionOfObjects->values()
                                   ->reduce(
                                       function ($collector, $item) use ($field) {
                                           if (isset($item->$field)) {
                                               return $collector->push($item->$field);
                                           } else {
                                               return $collector;
                                           }
                                       },
                                       new Collection()
                                   );
    }

    public static function hasObjectCollectionFieldWithGivenValue(
        Collection $collectionOfObjects,
        string $field,
        string $value
    ) {
        return self::getFieldValuesOfObjectCollection($collectionOfObjects, $field)->contains($value);
    }

}
