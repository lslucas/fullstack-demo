<style scoped>
    .action-link {
        cursor: pointer;
    }
</style>

<template>
    <div>
        <div class="card card-default">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span>
                        Github Users
                    </span>
                </div>
            </div>

            <div class="card-body">

                <table class="table table-borderless mb-0">
                    <thead>
                        <tr>
                            <th width='50px'>ID</th>
                            <th>Login</th>
                            <th width='100px'></th>
                            <th width='100px'></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="user in users.data">
                            <td style="vertical-align: middle;">
                                {{ user.id }}
                            </td>

                            <td style="vertical-align: middle;">
                                {{ user.login }}
                            </td>

                            <td style="vertical-align: middle;">
                                <a class="action-link" :href="'/github/' + user.login">
                                    <ion-icon name="information-circle-outline"></ion-icon>
                                    Details
                                </a>
                            </td>

                            <td style="vertical-align: middle;">
                                <a class="action-link" :href="'/github/' + user.login + '/repos'">
                                    <ion-icon name="logo-github"></ion-icon>
                                    Repos
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <pagination :pagination="pagination" :offset="5" @paginate="getUsers()"></pagination>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        /*
         * The component's data.
         */
        data() {
            return {
                users: [],
                pagination: {
                    'current_page': 1,
                    'previous_since': '',
                    'sinceHistory': [],
                    'since': ''
                }
            };
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            // restore pagination, if exists
            let paginationExists = this.restoreValues()

            if (paginationExists) {
                this.pagination = paginationExists
            }

            this.getUsers()
        },

        methods: {
            paginate() {
                this.getUsers()
            },

            restoreValues() {
                let filter = localStorage.getItem('pagination')

                return filter ? JSON.parse(filter) : false
            },

            /**
             * Get all users from github
             */
            getUsers() {
                //const token = vm.$auth.getToken()
                let config = {
                    headers: {
                        Authorization: 'Bearer ' + token,
                    }
                }

                axios.get('/api/github/users?page=' + this.pagination.current_page + '&since=' + this.pagination.since, config)
                        .then(response => {
                            this.users = response.data
                            this.pagination.since = this.users.data[this.users.data.length-1].id
                        });
            }

        }
    }
</script>
