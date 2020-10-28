<style>
    .printer-detail-box {
        height: 60px;
        width:60px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        margin-left: .2rem;
        margin-right: .2rem;
        word-break: break-all;
        text-align: center;
    }
</style>
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
    <div class="printer-detail-box" style="background-color: #d1d4d3{{ \App\Helpers\ColorTechnology::getDetailBoxCSS($printer->color_technology) }}">
        {{ \App\Helpers\ColorTechnology::getDetailBoxLabel($printer->color_management) }}
    </div>

</div>
