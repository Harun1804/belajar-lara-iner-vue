<script setup>
import PaginationLinks from '../Components/Elements/PaginationLinks.vue'
defineProps({
    users: Object
})

const getDateFormat = (date) => {
    return new Date(date).toLocaleDateString("id-ID", {
        year: "numeric",
        month: "long",
        day: "numeric"
    });
}
</script>

<template>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Created Date</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users.data" :key="user.id">
                    <td>
                        <img :src="user.avatar" alt="avatar" class="img-thumbnail" width="50">
                    </td>
                    <td>{{ user.name }}</td>
                    <td>{{ getDateFormat(user.created_at) }}</td>
                </tr>
            </tbody>
        </table>
        <PaginationLinks :paginator="users"/>
    </div>
</template>




