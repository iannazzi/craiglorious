<template>

    <div>

            <div>


            </div>
                <div class="row vertical-align">
                    <div class="col-md-4">
                        <h4>Event Title</h4>
                    </div>
                    <div class="col-md-8" >
                        <input id="entry_title" type="text" name="title" class=""
                               v-model="title" >
                    </div>


                </div>
                <div>


                    <button  class="btn btn-primary" v-on:click="onSave">
                        Save
                    </button>
                </div>
        </div>

    </div>
</template>

<script>

    export default {
        data(){
            return {
                title:''
            }
        },

        mounted(){
            console.log(this.$route.query.datest);
            let self = this;

        },
        methods: {

            onSave(){
                alert('on save');
                this.loading = true;
                let post_data = {
                    title: this.title,
                }
                let data = {data: post_data, _method: 'put'};
                console.log(JSON.stringify(data))
            },

        }
    }
</script>

