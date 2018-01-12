<template>
        <div><p>test2</p>
                <button @click="doit">di ot</button></div>

</template>
<script>
    export default {
        mounted(){
            console.log('test');
        },
        methods:{
            doit(){
                this.$router.push({path:'test2', query: { plan: 'private' }});
            }
        }
    }
</script>