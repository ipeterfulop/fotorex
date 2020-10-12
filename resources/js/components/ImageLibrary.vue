<template>
    <div class="image-library-container">
        <template v-for="image in images">
            <div draggable="true"
                 :data-imageurl="objectMode ? image.url : image"
                 :data-imageid="objectMode ? image.id : image"
                 v-on:dragover="$event.preventDefault()"
                 v-on:dragstart="startMoving"
                 v-on:dragend="endMoving"
                 v-on:dragenter="showDragOverEffect($event, objectMode ? image.url : image)"
                 v-on:dragleave="hideDragOverEffect($event, objectMode ? image.url : image)"
                 v-on:drop="moveToBefore($event, objectMode ? image.url : image)"
                 v-on:click.self="previewUrl = objectMode ? image.url : image"
                 :ref="objectMode ? 'image-'+image.url : 'image-'+image"
                 class="image-library-thumbnail">
                <img style="max-height: 100%; max-width: 100%" :src="objectMode ? image.url : image" :label="objectMode ? image.url : image">
                <div class="image-library-thumbnail-button"
                     v-on:click="removeImage(objectMode ? image.url : image)"
                     v-show="moving === false"
                >-
                </div>
            </div>
        </template>
        <div v-show="moving !== false"
             class="image-library-drop-field"
             :ref="'image-end'"
             v-on:dragover="$event.preventDefault()"
             v-on:dragenter="showDragOverEffect($event, 'end')"
             v-on:dragleave="hideDragOverEffect($event, 'end')"
             v-on:drop="moveToEnd($event)"
        ><span></span></div>
        <div v-if="adding" v-html="spinnerSrc"></div>
        <div style="height: 5rem; margin: .2rem; padding-top: 1rem">
            <label :for="'selected-file-'+fieldname" style="display:flex; height: 100%; padding: 5%">
                <input :id="'selected-file-'+fieldname"
                       type="file"
                       :accept="this.accept === false ? '' : this.accept.join(',')"
                       v-on:change="fileSelected"
                       style="height:0px; width:0px; opacity:0">
                <span class="image-library-add-button">+</span>
            </label>
        </div>
        <popup :visible="previewUrl != ''" v-on:close="previewUrl = ''">
            <div style="display: flex; align-items: center; justify-content: center">
                <img :src="previewUrl" style="max-height: 70vh; max-width: 70vw">
            </div>
        </popup>
    </div>
</template>

