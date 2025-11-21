<script setup>
import { useForm, Link } from '@inertiajs/vue3'
import AuthLayout from '@/Layouts/AuthLayout.vue'

const form = useForm({
    nama: '',
    email: '',
    password: '',
    password_confirmation: '',
    bio: '',
    umur: '',
    alamat: '',
})

const submit = () => {
    form.post(route('post.register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation')
        },
    })
}

const asset = (path) => {
    return `/${path}`
}
</script>

<template>
  <AuthLayout>
    <section class="py-20 bg-gray-50 dark:bg-gray-900">
      <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
          <img class="w-8 h-8 mr-2" :src="asset('images/talkloop.png')" alt="logo" />
          Talkloop
        </a>

        <div
          class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700"
        >
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
              Buat akun
            </h1>

            <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
              <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                <input
                  v-model="form.nama"
                  type="text"
                  class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                  :class="{ 'border-red-500': form.errors.nama }"
                  placeholder="firdaus"
                />
                <p v-if="form.errors.nama" class="text-red-500 text-sm">{{ form.errors.nama }}</p>
              </div>

              <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input
                  v-model="form.email"
                  type="email"
                  class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                  :class="{ 'border-red-500': form.errors.email }"
                  placeholder="name@company.com"
                />
                <p v-if="form.errors.email" class="text-red-500 text-sm">{{ form.errors.email }}</p>
              </div>

              <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input
                  v-model="form.password"
                  type="password"
                  class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                  :class="{ 'border-red-500': form.errors.password }"
                  placeholder="••••••••"
                />
                <p v-if="form.errors.password" class="text-red-500 text-sm">{{ form.errors.password }}</p>
              </div>

              <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                <input
                  v-model="form.password_confirmation"
                  type="password"
                  class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                  :class="{ 'border-red-500': form.errors.password_confirmation }"
                  placeholder="••••••••"
                />
                <p v-if="form.errors.password_confirmation" class="text-red-500 text-sm">{{ form.errors.password_confirmation }}</p>
              </div>

              <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biodata</label>
                <textarea
                  v-model="form.bio"
                  rows="4"
                  class="block mb-3 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  :class="{ 'border-red-500': form.errors.bio }"
                  placeholder="bio"
                ></textarea>
                <p v-if="form.errors.bio" class="text-red-500 text-sm">{{ form.errors.bio }}</p>
              </div>

              <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Umur</label>
                <input
                  v-model="form.umur"
                  type="number"
                  class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                  :class="{ 'border-red-500': form.errors.umur }"
                  placeholder="23"
                />
                <p v-if="form.errors.umur" class="text-red-500 text-sm">{{ form.errors.umur }}</p>
              </div>

              <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                <textarea
                  v-model="form.alamat"
                  rows="4"
                  class="block mb-3 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  :class="{ 'border-red-500': form.errors.alamat }"
                  placeholder="jl. example"
                ></textarea>
                <p v-if="form.errors.alamat" class="text-red-500 text-sm">{{ form.errors.alamat }}</p>
              </div>

              <button
                type="submit"
                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                {{ form.processing ? 'Loading...' : 'Buat akun' }}
              </button>

              <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                Sudah punya akun?
                <Link :href="route('login')" class="font-medium text-blue-600 hover:underline dark:text-blue-500">
                  Login
                </Link>
              </p>
            </form>
          </div>
        </div>
      </div>
    </section>
  </AuthLayout>
</template>