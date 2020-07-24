<style>
    .price-slider-handle {
        width: 1rem;
        height: 1rem;
        border-radius: 1rem;
    }
</style>
<div class="w-full" id="{{ $componentId }}">
    <input type="hidden" name="{{ $field }}" value="{{ $min }}-{{ $max }}">
    <div class="w-full h-2 bg-gray-400 relative"
         style="box-sizing: border-box; padding-left: 0px; padding-right: 0px"
    >
        <div class="absolute h-full w-full bg-fotored flex items-center justify-between price-slider-range-box "
             style="max-width: 100%; box-sizing:border-box"
             draggable="false"
        >
            <div class="price-slider-handle bg-fotored"
                 data-handle="1"
                 onmousedown="initHandleDrag(event)"
                 draggable="false"
            ></div>
            <div class="price-slider-handle bg-fotored"
                 data-handle="2"
                 onmousedown="initHandleDrag(event)"
                 draggable="false"
            ></div>
        </div>
    </div>

</div>
<script>
    let draggedHandle = null;
    let rangeBox = null;
    let currentX = 0
    function moveHandle(event) {
        if (draggedHandle.getAttribute('data-handle') == 1) {
            let movement = event.screenX * (rangeBox.parentNode.getBoundingClientRect().width / window.innerWidth);
            if (Math.ceil(movement) + parseInt(rangeBox.parentNode.style.paddingRight) < rangeBox.parentNode.getBoundingClientRect().width - 20) {
                rangeBox.parentNode.style.paddingLeft = Math.ceil(movement)+'px';
            }
        } else {
            let movement = (window.innerWidth - event.screenX) * (rangeBox.parentNode.getBoundingClientRect().width / window.innerWidth);
            if (Math.ceil(movement) + parseInt(rangeBox.parentNode.style.paddingLeft) < rangeBox.parentNode.getBoundingClientRect().width - 20) {
                rangeBox.parentNode.style.paddingRight = Math.ceil(movement) + 'px';
            }
        }
        rangeBox.style.width = rangeBox.parentNode.getBoundingClientRect().width - (
            parseInt(rangeBox.parentNode.style.paddingLeft) + parseInt(rangeBox.parentNode.style.paddingRight)
        )+'px';
    }
    function initHandleDrag(originalEvent) {
        event.preventDefault();
        event.stopImmediatePropagation();
        draggedHandle = originalEvent.currentTarget;
        rangeBox = originalEvent.currentTarget.parentNode;
        window.addEventListener('mousemove', moveHandle, true);
        window.addEventListener('mouseup', disableHandleDrag)
    }
    function disableHandleDrag() {
        event.preventDefault();
        event.stopImmediatePropagation();
        window.removeEventListener('mousemove', moveHandle, true);
        window.removeEventListener('mouseup', disableHandleDrag);
        draggedHandle = null;
        rangeBox = null;
    }
</script>
