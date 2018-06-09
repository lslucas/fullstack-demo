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
                    <h3>
                        Repositories of {{ user.login }}
                    </h3>
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
                                {{ repo.html_url }}
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
                //const token = vm.$auth.getToken()
                const token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6Ijk5Y2I3NDg3ZDMxM2JkNWM4ZjA5ZTMwMWE1YWMxNDBmNmM0YTYzYzI4OGM0MzMwNWEwZGNmMDU0MTQ0NTdlYmY4YWMxYWYwZDc2MDQ2YjZkIn0.eyJhdWQiOiIzIiwianRpIjoiOTljYjc0ODdkMzEzYmQ1YzhmMDllMzAxYTVhYzE0MGY2YzRhNjNjMjg4YzQzMzA1YTBkY2YwNTQxNDQ1N2ViZjhhYzFhZjBkNzYwNDZiNmQiLCJpYXQiOjE1Mjg0OTkyNTcsIm5iZiI6MTUyODQ5OTI1NywiZXhwIjoxNTYwMDM1MjU3LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.eKlH10HhC7SETXLTqEA87qdSkR1a5rPYUFo7LbJdvA82NRR8qa_wlyEtCHo_SWJost-XCtqcu3JDdSSO9LWeWig7JZMUG3Sl7y668XdBCwjs37L1PuCT1nbz2jyiYfCYfpH1siR6fZjwUCOt2tr7ePVUzyUb9ahW5oQEpFzU3reB9ugJhzZk7ab1Q03PUYyCJ9v4_K2gFKMVs9lmuyNdeyT_oDsCiiqZ54Z5KUG46gdgI9h8CDghiXimzckTIO37HovtnM3AdKZGicU7_PKUFngnk_NY-zdiu7H7ozhOh-lXguN4Zod1Kc19kaFLz9cDEe9gJHmMY8jdPtjA5M131iLOeG8sUNXpVHtk6IQY67TDnDSFCw4q22fPGk0W3gVi1CQOoltF1lpCSc5zbXcBPj97-iHhyJNVYD99yz2O7D-nIFeQA4NsIujb4MdccwienPO-rX7vRzMaeJ4dctO7-QX1bZtjGPjYuOw65Et4GvuYxcRn5URciS37e_cVOh9-u3nd3KO-hmo00VaTqkwaPlpYeXE1nOS1DiSstEFH783wjpexwv1Rkh2_yXe0q5O4hYr_WXr4Ha0P4L5PIVcRRnCyZff5KqXWbM4vMv0s63PXPGYLwDrPTqFj4WzFk2GEALfYniyTcrwPDyF0pnjpOIXHBTcCjKqxbtCooXBeqT4'
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
