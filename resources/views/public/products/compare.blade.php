@extends('layouts.tailwind.app')
@section('content')
    <style>
    </style>
    @push('printer-select')
        @include('public.partials.printers.selector', ['availablePrinters' => $availablePrinters])
    @endpush
    <div class="w-full bg-transparent flex justify-center my-8">
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
            <table id="printer-compare-table" class="printer-compare-table hidden md:table border-collapse">
                <thead>
                <tr>
                    <th></th>
                    <th id="comparable-0"
                        style="vertical-align: top"
                        data-column="0">@stack('printer-select') <img id="comparable-img-0"></th>
                    <th id="comparable-1"
                        style="vertical-align: top"
                        data-column="1">@stack('printer-select') <img id="comparable-img-1"></th>
                    <th id="comparable-2"
                        style="vertical-align: top"
                        data-column="2">@stack('printer-select') <img id="comparable-img-2"></th>
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
                createRow: function() {
                    let r = document.createElement('tr');
                    r.classList.add('bg-fotoverylightred', 'odd:bg-transparent');
                    return r;
                },
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
                        window.axios.get('{{ $dataUrl }}', {params: {printer: slug}})
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
                    tbl.classList.add('w-full');
                    let tb = document.createElement('tbody');
                    this.comparedAttributes.forEach((a, attributeIndex) => {
                        r = this.createRow();
                        t = document.createElement('td');
                        t.setAttribute('colspan', 2)
                        t.classList.add('font-bold', 'text-left', 'text-fotored', 'pt-4', 'pb-2');
                        t.innerHTML = a.n;
                        r.appendChild(t);
                        tb.appendChild(r);
                        this.printerData.forEach((p) => {
                            r = this.createRow();
                            t = document.createElement('td');
                            t.classList.add('font-bold', 'text-left');
                            if (p == null) {
                                t.innerHTML = 'Válasszon terméket';
                                t.classList.add('text-gray-400');
                            } else {
                                let a = document.createElement('a');
                                a.setAttribute('href', p.link);
                                a.innerHTML = p.displayname;
                                t.appendChild(a);
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
                createNormalAttributeRow: function(aN, aV) {
                    r = this.createRow();
                    t = document.createElement('td');
                    t.innerHTML = aN;
                    t.classList.add('font-bold', 'text-gray-900')
                    r.appendChild(t);
                    this.printerData.forEach((p, printerIndex) => {
                        t = document.createElement('td');
                        t.classList.add('printer-td', 'text-center');
                        if (printerIndex == 1) {
                            t.classList.add('border-0','border-l','border-r','border-dotted','border-fotogray');
                        }
                        t.innerHTML = p == null ? '-' : p[aV];
                        if (p == null) {
                            t.classList.add('text-gray-400');
                        }

                        r.appendChild(t);
                    });
                    return r;
                },
                renderNormal: function() {
                    let newBody = document.createElement('tbody');
                    let r = this.createRow();
                    let t = document.createElement('td');
                    r.appendChild(t);
                    this.printerData.forEach((p, printerIndex) => {
                        document.getElementById('comparable-img-'+printerIndex).setAttribute(
                            'src',
                            p == null ? '/images/assets/placeholder.png' : p.photo
                        );
                    });
                    newBody.appendChild(r);

                    this.comparedAttributes.forEach((a, attributeIndex) => {
                        r = this.createNormalAttributeRow(a.n, a.v);
                        newBody.appendChild(r);
                    });
                    r = this.createNormalAttributeRow('Részletek', 'linkbutton');
                    newBody.appendChild(r);
                    this.tableNode.querySelector('tbody').innerHTML = newBody.innerHTML;
                }
            }
            window.addEventListener('load', () => {
                printerCompareTable.initialize();
            });
        </script>
    </div>
@endsection