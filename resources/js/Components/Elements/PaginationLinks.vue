<script setup>
    import { defineProps } from 'vue'

    const props = defineProps({
        paginator: {
            type: Object,
            required: true
        }
    })

    const makeLabel = (label) => {
        if (label.includes("Previous")) {
            return "&lt;"
        } else if (label.includes("Next")) {
            return "&gt;"
        } else {
            return label
        }
    }
</script>

<template>
    <div class="row">
        <div class="col-6">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li v-for="link in paginator.links" :key="link.url" class="page-item"
                        :class="{ 'active': link.active, 'disabled': !link.url }">
                        <Link class="page-link" :href="link.url" v-html="makeLabel(link.label)" />
                    </li>
                </ul>
            </nav>
        </div>
        <div class="col-6">
            <p class="text-muted text-right float-end">Showing {{ paginator.from }} to {{ paginator.to }} of {{ paginator.total }} entries</p>
        </div>
    </div>
</template>

<style scoped>
    .page-item.disabled .page-link {
        pointer-events: none;
        cursor: default;
    }
</style>
