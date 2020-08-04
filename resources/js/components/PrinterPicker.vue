<template>
    <div style="display:flex; flex-direction: row; width: 100%">
        <template v-if="manufacturers.length == 0">
            <div style="width: 100%; display: flex; align-items: center; justify-content: center">
                <div  v-html="spinnerSrc"></div>
            </div>
        </template>
        <template v-else>
            <div style="display: flex; flex-direction: column; height: 100%; align-items: flex-start; justify-content: flex-start">
                <label>Gyártó</label>
                <select v-model="manufacturer_id"
                        class="form-control"
                >
                    <option v-for="manufacturer in manufacturers"
                            :value="manufacturer.id"
                            v-html="manufacturer.name"
                    ></option>
                </select>
            </div>
            <div style="display: flex; flex-direction: column; height: 100%; align-items: flex-start; justify-content: flex-start; margin-left: 1rem">
                <label>Modell</label>
                <template v-if="loadingPrinters">
                    <div  v-html="spinnerSrc"></div>
                </template>
                <template v-else>
                    <template v-if="printers.length == 0">
                        Nem található készülék
                    </template>
                    <template v-else>
                        <select v-model="printer_id"
                                class="form-control"
                        >
                            <option v-for="printer in printers"
                                    :value="printer.id"
                                    v-html="printer.name"
                            ></option>
                        </select>
                    </template>
                </template>
            </div>
        </template>
    </div>
</template>

<script>
    import {spinner} from "./mixins/spinner";

    export default {
        mixins: [spinner],
        props: {
            operationsUrl: {type: String},
            value: {},
        },
        data: function () {
            return {
                manufacturer_id: -1,
                printer_id: -1,
                manufacturers: [],
                printers: [],
                loadingPrinters: true,
            }
        },
        mounted() {
            this.fetchManufacturers();
            this.fetchPrinters();
        },
        methods: {
            fetchManufacturers: function() {
                window.axios.get(this.operationsUrl, {params: {action: 'fetchManufacturers'}})
                    .then((response) => {
                        this.manufacturers = response.data.manufacturers;
                    });
            },
            fetchPrinters: function() {
                this.loadingPrinters = true;
                window.axios.get(this.operationsUrl, {params: {action: 'fetchPrinters', manufacturer_id: this.manufacturer_id}})
                    .then((response) => {
                        if (response.data.printers.filter(printer => printer.id == this.value).length > 0) {
                            this.printer_id = this.value;
                        } else {
                            this.printer_id = -1;
                        }
                        this.printers = response.data.printers;
                        this.loadingPrinters = false;
                    });
            },
            emitData: function() {
                this.$emit('input', this.printer_id);
            }
        },
        computed: {

        },
        watch: {
            printer_id: function() {
                this.emitData();
            },
            manufacturer_id: function() {
                this.fetchPrinters();
            }
        }

    }
</script>
