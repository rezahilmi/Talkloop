<script setup>
import { useForm, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const asset = (path) => {
    return `/${path}`;
};
</script>

<template>
    <AppLayout>
        <div>
            <h1>Hello</h1>
        </div>
    </AppLayout>
</template>
