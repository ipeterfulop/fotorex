<?php


namespace App\Dataproviders;


use App\Printer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PrinterDataprovider
{
    const ITEMS_PER_INDEX_PAGE = 12;

    public static function getPrinters($page, $sortingOption)
    {
        $query = self::getPrintersQuery($sortingOption, request());
        $result = new DataproviderResult();
        $result->totalCount = $query->count();
        $result->results = self::addPaginationToQuery($query, $page)->get();
        $result->itemsPerPage = self::ITEMS_PER_INDEX_PAGE;
        $result->currentPage = $page;
        $result->indexRouteName = 'list_printers';
        $result->sortingOption = $sortingOption;
        $result->routingOptions = [];
        $result->pages = (int)ceil($result->totalCount / $result->itemsPerPage);

        return $result;
    }

    protected static function getPrintersQuery($sortingOption, Request $request)
    {
        return Printer::query()
            ->join(\DB::raw('(select id as mid from manufacturers where is_enabled=1) m'), 'printers.manufacturer_id', '=', 'm.mid')
            ->enabled()
            ->when($request->get('search', '') != '', function($query) use ($request) {
                return $query->where(function($query) use ($request) {
                    return $query->where('description', 'like', '%'.$request->get('search').'%')
                        ->orWhere('name', 'like', '%'.$request->get('search').'%');
                });
            })
            ->when($request->get('modes', '') != '', function ($query) use ($request) {
                $modes = explode(',', $request->get('modes'));
                if (array_search(1, $modes) !== false) {
                    $query = $query->where('printing_mode', '=', 1);
                }
                if (array_search(2, $modes) !== false) {
                    $query = $query->where('copying_mode', '=', 1);
                }
                if (array_search(3, $modes) !== false) {
                    $query = $query->where('scanning_mode', '=', 1);
                }
                return $query;
            })
            ->when($request->get('manufacturer', '') != '', function($query) use ($request) {
                $ids = explode(',', $request->get('manufacturer'));
                return $query->whereIn('manufacturer_id', $ids);
            })
            ->when($request->get('usergroup', '') != '', function($query) use ($request) {
                $ids = explode(',', $request->get('usergroup'));
                return $query->whereIn('usergroup_size_id', $ids);
            });
    }

    protected static function addPaginationToQuery(Builder $query, $page = 1)
    {
        return $query->skip(($page - 1) * self::ITEMS_PER_INDEX_PAGE)
            ->take(self::ITEMS_PER_INDEX_PAGE);
    }

}
