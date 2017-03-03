<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Home Page</div>

                    <div class="panel-body">
                        I'm a about component!
                        <zzi-modal v-show="showModal" @close="showModal = false"></zzi-modal>
                        <button @click="showModal = true">show modal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                showModal:false,
            }

        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
