@extends('layouts.tailwind.app')
@section('content')
    <style>
        .printer-compare-table .attribute-th {
            width: 20rem;
            max-width: 20rem;
        }
        .printer-compare-table {
            width: 100%;
        }
        .printer-compare-table th {
            font-weight: bold;
        }
        .printer-compare-table td,
        .printer-compare-table th {
            border: 1px solid darkgrey;
            padding: .5rem;
        }
    </style>
    <div class="w-full bg-transparent flex flex-col justify-center my-8">
        <div class="w-full max-width-container border border-gray-200 bg-white p-4">
            <table id="printer-compare-table" class="printer-compare-table">
            </table>
        </div>
        <script>
            let printerCompareTable = {
                selectedPrinters: {!! json_encode($printers) !!},
                printerData: [],
                comparedAttributes: {!! $comparedAttributes->toJson() !!},
                manufacturers: {!! \App\Manufacturer::orderBy('name', 'asc')->get()->pluck('name')->toJson()  !!},
                printers: {!! \App\Helpers\ComparablePrinter::select('name', 'slug', 'mfname')->orderBy('name', 'asc')->get()->groupBy('mfname') !!},
                tableNode: document.getElementById('printer-compare-table'),
                initialize: function() {
                    if (this.selectedPrinters.length > 0) {
                        this.fetchPrinterData(this.selectedPrinters[0]);
                    }
                },
                fetchPrinterData: function(slug) {
                    window.axios.get('{{ route('product_comparison_data') }}', {params: {printer: slug}})
                        .then((response) => {
                            this.printerData.push(response.data);
                            this.render();
                        }).catch((error) => {
                    });
                },
                render: function() {
                    let newHead = document.createElement('thead');
                    let r = document.createElement('tr');
                    let t = document.createElement('th');
                    t.classList.add('attribute-th');
                    t.innerHTML = 'Tulajdonság';
                    r.appendChild(t);
                    this.printerData.forEach((p) => {
                        t = document.createElement('th');
                        t.innerHTML = p.name;
                        r.appendChild(t);
                    });
                    newHead.appendChild(r);
                    let newBody = document.createElement('tbody');
                    this.comparedAttributes.forEach((a) => {
                        r = document.createElement('tr');
                        t = document.createElement('td');
                        t.innerHTML = a.n;
                        r.appendChild(t);
                        this.printerData.forEach((p) => {
                            t = document.createElement('td');
                            t.innerHTML = p[a.v];
                            r.appendChild(t);
                        });
                        newBody.appendChild(r);
                    });
                    this.tableNode.innerHTML = '';
                    this.tableNode.appendChild(newHead);
                    this.tableNode.appendChild(newBody);
                }
            }
            window.addEventListener('load', () => {
                printerCompareTable.initialize();
            });
        </script>
    </div>
@endsection