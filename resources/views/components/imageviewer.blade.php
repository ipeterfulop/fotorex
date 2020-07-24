<div class="flex flex-col-reverse lg:flex-row w-full h-full justify-start"
     x-data="imageViewer_{{ $componentId }}()"
     x-init="() => {initialize()}"
>
    @if(count($imageUrls) > 0)
        <div class="relative w-full lg:w-1/5 h-16 lg:h-full flex-shrink-0 mt-2 lg:mt-0  overflow-x-hidden lg:overflow-y-hidden ">
            <div class="w-auto lg:w-full h-full lg:h-auto flex flex-row lg:flex-col justify-start items-center imageviewer-thumbnails-container"
                 style="transform: translateY(0) translateX(0); transition: transform 200ms ease-in-out"
                 x-ref="imageviewer_thumbnails_container">
                @foreach ($imageUrls as $index => $image)
                    <img class="w-24 lg:h-auto lg:w-full opacity-75 hover:opacity-100 imageviewer-thumbnail cursor-pointer"
                         data-imageurl="{{ $image }}"
                         src="{{ $image }}"
                        @click="currentImage = '{{ $image }}'">
                @endforeach
                <div class="h-1 w-full opacity-0" id="{{ $componentId }}-closer"></div>
            </div>
            <div class="absolute cursor-pointer text-white font-xl z-10 top-0 left-0 w-full hidden lg:flex h-8 items-center justify-center p-1 bg-opacity-25 hover:bg-opacity-100 bg-black select-none" @click="scrollUp">&#x2303;</div>
            <div class="absolute cursor-pointer text-white font-xl z-10 top-0 left-0 h-full flex lg:hidden w-8 items-center justify-center p-1 bg-opacity-25 hover:bg-opacity-100 bg-black select-none" @click="scrollLeft">&lt;</div>
            <div class="absolute cursor-pointer text-white font-xl z-10 bottom-0 left-0 w-full hidden lg:flex h-8 items-center justify-center p-1 bg-opacity-25 hover:bg-opacity-100 bg-black select-none" @click="scrollDown">&#x2304;</div>
            <div class="absolute cursor-pointer text-white font-xl z-10 bottom-0 right-0 h-full flex lg:hidden w-8 items-center justify-center p-1 bg-opacity-25 hover:bg-opacity-100 bg-black select-none" @click="scrollRight">&gt;</div>
        </div>
        <div class="w-full lg:w-4/5 h-full">
            <img class="w-full h-full object-contain" x-bind:src="currentImage">
        </div>
    @endif
</div>
<script>
    function imageViewer_{{ $componentId }}() {
        return {
            currentImage: null,
            scrollPositionY: 0,
            scrollPositionX: 0,
            stepY: null,
            stepX: null,
            maxScrollY: null,
            maxScrollX: null,
            initialize: function() {
                this.currentImage = this.$refs.imageviewer_thumbnails_container.querySelector('.imageviewer-thumbnail').getAttribute('data-imageurl');
                this.$watch('scrollPositionY', (value) => {
                    this.$refs.imageviewer_thumbnails_container.style.transform = 'translateY(-'+value.toString()+'px)';
                });
                this.$watch('scrollPositionX', (value) => {
                    this.$refs.imageviewer_thumbnails_container.style.transform = 'translateX(-'+value.toString()+'px)';
                });
            },
            calculateStepY: function() {
                this.stepY = this.$refs.imageviewer_thumbnails_container.querySelector('img').getBoundingClientRect().height;
            },
            calculateStepX: function() {
                this.stepX = this.$refs.imageviewer_thumbnails_container.querySelector('img').getBoundingClientRect().width;
            },
            calculateMaxScrollY: function() {
                let i = Array.from(this.$refs.imageviewer_thumbnails_container.querySelectorAll('img'));
                i.pop();
                i.pop();
                this.maxScrollY = i.reduce((sum, image) => {
                    return sum + image.getBoundingClientRect().height;
                }, 0);
            },
            calculateMaxScrollX: function() {
                let i = Array.from(this.$refs.imageviewer_thumbnails_container.querySelectorAll('img'));
                i.pop();
                i.pop();
                this.maxScrollX = i.reduce((sum, image) => {
                    return sum + image.getBoundingClientRect().width;
                }, 0);
            },
            scrollUp: function() {
                if (this.stepY === null) {
                    this.calculateStepY();
                }
                this.scrollPositionY = this.scrollPositionY > this.step
                    ? this.scrollPositionY - this.stepY
                    : 0;
            },
            scrollDown: function() {
                if (this.stepY === null) {
                    this.calculateStepY();
                }
                if (this.maxScrollY === null) {
                    this.calculateMaxScrollY();
                }
                this.scrollPositionY = this.scrollPositionY < this.maxScrollY - this.step
                    ? this.scrollPositionY + this.stepY
                    : this.maxScrollY;
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
