{{-- @dd(session('alertCustomer')) --}}
@extends('layout.master')
@section('tittle')
    <title>Beranda</title>
@endsection
@section('content')
    @vite(['resources/js/animateBeranda.js'])

    @if (session()->has('alertCustomer'))
        <div id="toast-default"
            class="flex translate-y-2 transition-all ease-in-out duration-500 absolute z-[100] right-1/2 translate-x-1/2 items-center w-full max-w-xs p-4 text-body bg-neutral-primary-soft rounded-base shadow-xs border border-default durasiAlert"
            role="alert">
            <i class='bx bxs-message-alt-error text-yellow-400 text-xl'></i>
            <div class="ms-2.5 text-justify text-sm border-s border-r mr-2.5 pr-3.5 border-default ps-3.5">
                {{ session('alertCustomer') }}</div>
            <button type="button"
                class="ms-auto flex items-center justify-center text-body hover:text-heading bg-transparent box-border border border-transparent hover:bg-neutral-secondary-medium focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded text-sm h-8 w-8 focus:outline-none"
                data-dismiss-target="#toast-default" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18 17.94 6M18 18 6.06 6" />
                </svg>
            </button>
        </div>
    @endif

    <div id="indicators-carousel" class="relative w-full mt-14" data-carousel="static">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-base md:h-96">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                <div
                    class="large z-[100] centered right-1/2 translate-x-1/2 grid square-grid absolute top-1/2 -translate-y-1/2">
                    <p class="text-2xl md:text-4xl text-white w-full text-center font-semibold">
                        UP3 MAMUJU<br>
                        ULP MANAKARRA
                    </p>
                </div>
                <img src="{{ asset('img/upscalemedia-transformed.jpeg') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('img/Banner-Security.png') }}"
                    class="absolute block w-full h-full -translate-x-1/2 object-cover -translate-y-1/2 top-1/2 left-1/2"
                    alt="...">
            </div>
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('img/fa-nataru.png') }}"
                    class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>       
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse bottom-5 left-1/2">
            <button type="button" class="w-3 h-3 rounded-base" aria-current="true" aria-label="Slide 1"
                data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-base" aria-current="false" aria-label="Slide 2"
                data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-base" aria-current="false" aria-label="Slide 3"
                data-carousel-slide-to="2"></button>
           
        </div>
        <!-- Slider controls -->
        <button type="button"
            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-base bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-5 h-5 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m15 19-7-7 7-7" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button"
            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-base bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-5 h-5 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m9 5 7 7-7 7" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>


    <div class="w-full home-map bg-primary/30 pb-5 pt-2 px-2 mt-2.5 md:px-3">
        <div class="md:container md:mx-auto lg:px-20">
            <div class="grid gap-1 mb-2">
                <h1 class="text-center uppercase text-lg font-bold text-primary md:text-3xl">lokasi up3 mamuju</h1>
                <div class="w-full grid gap-1">
                    <div class="w-1/2 mx-auto h-1 bg-yellow-400"></div>
                    <div class="w-[65%] h-1 mx-auto bg-primary"></div>
                </div>
            </div>
            <iframe class="aspect-video w-full lg:w-[85%] rounded-sm overflow-hidden mx-auto"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3985.464308627829!2d118.89250687501698!3d-2.6769814973005834!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d92d9ad5a8f8151%3A0x88a7de059c267b7!2sPT.%20PLN%20(Persero)%20UP3%20Mamuju!5e0!3m2!1sen!2sid!4v1770108118811!5m2!1sen!2sid"
                style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <div class="grid home-terkini px-2.5 gap-3 bg-white mt-5 py-2 lg:px-28">
        <div class="w-full text-center mx-auto">
            <h1 class="font-bold text-lg text-primary md:text-3xl">TERKINI PLN MAMUJU</h1>
            <div class="grid gap-1 md:gap-2 md:mt-1">
                <div class="w-1/2  bg-yellow-300 h-1 mx-auto"></div>
                <div class="w-[65%]  bg-yellow-300 h-1 mx-auto"></div>
            </div>
        </div>

        <div class="w-full md:bg-white md:px-5 md:rounded-base xl:flex">
            <div
                class="relative terkini-main xl:w-[50%] py-4 rounded-t-base md:rounded-none bg-white md:bg-transparent px-2 md:px-0">
                <div class="px-2 text-justify">
                    <div class="flex xl:grid items-center gap-2">
                        <span class="text-md flex gap-2 font-light text-primary md:font-semibold md:text-lg xl:text-xl">
                            <img src="{{ $data1['publisher_logo'] }}" alt="logo"
                                class="w-7 h-7 md:h-9 md:w-9 xl:w-11 xl:h-11">
                            <p>{{ $data1['source_name'] }}</p>
                        </span class="flex items-center">
                        <span class="flex gap-1 xl:hidden">
                            <div class="h-3 w-[1px] md:w-0.5 bg-black"></div>
                            <div class="h-3 w-[1px] bg-black md:w-0.5"></div>
                        </span>
                        <span class="md:font-semibold md:text-lg xl:text-xl">
                            {{ $data1['pubDate'] }}
                        </span>
                    </div>
                    <a href="{{ $data1['link'] }}">
                        <h1 class="text-lg font-semibold md:text-3xl  text-justify"> {{ Str::limit($data1['title'], 70) }}
                        </h1>
                    </a>
                </div>
            </div>
            <hr class="border-yellow-300 border-4 xl:hidden">
            <div class="border-4 h-full border-yellow-300 hidden xl:block"></div>
            <div class="w-full sm:flex">
                <div class="w-full terkini-card bg-white px-2 py-4 md:flex sm:w-[50%] shrink">
                    <div class="px-2 text-justify">
                        <div class="flex sm:grid items-center gap-2">
                            <div
                                class="text-sm flex font-light text-primary gap-2 items-center md:text-base md:font-normal">
                                <img src="{{ $data2['publisher_logo'] }}" class="w-7 h-7 block">
                                <span>{{ $data2['source_name'] }}</span>
                            </div>
                            <span class="flex gap-1 sm:hidden">
                                <div class="h-3 w-[1px] md:w-0.5 bg-black md:bg-black/80"></div>
                                <div class="h-3 w-[1px] md:w-0.5 bg-black md:bg-black/80"></div>
                            </span>
                            <span class="text-sm md:text-base md:font-normal">
                                {{ $data2['pubDate'] }}
                            </span>
                        </div>
                        <h1 class="text-lg font-semibold md:text-2xl">
                            {{ $data2['title'] }}
                        </h1>
                        <div class="bg-white py-2 group">
                            <a href="{{ $data2['link'] }}"
                                class="text-primary group-hover:underline items-center flex text-xl">Selengkapnya<i
                                    class='bx bx-right-arrow-alt'></i></a>
                        </div>
                    </div>
                </div>
                <div class="terkini-card w-full px-2 py-4 bg-white rounded-b-base md:flex sm:w-[50%]">
                    <div class="px-2 text-justify">
                        <div class="flex w-full sm:grid items-center gap-2">
                            <span
                                class="text-sm flex gap-2 items-center font-light text-primary md:text-base md:font-normal">
                                <img src="{{ $data3['publisher_logo'] }}" alt="logo" class="w-7 h-7">
                                <p>{{ $data3['source_name'] }}</p>
                            </span class="flex items-center">
                            <span class="flex gap-1 sm:hidden">
                                <div class="h-3 w-[1px] bg-black md:w-0.5 md:bg-black/80"></div>
                                <div class="h-3 w-[1px] bg-black md:w-0.5 md:bg-black/80"></div>
                            </span>
                            <span class="text-sm md:text-base md:font-normal truncate">
                                {{ $data3['pubDate'] }}
                            </span>
                        </div>
                        <h1 class="text-lg md:text-2xl font-semibold">
                            {{ $data3['title'] }}
                        </h1>

                        <div class="bg-white py-2 group">
                            <a href="{{ $data3['link'] }}"
                                class="text-primary group-hover:underline items-center flex text-xl">Selengkapnya<i
                                    class='bx bx-right-arrow-alt'></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
