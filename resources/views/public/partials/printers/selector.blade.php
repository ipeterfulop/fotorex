<select class="product-comparison-selector w-full" onchange="printerCompareTable.fetchPrinterData(this)">
    <optgroup label="Válasszon">
        <option value="-1">Válasszon terméket</option>
    </optgroup>
    @foreach($availablePrinters as $group => $printers)
    <optgroup label="{{$group}}">
        @foreach($printers as $printer)
            <option value="{{ $printer->slug }}">{{ $printer->name }}</option>
        @endforeach
    </optgroup>
    @endforeach
</select>