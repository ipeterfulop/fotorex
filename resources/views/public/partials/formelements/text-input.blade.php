@php($value = $value ?? '')
<div class="form-group w-full lg:w-8/12 flex flex-col my-2" data-fieldname="{{ $fieldName }}">
    <div class="w-full flex flex-col lg:flex-row lg:items-center lg:justify-center">
        <label class="w-full lg:w-1/2 form-label text-left lg:text-right pr-2" for="text-input">
            {!! $label !!}
            @if($mandatory)<sup>*</sup>@endif
        </label>
        <div class="w-full lg:w-1/2">
            <input class="form-control flex-grow w-full"
                   type="text"
                   name="{{ $fieldName }}"
                   id="{{ $fieldName }}"
                   value="{{ old($fieldName) ?? $value }}"
                   placeholder="{{ $label }}">
        </div>
    </div>
    <div class="validation-error text-center text-fotored mb-1 w-full @if(!$errors->has($fieldName))  hidden  @endif">
        <i class="icon-slash"></i>&nbsp;<span>@if($errors->has($fieldName)) &nbsp;{!! $errors->first($fieldName) !!} @endif</span>
    </div>

</div>
