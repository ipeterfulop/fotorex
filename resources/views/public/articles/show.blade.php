@extends('layouts.tailwind.app', ['pageTitle' => $article->title])
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
    <script>
        function articleToPdf() {
            let c = new jsPDF();
            let baseContent = document.querySelector('.article-container');
            if (baseContent == null) {
                return;
            }
            let content = baseContent.cloneNode(true);
            Array.from(content.querySelectorAll('a')).forEach((link) => {
                link.remove();
            });

            c.addHTML(content, () => {
                c.save('cikk.pdf');
            });
        }

    </script>
    <div class="w-full bg-transparent flex justify-center my-8">
        <div class="w-full max-width-container-bordered bg-white p-4 flex flex-wrap flex-row items-center justify-between">
            <div class="my-4">
                @if($category->parentslug != null)
                    <a class="text-fotored underline mr-4" href="{{ route('list_articles', ['categorySlug' => $category->parentslug]) }}">{{ $category->parentname }}</a>&gt;&gt;
                    <a class="text-fotored underline mr-4" href="{{ route('list_articles', ['categorySlug' => $category->parentslug, 'subcategorySlug' => $category->custom_slug_base]) }}">{{ $category->name }}</a> &gt;&gt;
                @else
                    <a class="text-fotored underline mr-4" href="{{ route('list_articles', ['categorySlug' => $category->custom_slug_base]) }}">{{ $category->name }}</a>&gt;&gt;
                @endif
                <span class="ml-4">{{ $article->title }}</span>
            </div>
            <h2 class="w-full uppercase text-xl my-4 py-8 text-white bg-fotored text-center">{!! $article->title !!}</h2>
            <div class="w-full flex flex-row items-start justify-center">
                <div class="w-full max-width-container flex flex-col">
                    <div class="flex flex-col items-start justify-start">
                        <div class="w-full article-container">
                            {!! $article->content !!}
                        </div>
                        <div class="w-full px-8 lg:px-0 py-8 flex flex-row ">
                            <a class="w-full text-center lg:w-auto bg-fotored hover-gray-link py-2 px-4 mt-8 text-white text-sm my-8" href="{{ $backUrl }}">Vissza</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection