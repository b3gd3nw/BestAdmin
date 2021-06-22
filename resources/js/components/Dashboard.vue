<template>
    <div class="wrapper">
        <div class="columns">
            <div class="column">
                <div class="card">
                    <div class="card-content">
                         <div class="top-content">
                             <p class="">
                            Balance
                            </p>
                            <p class="title" id="balance">
                                <animated-integer :newnumber="data.bank_amount"></animated-integer>
                            </p>
                         </div>
                         <div class="bottom-content">
                             <p class="">
                            Last transactions
                            </p>
                            <div class="container">
                                <li v-for="(transaction, index) in data.transactions" :key="index">
                                    <div class="columns">
                                        <div class="column green" v-if="transaction.type === 'income'">
                                         +   {{ transaction.amount }}
                                        </div>
                                        <div class="column red" v-else>
                                         -   {{ transaction.amount }}
                                        </div>
                                        <div class="column">
                                            {{ transaction.category.name }}
                                        </div>
                                        <div class="column">
                                            {{ new Date(transaction.created_at).toLocaleDateString("en-US") }}
                                        </div>
                                    </div>
                                </li>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <div class="card-content">
                        <div class="columns">
                            <div class="column right-line">
                                <div class="top-content">
                                    <p>
                                    Monthly budget
                                    </p>
                                    <p class="title" id="balance">
                                        <animated-integer :newnumber="data.budget"></animated-integer>
                                    </p>
                                </div>
                                <div class="bottom-content">
                                    <p>
                                    Spent
                                    </p>
                                    <p class="subtitle red" id="balance">
                                        <animated-integer :newnumber="data.spent_budget"></animated-integer>
                                    </p>
                                </div>
                            </div>
                            <div class="column">
                                <p>
                                   Categories
                                </p>
                                <div class="container">
                                    <li class="list-categories" v-for="(category, index) in data.consumptions_category.slice(0,5)" :key="index">
                                        <div class="columns">
                                            <div class="column">
                                                {{ category.category }}
                                            </div>
                                            <div class="column" v-if="category.difference > 100">
                                                <b-progress :value="100" type="is-danger" size="is-small"></b-progress>
                                            </div>
                                             <div class="column" v-else-if="category.difference >= 50">
                                                <b-progress :value="category.difference" type="is-warning" size="is-small"></b-progress>
                                            </div>
                                            <div class="column" v-else>
                                                <b-progress :value="category.difference" type="is-success" size="is-small"></b-progress>
                                            </div>
                                        </div>
                                    </li>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <div class="card-content">
                        <p class="">
                            Monthly expenses
                        </p>
                        <p class="title" id="balance">
                            <animated-integer :newnumber="data.consumptions"></animated-integer>
                        </p>
                         <p class="">
                            Recent expenses
                        </p>
                    </div>
                </div>
            </div>
        </div>
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
</template>
<script>
import Axios from 'axios'
import { gsap } from 'gsap';

export default {

    data() {
        return {
            data: '',
            table_data: []
        }
    },

    mounted() {
        const self = this
        Axios.get('/api/dashboard')
            .then(response => {
                self.data = response.data

            })
        Axios.get('/api/employee_data')
            .then(response => {
                self.table_data = response.data
            })
           
    },
    
    updated() {
        this.$nextTick(function() {
            gsap.to(".table_card", { y: 10, duration: 1 });
        })
    },
    
}
</script>