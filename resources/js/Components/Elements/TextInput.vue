<script setup>
    const model = defineModel({
        type: null,
        required: true
    });

    defineProps({
        id: {
            type: String,
            required: true
        },
        name: {
            type: String,
            required: true
        },
        type: {
            type: String,
            default: 'text'
        },
        placeholder: {
            type: String,
            default: 'Input text here'
        },
        message: String
    })
</script>

<template>
    <div class="mb-3">
        <label :for="id" class="form-label">{{ name }}</label>
        <input :type="type" class="form-control" :id="id" v-model="model" :class="{'is-invalid' : message}" :placeholder="placeholder">
        <small class="form-text text-danger" v-if="message">{{ message }}</small>
    </div>
</template>
