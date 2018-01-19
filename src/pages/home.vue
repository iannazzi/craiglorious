<template>
    <div>
        <nav-component></nav-component>

        <div class = "container">
            <div class="jumbotron">
                <h1>
                    Home page, not much to do here
                </h1>
                <h2>right?</h2>
            </div>
        </div>
        <footer-component></footer-component>
    </div>
</template>
<script>
    //inspiration layout pages
    //https://www.sparkpost.com/
    module.exports = {

        data: function () {
            return {
                binders: [],
                messages: []
            }
        },
        ready() {
        }

    }
</script>