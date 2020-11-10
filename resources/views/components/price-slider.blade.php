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
    <button type="button"
           class="price-slider-update-button"
           style="display:none"
           data-handle="both"
           data-slider-id="{{ $componentId }}"
            onclick="updateSliderFromValue(event)"></button>
    <div class="w-full h-2 bg-gray-400 relative"
         style="box-sizing: border-box; padding-left: 0px; padding-right: 0px"
         id="price-slider-{{ $componentId }}"
    >
        <div class="absolute h-full w-full bg-fotored flex items-center justify-between price-slider-range-box "
             style="max-width: 100%; box-sizing:border-box"
             id="price-slider-rangebox-{{ $componentId }}"
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
    <div class="w-full flex flex-col lg:flex-row justify-between items-center mt-1">
        <div class="w-full lg:w-1/3 flex flex-grow items-center">
            <input type="text"
                   class="flex-grow text-right lg:text-left w-full price-slider-min-input"
                   value="{{ $min }}"
                   oninput="updateSliderFromValue(event)"
                   data-slider-id="{{ $componentId }}"
                   data-handle="1"
                   id="price-slider-min-input-{{ $componentId }}">
            <span class="mx-1">{{ $currency }}</span>
        </div>
        <span class="hidden lg:block font-bold text-xl mx-2">-</span>
        <div class="w-full  md:w-1/3  flex flex-grow  items-center">
            <input type="text"
                   value="{{ $max }}"
                   class="flex-grow text-right w-full price-slider-max-input"
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
        currentPriceSlider = priceSliders[event.target.getAttribute('data-slider-id')];
        initCurrentSliderObject(event);
        let minvalue = parseInt(document.getElementById('price-slider-min-input-{{ $componentId }}').value)
        let maxvalue = parseInt(document.getElementById('price-slider-max-input-{{ $componentId }}').value)
        let value = 0;
        value = isNaN(minvalue) ? currentPriceSlider.min : minvalue;
        value = value < currentPriceSlider.min ? currentPriceSlider.min : value;
        value = value > currentPriceSlider.max ? currentPriceSlider.max : value;
        let leftPadding = Math.ceil(currentPriceSlider.containerDivBounding.width * (
            value / currentPriceSlider.max
        ));
        if (leftPadding + parseInt(currentPriceSlider.containerDiv.style.paddingRight) > currentPriceSlider.containerDivBounding.width - 20) {
            leftPadding = currentPriceSlider.containerDivBounding.width - 20 - parseInt(currentPriceSlider.containerDiv.style.paddingRight);
        }
        currentPriceSlider.containerDiv.style.paddingLeft = leftPadding + 'px';
        value = isNaN(maxvalue) ? currentPriceSlider.max : maxvalue;
        value = value < currentPriceSlider.min ? currentPriceSlider.min : value;
        value = value > currentPriceSlider.max ? currentPriceSlider.max : value;
        let rightPadding = Math.ceil(currentPriceSlider.containerDivBounding.width * (
            (currentPriceSlider.max - value) / currentPriceSlider.max
        ));

        if (rightPadding + parseInt(currentPriceSlider.containerDiv.style.paddingLeft) > currentPriceSlider.containerDivBounding.width - 20) {
            rightPadding = currentPriceSlider.containerDivBounding.width - 20 - parseInt(currentPriceSlider.containerDiv.style.paddingLeft);
        }
        currentPriceSlider.containerDiv.style.paddingRight = rightPadding + 'px';
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
        if ((event.clientX >= currentPriceSlider.containerDivBounding.left)
            && (event.clientX <= currentPriceSlider.containerDivBounding.left + currentPriceSlider.containerDivBounding.width)) {
            if (currentPriceSlider.draggedHandle.getAttribute('data-handle') == 1) {
                let leftPadding = (event.clientX - currentPriceSlider.containerDivBounding.left);
                if (leftPadding + parseInt(currentPriceSlider.containerDiv.style.paddingRight) < currentPriceSlider.containerDivBounding.width - 20) {
                    currentPriceSlider.containerDiv.style.paddingLeft = leftPadding + 'px';
                }
            } else {
                let rightPadding = window.innerWidth
                    - (window.innerWidth - currentPriceSlider.containerDivBounding.width)
                    + currentPriceSlider.containerDivBounding.left
                    - event.clientX;
                if (rightPadding + parseInt(currentPriceSlider.containerDiv.style.paddingLeft) < currentPriceSlider.containerDivBounding.width - 20) {
                    currentPriceSlider.containerDiv.style.paddingRight = rightPadding + 'px';
                }
            }
        } else {
            if (event.clientX < currentPriceSlider.containerDivBounding.left) {
                currentPriceSlider.containerDiv.style.paddingLeft = '0px';
            }
            if (event.clientX > currentPriceSlider.containerDivBounding.left + currentPriceSlider.containerDivBounding.width) {
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
        currentPriceSlider = priceSliders[event.target.getAttribute('data-slider-id')];
        currentPriceSlider.draggedHandle = event.target;
        currentPriceSlider.containerDiv = document.getElementById('price-slider-'+event.target.getAttribute('data-slider-id'));
        currentPriceSlider.containerDivBounding = currentPriceSlider.containerDiv.getBoundingClientRect();
        currentPriceSlider.valueInput = document.getElementById('price-slider-value-input-'+event.target.getAttribute('data-slider-id'));
        currentPriceSlider.rangeBox = document.getElementById('price-slider-rangebox-{{ $componentId }}');
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