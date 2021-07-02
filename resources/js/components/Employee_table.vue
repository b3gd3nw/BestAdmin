<template>
    <b-table
        :data="table_data"
        :paginated="isPaginated"
        :per-page="perPage"
        :current-page.sync="currentPage"
        :pagination-simple="isPaginationSimple"
        :pagination-position="paginationPosition"
        :default-sort-direction="defaultSortDirection"
        :pagination-size="paginationSize"
        :pagination-rounded="isPaginationRounded"
        :sort-icon="sortIcon"
        :sort-icon-size="sortIconSize"

        aria-next-label="Next page"
        aria-previous-label="Previous page"
        aria-page-label="Page"
        aria-current-label="Current page">
        <div class="buttons is-flex is-justify-content-flex-end">
            <b-button type="is-success" outlined @click="filteredData('active')">Active</b-button>
            <b-button type="is-danger" outlined @click="filteredData('inactive')">Inactive</b-button>
            <b-button type="is-warning" outlined @click="filteredData('pending')">Pending</b-button>
        </div>

        <b-table-column field="user_id" label="ID"  sortable numeric v-slot="props">
            {{ props.row.user_id }}
        </b-table-column>

        <b-table-column field="user_name" label="Name"  sortable v-slot="props">
            {{ props.row.user_name }}
        </b-table-column>

        <b-table-column field="user_country" label="Country"  sortable v-slot="props">
            {{ props.row.user_country }}
        </b-table-column>
        
        <b-table-column field="user_position" label="Position"  sortable v-slot="props">
            {{ props.row.user_position }}
        </b-table-column>

        <b-table-column field="user_email" label="Email"  sortable v-slot="props">
            {{ props.row.user_email }}
        </b-table-column>
        
        <b-table-column field="user_salary" label="Salary"  sortable numeric v-slot="props">
            $ {{ props.row.user_salary }}
        </b-table-column>

        <b-table-column field="user_status" label="Status" sortable v-slot="props">
            <template v-if="props.row.user_status === 'active'">
                <p class="green">{{ props.row.user_status }}</p>
            </template>
            <template v-if="props.row.user_status === 'inactive'">
                <p class="red">{{ props.row.user_status }}</p>
            </template>
            <template v-if="props.row.user_status === 'pending'">
                <p class="orange">{{ props.row.user_status }}</p>
            </template>
        </b-table-column>

        <b-table-column field="actions" label="Actions" cell-class="is-flex is-justify-content-space-around" v-slot="props">
            <b-button @click="editUser(props.row.user_id)" type="is-warning"
                icon-right="user-edit" />
            <b-button type="is-danger"
                @click="deleteUser(props.row.user_id)"
                icon-right="trash-alt" />
        </b-table-column>
    </b-table>
</template>

<script>
import { bus } from '../app';
import Axios from 'axios'
    export default {
        data() {
            return {
                data: [],
                table_data: [],
                isPaginated: true,
                isPaginationSimple: false,
                isPaginationRounded: false,
                paginationPosition: 'top',
                defaultSortDirection: 'asc',
                sortIcon: 'arrow-up',
                sortIconSize: 'is-small',
                currentPage: 1,
                perPage: 10,
                paginationSize: 'is-small', 
            }
        },
        mounted() {
            Axios.get('/api/getallemployes')
                .then(response => {
                    this.table_data = response.data
            })
        },
        methods: {
            filteredData(filter) {
                Axios.get(`/api/getallemployes/${filter}`)
                    .then(response => {
                         console.log(response.data);
                        this.table_data = response.data
                    })
            },
            deleteUser(id) {
                Axios.delete(`/api/employee/${id}`)
                    .then(response => {
                        if(response.data.success === true) {
                            this.$buefy.toast.open({
                                message: `Employee succesfully deleted!`,
                                type: 'is-success',
                            });
                        }
                    })
            },
            editUser(id) {
                bus.$emit('getEmployeeData', id);
            }
        }
    }
</script>