<div class="form-group row">
    @if($errors->has($fieldName))
        <div class="alert alert-danger text-center margin-bottom-1x col-12">
            <i class="icon-slash"></i>&nbsp;&nbsp;{!! $errors->first($fieldName) !!}
        </div>
    @endif
    <label class="col-2 col-form-label" for="text-input">
        {{ $label }}
    </label>
    <div class="col-10">
        <textarea class="form-control"
                  id="{{ $fieldName }}"
                  name="{{ $fieldName }}"
                  rows="5">{{ old($fieldName) ?? '' }}</textarea>
    </div>
</div>
