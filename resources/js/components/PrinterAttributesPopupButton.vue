<template>
    <div>
        <button v-on:click="initializePopup"><span v-if="loading" style="margin-right: .5rem" v-html="spinnerSrc"></span>Kezelés</button>
        <popup :show-close-button="false" :visible="showPopup" v-if="loaded" v-on:close="discardChanges">
            <div style="width: 100%; display: flex; justify-content: flex-start; flex-direction: column; align-items: center">
                <h3 style="text-align: center; width: 100%; margin-bottom: 1rem;" v-html="printer.displayname+' tulajdonságai'"></h3>
                <div style="display: flex; flex-direction: column; align-items: stretch; justify-content: flex-start; height: 60vh; overflow-y: auto; max-width: 980px; width: 980px; border-bottom: 1px solid lightgray; border-top: 1px solid lightgray; padding: .5rem">
                    <div v-if="loading" v-html="spinnerSrc"></div>
                    <template v-if="!loading">
                        <div v-for="attribute in attributes">
                            <div style="display: flex; justify-content: space-between; flex-direction: row; align-items: center; border-bottom: 1px solid lightgray; padding: .2rem">
                                <div style="width: 60%; display: flex; align-items: flex-start; justify-content: flex-start; flex-direction: column"
                                     v-html="attribute.name"
                                     v-bind:class="{'text-danger': attribute.value == null || JSON.stringify(attribute.value) == '[]'}"></div>
                                <div v-if="attribute.attribute_value_set == null" style="width: 39%;">
                                    <input v-if="attribute.is_richtext == 0" v-model="attribute.value" type="text" style="width: 100%; text-align: right">
                                    <quill-wrapper v-if="attribute.is_richtext == 1"
                                                   v-model="attribute.value"
                                                   :custom-id="attribute.variable_name"
                                                   v-bind:fieldname="attribute.variable_name">

                                    </quill-wrapper>
                                </div>
                                <div v-if="attribute.attribute_value_set != null"  style="width: 39%">
                                    <template v-if="attribute.multiselect">
                                        <div style="display: flex; flex-direction: column; align-items: stretch; justify-content: flex-start;">
                                            <label v-for="av in attribute.attribute_value_set.attribute_values" style="margin-bottom: 1px; border-bottom: 1px solid lightgray">
                                                <input type="checkbox" v-model="attribute.value" :value="av.value" style="margin-right: .5rem">
                                                {{ av.label }}
                                            </label>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <select v-model="attribute.value" style="width: 100%; text-align: right">
                                            <option v-for="av in attribute.attribute_value_set.attribute_values"
                                                    v-html="av.label"
                                                    v-bind:value="av.id"></option>
                                        </select>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            <div style="display: flex; align-items: center; justify-content: space-between; width: 100%; padding-top: 1rem; font-weight: bold" v-if="statusMessage != ''">
                {{ statusMessage }}
            </div>
            <div style="display: flex; align-items: center; justify-content: space-between; width: 100%; padding-top: 1rem">
                <button class="btn btn-primary" v-on:click="saveChanges" :ref="'savebutton'">Mentés</button>
                <button class="btn btn-secondary" v-on:click="discardChanges">Mégse</button>
            </div>
        </popup>
    </div>
</template>

<script>
    import {spinner} from './mixins/spinner'
    export default {
        mixins: [spinner],
        props: {
            operationsUrl: {type: String},
            printerId: {},
        },
        data: function () {
            return {
                showPopup: false,
                statusMessage: '',
                loaded: false,
                loading: false,
                attributes: [],
                printerattributevalues: [],
                printer: null,
            }
        },
        mounted() {},
        methods: {
            saveChanges: function() {
                this.$refs.savebutton.setAttribute('disabled', true);
                window.axios.post(this.operationsUrl, {action: 'saveChanges', printerId: this.printerId, attributes: this.attributes})
                    .then((response) => {
                        this.value = [];
                        this.statusMessage = 'Módosítások elmentve';
                        window.setTimeout(() => {
                            this.showPopup = false;
                        }, 2000);
                    }).catch((error) => {
                    this.statusMessage = error.response.data;
                    this.$refs.savebutton.removeAttribute('disabled');
                });
            },
            fetchData: function() {
                window.axios.post(this.operationsUrl, {printerId: this.printerId, action: 'fetchData'})
                    .then((response) => {
                        this.printer = response.data.printer;
                        let attributes = response.data.attributes;
                        this.attributes = attributes.map((attribute) => {
                            let newAttribute = {...attribute};
                            let pav = response.data.printerattributevalues.find(item => item.variable_name == attribute.variable_name);
                            newAttribute.value = pav == undefined ? null : pav.finalvalue_or_id;
                            return newAttribute;
                        });
                        this.loaded = true;
                        this.loading = false;
                        Vue.nextTick(() => {
                            this.showPopup = true;
                            Vue.nextTick(() => {
                                this.$refs.savebutton.removeAttribute('disabled');
                            })
                        })

                    }).catch((error) => {
                        alert(error.response.data);
                    });
            },
            discardChanges: function() {
                this.showPopup = false;
                this.value = [];
                this.loaded = false;
            },
            initializePopup: function() {
                this.loading = true;
                this.statusMessage = '';
                this.fetchData();
            }
        },
        computed: {},
        watch: {}

    }
</script>
