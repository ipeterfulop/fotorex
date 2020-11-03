<template>
    <div>
        <a href="#" v-on:click.prevent="showInput" v-html="internalValue"></a>
        <span v-if="showLoader" v-html="spinnerSrc"></span>
    </div>
</template>

<script>
    import {spinner} from './mixins/spinner.js'
    export default {
        mixins: [spinner],
        props: {
            operationsUrl: {type: String},
            subject: {},
            action: {type: String},
            successEvent: {type: String, default: 'submit-success'},
            failureEvent: {type: String, default: 'submit-failed'},
            value: {},
            question: {type: String}
        },
        data: function () {
            return {
                showLoader: false,
                internalValue: '',
            }
        },
        created() {
            this.internalValue = this.value;
        },
        mounted() {
        },
        methods: {
            showInput: function() {
                let newValue = window.prompt(this.question, this.internalValue);
                if (newValue == null) {
                    return;
                }
                this.showLoader = true;
                window.axios.post(this.operationsUrl, {
                    action: this.action,
                    subject: this.subject,
                    value: newValue
                }).then((response) =>{
                    this.showLoader = false;
                    this.internalValue = newValue;
                    this.$emit(this.successEvent, response.data);
                }).catch((error) => {
                    this.showLoader = false;
                    this.$emit(this.failureEvent, error.response.data);
                    alert(error.response.data);
                });
            }
        },
        computed: {},
        watch: {}

    }
</script>
