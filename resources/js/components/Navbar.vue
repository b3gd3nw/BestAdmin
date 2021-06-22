<template>
    <nav class="navbar">
        <div class="is-flex slide">
            <div class="sidebar-button is-flex is-align-items-center">
                <b-button class="is-flex is-align-items-baseline" @click="openSidebar()">
                    <b-icon icon="bars"></b-icon>
                </b-button>
                <!-- <float-button></float-button> -->
            </div>
            <div class="navbar-brand">
                <h1 class="title">{{ $route.meta.title }}</h1>
            </div>
        </div>
        <div class="navbar-menu">
            <div class="navbar-end">
                <b-dropdown
                    v-model="navigation"
                    position="is-bottom-left"
                    append-to-body
                    aria-role="menu"> 
                    <template #trigger>
                        <a
                            class="navbar-item"
                            role="button">
                            <figure class="media-left">
                                <p class="image is-32x32">
                                    <img class="" src="/images/admin-photo.png">
                                </p>
                            </figure>
                            <span>Admin</span>
                            <b-icon icon="caret-down"></b-icon>
                        </a>
                    </template>


                    <b-dropdown-item custom aria-role="menuitem">
                        Logged as <b>Admin</b>
                    </b-dropdown-item>
                    <hr class="dropdown-divider">
                    <b-dropdown-item has-link aria-role="menuitem">
                        <a href="https://google.com" target="_blank">
                            <b-icon icon="link"></b-icon>
                            Google (link)
                        </a>
                    </b-dropdown-item>
                    <b-dropdown-item value="home" aria-role="menuitem">
                        <b-icon icon="home"></b-icon>
                        Home
                    </b-dropdown-item>
                    <b-dropdown-item value="products" aria-role="menuitem">
                        <b-icon icon="cart"></b-icon>
                        Products
                    </b-dropdown-item>
                    <b-dropdown-item value="blog" disabled aria-role="menuitem">
                        <b-icon icon="book-open"></b-icon>
                        Blog
                    </b-dropdown-item>
                    <hr class="dropdown-divider" aria-role="menuitem">
                    <b-dropdown-item value="settings">
                        <b-icon icon="settings"></b-icon>
                        Settings
                    </b-dropdown-item>
                    <b-dropdown-item value="logout" aria-role="menuitem">
                        <b-icon icon="logout"></b-icon>
                        Logout
                    </b-dropdown-item>
                </b-dropdown>
            </div>
        </div>
    </nav>
</template>

<script>
import { bus } from '../app';
import FloatButton from './FloatButton.vue';
import { gsap } from 'gsap';
// import router from '../routes';

// router.beforeEach((to, from, next) => {
//    console.log(to.meta.title);
// })

// console.log(this.$route.name);
    export default {
    components: { FloatButton },
        data() {
            return {
                navigation: 'home'
            }
        },
        methods: {
            openSidebar() {
                bus.$emit('openSidebar', true);
                
            }
        },  
        watch: {

        }
    }
   
</script>