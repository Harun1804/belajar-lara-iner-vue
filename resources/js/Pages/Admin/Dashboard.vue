<script setup>

</script>

<template>
    <div>
        <h1>Hello {{ $page.props.auth.user.name }}</h1>
        <img :src="$page.props.auth.user.avatar">
    </div>
</template>
