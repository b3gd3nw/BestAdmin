<template>
    <div id="pulse" class="float-btn" v-on:mouseover="pulse()"></div>
</template>

<script>
import { gsap, TweenMax } from "gsap";
// import { CustomBounce } from "gsap/CustomBounce";

// gsap.registerPlugin(CustomBounce);

export default {
    data() {
        return {

        }
    },

    mounted() {
       
        // gsap.to("#pulse", {
        //     "--after-scale": 1.2, 
        //     delay: 0.5,
        //     duration: 1.5,
        //     repeat: -1
        // });
        // gsap.to("#pulse", {
        //     "--before-opacity": 1,
        //     duration: 0.75,
        //     repeat: -1,
        //     yoyo: true
        // });
        // gsap.to("#pulse", {
        //     "--after-opacity": 1, 
        //     delay: 0.5,
        //     duration: 0.75,
        //     repeat: -1,
        //     yoyo: true
        // });
    },
    methods: {
        pulse() {
            gsap.to("#pulse", {
                        "box-shadow": '0 0 50px teal', 
                        duration: 1.5,
                        repeat: 1
                    });
        }
    }
}
</script>