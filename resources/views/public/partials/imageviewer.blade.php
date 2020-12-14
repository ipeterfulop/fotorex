@php($componentId = \Str::random(16))
<div class="flex flex-col-reverse lg:flex-row w-full h-full justify-start"
     x-data="imageViewer_{{ $componentId }}()"
     x-init="() => {initialize()}"
>
    @if(count($printerphotos) > 0)
        <div class="relative w-full lg:w-1/5 h-16 lg:h-full flex-shrink-0 mt-2 lg:mt-0 flex flex-row lg:flex-col">
            <div class="cursor-pointer text-white font-xl w-full hidden lg:flex h-1/6 items-center justify-center p-1 bg-fotomediumgray hover:bg-fotored transition transition-colors ease-in-out duration-200 select-none" @click="scrollUp">&#x2303;</div>
            <div class="cursor-pointer text-white font-xl h-full flex lg:hidden w-32 items-center justify-center p-1 bg-fotomediumgray hover:bg-fotored transition transition-colors ease-in-out duration-200 select-none" @click="scrollLeft">&lt;</div>
            <div class="w-auto lg:w-full h-4/6 lg:h-auto overflow-x-hidden lg:overflow-y-hidden">
                <div class="h-full max-h-full flex flex-row lg:flex-col justify-start items-center imageviewer-thumbnails-container"
                     style="transform: translateY(0) translateX(0); transition: transform 200ms ease-in-out"
                     x-ref="imageviewer_thumbnails_container">
                    @foreach (array_values($printerphotos) as $index => $printerphoto)
                        <img class="w-24 lg:h-1/4 opacity-75 hover:opacity-100 imageviewer-thumbnail cursor-pointer mx-4 object-contain border-2 border-gray-200"
                             data-imageurl="{{ $printerphoto['index'] }}"
                             data-imageindex="{{ $index }}"
                             data-originalimageurl="{{ $printerphoto['original'] }}"
                             src="{{ $printerphoto['thumbnail'] }}"
                             @click="currentImage = '{{ $printerphoto['index'] }}'; currentImageIndex = '{{ $index }}'; currentOriginalImage = '{{ $printerphoto['original'] }}'">
                    @endforeach
                    <div class="h-1 w-full opacity-0" id="{{ $componentId }}-closer"></div>
                </div>
            </div>
            <div class="cursor-pointer text-white font-xl w-full hidden lg:flex h-1/6 items-center justify-center p-1 bg-fotomediumgray hover:bg-fotored transition transition-colors ease-in-out duration-200 select-none" @click="scrollDown">&#x2304;</div>
            <div class="cursor-pointer text-white font-xl h-full flex lg:hidden w-32 items-center justify-center p-1 bg-fotomediumgray hover:bg-fotored transition transition-colors ease-in-out duration-200 select-none" @click="scrollRight">&gt;</div>
        </div>
        <div class="h-96 lg:h-auto w-auto lg:w-full mt-2 lg:mt-0 flex flex items-center justify-center z-0">
            <img class="w-full h-full object-contain cursor-pointer" x-bind:src="currentImage" @click.stop="imageFullscreen = !imageFullscreen">
        </div>
        <div class="w-full h-full fixed z-20 top-0 left-0 bg-gray-900 bg-opacity-75 p-8 transition-opacity ease-in-out duration-150"
             style="display: none"
             x-show="imageFullscreen">
            <div class="cursor-pointer text-4xl text-black hover:text-white z-30 fixed flex items-center justify-center p-1 bg-fotomediumgray bg-opacity-25 hover:bg-opacity-75 hover:bg-fotored transition transition-colors ease-in-out duration-200 select-none" @click.stop.prevent="stepLeft" style="height: 20%; top: 40%; left: .5rem; width: 5rem">{!! config('heroicons.solid.arrow-circle-left') !!}</div>
            <img x-ref="imageviewer_fullscreen_image" class="w-full h-full object-contain cursor-pointer transition-opacity ease-in-out duration-200" x-bind:src="currentOriginalImage" @click.stop.prevent.self="imageFullscreen = !imageFullscreen">
            <div class="cursor-pointer text-4xl text-black hover:text-white z-30 fixed flex items-center justify-center p-1 bg-fotomediumgray bg-opacity-25 hover:bg-opacity-75 hover:bg-fotored transition transition-colors ease-in-out duration-200 select-none" @click.stop.prevent="stepRight" style="height: 20%; top: 40%; right: .5rem; width: 5rem">{!! config('heroicons.solid.arrow-circle-right') !!}</div>
        </div>
    @endif
