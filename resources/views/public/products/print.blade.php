<html>
<link type="text/css" href="/css/print.css">
<table style="width: 100%" border="0">
    <tr>
        <td style="width: 50%" valign="top">
            <p style="font-weight: bold; font-size: 20px;">{{ $product->shortdisplayname }}</p>
            <hr>
            <table border="1">
                @foreach ($attributes as $attribute)
                    <tr>
                        <td border="1">
                            {{ $attribute['n'] }}
                        </td>
                        <td border="1">
                            {!! $product->{$attribute['v']} !!}
                        </td>
                    </tr>
                @endforeach
            </table>
        </td>
        <td style="width: 50%" valign="top">
            <img src="{{ $product->getMainImageUrl(request()->get('printerphotoroles')->get('index')) }}" style="width: 85%">
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <p>{!! $product->description  !!}</p>
        </td>
    </tr>
</table>
<hr>
<table style="width: 100%" border="0">
    <tr>
        <td colspan="2">
            <p style="font-size: 20px; font-weight: bold">Vásárlás</p>
            {!! $product->price_label !!}
        </td>
    </tr>
</table>
<hr>
<table style="width: 100%" border="0">
    @if($product->printerrentaloptions->isNotEmpty())
        <tr>
            <td colspan="2">
                <p style="font-size: 20px; font-weight: bold">Bérleti lehetőségek</p>
                @foreach($product->printerrentaloptions as $option)
                    <div><strong>Bérleti díj: </strong>
                        {!! \App\Helpers\RentalPeriodUnit::formatPriceWithSuffix($product->rentalprice, $option->rentaloption->rental_period_unit) !!}
                    </div>
                    <div><strong>Havi oldalszám (ff): </strong>
                        {{ \App\Helpers\PriceFormatter::formatToInteger($option->rentaloption->number_of_pages_included_bw, '') }}
                    </div>
                    @if($product->color_management == \App\Helpers\ColorTechnology::COLOR_ID)
                        <div><strong>Havi oldalszám (színes):</strong>
                            {{ \App\Helpers\PriceFormatter::formatToInteger($option->rentaloption->number_of_pages_included_color, '') }}
                        </div>
                    @endif
                @endforeach
            </td>
        </tr>
    @endif
</table>
</html>