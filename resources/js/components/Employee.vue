<template>
<div class="wrapper">
    <div class="columns">
        <div class="column bottom-line">
              <b-button type="is-link" @click="goDown('employee')">
                  <b-icon icon="user-plus"></b-icon>
              </b-button>
              <b-button type="is-link" @click="goDown('email')"> 
                  <b-icon icon="envelope-open-text"></b-icon>
              </b-button>
        </div>
    </div>
    <div class="columns email-form" style="display:none;">
        <div class="column">
            <mail-form></mail-form>
        </div>
    </div>
     <div class="columns employee-form" style="display:none;">
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
    import Axios from 'axios';

    export default {

        data() {
            return {
                email_form_open: false,
                employee_form_open: false,
                table_data : []
            }
        },
        mounted() {
            const self = this
            Axios.get('/api/employee_data')
            .then(response => {
                self.table_data = response.data
            })
        },
        methods: {
            
            goDown(type) {
                if (type === "email") {
                    
                    if (this.employee_form_open) {
                        this.closeForm(".employee-form")
                        this.employee_form_open = false;
                        this.openForm(".email-form", 1)
                        this.email_form_open = true;
                    } else if (this.email_form_open) {
                        this.closeForm(".email-form")
                        this.email_form_open = false;
                    } else {
                        this.openForm(".email-form")
                        this.email_form_open = true;
                    }
                } else {
                    if (this.email_form_open) {
                        this.closeForm(".email-form")
                        this.email_form_open = false;
                        this.openForm(".employee-form", 1, 525)
                        this.employee_form_open = true;
                    } else if (this.employee_form_open) {
                        this.closeForm(".employee-form")
                        this.employee_form_open = false;
                    } else {
                        this.openForm(".employee-form", 0, 525)
                        this.employee_form_open = true;
                    }
                }
            },
            openForm(selector, delay = 0, y = 300) {
                gsap.to(".section-table", { y: y, duration: 0.5, delay: delay })
                gsap.to(selector, {
                    "display": "flex",
                    "position": "absolute",
                    duration: 0.1,
                    delay: delay,
                    opacity: "1"
                })
            },
            closeForm(selector) {
                gsap.to(".section-table", { y: 0, duration: 0.5 })
                gsap.to(selector, {
                    "display": "none",
                    duration: 1,
                    opacity: "0"
                })
            }
        }

    }
</script>