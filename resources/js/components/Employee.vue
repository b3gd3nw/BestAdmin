<template>
<div class="wrapper">
    <div class="columns">
        <div class="column">
              <b-button type="is-link" @click="goDown('employee')">
                  <b-icon icon="user-plus"></b-icon>
              </b-button>
              <b-button type="is-link" @click="goDown('email')"> 
                  <b-icon icon="envelope-open-text"></b-icon>
              </b-button>
        </div>
    </div>
    <div class="columns email-form" style="display:none;z-index:0">
        <div class="column">
            <mail-form></mail-form>
        </div>
    </div>
     <div class="columns employee-form" style="display:none;z-index:0">
        <div class="column">
            <employee-form></employee-form>
        </div>
    </div>
    <div class="columns section-table">
        <div class="column">
            <div class="card table_card">
                <div class="wrapper">
                <div class="table-header is-flex">
                    <b-icon
                        icon="users"
                        size="is-small">
                    </b-icon>
                    <h1 class="subtitle">
                        Employes
                    </h1>
                </div>
                <dashboard-table
                    :table_data="table_data"
                ></dashboard-table>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
    import { gsap } from 'gsap';

    export default {

        data() {
            return {
                email_form_open: false,
                employee_form_open: false
            }
        },

        watch: {
            email_form_open: function() {
                this.email_form_open = this.email_form_open ? false : true;
            },
            employee_form_open: function() {
                this.employee_form_open ? false : true;
            }
        },

        methods: {
            goDown(type) {
                if (type === "email") {
                    this.animate(this.email_form_open, ".email-form")
                } else {
                    this.animate(this.employee_form_open, ".employee-form")
                }
              
            },
            animate(target, selector) {
                if (target === false) {
                        gsap.to(".section-table", { y: 200, duration: 0.5 })
                        gsap.to(selector, {
                            "display": "flex",
                            "position": "absolute",
                            duration: 1,
                    })
                    } else {
                        gsap.to(".section-table", { y: 0, duration: 0.5 })
                        gsap.to(selector, {
                            "display": "none",
                            duration: 1,
                        })
                    }
            }
        }

    }
</script>