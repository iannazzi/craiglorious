<template>

    <div class="panel-body">
        <div id="tests"></div>
    </div>

</template>

<script>
    import {tableTests} from '../../elements/tables/tests/tableTests'
    export default {
        data() {
            return {
            }
        },
        mounted: function () {
            let div = document.getElementById("tests");
            div.appendChild(tableTests());
        },
    }
</script>
