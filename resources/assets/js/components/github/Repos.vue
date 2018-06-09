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
                        Repositories of <strong>{{ user.login }}</strong>
                    </span>
                    <a class="action-link" href='/github'>
                        All Users 
                    </a>
                    <a class="action-link" :href="'/github/' + user.login">
                        Details of {{ user.login }}
                    </a>
                </div>
            </div>

            <div class="card-body">
                <!-- Current Clients -->
                <p class="mb-0" v-if="repos.data.length === 0">
                    This user has no repos.
                </p>

                <table class="table table-borderless mb-0" v-if="repos.data.length > 0">
                    <thead>
                        <tr>
                            <th width='50px'>ID</th>
                            <th>Name</th>
                            <th>URL</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="repo in repos.data">
                            <td style="vertical-align: middle;">
                                {{ repo.id }}
                            </td>

                            <td style="vertical-align: middle;">
                                {{ repo.full_name }}
                            </td>

                            <td style="vertical-align: middle;">
                                <a :href='repo.html_url' target='_blank'>{{ repo.html_url }}</a>
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
                username: '',
                repos: [],
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
            this.username = uri[uri.length-2]
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

                axios.get('/api/github/users/' + this.username + '/repos', config)
                        .then(response => {
                            this.repos = response.data
                            this.user = this.repos.data[0].owner
                        });
            }

        }
    }
</script>
