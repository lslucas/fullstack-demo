<template>
<nav aria-label="navigation ">
  <ul class="pagination">
        <li :class="'page-item' + (pagination.current_page<=1 ? ' disabled' : '')"><a class="page-link" href='#' @click="changePage(pagination.current_page - 1)" :disabled="pagination.current_page <= 1"><span aria-hidden="true">&laquo;</span> Previous</a></li>
        <li class='page-item'><a class="page-link" href='#' @click="changePage(pagination.current_page + 1)">Next page <span aria-hidden="true">&raquo;</span></a></li>
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
            changePage(page) {
                if (page>=1) {
                    this.pagination.current_page = page
                    this.$emit('paginate')
                }
            }
        }
    }
</script>