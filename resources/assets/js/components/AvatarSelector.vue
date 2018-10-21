<template>
    <div>
        <img :src="imagePreview" class="avatar-preview" @click="imageUpload" v-if="imagePreview">

        <input type="file" name="avatar" class="d-none" ref="file-avatar" @change="handleFileChange"/>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                imagePreview: '/images/default-avatar.svg',
                file: null
            }
        },
        watch: {
            file() {
                this.$emit('select-file', this.file)
            }
        },
        methods: {
            handleFileChange() {
                this.file = this.$refs['file-avatar'].files[0]

                /*
                  Initialize a File Reader object
                */
                let reader  = new FileReader();

                /*
                  Add an event listener to the reader that when the file
                  has been loaded, we flag the show preview as true and set the
                  image to be what was read from the reader.
                */
                reader.addEventListener("load", function () {
                    this.imagePreview = reader.result
                    console.log(reader.result)
                }.bind(this), false);

                /*
                  Check to see if the file is not empty.
                */
                if(this.file) {
                    console.log(this.file.name)
                    /*
                      Ensure the file is an image file.
                    */
                    if(/\.(jpe?g|png|gif)$/i.test(this.file.name)) {
                        console.log(this.file.name)
                        /*
                          Fire the readAsDataURL method which will read the file in and
                          upon completion fire a 'load' event which we will listen to and
                          display the image in the preview.
                        */
                        reader.readAsDataURL(this.file);
                    }
                }
            },
            imageUpload() {
                this.$refs['file-avatar'].click()
            }
        }
    }
</script>

<style>
.avatar-preview {
    cursor: pointer;
    height: 60px;
    width: 60px;
    border-radius: 50%;
}
</style>