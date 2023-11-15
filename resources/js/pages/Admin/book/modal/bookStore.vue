<template>
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Book</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Title</label>
                        <input
                            v-model="book.title"
                            type="text"
                            class="form-control"
                        />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Author</label>
                        <input
                            v-model="book.author"
                            type="text"
                            class="form-control"
                        />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Genre</label>
                        <input
                            v-model="book.genre"
                            type="text"
                            class="form-control"
                        />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea
                            v-model="book.description"
                            cols="30"
                            rows="10"
                            class="form-control"
                        ></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Publisher</label>
                        <input
                            v-model="book.publisher"
                            type="text"
                            class="form-control"
                        />
                    </div>
                    <div class="form-group">
                        <label class="form-label">ISBN</label>
                        <input
                            v-model="book.isbn"
                            type="number"
                            class="form-control"
                        />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Published at</label>
                        <input
                            v-model="book.published_at"
                            type="date"
                            class="form-control"
                        />
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-primary"
                        @click="saveBook"
                    >
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive } from "vue";

export default {
    setup() {
        const form = reactive({
            title: "",
            author: "",
            genre: "",
            description: "",
            publisher: "",
            isbn: "",
            published_at: "",
        });
        return { form, saveBook };
    },
    methods: {
        saveBook() {
            console.log("Saving book:", this.form);
            $("#myModal").modal("hide");
        },
    },
};
</script>

<style scoped></style>
