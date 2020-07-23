<div class="flex flex-col-reverse lg:flex-row w-full h-full justify-start"
     x-data="{currentImage: null}"
     x-init="() => {currentImage = $refs.imageviewer_thumbnails_container.querySelector('.imageviewer-thumbnail').getAttribute('data-imageurl');}"
>
    @if(count($imageUrls) > 0)
        <div class="w-full lg:w-1/5 flex flex-row lg:flex-col overflow-x-auto lg:overflow-y-auto h-16 lg:h-full flex-shrink-0 mt-2 lg:mt-0 justify-start items-center imageviewer-thumbnails-container" x-ref="imageviewer_thumbnails_container">
            @foreach ($imageUrls as $image)
                <img class="h-full lg:w-full opacity-75 hover:opacity-100 imageviewer-thumbnail cursor-pointer"
                     data-imageurl="{{ $image }}"
                     src="{{ $image }}"
                    @click="currentImage = '{{ $image }}'">
            @endforeach
        </div>
        <div class="w-full lg:w-4/5 h-full">
            <img class="w-full h-full object-contain" x-bind:src="currentImage">
        </div>
    @endif
</div>
