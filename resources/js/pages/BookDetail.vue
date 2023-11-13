<template>
    <div>
        <h2>{{ book.title }}</h2>
        <p><strong>Author:</strong> {{ book.author }}</p>
        <p><strong>Genre:</strong> {{ book.genre }}</p>
        <p><strong>Description:</strong> {{ book.description }}</p>
        <p><strong>ISBN:</strong> {{ book.isbn }}</p>
        <p><strong>Published At:</strong> {{ book.published_at }}</p>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            book: {},
        };
    },
    async created() {
        const bookId = this.$route.params.id;
        await this.fetchBookDetails(bookId);
    },
    methods: {
        async fetchBookDetails(bookId) {
            try {
                const response = await axios.get(
                    `http://localhost:8000/api/book/detail/${bookId}`
                );
                this.book = response.data;
            } catch (error) {
                console.error("Error fetching book details:", error);
            }
        },
    },
};
</script>

<style scoped>
</style>
