<?php


namespace App\Dataproviders;


use App\Attribute;
use App\Helpers\DeviceFunctionality;
use App\Manufacturer;
use App\Printer;
use App\PrinterAttribute;
use App\PrinterPapersize;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PrinterDataprovider
{
    const ITEMS_PER_INDEX_PAGE = 12;
    protected $attributes;

    public function __construct()
    {
        $this->attributes = Attribute::all()->keyBy('variable_name');
    }

    public function getPrinters($page, $sortingOption)
    {
        $query = $this->getPrintersQuery($sortingOption, request());
        $result = new DataproviderResult();
        $result->totalCount = (clone $query)->get()->count();
        $result->results = self::addPaginationToQuery($query, $page)->get();
        $result->itemsPerPage = self::ITEMS_PER_INDEX_PAGE;
        $result->currentPage = $page;
        $result->indexRouteName = 'list_printers';
        $result->sortingOption = $sortingOption;
        $result->routingOptions = [];
        $result->pages = (int)ceil($result->totalCount / $result->itemsPerPage);

        return $result;
    }

    protected function getPrintersQuery($sortingOption, Request $request)
    {
        $attributes = Attribute::with(['attribute_value_set'])->get()->keyBy('variable_name');
        $query = Printer::withAttributes()
            ->enabled()
            ->when($request->get('search', '') != '', function($query) use ($request) {
                return $query->where(function($query) use ($request) {
                    $manufacturerIds = Manufacturer::where('name', 'like', '%'.$request->get('search').'%')->get()->pluck('id');
                    return $query->where('description', 'like', '%'.$request->get('search').'%')
                        ->orWhereIn('manufacturer_id', $manufacturerIds)
                        ->orWhere('name', 'like', '%'.$request->get('search').'%')
                        ->orWhere('model_number', 'like', '%'.$request->get('search').'%')
                        ->orWhere('model_number_displayed', 'like', '%'.$request->get('search').'%');
                });
            })
            ->when($request->get('price', '') != '', function ($query) use ($request) {
                $range = explode('-', $request->get('price'));
                return $query->where(function($query) use ($range) {
                    return $query->where('request_for_price', '=', 1)
                        ->orWhere('actualprice', '=', null)
                       ->orWhereBetween('actualprice', $range);
                });
            })
            ->when($request->get('usergroup', '') != '', function($query) use ($request) {
                $ids = explode(',', $request->get('usergroup'));
                return $query->whereIn('usergroup_size_id', $ids);
            })
            ->when($request->get('papersize', '') != '', function($query) use ($request) {
                return $query->whereIn('id', PrinterPapersize::distinct('printer_id')->where('papersize_id', '=', $request->get('papersize'))->get()->pluck('printer_id'));
            });
        foreach ($attributes as $variableName => $attribute) {
            if (request()->has($variableName)) {
                $values = collect(explode(',', $request->get($variableName)));
                $query = $query->having($variableName, '=', $values->max());
            }
        }

        return $query;
    }

    protected static function addPaginationToQuery(Builder $query, $page = 1)
    {
        return $query->skip(($page - 1) * self::ITEMS_PER_INDEX_PAGE)
            ->take(self::ITEMS_PER_INDEX_PAGE);
    }
}
