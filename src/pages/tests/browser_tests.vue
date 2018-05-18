<template>

    <div class="panel-body">
        <div id="keys"></div>
        <div id="tests"></div>

        <nav-component></nav-component>
        <zzi-nav-keys></zzi-nav-keys>
        <footer-component></footer-component>



    </div>

</template>

<script>

    export default {
        data() {
            return {
            }
        },
        mounted: function () {
            document.addEventListener("keydown", function(event) {

                console.log(event);

                document.getElementById('keys').innerHTML = `
    &nbsp;&nbsp;&nbsp;
    <b>which: ${event.which}</b>
    <br>&nbsp;
    <b>keyCode:</b> ${event.keyCode}
    <br>&nbsp;&nbsp;&nbsp;
    <b>shiftKey:</b> ${event.shiftKey}
    </br>&nbsp;&nbsp;&nbsp;&nbsp;
    <b>altKey:</b> ${event.altKey}
    <br>&nbsp;&nbsp;&nbsp;
    <b>ctrlKey:</b> ${event.ctrlKey}
    <br>&nbsp;&nbsp;
    <b>metaKey:</b> ${event.metaKey}
  `;

            });
            let div = document.getElementById("tests");
        },
    }
</script>
