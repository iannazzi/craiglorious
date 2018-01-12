
<script>
    //import { pageSetup }from '../pages/roles/pageSetup'
    export default {

        mounted() {
        console.log('modal mounted');
    },
        template: `
<div class="modal is-active" >
    <div class="modal-background"></div>
    <div class="modal-content">
        <p>pussy</p>
    </div>
    <button class="modal-close" @click="$emit('close')"></button>
</div>
`
        }
</script>
