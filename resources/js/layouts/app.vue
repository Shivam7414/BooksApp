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
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <form class="d-flex" role="search">
                            <input
                                class="form-control me-2"
                                type="search"
                                placeholder="Search"
                                aria-label="Search"
                            />
                            <button class="btn btn-outline-success" type="submit">
                                Search
                            </button>
                        </form>
                    </ul>
                    <div>
                        <router-link to="admin/login" class="btn btn-primary">Admin Login</router-link>
                    </div>
                </div>
            </div>
        </nav>
        <router-view></router-view>
    </div>
</template>
