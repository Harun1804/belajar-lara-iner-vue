<script setup>

</script>

<template>
    <Head :title="`${$page.component} Page`"/>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <Link class="nav-link" aria-current="page" :href="route('home')" >Home</Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link" :href="route('about')">About</Link>
                    </li>
                </ul>
                <div class="d-flex">
                    <Link :href="route('auth.login.page')" class="btn btn-info text-white mx-2">Login</Link>
                    <Link :href="route('auth.register.page')" class="btn btn-primary">Register</Link>
                </div>
            </div>
        </div>
    </nav>
    <slot />
</template>
