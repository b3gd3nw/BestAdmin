<template>
    <b-table :data="table_data" :columns="columns"></b-table>
</template>

<script>
    export default {
        props: {
            table_data: {
                type: Array
            }
        },
        data() {
            return {
                data: [],
                columns: [
                    {
                        field: 'user_id',
                        label: 'ID',
                        width: '40',
                        numeric: true,
                        sortable: true,
                    },
                    {
                        field: 'user_name',
                        label: 'Name',
                        sortable: true,
                    },
                    {
                        field: 'user_position',
                        label: 'Position',
                        sortable: true,
                        centered: true
                    },
                    {
                        field: 'user_email',
                        label: 'Email',
                        sortable: true,
                    },
                    {
                        field: 'user_status',
                        label: 'Status',
                    }
                ]
            }
        }
    }
</script>