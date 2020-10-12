<div class="fotorex-list-item-list-view">
    <div class="w-full flex flex-row m-2">
        <div class="w-1/3">
        </div>
        <div class="w-2/3 pl-2 flex flex-col items-start justify-start">
            <strong>{{ $element->name }}</strong>
            <p>{{ $element->description }}</p>
        </div>
    </div>
</div>
<div class="fotorex-list-item-grid-view">
    <div class="w-full h-24 relative z-0 h-48 m-4" style="background:url('{{ $element->getMainImageUrl(request()->get('printerphotoroles')->get('index')) }}'); background-size: contain; background-repeat: no-repeat">
        <div class="w-full bg-opacity-75 bg-gray-500 absolute bottom-0 left-0 h-8 z-10">
            <strong>{{ $element->name }}</strong>
        </div>
    </div>
</div>
