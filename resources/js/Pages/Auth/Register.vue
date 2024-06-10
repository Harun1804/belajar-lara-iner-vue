<script setup>
import { useForm } from '@inertiajs/vue3';
import TextInput from '../../Components/Elements/TextInput.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    avatar: null,
    preview: null,
})

const addAvatar = (e) => {
    const file = e.target.files[0];
    form.avatar = file;
    form.preview = URL.createObjectURL(file);
}

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
            <div class="input-group mb-3">
                <label class="input-group-text" for="avatar">Avatar</label>
                <input type="file" class="form-control" id="avatar" @input="addAvatar">
            </div>
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
