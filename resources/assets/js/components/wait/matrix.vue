<template>
    <div class=row>
        <div class="container" id="matrix_container">
            <canvas id="c"></canvas>
        </div>
    </div>
</template>
<style>
    /*basic reset*/
    /** {margin: 0; padding: 0;}*/
    /*adding a black bg to the body to make things clearer*/
    /*body {background: black;}*/
    canvas {
        display: block;
    }

    #matrix_container {
        width: 90%;
        height: 1400px;
    }
</style>

<script>
    export default{
        mounted(){
            let c = document.getElementById("c");
            let ctx = c.getContext("2d");

//making the canvas full screen
            let clientHeight = document.getElementById('matrix_container').clientHeight;
            let clientWidth = document.getElementById('matrix_container').clientWidth;

            c.height = clientHeight;
            c.width = clientWidth;
//            c.height = window.innerHeight;
//            c.width = window.innerWidth;

//chinese characters - taken from the unicode charset
            let chinese = "CRAIGLORIOUS";
//converting the string into an array of single characters
            chinese = chinese.split("");

            let font_size = 20;
            let columns = c.width / font_size; //number of columns for the rain
//an array of drops - one per column
            let drops = [];
//x below is the x coordinate
//1 = y co-ordinate of the drop(same for every drop initially)
            for (let x = 0; x < columns; x++)
                drops[x] = 1;

//drawing the characters
            function draw() {
                //Black BG for the canvas
                //translucent BG to show trail
                ctx.fillStyle = "rgba(255, 255, 255, 0.05)";
                ctx.fillRect(0, 0, c.width, c.height);

//                ctx.fillStyle = "#008080"; //green text

                let colors = [
                    "#008080", '#FF8C00', '#006400', '#008080', '#2F4F4F', '#C71585', '#4B0082'
                ];
                ctx.fillStyle = colors[Math.floor(Math.random() * colors.length)];
                ctx.font = font_size + "px arial";
                //looping over drops
                let text;
                for (let i = 0; i < drops.length; i++) {
                    //a random chinese character to print
                    text = chinese[Math.floor(Math.random() * chinese.length)];
                    //x = i*font_size, y = value of drops[i]*font_size
                    ctx.fillText(text, i * font_size, drops[i] * font_size);

                    //sending the drop back to the top randomly after it has crossed the screen
                    //adding a randomness to the reset to make the drops scattered on the Y axis
                    if (drops[i] * font_size > c.height && Math.random() > 0.975)
                        drops[i] = 0;

                    //incrementing Y coordinate
                    drops[i]++;
                }
            }

            setInterval(draw, 100);


        }
    }
</script>