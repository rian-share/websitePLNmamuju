@extends('layout.master')
@section('tittle')
    <title>Berita</title>
@endsection
@section('content')
    @vite(['resources/js/gsap.js'])
    <div class="w-full relative h-full pb-10 bg-primary/20 z-10">
        <div class="container mx-auto z-[100] mt-15">
            <div class="md:flex md:justify-evenly md:px-5 md:mt-10 lg:gap-5 lg:mt-20 items-center news-header">
                <div class="flex items-center md:w-[40%] lg:w-fit mx-auto w-fit">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold uppercase md:whitespace-nowrap text-primary">pln news</h1>
                        <hr class="border-2 border-yellow-400">
                    </div>
                    <img src="{{ asset('svg/1661781006-removebg-preview (1).svg') }}" alt="Logopln"
                        class="w-15 h-15 md:w-20 md:h-20">
                </div>
                <div class="w-[90%] md:grow mx-auto">
                    <form class="flex items-center mx-auto space-x-2" id="formSearch">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <i class='bx bx-news text-black/50'></i>
                            </div>
                            <input type="text" id="inputSearch"
                                class="px-3 py-2.5 md:text-lg xl:text-xl bg-neutral-secondary-medium border border-default-medium rounded-base ps-9 text-heading text-sm focus:ring-primary focus:border-primary block w-full placeholder:text-body"
                                placeholder="Cari Berita......" required />
                        </div>
                        <button type="submit"
                            class="inline-flex items-center justify-center shrink-0 text-white bg-primary hover:bg-primary/70 trans focus:ring-4 focus:ring-brand-medium shadow-xs rounded-base w-10 h-10 md:w-12 md:h-12 xl:w-14 xl:h-14 focus:outline-none">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                    d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                            </svg>
                            <span class="sr-only">Icon description</span>
                        </button>
                    </form>
                    {{-- <div>
                        <button type="submit" onclick="window.location.reload()" class="w-fit border p-3 rounded-xl text-wh">Semua Berita</button>
                    </div> --}}
                </div>
            </div>
            <div class="w-full hidden h-40 grid items-center justify-center" id="loadSearch">
                <div class="rounded-full w-14 h-14 border-8 animate-spin border-gray-300 border-t-primary">
                </div>
            </div>
            <div class="w-full" id="alertError"></div>
            <div class=" grid mt-8 md:mt-5 justify-center gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 md:px-5 w-full"
                id="viewBerita">

                @foreach ($itemsArray as $data)
                    <div
                        class="w-[90%] bg-white md:w-full mx-auto shadow-[-3px_0px_5px_rgba(0,0,0,.25),3px_0px_5px_rgba(0,0,0,.25),0px_5px_5px_rgba(0,0,0,.25)] rounded-lg p-3 grid gap-2 news-card">
                        <div class="flex gap-3">
                            <img src="https://www.google.com/s2/favicons?sz=64&domain={{ $data['source_url'] }}"
                                alt="logo_berita" class="w-12 h-12">
                            <div class="grid">
                                <h1 class="font-semibold text-black/80">
                                    {{ $data['source_name'] }}
                                </h1>
                                <div class="flex items-center">
                                    <i class='bx bxs-calendar mr-1 self-start text-black/50'></i>
                                    <div class="font-normal text-base"> {{ $data['pubDate'] }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="h-40 grid">
                            <div>
                                <h1 class="font-semibold h-full text-xl">
                                    {{ Str::limit($data['title'], 100) }}
                                </h1>
                            </div>
                            <div class="w-full bg-primary self-end  px-3 py-2 rounded-sm">
                                <a href="" class="w-fit mx-auto text-center" target="blank">
                                    <p class="text-light font-semibold">Selengkapnya</p>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script src="{{ asset('js/cariBerita.js') }}"></script>
@endsection
