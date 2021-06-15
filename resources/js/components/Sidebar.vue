<template>
  <section>
    <b-sidebar
      type="is-light"
      :fullheight="fullheight"
      :fullwidth="fullwidth"
      :overlay="overlay"
      :right="right"
      v-model="open"
    >
      <div class="p-1">
        <div class="side-logo is-flex is-justify-content-center">
          <img src="/images/admin-logo-v2.png" alt="Best Admin">
        </div>
        <b-menu>
          <b-menu-list label="Menu">
            <b-menu-item v-bind:tag="'router-link'" v-bind:to="'/'" icon="tachometer-alt" label="Dashboard"></b-menu-item>
            <b-menu-item v-bind:tag="'router-link'" v-bind:to="'/employee'" icon="users" label="Employee"></b-menu-item>
            <b-menu-item icon="wallet" label="Accounting">
              <b-menu-item icon= "home" label="General"></b-menu-item>
              <b-menu-item icon="bookmark" label="Categories"></b-menu-item>
            </b-menu-item>
          </b-menu-list>
        </b-menu>
      </div>
    </b-sidebar>
    <!-- <b-button absolute @click="open = true">Shows</b-button> -->
  </section>
</template>

<script>
import { bus } from '../app';
import { gsap } from 'gsap';

export default {
  data() {
    return {
      users: 'users',
      open: false,
      overlay: false,
      fullheight: true,
      fullwidth: false,
      right: false
    };
  },
  methods: {
  
  },
  created() {
    bus.$on('openSidebar', data => {
      this.open = data;
    })
  },
  watch: {
    open: function() {
      if (this.open === true) {
        gsap.to(".slide", { x: 200, duration: 0.5 })
      } else {
        gsap.to(".slide", { x: 0, duration: 0.5 })
      }
    }
  }
};
</script>

<style>
.p-1 {
  padding: 1em;
}
</style>