<template>
<nav aria-label="navigation ">
  <ul class="pagination">
        <li :class="'page-item' + (pagination.current_page<=1 ? ' disabled' : '')"><a class="page-link" href='#' @click="changePage(pagination.current_page - 1, pagination.previous_since)" :disabled="pagination.current_page <= 1"><span aria-hidden="true">&laquo;</span> Previous</a></li>
        <li class='page-item'><a class="page-link" href='#' @click="changePage(pagination.current_page + 1, pagination.since)">Next page <span aria-hidden="true">&raquo;</span></a></li>
    </ul>
</nav>
</template>

<style>
    .pagination {
        margin-top: 40px;
    }
</style>

<script>
    export default {
        props: ['pagination'],
        methods: {
            changePage(page, since) {
                if (page>=1) {
                    this.pagination.current_page = page
                    this.pagination.sinceHistory[page] = since
                    this.pagination.previous_since = this.pagination.sinceHistory[page-1]
                    this.pagination.since = since

                    // store current pagination
                    localStorage.setItem('pagination', JSON.stringify(this.pagination))

                    this.$emit('paginate')
                }
            }
        }
    }
</script>