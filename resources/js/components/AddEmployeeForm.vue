<template>
    <ValidationObserver ref="observer" v-slot="{ handleSubmit }">
    <div class="card auto-card">
        <div class="card-header">
            <b-icon icon="user-friends" size="is-small"></b-icon>
            <h1 class="subtitle" v-if="f_data">
                Edit employee
            </h1>
            <h1 class="subtitle" v-else>
                Add new employee 
            </h1>
        </div>
        <div class="container">
            <form ref="form" action="">
                <div class="form-header">
                    <b-icon icon="user-plus" size="is-large"></b-icon>
                </div>
                <div class="form-body">
                   <div class="wrapper">
                        <div class="columns">
                            <div class="column is-flex is-align-items-center is-flex-direction-column">
                                <ValidationProvider 
                                    rules="required|nochars" 
                                    name="firstname" 
                                    v-slot="{ errors }">
                                    <b-field label="First Name" :label-position="labelPosition"
                                        :type="{ 'is-danger': errors[0] }"
                                        :message="errors"> 
                                        <b-input
                                            name="firstname" 
                                            v-model="firstname"
                                            maxlength="30"
                                        ></b-input>
                                    </b-field>
                                </ValidationProvider>
                                 <ValidationProvider 
                                    rules="required|nochars" 
                                    name="lastname" 
                                    v-slot="{ errors }">
                                <b-field label="Last Name" :label-position="labelPosition"
                                    :type="{ 'is-danger': errors[0] }"
                                    :message="errors"> 
                                    <b-input
                                        ref="inputs "
                                        name="lastname" 
                                        v-model="lastname"
                                        maxlength="30"
                                    ></b-input>
                                </b-field>
                                </ValidationProvider>
                                <ValidationProvider 
                                    rules="required" 
                                    name="birthdate"
                                    v-slot="{ errors }">
                                    <b-field label="Select a birthdate" :label-position="labelPosition"
                                        :type="{ 'is-danger': errors[0] }"
                                        :message="errors"> 
                                        <b-datepicker
                                            name="birthdate" 
                                            v-model="selected"
                                            placeholder="Click to select..."
                                            icon="calendar-alt"
                                            :max-date="new Date()"
                                            trap-focus>
                                        </b-datepicker>
                                    </b-field>
                                </ValidationProvider>
                                <ValidationProvider 
                                    rules="required" 
                                    name="countryId" 
                                    v-slot="{ errors }">
                                    <b-field label="Select a country" :label-position="labelPosition"
                                        :type="{ 'is-danger': errors[0] }"
                                        :message="errors"> 
                                        <b-select
                                            name="countryId" 
                                            placeholder="Country"
                                            icon="globe"
                                            icon-pack="fas"
                                            v-model="country"
                                            expanded>
                                            <option :value="country['id']" v-for="country in countries" :key="country['id']">
                                                {{ country['name'] }}
                                            </option>
                                        </b-select>
                                    </b-field>
                                </ValidationProvider>
                                <ValidationProvider 
                                    rules="required|fullnumber" 
                                    name="phone" 
                                    v-slot="{ errors }">
                                    <b-field label="Phone" :label-position="labelPosition"
                                        :type="{ 'is-danger': errors[0] }"
                                        :message="errors"> 
                                        <b-input
                                            v-mask="'+##############'"
                                            name="phone"  
                                            v-model="phone"
                                            maxlength="15"
                                        ></b-input>
                                    </b-field>
                                </ValidationProvider>
                            </div>
                            <div class="column is-flex is-align-items-center is-flex-direction-column">
                                <ValidationProvider 
                                    ref="email"
                                    rules="required|email" 
                                    name="email" 
                                    v-slot="{ errors }">
                                    <b-field label="Email"
                                        :label-position="labelPosition"
                                        :type="{ 'is-danger': errors[0] }"
                                        :message="errors"> 
                                        <b-input 
                                            name="email" 
                                            type="email"
                                            v-model="email"
                                            maxlength="30">
                                        </b-input>
                                    </b-field>
                                </ValidationProvider>
                                <ValidationProvider 
                                    rules="required" 
                                    name="position" 
                                    v-slot="{ errors }">
                                    <b-field label="Position" :label-position="labelPosition"
                                        :type="{ 'is-danger': errors[0] }"
                                        :message="errors"> 
                                        <b-input 
                                            name="position" 
                                            v-model="position"
                                            maxlength="30"
                                        ></b-input>
                                    </b-field>
                                </ValidationProvider>
                                <ValidationProvider 
                                    rules="required" 
                                    name="salary" 
                                    v-slot="{ errors }">
                                    <b-field label="Salary" :label-position="labelPosition"
                                        :type="{ 'is-danger': errors[0] }"
                                        :message="errors"> 
                                        <b-input
                                            v-mask="['$###', '$###.##', '$####.##']"
                                            name="salary"  
                                            v-model="salary"
                                            maxlength="8"  
                                        ></b-input>
                                    </b-field>
                                </ValidationProvider>
                                <ValidationProvider 
                                    rules="required|tags" 
                                    name="skills" 
                                    v-slot="{ errors }">
                                    <b-field label="Add some tags" :label-position="labelPosition"
                                        :type="{ 'is-danger': errors[0] }"
                                        :message="errors"> 
                                        <b-taginput
                                            name="skills" 
                                            v-model="skills"
                                            ellipsis
                                            icon="tag"
                                            maxtags="10"
                                            placeholder="Add a tag"
                                            :before-adding="beforeAdding"
                                            aria-close-label="Delete this tag">
                                        </b-taginput>
                                    </b-field>
                                </ValidationProvider>
                            </div>
                        </div>
                   </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="wrapper">
                <b-button v-if="f_data" type="is-link" @click="handleSubmit(updateData)">Update</b-button>
                <b-button v-else type="is-link" @click="handleSubmit(sendData)">Submit</b-button>
                <b-button @click="closeForm()">Cancel</b-button>
            </div>
        </div>
    </div>
    </ValidationObserver>
