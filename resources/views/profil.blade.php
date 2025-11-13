@extends('layouts.main')

@section('content')
<div x-data="{ edit: false, nama: '{{ auth()->user()->name }}', biodata: '{{ auth()->user()->biodata }}', email: '{{ auth()->user()->email }}', umur: '{{ auth()->user()->umur }}', alamat: '{{ auth()->user()->alamat }}' }"
    class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
    <section class="bg-white dark:bg-gray-800">
        <div class="py-4 px-4 mx-auto w-full">
            @if ($errors->any())
            <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Danger</span>
                <div>
                    <span class="font-medium">Ensure that these requirements are met:</span>
                    <ul class="mt-1.5 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            <form action="{{ route('update.profil') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4 flex items-center justify-between border-b border-gray-300">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Profil</h2>
                    <div class="flex items-center justify-end pb-4">
                        <button x-show="!edit" @click="edit = true" type="button" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                            Edit
                        </button>
                        <button x-show="edit" @click="edit = false" type="submit" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-green-700 rounded-lg focus:ring-4 focus:ring-green-200 dark:focus:ring-green-900 hover:bg-green-800">
                            Simpan
                        </button>
                        <button x-show="edit" @click="edit = false" type="button" class="inline-flex items-center px-5 py-2.5 ms-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                            Batal
                        </button>
                    </div>
                </div>
                <div class=" grid gap-4 sm:grid-cols-6 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <p x-show="!edit" class="block text-sm text-gray-900 dark:text-white">{{ auth()->user()->name }}</p>
                        <input x-show="edit" x-model="nama" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nama" required="">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="umur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Umur</label>
                        <p x-show="!edit" class="block mb-2 text-sm text-gray-900 dark:text-white">{{ auth()->user()->umur }}</p>
                        <input x-show="edit" x-model="umur" type="number" name="umur" id="umur" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="23" required="">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <p x-show="!edit" class="block mb-2 text-sm text-gray-900 dark:text-white">{{ auth()->user()->email }}</p>
                        <input x-show="edit" x-model="email" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nama@email.com" required="">
                    </div>
                    <div class="sm:col-span-3">
                        <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                        <p x-show="!edit" class="block mb-2 text-sm text-gray-900 dark:text-white">{{ auth()->user()->alamat }}</p>
                        <textarea x-show="edit" id="alamat" name="alamat" x-model="alamat" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="jl example"></textarea>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="biodata" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biodata</label>
                        <p x-show="!edit" class="block mb-2 text-sm text-gray-900 dark:text-white">{{ auth()->user()->biodata }}</p>
                        <textarea x-show="edit" id="biodata" name="biodata" x-model="biodata" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Biodata"></textarea>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection