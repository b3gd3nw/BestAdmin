<template>
    <ValidationObserver ref="observer" v-slot="{ handleSubmit }">
        <div class="card auto-card">
            <div class="card-header">
                <b-icon icon="envelope-open" size="is-small"></b-icon>
                <h1 class="subtitle">
                    Send form on email
                </h1>
            </div>
            <div class="container">
                <form ref="form" id="form" action="">
                    <div class="form-header">
                        <b-icon icon="envelope-open-text" size="is-large"></b-icon>
                    </div>
                    <div class="form-body">
                        <div class="wrapper">
                                <div class="columns">
                                    <div class="column is-flex is-align-items-center">
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-footer">
                        
                    </div>
                    
                </form>
            </div>
            <div class="card-footer">
                <b-button type="is-link" @click="handleSubmit(sendMail)">Send</b-button>
            </div>
        </div>
    </ValidationObserver>
</template>
<script>
import { ValidationObserver, ValidationProvider } from "vee-validate";
import Axios from 'axios';
import { bus } from '../app';
export default {
    components: {
        ValidationObserver,
        ValidationProvider
    },
    data() {
        return {
            hasError: true,
            formData: null,
      
            email: '',
            labelPosition: 'on-border',
            submitStatus: null
        }
    },
    methods: {
        sendMail() {
            let formData = new FormData(this.$refs["form"]);
            Axios.post('/api/sendmail', formData)
                .then(response => {
                    if(response.data.exist === true) {
                        this.$buefy.toast.open({
                            message: `Email '${response.data.email}' alredy in use!`,
                            type: 'is-warning',
                        });
                    } else {
                        this.$buefy.toast.open({
                            message: `Message has been successfully sent to '${response.data.email}'`,
                            type: 'is-success',
                        });
                    }
                    bus.$emit('closeEmailForm', true);
                    this.email = '';
                    this.$refs.observer.reset();
                });
        }
    }
}
</script>