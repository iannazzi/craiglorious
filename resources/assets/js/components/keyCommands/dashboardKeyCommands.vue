<template>
    <div id="keys"></div>
</template>

<script>
    export default {

        mounted(){

            let self = this;
            let meta_key = false;
            let shift_key = false;
            let alt_key = false;
            let ctrl_key = false;
            let modifier1 = false;
            let modifier2 = false;


            document.addEventListener("keydown", function (event) {
                meta_key = event.metaKey;
                shift_key = event.shiftKey;
                alt_key = event.altKey;
                ctrl_key = event.ctrlKey;
                modifier1 = (event.which == 32); //space bar
                modifier1 = event.metaKey;
                modifier2 = true;

                //console.log(event.which);
                //console.log('modifier 1 ' + modifier1)


//                if($("input").is(":focus")) return;
//                if($("select").is(":focus")) return;


                switch (event.which) {
                    case 68:
                        if (modifier1 && modifier2){
                            event.preventDefault();
                            self.$router.push('/');
                        }
                        break;
                    case 67:
                        if (modifier1 && modifier2) self.$router.push('/calendar');
                        break;
                    default:
                }

            })
            document.addEventListener("keyup", function (event) {

                modifier1 = event.metaKey;
                modifier2 = event.shiftKey;

            })
        }
    }

</script>
