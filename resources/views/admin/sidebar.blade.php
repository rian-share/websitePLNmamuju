 <aside id="default-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-full  transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full shadow-2xl pl-3 py-4 overflow-y-auto bg-white">
            <ul class="space-y-2 font-medium">
                <li>
                    <div class=" mx-auto shadow-xl px-1 py-0.5 rounded-lg w-fit">
                        <img src="{{ asset('svg/1661781006-removebg-preview (1).svg') }}" alt="logo_pln" class="w-24 h-24">
                    </div>
                </li>
                <li id="logOut">
                    <a href="#"
                        class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-primary/70 hover:rounded-r-none hover:text-white transition-all ease-in-out duration-300">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-fg-brand" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6.025A7.5 7.5 0 1 0 17.975 14H10V6.025Z" />
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.5 3c-.169 0-.334.014-.5.025V11h7.975c.011-.166.025-.331.025-.5A7.5 7.5 0 0 0 13.5 3Z" />
                        </svg>
                        <span class="ms-3">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>