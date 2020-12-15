@php($componentId = \Str::random(16))
<div class="flex lg:flex-row w-full md:h-auto justify-start"
     style="min-height: 35rem;"
     x-data="itemSlider_{{ $componentId }}()"
     x-init="() => {initialize()}"
>
    @if(count($items) > 0)
        <div class="relative w-full flex-shrink-0 overflow-x-hidden lg:overflow-y-hidden flex flex-row flex-no-wrap">
            <button class="absolute z-10 cursor-pointer text-white font-xl h-full flex flex-col items-center justify-center p-1 select-none item-slider-slide-button px-2 bg-white text-4xl text-fotored font-bold opacity-100 hover:opacity-75 transition-opacity duration-200 ease-in-out"
                    @click="scrollLeft"
                    style=""
                    x-bind:disabled="scrollPositionX == 0"
            ><div class="h-12 w-12 rounded-full flex items-center justify-center ">{!! config('heroicons.solid.arrow-circle-left') !!}</div>
            </button>
            <div class="w-full h-auto flex flex-row justify-start items-center px-16"
                 style="transform: translateY(0) translateX(0); transition: transform 200ms ease-in-out"
                 x-ref="slider_list_container">
                @foreach ($items as $item)
                    <div class="slider-list-item w-full md:w-1/3 lg:w-1/4 flex-shrink-0 px-1">
                        @include($view, ['item' => $item])
                    </div>
                @endforeach
                <div class="h-1 w-full opacity-0" id="{{ $componentId }}-closer"></div>
            </div>
            <button class="absolute right-0 z-10 cursor-pointer text-white font-xl h-full flex flex-col items-center justify-center p-1 select-none item-slider-slide-button px-2 bg-white text-4xl text-fotored font-bold opacity-100 hover:opacity-75 transition-opacity duration-200 ease-in-out"
                    @click="scrollRight"
                    style=""
                    x-bind:disabled="scrollPositionX >= maxScrollX"
            ><div class="h-12 w-12 rounded-full flex items-center justify-center">{!! config('heroicons.solid.arrow-circle-right') !!}</div></button>
        </div>
    @endif
</div>
<script>
    function itemSlider_{{ $componentId }}() {
        return {
            scrollPositionX: 0,
            stepX: null,
            maxScrollX: null,
            initialize: function() {
                this.calculateMaxScrollX();
                this.$watch('scrollPositionX', (value) => {
                    this.$refs.slider_list_container.style.transform = 'translateX(-'+value.toString()+'px)';
                });
                window.addEventListener('resize', () => {
                    this.calculateMaxScrollX();
                })

            },
            calculateStepX: function() {
                let computed = window.getComputedStyle(this.$refs.slider_list_container.querySelector('.slider-list-item'));
                this.stepX = this.$refs.slider_list_container.querySelector('.slider-list-item').getBoundingClientRect().width
                    + parseInt(computed['margin-left'])
                    + parseInt(computed['margin-right']);
            },
            calculateMaxScrollX: function() {
                let i = Array.from(this.$refs.slider_list_container.querySelectorAll('.slider-list-item'));
                i.pop();
                if (i.length > 2) {
                    i.pop();
                }
                this.maxScrollX = i.reduce((sum, item) => {
                    return sum + item.getBoundingClientRect().width;
                }, 0);
            },
            scrollLeft: function() {
                if (this.stepX === null) {
                    this.calculateStepX();
                }
                this.scrollPositionX = this.scrollPositionX > this.stepX
                    ? this.scrollPositionX - this.stepX
                    : 0;
            },
            scrollRight: function() {
                if (this.stepX === null) {
                    this.calculateStepX();
                }
                if (this.maxScrollX === null) {
                    this.calculateMaxScrollX();
                }
                this.scrollPositionX = this.scrollPositionX < this.maxScrollX - this.stepX
                    ? this.scrollPositionX + this.stepX
                    : this.maxScrollX;
            }
        }
    }
</script>
