<template></template>
<script>
    export default {
        mounted(){
            this.$root.destroyLogin();
            this.$router.push('/auth/login');
        },
        route: {
            activate: function (transition) {

                //transition.redirect('login')
            }
        }

    }
</script>