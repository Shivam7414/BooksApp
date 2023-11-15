<template>
    <div class="container">
        <div class="d-flex justify-content-between mt-3">
            <h2>Book List</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Add Book</button>
        </div>
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-tittle">Add New Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Author</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Genre</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Publisher</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-label">ISBN</label>
                            <input type="number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Published at</label>
                            <input type="date" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-inline mb-3">
            <label class="mr-2">Show:</label>
            <select v-model="perPage" @change="fetchBooks" class="form-control">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Genre</th>
                        <th>Description</th>
                        <th>ISBN</th>
                        <th>Published At</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(book, index) in books.data" :key="book.id">
                        <td>
                            {{
                                (books.current_page - 1) * books.per_page +
                                index +
                                1
                            }}
                        </td>
                        <td>{{ book.title }}</td>
                        <td>{{ book.author }}</td>
                        <td>{{ book.genre }}</td>
                        <td>{{ book.description }}</td>
                        <td>{{ book.isbn }}</td>
                        <td>{{ book.published_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            <nav v-if="books.last_page > 1" class="mt-4">
                <ul class="pagination">
                    <li
                        class="page-item"
                        :class="{ disabled: books.current_page === 1 }"
                    >
                        <a
                            class="page-link"
                            @click="changePage(1)"
                            aria-label="First"
                        >
                            <span aria-hidden="true">Start</span>
                        </a>
                    </li>
                    <li
                        class="page-item"
                        :class="{ disabled: books.current_page === 1 }"
                    >
                        <a
                            class="page-link"
                            @click="changePage(books.current_page - 1)"
                            aria-label="Previous"
                        >
                            <span aria-hidden="true">Prev</span>
                        </a>
                    </li>

                    <li
                        v-for="pageNumber in books.last_page"
                        :key="pageNumber"
                        class="page-item"
                        :class="{ active: books.current_page === pageNumber }"
                    >
                        <a class="page-link" @click="changePage(pageNumber)">{{
                            pageNumber
                        }}</a>
                    </li>

                    <li
                        class="page-item"
                        :class="{
                            disabled: books.current_page === books.last_page,
                        }"
                    >
                        <a
                            class="page-link"
                            @click="changePage(books.current_page + 1)"
                            aria-label="Next"
                        >
                            <span aria-hidden="true">Next</span>
                        </a>
                    </li>
                    <li
                        class="page-item"
                        :class="{
                            disabled: books.current_page === books.last_page,
                        }"
                    >
                        <a
                            class="page-link"
                            @click="changePage(books.last_page)"
                            aria-label="Last"
                        >
                            <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
    import { useRouter } from "vue-router";
    import { reactive } from "vue";
    export default {
        setup() {
           const form = reactive({
                title: '',
                author: '',
                genre: '',
                description: '',
                publisher: '',
                isbn: '',
                published_at: '',
            });
        },
        data() {
            return {
                books: {
                    data: [],
                    current_page: 1,
                    last_page: 1,
                },
                perPage: 10,
            };
        },
        mounted() {
            this.fetchBooks();
        },
        methods: {
            async fetchBooks() {
                try {
                    const response = await fetch(
                        `/api/admin/get_books?per_page=${this.perPage}&page=${this.books.current_page}`
                    );
                    const data = await response.json();
                    this.books = data;
                } catch (error) {
                    console.error("Error fetching books:", error);
                }
            },
            changePage(pageNumber) {
                this.books.current_page = pageNumber;
                this.fetchBooks();
            },
        },
    };
</script>
