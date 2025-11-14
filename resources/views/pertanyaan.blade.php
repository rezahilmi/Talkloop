@extends('layouts.main')

@section('content')

@section('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/erimicel/select2-tailwindcss-theme/dist/select2-tailwindcss-theme-plain.min.css">
@endsection

<nav class="flex mb-4" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
            <a href="{{ route('forum') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd" />
                </svg>
                Forum
            </a>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                </svg>
                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Pertanyaan</span>
            </div>
        </li>
    </ol>
</nav>
<div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
    <div class="mb-2 w-full pt-4 pb-3 px-3">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-md font-semibold text-gray-800 dark:text-white">{{ $pertanyaan->user->name }}</p>
                <p class="mb-2 text-sm text-gray-800 dark:text-white/90">{{ \Carbon\Carbon::parse($pertanyaan->created_at)->translatedFormat('d M Y') }}</p>
            </div>
            @if(Auth::id() === $pertanyaan->user_id)
            <button id="dropdownMenuIconHorizontalButton" data-dropdown-toggle="dropdownDotsHorizontal{{ $pertanyaan->id }}" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                </svg>
            </button>
            @endif
        </div>

        <div id="dropdownDotsHorizontal{{ $pertanyaan->id }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
            <ul class="py-2 text-sm text-gray-700 dark:text-white" aria-labelledby="dropdownMenuIconHorizontalButton">
                @can('update', $pertanyaan)
                <li>
                    <button data-modal-target="modal-edit-tanya" data-modal-toggle="modal-edit-tanya" class="block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</button>
                </li>
                @endcan
                @can('delete', $pertanyaan)
                <li>
                    <form action="{{ route('destroy.pertanyaan', $pertanyaan->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Hapus</button>
                    </form>
                </li>
                @endcan
            </ul>
        </div>

        <!-- Main modal -->
        <div id="modal-edit-tanya" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Edit pertanyaan
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-edit-tanya">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <form action="{{ route('update.pertanyaan', $pertanyaan->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="judul" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Pertanyaan</label>
                                <input type="text" value="{{ $pertanyaan->judul }}" name="judul" id="judul" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan judul pertanyaan Anda" required>
                            </div>
                            <div class="mb-4">
                                <label for="isi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Isi Pertanyaan</label>
                                <textarea id="isi" name="isi" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Jelaskan pertanyaan Anda secara detail">{{ $pertanyaan->isi }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="dropzone-file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Gambar</label>
                                <div
                                    x-data="{
                                    imageUrl: '{{ $pertanyaan->gambar ? asset('storage/' . $pertanyaan->gambar) : '' }}',
                                    previewImage(event) {
                                        const file = event.target.files[0];
                                        if (!file) return;
                                        this.imageUrl = URL.createObjectURL(file);
                                    },
                                    chooseNew() {
                                        $refs.fileInput.click();
                                    }
                                }"
                                    class="flex items-center justify-center w-full">
                                    <label for="dropzone-file" x-show="!imageUrl" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                        </div>
                                        <input id="dropzone-file" type="file" name="gambar" class="hidden" @change="previewImage" x-ref="fileInput" />
                                    </label>
                                    <div
                                        class="w-full h-64 rounded-lg overflow-hidden relative cursor-pointer"
                                        x-show="imageUrl"
                                        @click="chooseNew">
                                        <img :src="imageUrl" class="w-full h-full object-contain" alt="Preview">

                                        <!-- Optional overlay text -->
                                        <div class="absolute bottom-2 right-2 bg-black/50 text-white text-xs px-2 py-1 rounded">
                                            Klik untuk ganti gambar
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                                <select id="kategori{{  $pertanyaan->id }}" name="kategori" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled>Pilih Kategori</option>
                                    @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ $pertanyaan->kategori_id === $kategori->id ? 'selected' : '' }}>{{ $kategori->kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <!-- Modal footer -->
                    <div class=" flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="modal-edit-tanya" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kirim</button>
                        <button data-modal-hide="modal-edit-tanya" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batal</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $pertanyaan->judul }}</h5>
        <p class="font-normal text-gray-700 dark:text-white/80">{!! $pertanyaan->isi !!}</p>
        @if ($pertanyaan->gambar)
        <img src="{{ asset('storage/' . $pertanyaan->gambar) }}" alt="gambar" class="mt-2 w-full h-60 object-contain">
        @endif
        <p class="my-3 w-fit bg-gray-100 text-gray-700 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-white">{{ $pertanyaan->kategori->kategori }}</p>
        <div class="inline-flex items-center">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17h6l3 3v-3h2V9h-2M4 4h11v8H9l-3 3v-3H4V4Z" />
            </svg>
            <p class="ps-1 text-gray-800 dark:text-white">{{ $pertanyaan->jawaban()->count() }} balasan</p>
        </div>
    </div>
    <div class="w-full mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">

        <p class="text-md font-semibold text-gray-800 dark:text-white">{{ auth()->user()->name }}</p>
        <form action="{{ route('store.jawaban', $pertanyaan->id) }}" method="POST">
            @csrf
            <label for="jawaban" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Beri Jawaban</label>
            <textarea id="jawaban" name="jawaban" rows="4" class="block mb-3 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Bantu berikan jawaban anda"></textarea>
            <div class="flex justify-end">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Jawab</button>
            </div>
        </form>

    </div>
    @forelse ($pertanyaan->jawaban as $jawaban)
    <div x-data="{ editing: false, newJawaban: '{{ $jawaban->jawaban }}' }"
        class="w-full mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-between items-start">
            <p class="text-md font-semibold text-gray-800 dark:text-white">{{ $jawaban->user->name }}</p>
            @if(Auth::id() === $jawaban->user_id)
            <button id="dropdownMenuIconHorizontalButton" data-dropdown-toggle="dropdownDotsHorizontal{{ $jawaban->id }}" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                </svg>
            </button>
            @endif
        </div>

        <!-- Dropdown menu -->
        <div id="dropdownDotsHorizontal{{ $jawaban->id }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
            <ul class="py-2 text-sm text-gray-700 dark:text-white" aria-labelledby="dropdownMenuIconHorizontalButton">
                @can('update', $jawaban)
                <li>
                    <button @click="editing = true" class="block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</button>
                </li>
                @endcan
                @can('delete', $jawaban)
                <li>
                    <form action="{{ route('destroy.jawaban', $jawaban->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Hapus</button>
                    </form>
                </li>
                @endcan
            </ul>
        </div>
        <p x-show="!editing" class="font-normal text-gray-700 dark:text-white/80">{{ $jawaban->jawaban }}</p>
        <form
            x-show="editing"
            method="POST"
            action="{{ route('update.jawaban', $jawaban->id) }}"
            class="mt-3 space-y-2">
            @csrf
            @method('PUT')
            <textarea x-model="newJawaban" id="jawaban" name="jawaban" rows="4" class="block mb-3 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Bantu berikan jawaban anda"></textarea>

            <div class="flex justify-end gap-2">
                <button type="submit"
                    class="px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Edit
                </button>
                <button type="button"
                    @click="editing = false"
                    class="px-3 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">
                    Batal
                </button>
            </div>
        </form>
    </div>
    @empty
    <div class="w-full mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <p class="text-md text-center font-semibold text-gray-800 dark:text-white">Bantu penanya dengan jawabanmu!</p>
    </div>
    @endforelse
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.tiny.cloud/1/zi1cn2ua23tfhzc0lj8irpq57eenu29lev9gt9hmmp2b9nme/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
<script>
    tinymce.init({
        selector: 'textarea#isi',
        plugins: 'lists link image code',
        toolbar: 'bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link image | code',
        menubar: false,
    });
</script>
<script>
    $('#kategori').select2({
        theme: 'tailwindcss-3',
    });
</script>
@endsection