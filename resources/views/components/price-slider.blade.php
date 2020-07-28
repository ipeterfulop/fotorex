<style>
    .price-slider-handle {
        width: 1rem;
        height: 1rem;
        border-radius: 1rem;
    }
</style>
<div class="w-full" id="{{ $componentId }}">
    <input type="hidden"
           name="{{ $field }}"
           class="range-value-input"
           id="price-slider-value-input-{{ $componentId }}"
           data-slider-id="{{ $componentId }}"
           value="{{ $min }}-{{ $max }}">
    <div class="w-full h-2 bg-gray-400 relative"
         style="box-sizing: border-box; padding-left: 0px; padding-right: 0px"
         id="price-slider-{{ $componentId }}"
    >
        <div class="absolute h-full w-full bg-fotored flex items-center justify-between price-slider-range-box "
             style="max-width: 100%; box-sizing:border-box"
             draggable="false"
        >
            <div class="price-slider-handle bg-fotored"
                 data-handle="1"
                 data-slider-id="{{ $componentId }}"
                 onmousedown="initHandleDrag(event)"
                 draggable="false"
            ></div>
            <div class="price-slider-handle bg-fotored"
                 data-handle="2"
                 data-slider-id="{{ $componentId }}"
                 onmousedown="initHandleDrag(event)"
                 draggable="false"
            ></div>
        </div>
    </div>
    <div class="w-full flex justify-between items-center mt-1">
        <div class="w-full flex flex-grow items-center">
            <input type="text"
                   class="flex-grow"
                   value="{{ $min }}"
                   oninput="updateSliderFromValue(event)"
                   data-slider-id="{{ $componentId }}"
                   data-handle="1"
                   id="price-slider-min-input-{{ $componentId }}">
            <span class="mx-1">{{ $currency }}</span>
        </div>
        <span class="font-bold text-xl mx-2">-</span>
        <div class="w-full flex flex-grow  items-center">
            <input type="text"
                   value="{{ $max }}"
                   class="flex-grow text-right"
                   oninput="updateSliderFromValue(event)"
                   data-handle="2"
                   data-slider-id="{{ $componentId }}"
                   id="price-slider-max-input-{{ $componentId }}">
            <span class="mx-1">{{ $currency }}</span>
        </div>
    </div>

