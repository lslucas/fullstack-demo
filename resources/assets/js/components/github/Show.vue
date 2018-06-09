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

        created() {
            let uri = window.location.href.split('/')
            this.username = uri[uri.length-1]
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.getInfo();
        },

        methods: {
            /**
             * Get info of this user.
             */
            getInfo() {
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