</div>
<script>
    function imageViewer_{{ $componentId }}() {
        return {
            currentImage: null,
            currentImageIndex: 0,
            currentOriginalImage: null,
            selectedOriginalImage: null,
            imageFullscreen: false,
            scrollPositionY: 0,
            scrollPositionX: 0,
            stepY: null,
            stepX: null,
            imagesCount: {{ count($printerphotos) }},
            maxScrollY: null,
            maxScrollX: null,
            initialize: function() {
                this.currentImage = this.$refs.imageviewer_thumbnails_container.querySelector('.imageviewer-thumbnail').getAttribute('data-imageurl');
                this.currentOriginalImage = this.$refs.imageviewer_thumbnails_container.querySelector('.imageviewer-thumbnail').getAttribute('data-originalimageurl');
                this.$watch('scrollPositionY', (value) => {
                    this.$refs.imageviewer_thumbnails_container.style.transform = 'translateY(-'+value.toString()+'px)';
                });
                this.$watch('scrollPositionX', (value) => {
                    this.$refs.imageviewer_thumbnails_container.style.transform = 'translateX(-'+value.toString()+'px)';
                });
                this.$watch('imageFullscreen', (value) => {
                    if (value) {
                        this.selectedOriginalImage = this.currentOriginalImage;
                    } else {
                        this.currentOriginalImage = this.selectedOriginalImage;
                    }

                });
            },
            calculateStepY: function() {
                this.stepY = this.$refs.imageviewer_thumbnails_container.querySelector('img').getBoundingClientRect().height;
            },
            calculateStepX: function() {
                let i = this.$refs.imageviewer_thumbnails_container.querySelector('img');
                this.stepX = i.getBoundingClientRect().width
                    + parseInt(window.getComputedStyle(i).marginLeft)
                    + parseInt(window.getComputedStyle(i).marginRight);
            },
            calculateMaxScrollY: function() {
                let i = Array.from(this.$refs.imageviewer_thumbnails_container.querySelectorAll('img'));
                i.pop();
                if (i.length > 2) {
                    i.pop();
                }
                this.maxScrollY = i.reduce((sum, image) => {
                    return sum + image.getBoundingClientRect().height;
                }, 0);
            },
            calculateMaxScrollX: function() {
                let i = Array.from(this.$refs.imageviewer_thumbnails_container.querySelectorAll('img'));
                i.pop();
                if (i.length > 2) {
                    i.pop();
                }
                this.maxScrollX = i.reduce((sum, image) => {
                    return sum + image.getBoundingClientRect().width;
                }, 0);
            },
            switchCurrentOriginalImage: function(newUrl) {
                let c = this.$refs.imageviewer_fullscreen_image;
                c.classList.add('opacity-0')
                window.setTimeout(() => {
                    this.currentOriginalImage = newUrl;
                    window.setTimeout(() => {
                        c.classList.remove('opacity-0');
                    }, 1);
                }, 200);
            },
            stepTo: function(index) {
                let i = this.$refs.imageviewer_thumbnails_container.querySelector('.imageviewer-thumbnail[data-imageindex="'+index+'"]');
                if (i != null) {
                    this.currentImageIndex = index;
                    this.switchCurrentOriginalImage(i.getAttribute('data-originalimageurl'));
                }
            },
            stepLeft: function() {
                if (this.currentImageIndex > 0) {
                    this.currentImageIndex--;
                    this.stepTo(this.currentImageIndex);
                }
            },
            stepRight: function() {
                if (this.currentImageIndex < this.imagesCount) {
                    this.currentImageIndex++;
                    this.stepTo(this.currentImageIndex);
                }
            },
            scrollUp: function() {
                if (this.stepY === null) {
                    this.calculateStepY();
                }
                this.scrollPositionY = this.scrollPositionY > this.stepY
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
                this.scrollPositionY = this.scrollPositionY < this.maxScrollY - this.stepX
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
