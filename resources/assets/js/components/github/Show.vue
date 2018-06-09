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
                        User <strong>{{ user.name }}</strong>
                    </span>
                    <a class="action-link" href='/github'>
                        All Users 
                    </a>
                    <a class="action-link" :href="'/github/' + user.login + '/repos'">
                        Repos
                    </a>
                </div>
            </div>

            <div class="card-body">
                <!-- Current Clients -->
                <p class="mb-0" v-if="user.length === 0">
                    This user has no info.
                </p>

                <table class="table table-borderless mb-0" v-if="user">
                    <tbody>
                        <tr>
                            <th width='50px'>ID</th>
                            <td>{{ user.id }}</td>
                        </tr>
                        <tr>
                            <th>Login</th>
                            <td>{{ user.login }}</td>
                        </tr>
                        <tr>
                            <th>Profile URL</th>
                            <td><a :href='user.html_url' target='_blank'>{{ user.html_url }}</a></td>
                        </tr>
                        <tr>
                            <th>Date of registration (local)</th>
                            <td>{{ user.creation_date }}</td>
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
                username: '',
                user: []
            };
        },

        /**
         * Prepare the component (Vue 1.x).
         */
        ready() {
            this.prepareComponent();
        },

        created() {
            let uri = window.location.href.split('/')
            this.username = uri[uri.length-1]
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
                let config = {
                    headers: {
                        Authorization: 'Bearer ' + token,
                    }
                }

                axios.get('/api/github/users/' + this.username, config)
                        .then(response => {
                            this.user = response.data.data

                            let date = new Date(this.user.created_at)
                            this.user.creation_date = date.toLocaleString()
                        });
            }

        }
    }
</script>
