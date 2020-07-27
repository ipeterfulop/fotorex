<div class="form-group w-full lg:w-8/12 flex flex-col  my-2">
    <div class="w-full flex flex-row items-center justify-center">
        <label class="w-1/2 form-label text-right pr-2" for="text-input">
            {!! $label !!}
            @if($mandatory)<sup>*</sup>@endif
        </label>
        <div class="w-1/2">
        <textarea class="form-control w-full"
                  id="{{ $fieldName }}"
                  name="{{ $fieldName }}"
                  rows="5">{{ old($fieldName) ?? '' }}</textarea>
        </div>
    </div>
    @if($errors->has($fieldName))
        <div class="text-center text-fotored mb-1 w-full">
            <i class="icon-slash"></i>&nbsp;&nbsp;{!! $errors->first($fieldName) !!}
        </div>
    @endif
</div>
