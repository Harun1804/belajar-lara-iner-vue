<script setup>
import TextInput from '../../Components/Elements/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    email: null,
    password: null,
    remember: false,
});

function login() {
    form.post(route('auth.login'), {
        onError: () => {
            form.reset('password');
        }
    });
}

</script>

<template>
    <div class="container mt-5">
        <form @submit.prevent="login()">
            <TextInput id="email" name="Email Address" v-model="form.email" placeholder="example@mail.test" :message="form.errors.email"/>
            <TextInput id="password" name="Password" v-model="form.password" placeholder="*****" :message="form.errors.password"/>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="flexCheckDefault" v-model="form.remember">
                <label class="form-check-label" for="flexCheckDefault">
                    Remember me
                </label>
            </div>
            <div class="row mb-3">
                <div class="col-12 d-flex flex-column text-center">
                    <p>Doesn't have an account ? <Link :href="route('auth.register.page')">Register</Link></p>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</template>
