<template>
    <div class="related-printers-list">
        <div v-if="loading" v-html="spinnerSrc"></div>
        <template v-else>
            <div class="related-printers-container">
                <div draggable="true"
                     v-for="item in items"
                     :data-itemid="item.id"
                     v-on:dragover="$event.preventDefault()"
                     v-on:dragstart="startMoving"
                     v-on:dragend="endMoving"
                     v-on:dragenter="showDragOverEffect($event, item.id)"
                     v-on:dragleave="hideDragOverEffect($event, item.id)"
                     v-on:drop="moveToBefore($event, item.id)"
                     :ref="'item-'+item.id"
                     class="related-printers-row">
                    <span v-html="item.name"></span>
                    <div class="related-printers-row-button"
                         v-on:click="removeItem(item.id)"
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
                <div style="display:flex; align-items: stretch; justify-content: flex-start; flex-direction: column">
                    <label>Válasszon</label>
                    <select v-model="selectedElement">
                        <option v-for="value in valueset"
                                v-if="!itemIds.includes(value.id)"
                                :value="value.id"
                                v-html="value.name"
                        ></option>
                    </select>
                </div>
                <button style="margin-left: auto"
                        v-on:click="addSelected()">+</button>
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
                allowedFileTypes: [],
                moving: false,
            }
        },
        created() {},
        mounted() {
            this.fetchValueset();
        },
        methods: {
            addSelected: function() {
                if (this.items.find(element => element.id == this.selectedElement) === undefined) {
                    this.items.push(this.valueset.find(element => element.id == this.selectedElement));
                }
            },
            emitValue: function() {
                this.$emit('input', this.formData);
            },
            showDragOverEffect: function(event, itemId) {
                console.log(itemId);
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
                this.items = this.items.filter(item => item.id != itemId);
                this.emitValue();
            },
            startMoving: function(event) {
                let target = event.target;
                while (target.getAttribute('data-itemid') == null) {
                    target = target.parentNode;
                }
                console.log(target);
                event.dataTransfer.setData('id', target.getAttribute('data-itemid'));
                event.dataTransfer.setDragImage(target.firstChild, 100, 100);
                window.setTimeout(() => {
                    Array.from(document.querySelectorAll('.related-printers-row')).forEach((t) => {
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
                    t.classList.remove('pointer-events-none');
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
                    if (item.id == itemId) {
                        newOrder.push(this.valueset.find(element => element.id == event.dataTransfer.getData('id')));
                    }
                    if (item.id != event.dataTransfer.getData('id')) {
                        newOrder.push(item);
                    }
                });
                this.items = newOrder;
                this.emitValue();
            },
            moveToEnd: function(event) {
                event.stopPropagation();
                event.preventDefault();
                this.removeItem(event.dataTransfer.getData('id'));
                this.items.push(this.valueset.find(element => element.id == event.dataTransfer.getData('id')));
                this.emitValue();
            },
            fetchValueset: function() {
                window.axios.post(this.operationsUrl, {action: 'fetchValueset'})
                    .then((response) => {
                        this.valueset = response.data.valueset;
                        this.items = this.valueset.filter((item) => {
                            return this.value.includes(item.id);
                        });
                        // testing block
                            this.valueset.forEach((item) => {
                                if (this.items.length < 4) {
                                    this.items.push(item);
                                }
                            });
                        // end testing
                        this.loading = false;
                        this.emitValue();
                    })
            }
        },
        computed: {
            itemIds: function() {
                return this.items.map(element => element.id);
            },
            formData: function() {
                return this.items.map((itemData) => {
                    return itemData.id;
                });
            }
        }
    }
</script>
<style>
    .related-printers-container {
        min-height: 20rem;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        align-items: flex-start;
        justify-content: flex-start;
        border: 1px solid darkgrey
    }

    .related-printers-add-button {
        height: 3rem;
        width: 3rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        border-radius: 50%;
        border: 1px solid darkgrey;
        transition: box-shadow 200ms ease-in-out;
    }

    .related-printers-add-button:hover {
        box-shadow: .2rem .2rem rgba(7, 7, 7, .5);
    }

    .related-printers-row {
        margin: .2rem;
        width: 100%;
        display: flex;
        border: 1px solid lightgray;
        padding: .5rem;
        padding-top: .5rem;
        text-align: left;
        transition: background-color 200ms ease-in-out, padding-top 200ms ease-in-out;
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
        padding-left: 2rem !important;
    }
    .related-printers-row-hidden {
        height: 0px !important;
    }

    .related-printers-row-button {
        visibility: hidden;
        cursor: pointer;
        position: absolute;
        z-index:100;
        top: 0px;
        right: 0px;
        width: 2em;
        height: 100%;
        background-color: rgba(7, 7, 7, .5);
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
        box-shadow: .2rem .2rem rgba(7,7,7,.4);
        transition: transform 200ms ease-in-out, background-color 200ms ease-in-out;
    }
</style>
