<script setup>
import { Head } from '@inertiajs/vue3'
import { onMounted } from 'vue'

defineProps({
    title: {
        type: String,
        default: 'Talkloop'
    }
})

onMounted(() => {
    if (localStorage.getItem('color-theme') === 'dark' || 
        (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark')
    } else {
        document.documentElement.classList.remove('dark')
    }
})
</script>

<template>
    <div>
        <div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 px-4">
            <div class="max-w-md w-full">
                <slot />
            </div>
        </div>
    </div>
</template>