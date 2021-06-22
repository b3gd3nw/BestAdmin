<template>
    <div class="anim">
       $ {{animateNumber}}
    </div>
</template>

<script>
import { gsap } from "gsap";

    export default {
        props: {
            newnumber: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                number: 0,
                tweenedNumber: 0
            }
        },
        computed: {
            animateNumber: function() {
                return this.tweenedNumber.toFixed(2);
            }
        },

        watch: {
            number: function(newValue) {
                gsap.to(this.$data, { duration: 0.4, tweenedNumber: newValue });
            }
        },

        mounted() {
            this.number = this.newnumber;
        }
    
    }
</script>