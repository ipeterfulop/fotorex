<style>
    .fotorex-list-container {
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
    }
    .fotorex-grid-container {
        flex-wrap: wrap;
        flex-direction: row;
    }
    .fotorex-list-container .fotorex-list-item-grid-view {
        display: none;
    }
    .fotorex-grid-container .fotorex-list-item-list-view {
        display: none;
    }
    .fotorex-list-container .fotorex-list-item {
        width: 100%;
    }
    .fotorex-grid-container .fotorex-list-item {
        width: 25%;
    }
</style>
<div x-data="listOrGridView()">
    <div  class="flex flex-start flex-no-wrap flex-row">
        <button class="flex flex-row items-center justify-start ml-4 transition transition-colors ease-in-out hover:text-fotored  duration-200" @click="switchToList()" x-bind:class="{'font-bold': containerClass == 'fotorex-list-container'}">{!! config('heroicons.solid.view-list') !!}&nbsp;Lista</button>
        <button class="flex flex-row items-center justify-start ml-4 transition transition-colors ease-in-out hover:text-fotored  duration-200" @click="switchToGrid()" x-bind:class="{'font-bold': containerClass == 'fotorex-grid-container'}">{!! config('heroicons.solid.view-grid') !!}&nbsp;Rács</button>
    </div>
    <div class="flex w-full"
         x-bind:class="containerClass"
    >
        @foreach($elements as $element)
            <div class="fotorex-list-item">
                @include($view, ['element' => $element])
            </div>
        @endforeach
    </div>

</div>
<script>
    function listOrGridView() {
        return {
            containerClass: 'fotorex-list-container',
            switchToList() {
                this.containerClass = 'fotorex-list-container'
            },
            switchToGrid() {
                this.containerClass = 'fotorex-grid-container';
            },
        }
    }
</script>
