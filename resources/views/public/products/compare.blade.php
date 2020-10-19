@extends('layouts.tailwind.app')
@section('content')
    <style>
    </style>
    @push('printer-select')
        @include('public.partials.printers.selector', ['availablePrinters' => $availablePrinters])
    @endpush
    <div class="w-full bg-transparent flex flex-col justify-center my-8">
        <div class="w-full max-width-container border bg-white p-4">
            <div class="printer-compare-list w-full flex md:hidden flex-col justify-start items-stretch">
                <div class="flex flex-col">
                    <div id="comparable-mobile-0" class="p-2" data-column="0">@stack('printer-select')</div>
                    <div id="comparable-mobile-1" class="p-2" data-column="1">@stack('printer-select')</div>
                    <div id="comparable-mobile-2" class="p-2" data-column="2">@stack('printer-select')</div>
                    <div id="printer-compare-list-inner" class="pl-4">

                    </div>
                </div>
            </div>
            <table id="printer-compare-table" class="printer-compare-table hidden md:table">
                <thead>
                <tr>
                    <th></th>
                    <th id="comparable-0" data-column="0">@stack('printer-select')</th>
                    <th id="comparable-1" data-column="1">@stack('printer-select')</th>
                    <th id="comparable-2" data-column="2">@stack('printer-select')</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <script>
            let printerCompareTable = {
                selectedPrinters: {!! json_encode($printers) !!},
                printerData: [null, null, null],
                comparedAttributes: {!! $comparedAttributes->toJson() !!},
                tableNode: document.getElementById('printer-compare-table'),
                mobileNode: document.getElementById('printer-compare-list-inner'),
                initialize: function() {
                    if (this.selectedPrinters.length > 0) {
                        document.querySelector('#comparable-mobile-0').querySelector('select').value = this.selectedPrinters[0];
                        this.tableNode.querySelector('#comparable-0').querySelector('select').value = this.selectedPrinters[0];
                        this.fetchPrinterData(this.tableNode.querySelector('#comparable-0').querySelector('select'));
                    }
                },
                fetchPrinterData: function(sender) {
                    let slug = sender.value;
                    let index = sender.parentNode.getAttribute('data-column');
                    if (slug == -1) {
                        this.printerData[index] = null;
                        this.render();
                    } else {
                        window.axios.get('{{ route('product_comparison_data') }}', {params: {printer: slug}})
                            .then((response) => {
                                this.printerData[index] = response.data;
                                this.render();
                            }).catch((error) => {
                        });
                    }
                },
                render: function() {
                    this.renderNormal();
                    this.renderMobile();
                },
                renderMobile: function() {
                    let tbl = document.createElement('table');
                    let tb = document.createElement('tbody');
                    this.comparedAttributes.forEach((a, attributeIndex) => {
                        r = document.createElement('tr');
                        t = document.createElement('td');
                        t.setAttribute('colspan', 2)
                        t.classList.add('font-bold', 'text-left', 'text-fotored');
                        t.innerHTML = a.n;
                        r.appendChild(t);
                        tb.appendChild(r);
                        this.printerData.forEach((p) => {
                            r = document.createElement('tr');
                            t = document.createElement('td');
                            t.classList.add('font-bold', 'text-left');
                            t.innerHTML = p == null ? 'Válasszon terméket' : p.name;
                            if (p == null) {
                                t.classList.add('text-gray-400');
                            }
                            r.appendChild(t);
                            t = document.createElement('td');
                            t.classList.add('text-right');
                            t.innerHTML = p == null ? '-' : p[a.v];
                            if (p == null) {
                                t.classList.add('text-gray-400');
                            }
                            r.appendChild(t);
                            tb.appendChild(r);
                        });
                        tb.appendChild(r);
                    });
                    tbl.appendChild(tb);
                    this.mobileNode.innerHTML = '';
                    this.mobileNode.appendChild(tbl);
                },
                renderNormal: function() {
                    let newBody = document.createElement('tbody');
                    let r = document.createElement('tr');
                    let t = document.createElement('td');
                    r.appendChild(t);
                    this.printerData.forEach((p) => {
                        t = document.createElement('td');
                        t.classList.add('printer-td');
                        //t.classList.add('flex', 'items-center', 'justify-center', 'p-2')
                        if (p != null) {
                            let img = document.createElement('img');
                            img.classList.add('object-contain', 'w-full');
                            img.setAttribute('src', p.photo)
                            t.appendChild(img);
                        }
                        r.appendChild(t);
                    });
                    newBody.appendChild(r);

                    this.comparedAttributes.forEach((a, attributeIndex) => {
                        r = document.createElement('tr');
                        t = document.createElement('td');
                        t.innerHTML = a.n;
                        r.appendChild(t);
                        this.printerData.forEach((p) => {
                            t = document.createElement('td');
                            t.classList.add('printer-td');
                            t.innerHTML = p == null ? '-' : p[a.v];
                            if (p == null) {
                                t.classList.add('text-gray-400');
                            }

                            r.appendChild(t);
                        });
                        newBody.appendChild(r);
                    });
                    this.tableNode.querySelector('tbody').innerHTML = newBody.innerHTML;
                }
            }
            window.addEventListener('load', () => {
                printerCompareTable.initialize();
            });
        </script>
    </div>
@endsection