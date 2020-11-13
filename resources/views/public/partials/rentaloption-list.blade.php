<table class="w-full">
    <thead>
    <tr>
        <th class="p-1 border border-fotolightgray text-center">Periódus</th>
        <th class="p-1 border border-fotolightgray text-center">Havi oldalszám (ff)</th>
        <th class="p-1 border border-fotolightgray text-center">Havi oldalszám (színes)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($element->printerrentaloptions as $option)
        <tr>
            <td class="p-1 border border-fotolightgray text-center">{{ $option->rentaloption->period_label }}</td>
            <td class="p-1 border border-fotolightgray text-right">{{ $option->rentaloption->number_of_pages_included_bw }}</td>
            <td class="p-1 border border-fotolightgray text-right">{{ $option->rentaloption->number_of_pages_included_color }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
