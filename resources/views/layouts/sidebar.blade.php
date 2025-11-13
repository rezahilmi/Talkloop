<aside id="sidebar" class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-15 font-normal duration-75 lg:flex transition-width" aria-label="Sidebar">
    <div class="relative flex flex-col flex-1 min-h-0 pt-0 bg-gray-50 border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 space-y-1 bg-gray-50 divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                <ul class="pb-2 space-y-2">
                    @auth
                    <li>
                        <a href="{{ route('forum') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-blue-100 group dark:text-gray-200 dark:hover:bg-gray-700 @if(request()->segment(1) == 'forum') bg-blue-100 dark:bg-gray-700 @endif">
                            <svg class="w-6 h-6 transition duration-75 group-hover:text-blue-500 dark:text-gray-400 dark:group-hover:text-white @if(request()->segment(1) == 'forum') text-blue-500 @else text-gray-500 @endif" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd" />
                            </svg>

                            <span class="ml-3" sidebar-toggle-item>Forum</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('show.kategori') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-blue-100 group dark:text-gray-200 dark:hover:bg-gray-700 @if(request()->segment(1) == 'kategori') bg-blue-100 dark:bg-gray-700 @endif">
                            <svg class="w-6 h-6 transition duration-75 group-hover:text-blue-500 dark:text-gray-400 dark:group-hover:text-white @if(request()->segment(1) == 'kategori') text-blue-500 @else text-gray-500 @endif" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M9 8h10M9 12h10M9 16h10M4.99 8H5m-.02 4h.01m0 4H5" />
                            </svg>
                            <span class="ml-3" sidebar-toggle-item>Kategori</span>
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</aside>

<div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop"></div>