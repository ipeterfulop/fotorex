<div class="flex items-center justify-start flex-nowrap flex-row">
    @if($printer->printing >= \App\Helpers\DeviceFunctionality::BW_ID)
        <div class="printer-detail-box" style="background-color: #e30450">PRINT</div>
    @endif
    @if($printer->copying >= \App\Helpers\DeviceFunctionality::BW_ID)
        <div class="printer-detail-box" style="background-color: #ff5502">COPY</div>
    @endif
    @if($printer->scanning >= \App\Helpers\DeviceFunctionality::BW_ID)
        <div class="printer-detail-box" style="background-color: #e62899">SCAN</div>
    @endif
    <div class="printer-detail-box" style="background-color: #00aad2">
        {{ $printer->max_papersize->code }}
    </div>
    @if($printer->networked >= 2)
        <div class="printer-detail-box" style="background-color: #4891dc">NET<br>WORK</div>
    @endif
    <div class="printer-detail-box" style="{{ \App\Helpers\ColorTechnology::getDetailBoxCSS($printer->printing) }}">
        {!! \App\Helpers\ColorTechnology::getDetailBoxLabel($printer->color_management) !!}
    </div>

</div>