<script>
    import {fileUploadMixin} from './mixins/fileUploadMixin.js'
    import {spinner} from './mixins/spinner'

    export default {
        mixins: [fileUploadMixin, spinner],
        props: {
            uploadUrl: {type: String},
            value: {type: Array},
            fieldname: {type: String, default: 'fieldname'},
            formElementLabel: {type: String, default: ''},
            limit: {default: null},
            accept: {default: false},
            objectMode: {type: Boolean, default: true},
        },
        data: function () {
            return {
                adding: false,
                images: [],
                selectedFileLabel: '',
                selectedFile: '',
                allowedFileTypes: [],
                defaultValue: null,
                moving: false,
                previewUrl: '',
            }
        },
        created() {
            if (this.accept !== false) {
                this.accept.forEach((allowString) => {
                    allowString.split(',').forEach((allow) => {
                        this.allowedFileTypes.push(allow);
                    })
                })
            }
        },
        mounted() {
            this.images = this.value;
            if (this.objectMode) {
                this.emitValue();
            }
        },
        methods: {
            emitValue: function() {
                this.$emit('input', this.formData);
            },
            showDragOverEffect: function(event, url) {
                event.preventDefault();
                let target = this.$refs['image-'+url][0] || this.$refs['image-'+url];
                if (target.getAttribute('data-imageurl') !== this.moving) {
                    target.classList.add('image-library-thumbnail-dropping');
                }
            },
            hideDragOverEffect: function(event, url) {
                event.preventDefault();
                let target = this.$refs['image-'+url][0] || this.$refs['image-'+url];
                target.classList.remove('image-library-thumbnail-dropping');
            },
            removeImage: function (url) {
                if (this.objectMode) {
                    this.images = this.images.filter(item => item.url != url);
                } else {
                    this.images = this.images.filter(item => item != url);
                }
                this.emitValue();
            },
            startMoving: function(event) {
                let target = event.target;
                while (target.getAttribute('data-imageurl') == null) {
                    target = target.parentNode;
                }
                event.dataTransfer.setData('url', target.getAttribute('data-imageurl'));
                event.dataTransfer.setData('id', target.getAttribute('data-imageid'));
                window.setTimeout(() => {
                    Array.from(document.querySelectorAll('.image-library-thumbnail img')).forEach((t) => {
                        t.classList.add('pointer-events-none');
                    });
                    this.moving = target.getAttribute('data-imageurl');
                    target.classList.add('image-library-thumbnail-hidden');
                }, 10);

            },
            endMoving: function(event) {
                event.target.classList.remove('image-library-thumbnail-hidden');
                this.moving = false;
                Array.from(document.querySelectorAll('.image-library-thumbnail')).forEach((t) => {
                    t.querySelector('img').classList.remove('pointer-events-none');
                    t.classList.remove('image-library-thumbnail-dropping');
                    t.classList.remove('image-library-thumbnail-hidden');
                });
                document.querySelector('.image-library-drop-field').classList.remove('image-library-thumbnail-dropping');
            },
            moveToBefore: function(event, imageUrl) {
                event.stopPropagation();
                event.preventDefault();
                let newOrder = [];
                this.imageUrls.forEach((item) => {
                    if (item == decodeURI(imageUrl)) {
                        newOrder.push(decodeURI(event.dataTransfer.getData('url')));
                    }
                    if (item != decodeURI(event.dataTransfer.getData('url'))) {
                        newOrder.push(item);
                    }
                });
                if (this.objectMode) {
                    let newImages = [];
                    newOrder.forEach((image) => {
                        newImages.push(this.images.find(element => element.url == image));
                    })
                    this.images = newImages;
                } else {
                    this.images = newOrder;
                }
                this.emitValue();
            },
            moveToEnd: function(event) {
                event.stopPropagation();
                event.preventDefault();
                this.removeImage(decodeURI(event.dataTransfer.getData('url')));
                if (this.objectMode) {
                    this.images.push({id: event.dataTransfer.getData('id'), url: decodeURI(event.dataTransfer.getData('url'))});
                } else {
                    this.images.push(decodeURI(event.dataTransfer.getData('url')));
                }
                this.emitValue();
            },
            fileSelected: function (event) {
                if (event.target.files.length == 0) {
                    return false;
                }
                if (this.allowedFileTypes.indexOf(event.target.files[0].type) == -1) {
                    return false;
                }
                if (this.imageUrls.length == this.limit) {
                    alert('Maximum '+this.limit+' fájl tölthető fel!')
                    return false;
                }
                this.adding = true;
                this.uploadPublicFileToVueCRUDController(
                    this.uploadUrl,
                    event.target.files[0],
                    'storePublicPicture'
                ).then((response) => {
                    this.adding = false;
                    if (this.objectMode) {
                        this.images.push(response.data.image);
                    } else {
                        this.images.push(response.data.url);
                    }
                    this.emitValue();
                }).catch((error) => {
                    console.log(error);
                })
            },
        },
        computed: {
            imageUrls: function() {
                if (this.objectMode) {
                    return this.images.map((imageData) => {
                        return imageData.url;
                    });
                } else {
                    return this.images;
                }
            },
            formData: function() {
                if (this.objectMode) {
                    return this.images.map((imageData) => {
                        return imageData.id;
                    });
                } else {
                    return this.images;
                }
            }
        }
    }
</script>
<style>
    .image-library-container {
        min-height: 10rem;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: flex-start;
        border: 1px solid darkgrey
    }

    .image-library-add-button {
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

    .image-library-add-button:hover {
        box-shadow: .2rem .2rem rgba(7, 7, 7, .5);
    }

    .image-library-thumbnail {
        object-fit: contain;
        box-shadow: .2rem .2rem rgba(7,7,7,.4);
        height: 5rem;
        width: 5rem;
        max-height: 5rem;
        max-width: 5rem;
        margin: .2rem;
        position: relative;
        cursor: move;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        transition: width 200ms ease-in-out, max-width 200ms ease-in-out, padding-left 200ms ease-in-out;
    }
    .pointer-events-none {
        pointer-events: none;
    }
    .image-library-thumbnail-dropping {
        padding-left: 2rem;
        width: 7rem;
        max-width: 7rem;
    }
    .image-library-thumbnail-hidden {
        width: 0px !important;
    }

    .image-library-thumbnail-button {
        visibility: hidden;
        cursor: pointer;
        position: absolute;
        z-index:100;
        top: 0px;
        right: 0px;
        width: 40%;
        height: 40%;
        background-color: rgba(7, 7, 7, .5);
        color: white;
        font-size: 2rem;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .image-library-thumbnail:hover .image-library-thumbnail-button {
        visibility: visible;
    }
    .image-library-drop-field.image-library-thumbnail-dropping {
        background-color: rgba(7,7,7,.2);
    }
    .image-library-drop-field {
        height: 5rem;
        margin: .2rem;
        width: 2rem;
        max-height: 5rem;
        flex-shrink: 0;
        background-color: transparent;
        box-shadow: .2rem .2rem rgba(7,7,7,.4);
        transition: transform 200ms ease-in-out, background-color 200ms ease-in-out;
    }

</style>
