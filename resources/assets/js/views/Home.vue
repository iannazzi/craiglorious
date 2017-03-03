<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Home Page</div>

                    <div class="panel-body">
                        I'm a home component!
                        <zzi-tabs>
                            <zzi-tab name="Why me?" :selected="true">
                                <h1>Here is the content for the about us</h1>
                            </zzi-tab>
                            <zzi-tab name="Because me?">
                                <h1>Here is the content for the because us</h1>
                            </zzi-tab>
                            <zzi-tab name="Why not?">
                                <h1>Here is the content for the boit us</h1>
                            </zzi-tab>
                        </zzi-tabs>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
