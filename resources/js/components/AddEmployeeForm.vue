<template>
    <ValidationObserver ref="observer" v-slot="{ handleSubmit }">
    <div class="card auto-card">
        <div class="card-header">
            <b-icon icon="user-friends" size="is-small"></b-icon>
            <h1 class="subtitle">
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
                                            expanded>
                                            <option :value="country['id']" v-for="country in countries" :key="country['id']">
                                                {{ country['name'] }}
                                            </option>
                                        </b-select>
                                    </b-field>
                                </ValidationProvider>
                                <ValidationProvider 
                                    rules="required" 
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
                                    rules="required" 
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
                                            placeholder="Add a tag"
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
                <b-button type="is-link" @click="handleSubmit(sendData)">Submit</b-button>
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
            selected: new Date(),
            phone: '',
            email: '',
            position: '',
            salary: '',
            skills: [],
            countries: [],
            submitStatus: null
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
                    if(response.data.registered === true) {
                        this.$buefy.toast.open({
                            message: `Employee succesfully registered!`,
                            type: 'is-success',
                        });
                        this.closeForm();
                    }
            });
        },
        closeForm() {
            bus.$emit('closeEmployeeForm', true);
            this.firstname = "";
            this.lastname = "";
            this.phone = "";
            this.email = "";
            this.position = "";
            this.salary = "";
            this.skills = [];
            requestAnimationFrame(() => {
                this.$refs.observer.reset();
            });
        },
    },
}
</script>