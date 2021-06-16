<template>
    <div class="card auto-card">
        <div class="card-header">
            <b-icon icon="user-friends" size="is-small"></b-icon>
            <h1 class="subtitle">
                Add new employee
            </h1>
        </div>
        <div class="container">
            <form action="" id="form">
                <div class="form-header">
                    <b-icon icon="user-plus" size="is-large"></b-icon>
                </div>
                <div class="form-body">
                   <div class="wrapper">
                        <div class="columns">
                            <div class="column is-flex is-align-items-center is-flex-direction-column">
                                <b-field label="First Name" :label-position="labelPosition"> 
                                    <b-input
                                    name="firstname" 
                                    v-model="firstname"
                                    maxlength="30"
                                    ></b-input>
                                </b-field>
                                <b-field label="Last Name" :label-position="labelPosition">
                                    <b-input 
                                    name="lastname" 
                                    v-model="lastname"
                                    maxlength="30"></b-input>
                                </b-field>
                                <b-field label="Select a birthdate" :label-position="labelPosition">
                                    <b-datepicker
                                        name="birthdate" 
                                        v-model="selected"
                                        placeholder="Click to select..."
                                        icon="calendar-alt"
                                        trap-focus>
                                    </b-datepicker>
                                </b-field>
                                <b-field label="Select a country" :label-position="labelPosition">
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
                                <b-field label="Phone" :label-position="labelPosition">
                                    <b-input
                                    v-mask="'+##############'"
                                    name="phone"  
                                    v-model="phone"
                                    maxlength="30"
                                    ></b-input>
                                </b-field>
                            </div>
                            <div class="column">
                                <b-field label="Email"
                                    :label-position="labelPosition">
                                    <b-input 
                                        name="email" 
                                        type="email"
                                        v-model="email"
                                        maxlength="30">
                                    </b-input>
                                </b-field>
                                <b-field label="Position" :label-position="labelPosition">
                                    <b-input 
                                        name="position" 
                                        v-model="position"
                                        maxlength="30"
                                    ></b-input>
                                </b-field>
                                <b-field label="Salary" :label-position="labelPosition">
                                    <b-input
                                        name="salary"  
                                        v-model="salary"
                                        maxlength="30"
                                    ></b-input>
                                </b-field>
                                <b-field label="Add some tags" :label-position="labelPosition">
                                    <b-taginput
                                        name="skills" 
                                        v-model="skills"
                                        ellipsis
                                        icon="tag"
                                        placeholder="Add a tag"
                                        aria-close-label="Delete this tag">
                                    </b-taginput>
                                </b-field>
                            </div>
                        </div>
                   </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="wrapper">
                <b-button type="is-link" @click="sendData()">Submit</b-button>
                <b-button >Cancel</b-button>
            </div>
        </div>
    </div>
</template>
<script>
import Axios from 'axios';
import {TheMask} from 'vue-the-mask';

export default {
    components: {
        TheMask
    },
    data() {
        return {
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
            countries: []
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
                let formData = new FormData(document.querySelector("#form"));
                console.log(this.skills);
                // Axios.post("/api/employee", formData)
                //     .then(response => {

                //     })
            },
    }
}
</script>