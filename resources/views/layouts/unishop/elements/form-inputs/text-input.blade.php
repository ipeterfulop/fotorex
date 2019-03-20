<div class="form-group row">
    @if($errors->has($fieldName))
        <div class="alert alert-danger text-center margin-bottom-1x col-12">
            <i class="icon-slash"></i>&nbsp;&nbsp;{!! $errors->first($fieldName) !!}
        </div>
    @endif
    <label class="col-2 col-form-label" for="text-input">
        {!! $label !!}
        @if($mandatory)<sup>*</sup>@endif
    </label>
    <div class="col-10">
        <input class="form-control"
               type="text"
               name="{{ $fieldName }}"
               id="{{ $fieldName }}"
               value="{{ old($fieldName) ?? '' }}"
               placeholder="{{ $label }}">
    </div>
</div>
