
<script>
    //import { pageSetup }from '../pages/roles/pageSetup'
    export default {
        template: '<div><input placeholder="Enter Your COupon Code" @blur = "onCouponApplied"></div>',
        methods: {
            onCouponApplied(){
                console.log('emmitting event applied');
                Event.fire('applied');
    }
</script>