<template>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!-- Előző gomb -->
            <li class="page-item" :class="{ disabled: currentPage === 1 }" @click="changePage(currentPage - 1)">
                <a class="page-link" href="#">Previous</a>
            </li>

            <!-- Oldalszámok -->
            <li class="page-item" v-for="page in pagesArray" :key="page" :class="{ active: page === currentPage }"
                @click="changePage(page)">
                <a class="page-link" href="#">{{ page }}</a>
            </li>

            <!-- Következő gomb -->
            <li class="page-item" :class="{ disabled: currentPage === totalPages }"
                @click="changePage(currentPage + 1)">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: ["currentPage", "pagesArray", "totalPages"],
    methods: {
        changePage(newPage) {
            if (newPage >= 1 && newPage <= this.totalPages) {
                this.$emit("pageChange", newPage);
            }
        }
    }
};
</script>