<form method="POST" class="w-full flex flex-col items-center justify-start"
      action="{{ $action ?? '' }}"
      id="contact-form"
>
    {{ csrf_field() }}
    @include('public.partials.formelements.text-input', [
        'fieldName' => 'name',
        'label' => 'Név',
        'mandatory' => true,
    ])
    @include('public.partials.formelements.text-input', [
        'fieldName' => 'email',
        'label' => 'E-mailcím',
        'mandatory' => true,
    ])
    @include('public.partials.formelements.text-input', [
        'fieldName' => 'phone',
        'label' => 'Telefonszám',
        'mandatory' => false,
    ])
    @include('public.partials.formelements.textarea-input', [
        'fieldName' => 'message',
        'label' => 'Üzenet',
        'mandatory' => true,
        'value' => $defaultMessage ?? ''
    ])
    @if(isset($printerId))
        <input type="hidden" name="printer_id" value="{{ $printerId }}">
    @endif
    <div class="flex flex-col justify-start items-center w-full">
        @if($ajax)
            <button class="btn bg-fotored hover-gray-link mt-6 p-2 text-white uppercase"
                    type="button"
                    id="contact-form-submit-button"
                    onclick="submitContactmessage()"
            >Küldés</button>
            <div class="text-right font-bold mt-4" id="contact-form-response-message"></div>
        @else
            <button class="btn bg-fotored hover-gray-link mt-6 p-2 text-white uppercase" type="submit">Küldés</button>
        @endif
    </div>
</form>
<script>
    function submitContactmessage() {
        document.getElementById('contact-form-submit-button').setAttribute('disabled', true);
        let formNode = document.getElementById('contact-form');
        let formData = {
            'name': formNode.querySelector('#name').value,
            'email': formNode.querySelector('#email').value,
            'phone': formNode.querySelector('#phone').value,
            'message': formNode.querySelector('#message').value,
        }
        let printerNode = formNode.querySelector('#printer_id');
        if (printerNode !== null) {
            formData['printer_id'] = printerNode.value
        }
        Array.from(formNode.querySelectorAll('.validation-error')).forEach((errorNode) => {
            errorNode.querySelector('span').innerHTML = '';
            errorNode.classList.add('hidden');
        })
        window.axios.post('{{ $action ?? '' }}', formData)
            .then((response) => {
                Array.from(formNode.querySelectorAll('input[type="text"]')).forEach((i) => {
                    i.value = '';
                })
                Array.from(formNode.querySelectorAll('textarea')).forEach((i) => {
                    i.value = '';
                })
                document.getElementById('contact-form-response-message').innerText = response.data;
                document.getElementById('contact-form-submit-button').removeAttribute('disabled');

            }).catch((error) => {
                if (error.response.status == 422) {
                    Object.keys(error.response.data.errors).forEach((err) => {
                        let errorNode = formNode.querySelector('div[data-fieldname="'+err+'"]').querySelector('.validation-error');
                        errorNode.querySelector('span').innerHTML = error.response.data.errors[err][0];
                        errorNode.classList.remove('hidden');
                    });
                    document.getElementById('contact-form-submit-button').removeAttribute('disabled');
                }
            })
    }
</script>