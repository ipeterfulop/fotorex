<style>
    .price-slider-handle {
        width: 1rem;
        height: 1rem;
        border-radius: 1rem;
    }
</style>
<div class="w-full">
    <input type="hidden" name="{{ $field }}" value="{{ $min }}-{{ $max }}">
    <div class="w-full h-2 bg-gray-400 relative">
        <div class="absolute h-full w-full bg-fotored flex items-center justify-between"
             style="left: 5%; width: 40%">
            <div class="price-slider-handle bg-fotored"
                 data-handle="1"
                 onmousedown="initHandleDrag(event)"
            ></div>
            <div class="price-slider-handle bg-fotored"
                 draggable="true"
            ></div>
        </div>
    </div>

</div>
<script>
    let draggedHandle = null;
    function moveHandle(event) {
        console.log(event.movementX);
    }
    function initHandleDrag(originalEvent) {
        draggedHandle = originalEvent.currentTarget;
        window.addEventListener('mousemove', moveHandle, true);
        window.addEventListener('mouseup', disableHandleDrag)
    }
    function disableHandleDrag() {
        window.removeEventListener('mousemove', moveHandle, true);
        window.removeEventListener('mouseup', disableHandleDrag);
        draggedHandle = null;
    }
</script>
