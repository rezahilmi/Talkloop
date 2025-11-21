<script setup>
import { useForm, Link } from '@inertiajs/vue3'
import AuthLayout from '@/Layouts/AuthLayout.vue'

const form = useForm({
    email: '',
    password: '',
})

const submit = () => {
    form.post(route('post.login'), {
        onFinish: () => {
            form.reset('password')
        },
    })
}

const asset = (path) => {
    return `/${path}`
}
</script>

<template>
    <AuthLayout>
        <section class="bg-gray-50 dark:bg-gray-900">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <Link href="/" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="w-8 h-8 mr-2" :src="asset('images/talkloop.png')" alt="logo">
                    Talkloop
                </Link>
                
                <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Masuk ke akunmu
                        </h1>
                        
                        <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Email
                                </label>
                                <input 
                                    type="email" 
                                    v-model="form.email"
                                    id="email" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    :class="{ 'border-red-500': form.errors.email }"
                                    placeholder="name@company.com" 
                                    required
                                >
                                <p v-if="form.errors.email" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.email }}
                                </p>
                            </div>

                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Password
                                </label>
                                <input 
                                    type="password" 
                                    v-model="form.password"
                                    id="password" 
                                    placeholder="••••••••" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    :class="{ 'border-red-500': form.errors.password }"
                                    required
                                >
                                <p v-if="form.errors.password" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.password }}
                                </p>
                            </div>
                            
                            <button 
                                type="submit" 
                                :disabled="form.processing"
                                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                {{ form.processing ? 'Loading...' : 'Masuk' }}
                            </button>
                            
                            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                Tidak punya akun? 
                                <Link :href="route('register')" class="font-medium text-blue-600 hover:underline dark:text-blue-500">
                                    Buat akun
                                </Link>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </AuthLayout>
</template>