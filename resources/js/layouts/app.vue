<template>
    <div>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <router-link to="/" class="navbar-brand">Book App</router-link>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div
                    class="collapse navbar-collapse"
                    id="navbarSupportedContent"
                >
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <router-link to="admin/book/index" class="nav-link">Dashboard</router-link
                            >
                        </li>
                    </ul>
                    <div>
                        <ul class="navbar-nav">
                            <li class="nav-item me-3" v-if="isLoggedIn">
                                <router-link to="admin_login" class="btn btn-primary">Admin Login</router-link
                                >
                            </li>
                            <li class="nav-item" v-if="isLoggedIn">
                                <button class="btn btn-danger" @click="logout">
                                    Logout
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <router-view></router-view>
    </div>
</template>
<script>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";

export default {
    setup() {
        const router = useRouter();
        const isLoggedIn = ref(false);

        const logout = () => {
            localStorage.removeItem("token");
            router.push({ name: "Home" });
        };

        // Check if the user is logged in on component mount
        onMounted(() => {
            isLoggedIn.value = !!localStorage.getItem("token");
        });

        return {
            isLoggedIn,
            logout,
        };
    },
};
</script>
