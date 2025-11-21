<script setup>
import { Link, Head } from "@inertiajs/vue3";
import { onMounted, watch } from "vue";
import Swal from "sweetalert2";

defineProps({
    title: {
        type: String,
        default: "Talkloop",
    },
});

const asset = (path) => {
    return `/${path}`;
};

onMounted(() => {
    if (
        localStorage.getItem("color-theme") === "dark" ||
        (!("color-theme" in localStorage) &&
            window.matchMedia("(prefers-color-scheme: dark)").matches)
    ) {
        document.documentElement.classList.add("dark");
    } else {
        document.documentElement.classList.remove("dark");
    }

    if (window.initFlowbite) {
        window.initFlowbite();
    }
});

watch(
    () => window.history.state,
    () => {
        const page = usePage();

        if (page.props.flash?.success) {
            Swal.fire({
                icon: "success",
                title: "Berhasil!",
                text: page.props.flash.success,
                showConfirmButton: false,
                timer: 2000,
            });
        }

        if (page.props.flash?.error) {
            Swal.fire({
                icon: "error",
                title: "Gagal!",
                text: page.props.flash.error,
                showConfirmButton: false,
                timer: 2000,
            });
        }
    },
    { deep: true }
);
</script>

<template>
    <div>
        <nav
            class="fixed z-30 w-full bg-gray-50 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700"
        >
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start">
                        <button
                            id="toggleSidebarMobile"
                            aria-expanded="true"
                            aria-controls="sidebar"
                            class="p-2 text-gray-600 rounded cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        >
                            <svg
                                id="toggleSidebarMobileHamburger"
                                class="w-6 h-6"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                            <svg
                                id="toggleSidebarMobileClose"
                                class="hidden w-6 h-6"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </button>
                        <Link href="/" class="flex ml-2 md:mr-24">
                            <img
                                :src="asset('images/talkloop.png')"
                                width="32"
                                height="32"
                                class="mr-2"
                                alt="Talkloop Logo"
                            />
                            <span
                                class="self-center text-sm font-semibold sm:text-2xl whitespace-nowrap dark:text-white"
                                >Talkloop</span
                            >
                        </Link>
                    </div>
                    <div class="flex items-center">
                        <button
                            id="theme-toggle"
                            data-tooltip-target="tooltip-toggle"
                            type="button"
                            class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
                        >
                            <svg
                                id="theme-toggle-dark-icon"
                                class="hidden w-5 h-5"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                                ></path>
                            </svg>
                            <svg
                                id="theme-toggle-light-icon"
                                class="hidden w-5 h-5"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </button>
                        <div
                            id="tooltip-toggle"
                            role="tooltip"
                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip"
                        >
                            Toggle dark mode
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <!-- Profile -->
                        <div class="flex items-center ml-3">
                            <div>
                                <button
                                    type="button"
                                    class="flex text-sm text-gray-500 dark:text-gray-400 hover:text-gray-900 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                    id="user-menu-button-2"
                                    aria-expanded="false"
                                    data-dropdown-toggle="dropdown-2"
                                >
                                    <span class="sr-only">Open user menu</span>
                                    <svg
                                        class="w-9 h-9 rounded-full"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        fill="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M12 20a7.966 7.966 0 0 1-5.002-1.756l.002.001v-.683c0-1.794 1.492-3.25 3.333-3.25h3.334c1.84 0 3.333 1.456 3.333 3.25v.683A7.966 7.966 0 0 1 12 20ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10c0 5.5-4.44 9.963-9.932 10h-.138C6.438 21.962 2 17.5 2 12Zm10-5c-1.84 0-3.333 1.455-3.333 3.25S10.159 13.5 12 13.5c1.84 0 3.333-1.455 3.333-3.25S13.841 7 12 7Z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>
                            </div>
                            <!-- Dropdown menu -->
                            <div
                                class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                                id="dropdown-2"
                            >
                                <div class="px-4 py-3" role="none">
                                    <p
                                        class="text-sm text-gray-900 dark:text-white"
                                        role="none"
                                    >
                                        {{ $page.props.auth.user.name }}
                                    </p>
                                    <p
                                        class="text-sm font-medium text-gray-900 truncate dark:text-gray-300"
                                        role="none"
                                    >
                                        {{ $page.props.auth.user.email }}
                                    </p>
                                </div>
                                <ul class="py-1" role="none">
                                    <li>
                                        <Link
                                            :href="route('profil')"
                                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                            role="menuitem"
                                        >
                                            <svg
                                                class="text-gray-500 w-5 h-5 dark:text-gray-400"
                                                aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                fill="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>

                                            <span class="ml-1">Profil</span>
                                        </Link>
                                    </li>
                                    <li>
                                        <Link
                                            method="post"
                                            as="button"
                                            :href="route('logout')"
                                            class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        >
                                            <svg
                                                class="text-gray-500 w-5 h-5 dark:text-gray-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                                                ></path>
                                            </svg>
                                            <span class="ml-1">Log out</span>
                                        </Link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="flex pt-16 bg-gray-50 dark:bg-gray-900">
            <aside
                id="sidebar"
                class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-15 font-normal duration-75 lg:flex transition-width"
                aria-label="Sidebar"
            >
                <div
                    class="relative flex flex-col flex-1 min-h-0 pt-0 bg-gray-50 border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700"
                >
                    <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
                        <div
                            class="flex-1 px-3 space-y-1 bg-gray-50 divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700"
                        >
                            <ul
                                v-if="$page.props.auth.user"
                                class="pb-2 space-y-2"
                            >
                                <li>
                                    <Link
                                        :href="route('forum')"
                                        class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-blue-100 group dark:text-gray-200 dark:hover:bg-gray-700 @if(request()->segment(1) == 'forum') bg-blue-100 dark:bg-gray-700 @endif"
                                    >
                                        <svg
                                            class="w-6 h-6 transition duration-75 group-hover:text-blue-500 dark:text-gray-400 dark:group-hover:text-white @if(request()->segment(1) == 'forum') text-blue-500 @else text-gray-500 @endif"
                                            aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            fill="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>

                                        <span class="ml-3" sidebar-toggle-item
                                            >Forum</span
                                        >
                                    </Link>
                                </li>
                                <li>
                                    <Link
                                        :href="route('show.kategori')"
                                        class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-blue-100 group dark:text-gray-200 dark:hover:bg-gray-700 @if(request()->segment(1) == 'kategori') bg-blue-100 dark:bg-gray-700 @endif"
                                    >
                                        <svg
                                            class="w-6 h-6 transition duration-75 group-hover:text-blue-500 dark:text-gray-400 dark:group-hover:text-white @if(request()->segment(1) == 'kategori') text-blue-500 @else text-gray-500 @endif"
                                            aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke="currentColor"
                                                stroke-linecap="round"
                                                stroke-width="2"
                                                d="M9 8h10M9 12h10M9 16h10M4.99 8H5m-.02 4h.01m0 4H5"
                                            />
                                        </svg>
                                        <span class="ml-3" sidebar-toggle-item
                                            >Kategori</span
                                        >
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </aside>

            <div
                class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90"
                id="sidebarBackdrop"
            ></div>

            <div
                id="main-content"
                class="relative p-6 w-full h-full bg-gray-50 lg:ml-64 dark:bg-gray-900"
            >
                <main>
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>
