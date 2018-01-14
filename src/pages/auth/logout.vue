<template></template>
<script>
    export default {
        mounted(){
//            bus.$emit('userHasLoggedOut')

        },
        ready(){
            bus.$emit('userHasLoggedOut')

        },
        route: {
            activate: function (transition) {

                //transition.redirect('login')
            }
        }

    }
</script>