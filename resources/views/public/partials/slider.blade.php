<div class="slider"
     style="height:100%; max-height: 100%; position: relative; width: 100%; overflow: hidden; display: flex; flex-direction: row; align-items: stretch; justify-content: flex-start"
     id="slider-{{ $slider->id }}"
     data-display-duration="{{ ($slider->slide_display_duration * 1000) }}"
     data-pagination-duration="{{ ($slider->slide_pagination_duration * 1000) }}"
     data-translate="0"
     onmouseenter="slider{{ $slider->id }}.hovering = true"
     onmouseleave="slider{{ $slider->id }}.hovering = false"
>
    <div class="slider-inner"
         style="flex-shrink: 1; flex-grow: 1; position: relative "
         id="slider-inner-{{ $slider->id  }}"
    >
        @foreach($slider->slides as $index => $slide)
            <div class="slider-slide"
                 id="slider-{{ $slider->id }}-slide-{{ $index }}"
                 data-slide-index="{{ $index }}"
                 style="transition: opacity {{ $slider->slide_pagination_duration }}s ease-in-out; position: absolute; top: 0px; left: 0px; overflow-y: hidden; width: 100%; height:100%; display: flex; align-items: flex-start; justify-content: flex-start; opacity: {{ $index == 0 ? 1 : 0 }}"
            >
                @include($view, ['slide' => $slide])
            </div>
            @push('sliderbuttons')
                <span class="slider-button"
                      id="slider-{{ $slider->id }}-slider-button-{{ $index }}"
                      data-index="{{ $index }}"
                      onclick="slider{{ $slider->id }}.showSlide({{ $index }})"
                      style="padding: .5rem; font-size: 3rem; color: #333745; transition: opacity 200ms ease-in-out; cursor:pointer ">●</span>
            @endpush
        @endforeach
        <button class="slider-page-button focus:outline-none" style="left:0px;" onclick="slider{{ $slider->id }}.nextSlideNoRollover()">&lt;</button>
        <button class="slider-page-button focus:outline-none" style="right:0px;" onclick="slider{{ $slider->id }}.prevSlide()">&gt;</button>
    </div>
    @if(false)
        @if($slider->slides->count() > 1)
            <div style="position: absolute; bottom: 0px; height: 20%; left: 0px; width: 100%; background-color: transparent; display: flex; align-items: center; justify-content: center; z-index:50">
                @stack('sliderbuttons')
            </div>
        @endif
    @endif
</div>
<script>
    slider{{ $slider->id }} = {
        position: 0,
        hovering: false,
        slideCount: {{ $slider->slides->count() }},
        sliderNode: document.getElementById('slider-{{ $slider->id }}'),
        innerContainer: document.getElementById('slider-inner-{{ $slider->id }}'),
        firstSlide: document.getElementById('slider-{{ $slider->id }}-slide-0'),
        showSlide: function (position) {
            this.position = position;
            let currentSlide = document.getElementById('slider-{{ $slider->id }}-slide-' + position);
            let previousSlide = null;
            if (position > 0) {
                previousSlide = document.getElementById('slider-{{ $slider->id }}-slide-' + (position - 1).toString());
            } else {
                previousSlide = document.getElementById('slider-{{ $slider->id }}-slide-' + (this.slideCount - 1).toString());
            }
            if (previousSlide != null) {
                previousSlide.style.opacity = 0;
            }
            currentSlide.style.opacity = 1;
            Array.from(this.sliderNode.querySelectorAll('.slider-button')).forEach((button) => {
                if (button.getAttribute('data-index') == position) {
                    button.style.opacity = 1;
                } else {
                    button.style.opacity = .4
                }
            });
        },
        nextSlide: function () {
            this.position++;
            if (this.position == this.slideCount) {
                this.position = 0;
                this.showSlide(0);
            } else {
                this.showSlide(this.position);
            }
        },
        nextSlideNoRollover: function () {
            this.position++;
            if (this.position > this.slideCount) {
                this.position = this.slideCount;
            }
            this.showSlide(this.position);
        },
        prevSlide: function () {
            this.position--;
            if (this.position < 0) {
                this.position = 0;
            }
            this.showSlide(this.position);
        },
        resizeSlides: function () {
            Array.from(this.innerContainer.querySelectorAll('.slider-slide')).forEach((slide) => {
                let width = this.sliderNode.getBoundingClientRect().width
                    - parseInt(window.getComputedStyle(this.sliderNode).marginLeft)
                    - parseInt(window.getComputedStyle(this.sliderNode).marginRight);
                slide.style.width = width + 'px';
                slide.style.maxWidth = width + 'px';
            });
            this.showSlide(0);
        },
        start: function () {
            this.resizeSlides();
            if (this.slideCount > 1) {
                window.setInterval(() => {
                    if (!this.hovering) {
                        this.nextSlide();
                    }
                }, {{ (($slider->slide_display_duration + $slider->slide_pagination_duration) * 1000  ) }});
            }
            window.addEventListener('resize', () => {
                this.resizeSlides();
            })

        }
    }
    slider{{ $slider->id }}.start();
</script>
