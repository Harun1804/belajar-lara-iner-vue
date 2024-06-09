<script setup>
import { useForm } from '@inertiajs/vue3';
import TextInput from '../../Components/Elements/TextInput.vue';

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
            <TextInput id="name" name="Fullname" v-model="form.name" :message="form.errors.name" placeholder="Ex. Brandon"/>
            <TextInput id="email" name="Email Address" type="email" v-model="form.email" :message="form.errors.email" placeholder="Ex. example@mail.test"/>
            <TextInput id="password" name="Password" type="password" v-model="form.password" :message="form.errors.password" placeholder="********"/>
            <TextInput id="password_confirmation" name="Password Confirmation" type="password" v-model="form.password_confirmation" placeholder="********"/>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary float-end">Submit</button>
            </div>
        </form>
    </div>
</template>
