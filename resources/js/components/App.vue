<template>
    <div id="content">
        <navbar ></navbar>
        <sidebar></sidebar>
        <transition name="fade">
        <router-view></router-view>
        </transition>
    </div>
</template>
<script>
export default {
    data() {
        return {
            state: false
        }
    },
    methods: {
    },

}
</script>