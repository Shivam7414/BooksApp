<!-- SearchPage.vue -->

<template>
    <div
        class="d-flex align-items-center justify-content-center w-100"
        style="height: 500px"
    >
        <div class="text-center">
            <h1>Book Search</h1>
            <div class="search-container">
                <input
                    type="text"
                    v-model="searchQuery"
                    @input="debouncedSearch"
                    placeholder="Search by book title, author name, isbn"
                    class="form-control search-input"
                    style="width: 400px;"
                />
                <ul v-if="searchResults.length > 0" class="suggestions">
                    <li
                        v-for="result in searchResults"
                        :key="result.id"
                        @click="selectSuggestion(result)"
                    >
                        {{ result.title }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";
    import _debounce from "lodash/debounce";

    export default {
        data() {
            return {
                searchQuery: "",
                searchResults: [],
                searchExecuted: false,
            };
        },
        methods: {
            debouncedSearch: _debounce(function () {
                this.search();
            }, 100),

            async search() {
                if (this.searchQuery.trim() === "") {
                    this.searchResults = [];
                    this.searchExecuted = false;
                    return;
                }

                try {
                    const response = await axios.get(
                        `http://localhost:8000/api/book/search?q=${this.searchQuery}`
                    );
                    this.searchResults = response.data;
                    this.searchExecuted = true;
                } catch (error) {
                    console.error("Error searching:", error);
                }
            },

            selectSuggestion(result) {
                const bookId = result.id;
                this.$router.push(`/book-detail/${bookId}`);
            },
        },
    };
</script>

<style scoped>
.search-container {
    position: relative;
}

.suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1;
    background-color: #fff;
    border: 1px solid #ddd;
    border-top: none;
    list-style: none;
    padding: 0;
    margin: 0;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
}

.suggestions li {
    padding: 8px;
    cursor: pointer;
    border-bottom: 1px solid #ddd;
}

.suggestions li:last-child {
    border-bottom: none;
}
</style>
