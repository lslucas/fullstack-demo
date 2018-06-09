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
                const token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6Ijk5Y2I3NDg3ZDMxM2JkNWM4ZjA5ZTMwMWE1YWMxNDBmNmM0YTYzYzI4OGM0MzMwNWEwZGNmMDU0MTQ0NTdlYmY4YWMxYWYwZDc2MDQ2YjZkIn0.eyJhdWQiOiIzIiwianRpIjoiOTljYjc0ODdkMzEzYmQ1YzhmMDllMzAxYTVhYzE0MGY2YzRhNjNjMjg4YzQzMzA1YTBkY2YwNTQxNDQ1N2ViZjhhYzFhZjBkNzYwNDZiNmQiLCJpYXQiOjE1Mjg0OTkyNTcsIm5iZiI6MTUyODQ5OTI1NywiZXhwIjoxNTYwMDM1MjU3LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.eKlH10HhC7SETXLTqEA87qdSkR1a5rPYUFo7LbJdvA82NRR8qa_wlyEtCHo_SWJost-XCtqcu3JDdSSO9LWeWig7JZMUG3Sl7y668XdBCwjs37L1PuCT1nbz2jyiYfCYfpH1siR6fZjwUCOt2tr7ePVUzyUb9ahW5oQEpFzU3reB9ugJhzZk7ab1Q03PUYyCJ9v4_K2gFKMVs9lmuyNdeyT_oDsCiiqZ54Z5KUG46gdgI9h8CDghiXimzckTIO37HovtnM3AdKZGicU7_PKUFngnk_NY-zdiu7H7ozhOh-lXguN4Zod1Kc19kaFLz9cDEe9gJHmMY8jdPtjA5M131iLOeG8sUNXpVHtk6IQY67TDnDSFCw4q22fPGk0W3gVi1CQOoltF1lpCSc5zbXcBPj97-iHhyJNVYD99yz2O7D-nIFeQA4NsIujb4MdccwienPO-rX7vRzMaeJ4dctO7-QX1bZtjGPjYuOw65Et4GvuYxcRn5URciS37e_cVOh9-u3nd3KO-hmo00VaTqkwaPlpYeXE1nOS1DiSstEFH783wjpexwv1Rkh2_yXe0q5O4hYr_WXr4Ha0P4L5PIVcRRnCyZff5KqXWbM4vMv0s63PXPGYLwDrPTqFj4WzFk2GEALfYniyTcrwPDyF0pnjpOIXHBTcCjKqxbtCooXBeqT4'
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
