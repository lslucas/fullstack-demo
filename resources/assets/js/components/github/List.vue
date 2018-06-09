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
                <!-- Current Clients -->
                <p class="mb-0" v-if="users.data.length === 0">
                    There is no github users to show at the moment.
                </p>

                <table class="table table-borderless mb-0" v-if="users.data.length > 0">
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
                            <!-- ID -->
                            <td style="vertical-align: middle;">
                                {{ user.id }}
                            </td>

                            <!-- Name -->
                            <td style="vertical-align: middle;">
                                {{ user.login }}
                            </td>

                            <!-- Edit Button -->
                            <td style="vertical-align: middle;">
                                <a class="action-link" :href="'/github/' + user.login">
                                    <ion-icon name="information-circle-outline"></ion-icon>
                                    Details
                                </a>
                            </td>

                            <!-- Delete Button -->
                            <td style="vertical-align: middle;">
                                <a class="action-link text-info" :href="'/github/' + user.login + '/repos'">
                                    <ion-icon name="logo-github"></ion-icon>
                                    Repos
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                users: []
            };
        },

        /**
         * Prepare the component (Vue 1.x).
         */
        ready() {
            this.prepareComponent();
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
        },

        methods: {
            /**
             * Prepare the component.
             */
            prepareComponent() {
                this.getUsers();
            },

            /**
             * Get all of the OAuth clients for the user.
             */
            getUsers() {
                //const token = vm.$auth.getToken()
                let config = {
                    headers: {
                        Authorization: 'Bearer ' + token,
                    }
                }

                axios.get('/api/github/users', config)
                        .then(response => {
                            this.users = response.data;
                        });
            },

            /**
             * Persist the client to storage using the given form.
             */
            persistClient(method, uri, form, modal) {
                form.errors = [];

                axios[method](uri, form)
                    .then(response => {
                        this.getClients();

                        form.name = '';
                        form.redirect = '';
                        form.errors = [];

                        $(modal).modal('hide');
                    })
                    .catch(error => {
                        if (typeof error.response.data === 'object') {
                            form.errors = _.flatten(_.toArray(error.response.data.errors));
                        } else {
                            form.errors = ['Something went wrong. Please try again.'];
                        }
                    });
            }

        }
    }
</script>