</div>
<script>
    priceSliders = {};
    let currentPriceSlider = null;
    priceSliders['{{ $componentId }}'] = {
        componentId: '{{ $componentId }}',
        containerDivBounding: null,
        draggedHandle: null,
        containerDiv: null,
        rangeBox: null,
        valueInput: null,
        currentX: 0,
        min: {{ $min }},
        max: {{ $max }}
    }
    function updateSliderFromValue(event) {
        currentPriceSlider = priceSliders[event.currentTarget.getAttribute('data-slider-id')];
        initCurrentSliderObject(event);
        let value = parseInt(event.currentTarget.value)
        if (event.currentTarget.getAttribute('data-handle') == 1) {
            value = isNaN(value) ? priceSliders[event.currentTarget.getAttribute('data-slider-id')].min : value;
            value = value < priceSliders[event.currentTarget.getAttribute('data-slider-id')].min
                ? priceSliders[event.currentTarget.getAttribute('data-slider-id')].min : value;
            value = value > priceSliders[event.currentTarget.getAttribute('data-slider-id')].max
                ? priceSliders[event.currentTarget.getAttribute('data-slider-id')].max
                : value;
            let leftPadding = Math.ceil(currentPriceSlider.containerDivBounding.width * (
                value / priceSliders[event.currentTarget.getAttribute('data-slider-id')].max
            ));
            if (leftPadding + parseInt(currentPriceSlider.containerDiv.style.paddingRight) < currentPriceSlider.containerDivBounding.width - 20) {
                currentPriceSlider.containerDiv.style.paddingLeft = leftPadding + 'px';
            }
        } else {
            value = isNaN(value) ? priceSliders[event.currentTarget.getAttribute('data-slider-id')].max : value;
            value = value < priceSliders[event.currentTarget.getAttribute('data-slider-id')].min
                ? priceSliders[event.currentTarget.getAttribute('data-slider-id')].min
                : value;
            value = value > priceSliders[event.currentTarget.getAttribute('data-slider-id')].max
                ? priceSliders[event.currentTarget.getAttribute('data-slider-id')].max
                : value;
            let rightPadding = priceSliders[event.currentTarget.getAttribute('data-slider-id')].max * (
                value / priceSliders[event.currentTarget.getAttribute('data-slider-id')].max
            );
            if (leftPadding + parseInt(currentPriceSlider.containerDiv.style.paddingRight) < currentPriceSlider.containerDivBounding.width - 20) {
                currentPriceSlider.containerDiv.style.paddingLeft = leftPadding + 'px';
            }
        }
        window.setTimeout(setRangeDivSize, 5);
    }

    function updateValue()
    {
        let min = Math.round(currentPriceSlider.max * parseInt(currentPriceSlider.containerDiv.style.paddingLeft) / currentPriceSlider.containerDiv.getBoundingClientRect().width);
        let max = Math.round(currentPriceSlider.max * (currentPriceSlider.containerDiv.getBoundingClientRect().width - parseInt(currentPriceSlider.containerDiv.style.paddingRight)) / currentPriceSlider.containerDiv.getBoundingClientRect().width);
        currentPriceSlider.valueInput.value = min.toString()+'-'+max.toString();
        document.getElementById('price-slider-min-input-'+currentPriceSlider.componentId).value = min;
        document.getElementById('price-slider-max-input-'+currentPriceSlider.componentId).value = max;
    }

    function moveHandle(event) {
        currentPriceSlider.containerDivBounding = currentPriceSlider.containerDiv.getBoundingClientRect();
        if ((event.screenX >= currentPriceSlider.containerDivBounding.left)
            && (event.screenX <= currentPriceSlider.containerDivBounding.left + currentPriceSlider.containerDivBounding.width)) {
                if (currentPriceSlider.draggedHandle.getAttribute('data-handle') == 1) {
                    let leftPadding = (event.screenX - currentPriceSlider.containerDivBounding.left);
                    if (leftPadding + parseInt(currentPriceSlider.containerDiv.style.paddingRight) < currentPriceSlider.containerDivBounding.width - 20) {
                        currentPriceSlider.containerDiv.style.paddingLeft = leftPadding + 'px';
                    }
                } else {
                    let rightPadding = window.innerWidth
                        - (window.innerWidth - currentPriceSlider.containerDivBounding.width)
                        + currentPriceSlider.containerDivBounding.left
                        - event.screenX;
                    if (rightPadding + parseInt(currentPriceSlider.containerDiv.style.paddingLeft) < currentPriceSlider.containerDivBounding.width - 20) {
                        currentPriceSlider.containerDiv.style.paddingRight = rightPadding + 'px';
                    }
                }
        } else {
            if (event.screenX < currentPriceSlider.containerDivBounding.left) {
                currentPriceSlider.containerDiv.style.paddingLeft = '0px';
            }
            if (event.screenX > currentPriceSlider.containerDivBounding.left + currentPriceSlider.containerDivBounding.width) {
                currentPriceSlider.containerDiv.style.paddingRight = '0px';
            }
        }
        setRangeDivSize();
        updateValue();
    }

    function setRangeDivSize() {
        currentPriceSlider.rangeBox.style.width = (currentPriceSlider.containerDivBounding.width - (
            parseInt(currentPriceSlider.containerDiv.style.paddingLeft) + parseInt(currentPriceSlider.containerDiv.style.paddingRight)
        )).toString()+'px';
    }

    function initCurrentSliderObject(event) {
        currentPriceSlider = priceSliders[event.currentTarget.getAttribute('data-slider-id')];
        currentPriceSlider.draggedHandle = event.currentTarget;
        currentPriceSlider.containerDiv = document.getElementById('price-slider-'+event.currentTarget.getAttribute('data-slider-id'));
        currentPriceSlider.containerDivBounding = currentPriceSlider.containerDiv.getBoundingClientRect();
        currentPriceSlider.valueInput = document.getElementById('price-slider-value-input-'+event.currentTarget.getAttribute('data-slider-id'));
        currentPriceSlider.rangeBox = event.currentTarget.parentNode;
    }

    function initHandleDrag(event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        initCurrentSliderObject(event);
        window.addEventListener('mousemove', moveHandle, true);
        window.addEventListener('mouseup', disableHandleDrag)
    }
    function disableHandleDrag(event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        window.removeEventListener('mousemove', moveHandle, true);
        window.removeEventListener('mouseup', disableHandleDrag);
        currentPriceSlider.draggedHandle = null;
        currentPriceSlider.rangeBox = null;
        currentPriceSlider.containerDiv = null;
        currentPriceSlider.valueInput = null;
        currentPriceSlider = null;
    }
</script>
