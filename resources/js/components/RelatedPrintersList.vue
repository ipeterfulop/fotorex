<template>
    <div class="related-printers-list">
        <div v-if="loading" v-html="spinnerSrc"></div>
        <template v-else>
            <div class="related-printers-container">
                <div draggable="true"
                     v-for="item in items"
                     :data-itemid="item.custom_id"
                     v-on:dragover="$event.preventDefault()"
                     v-on:dragstart="startMoving"
                     v-on:dragend="endMoving"
                     v-on:dragenter="showDragOverEffect($event, item.custom_id)"
                     v-on:dragleave="hideDragOverEffect($event, item.custom_id)"
                     v-on:drop="moveToBefore($event, item.custom_id)"
                     :ref="'item-'+item.custom_id"
                     class="related-printers-row">
                    <span v-if="item.custom_id.toString().substr(0,1) == 'x'">
                        <input placeholder="Megjelenítendő felirat" v-model="item.final_label">
                        <input placeholder="URL" v-model="item.url" style="margin-left: 1rem">
                    </span>
                    <span v-if="item.custom_id.toString().substr(0,1) != 'x'">
                        <span v-html="item.final_label"></span>
                    </span>
                    <div class="related-printers-row-button"
                         v-on:click="removeItem(item.custom_id)"
                         v-show="moving === false"
                    >-
                    </div>
                </div>
                <div v-show="moving !== false"
                     class="related-printers-drop-field"
                     :ref="'item-end'"
                     v-on:dragover="$event.preventDefault()"
                     v-on:dragenter="showDragOverEffect($event, 'end')"
                     v-on:dragleave="hideDragOverEffect($event, 'end')"
                     v-on:drop="moveToEnd($event)"
                ><span></span></div>
            </div>
            <div style="width: 100%; margin-top: 1rem; display: flex; flex-direction: row; ">
                <div style="display:flex; align-items: stretch; justify-content: flex-start; flex-direction: column; flex-grow:1; margin-right: 3rem">
                    <label>Válasszon terméket. A sorrend változtatásához húzza a fenti listában egérrel a sorokat.</label>
                    <select v-model="selectedElement" style="width: 100%; padding: .25rem;">
                        <option value="custom">Egyedi URL</option>
                        <option value="-1"> --- </option>
                        <option v-for="value in valueset"
                                v-if="!itemIds.includes(value.id)"
                                :value="value.id"
                                v-html="value.shortdisplayname"
                        ></option>
                    </select>
                </div>
                <button style="margin-left: auto; width: 4rem; border-radius: .25rem"
                        :disabled="selectedElement == '' || selectedElement == -1 || selectedElement == null"
                        v-on:click="addSelected">+</button>
            </div>
        </template>
    </div>
</template>

