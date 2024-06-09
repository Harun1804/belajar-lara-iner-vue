<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
})

const register = () => {
    form.post(route('auth.register', {
        onErrors: () => {
            form.reset('password', 'password_confirmation');
        }
    }));
}

</script>

<template>
    <div class="container my-5">
        <form @submit.prevent="register()">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" placeholder="bandung bodowoso" v-model="form.name">
                <small class="form-text text-danger">{{ form.errors.name }}</small>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="name@example.com" v-model="form.email">
                <small class="form-text text-danger">{{ form.errors.email }}</small>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="********" v-model="form.password">
                <small class="form-text text-danger">{{ form.errors.password }}</small>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" placeholder="********" v-model="form.password_confirmation">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary float-end">Submit</button>
            </div>
        </form>
    </div>
</template>