</template>
<script>
import { bus } from '../app';
import Axios from 'axios';
import {TheMask} from 'vue-the-mask';
import { ValidationObserver, ValidationProvider } from "vee-validate";



export default {
    props: ['f_data'],
    components: {
        TheMask,
        ValidationObserver,
        ValidationProvider
    },
    data() {
        return {
            hasError: true,
            formData: null,
            labelPosition: 'on-border',
            firstname: '',
            lastname: '',
            selected: [],
            country: '',
            phone: '',
            email: '',
            position: '',
            salary: '',
            skills: [],
            countries: [],
            submitStatus: null,
            unselectableDates: new Date(),
            userId: ''

        }
    },
    watch: {
        f_data: function(f_data) {
          if(f_data) {
                this.firstname = f_data.user_firstname
                this.lastname = f_data.user_lastname
                this.selected = new Date(f_data.user_birthdate)
                this.country = f_data.user_country
                this.phone = f_data.user_phone
                this.email = f_data.user_email
                this.position = f_data.user_position
                this.salary = f_data.user_salary
                this.skills = f_data.user_skills
                this.userId = f_data.user_id
          }
        }
    },
    mounted() {
        Axios.get("/api/countries")
            .then(response => {
                this.countries = response.data;
            });
    },
    methods: {
        sendData() {
            let formData = new FormData(this.$refs["form"]);
            formData.append('phone', this.phone);
            formData.append('skills', this.skills);
            Axios.post("/api/employee", formData)
                .then(response => {
                    if(response.data.exists === true) {
                        this.$refs.observer.setErrors({
                            email: ['This email is already taken']
                        })
                    } else {
                        this.$buefy.toast.open({
                            message: `Employee succesfully registered!`,
                            type: 'is-success',
                        });
                        this.closeForm();
                    }
            });
        },
        updateData() {
            let formData = new FormData(this.$refs["form"]);
            formData.append('phone', this.phone);
            formData.append('skills', this.skills);
            console.log(formData.sa);
            Axios.put(`/api/employee/${this.userId}`, formData)
                .then(response => {
        
                        this.closeForm();

            });
        },
        closeForm() {
            bus.$emit('closeEmployeeForm', true);
            this.firstname = "";
            this.lastname = "";
            this.phone = "";
            this.email = "";
            this.country = "";
            this.position = "";
            this.salary = "";
            this.skills = [];
            requestAnimationFrame(() => {
                this.$refs.observer.reset();
            });
        },
        beforeAdding(tag) {
        	return tag.length < 10;
        },
    },
}
</script>