<script>
    import {fileUploadMixin} from './mixins/fileUploadMixin.js'
    import {spinner} from './mixins/spinner'

    export default {
        mixins: [fileUploadMixin, spinner],
        props: {
            operationsUrl: {type: String},
            printerId: {},
            value: {type: Array, default: () => {return []}},
            fieldname: {type: String, default: 'fieldname'},
            formElementLabel: {type: String, default: ''},
            limit: {default: null},
        },
        data: function () {
            return {
                loading: true,
                items: [],
                valueset: [],
                selectedElement: '',
                moving: false,
            }
        },
        created() {},
        mounted() {
            this.fetchValueset();
        },
        methods: {
            randomId: function() {
                return 'x_'+Math.ceil(Math.random() * 1000000);
            },
            addSelected: function() {
                if (this.selectedElement == 'custom') {
                    this.items.push({
                        custom_id: this.randomId(),
                        final_label: '',
                        final_url: '',
                        similar_printer_id: null
                    });
                    return;
                }
                if (this.items.find(element => element.id == this.selectedElement) === undefined) {
                    let newItem = this.valueset.find(element => element.id == this.selectedElement);
                    this.items.push({
                        custom_id: newItem.id,
                        final_label: newItem.shortdisplayname,
                        final_url: null,
                        similar_printer_id: newItem.id
                    });
                }
                this.emitValue();
            },
            emitValue: function() {
                this.$emit('input', this.items);
            },
            showDragOverEffect: function(event, itemId) {
                event.preventDefault();
                let target = this.$refs['item-'+itemId][0] || this.$refs['item-'+itemId];
                if (target.getAttribute('data-itemid') !== this.moving) {
                    target.classList.add('related-printers-row-dropping');
                }
            },
            hideDragOverEffect: function(event, itemId) {
                event.preventDefault();
                let target = this.$refs['item-'+itemId][0] || this.$refs['item-'+itemId];
                target.classList.remove('related-printers-row-dropping');
            },
            removeItem: function (itemId) {
                this.items = this.items.filter(item => item.custom_id != itemId);
                this.emitValue();
            },
            startMoving: function(event) {
                let target = event.target;
                while (target.getAttribute('data-itemid') == null) {
                    target = target.parentNode;
                }
                event.dataTransfer.setData('id', target.getAttribute('data-itemid'));
                event.dataTransfer.setDragImage(target.querySelector('span'), 100, 100);
                window.setTimeout(() => {
                    Array.from(document.querySelectorAll('.related-printers-row span')).forEach((t) => {
                        t.classList.add('pointer-events-none');
                    });
                    this.moving = target.getAttribute('data-itemid');
                    target.classList.add('related-printers-row-hidden');
                }, 10);

            },
            endMoving: function(event) {
                event.target.classList.remove('related-printers-row-hidden');
                this.moving = false;
                Array.from(document.querySelectorAll('.related-printers-row')).forEach((t) => {
                    t.querySelector('span').classList.remove('pointer-events-none');
                    t.classList.remove('related-printers-row-dropping');
                    t.classList.remove('related-printers-row-hidden');
                });
                document.querySelector('.related-printers-drop-field').classList.remove('related-printers-row-dropping');
            },
            moveToBefore: function(event, itemId) {
                event.stopPropagation();
                event.preventDefault();
                let newOrder = [];
                this.items.forEach((item) => {
                    if (item.custom_id == itemId) {
                        newOrder.push(this.items.find(element => element.custom_id == event.dataTransfer.getData('id')));
                    }
                    if (item.custom_id != event.dataTransfer.getData('id')) {
                        newOrder.push(item);
                    }
                });
                this.items = newOrder;
                this.emitValue();
            },
            moveToEnd: function(event) {
                event.stopPropagation();
                event.preventDefault();
                let item = this.items.find(element => element.custom_id == event.dataTransfer.getData('id'));
                this.removeItem(event.dataTransfer.getData('id'));
                this.items.push(item);
                this.emitValue();
            },
            fetchValueset: function() {
                window.axios.post(this.operationsUrl, {action: 'fetchValueset', printerId: this.printerId})
                    .then((response) => {
                        this.valueset = response.data.valueset;
                        this.items = [];
                        this.value.forEach((v) => {
                            if ((v.custom_id.toString().substr(0,1) == 'x') || (this.valueset.filter(vi => vi.id == v.custom_id).length > 0)) {
                                this.items.push(v);
                            }
                        });
                        this.loading = false;
                        this.emitValue();
                    })
            }
        },
        computed: {
            itemIds: function() {
                if (this.items == null) {
                    return [];
                }
                return this.items.map(element => element.id);
            },
            formData: function() {
                return this.items;
                //return this.items.map((itemData) => {
                //  return itemData.id;
                //});
            }
        }
    }
</script>
<style>
    .related-printers-container {
        min-height: 20rem;
        max-height: 20rem;
        overflow-y: auto;
        padding: .1rem;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        align-items: flex-start;
        justify-content: flex-start;
        background-color: lightgray;
    }

    .related-printers-row {
        margin: 0px;
        margin-bottom: .2rem;
        width: 100%;
        display: flex;
        background-color: white;
        padding: .5rem;
        padding-top: .5rem;
        text-align: left;
        transition: padding 200ms ease-in-out;
        position: relative;
        cursor: move;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
    .pointer-events-none {
        pointer-events: none;
    }
    .related-printers-row-dropping {
        padding-top: 2rem !important;
    }
    .related-printers-row-hidden {
        opacity: .25;
    }

    .related-printers-row-button {
        visibility: hidden;
        cursor: pointer;
        position: absolute;
        margin: .25rem;
        z-index:100;
        top: 0px;
        right: 0px;
        width: 2em;
        height: 75%;
        background-color: rgba(128, 7, 7, .5);
        color: white;
        font-size: 2rem;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .related-printers-row:hover .related-printers-row-button {
        visibility: visible;
    }
    .related-printers-drop-field.related-printers-row-dropping {
        background-color: rgba(7,7,7,.2);
    }
    .related-printers-drop-field {
        height: 2rem;
        margin: .2rem;
        width: 100%;
        flex-shrink: 0;
        background-color: transparent;
        transition: transform 200ms ease-in-out, background-color 200ms ease-in-out;
    }
</style>
