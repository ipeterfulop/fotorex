<template>
    <div>
        <button v-on:click="initializePopup"><span v-if="loading" style="margin-right: .5rem" v-html="spinnerSrc"></span>Kezelés</button>
        <popup :show-close-button="false" :visible="showPopup" v-if="loaded" v-on:close="discardChanges">
            <related-printers-list :operations-url="operationsUrl"
                                   :printer-id="printerId"
                                   v-model="value"
            ></related-printers-list>
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
            relationType: {},
        },
        data: function () {
            return {
                showPopup: false,
                value: [],
                statusMessage: '',
                loaded: false,
                loading: false,
            }
        },
        mounted() {
        },
        methods: {
            saveChanges: function() {
                this.$refs.savebutton.setAttribute('disabled', true);
                window.axios.post(this.operationsUrl, {action: 'saveChanges', relationType: this.relationType, printerId: this.printerId, value: this.value})
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
            discardChanges: function() {
                this.showPopup = false;
                this.value = [];
                this.loaded = false;
            },
            initializePopup: function() {
                this.loading = true;
                this.statusMessage = '';
                window.axios.post(this.operationsUrl, {action: 'getRelated', relationType: this.relationType, printerId: this.printerId})
                    .then((response) => {
                        this.value = response.data.value;
                        this.loaded = true;
                        this.loading = false;
                        Vue.nextTick(() => {
                            this.showPopup = true;
                            Vue.nextTick(() => {
                                this.$refs.savebutton.removeAttribute('disabled');
                            })
                        })
                    })

            }
        },
        computed: {},
        watch: {}

    }
</script>
