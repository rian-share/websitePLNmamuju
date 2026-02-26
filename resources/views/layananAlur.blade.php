@extends('layout.master')
@section('tittle')
<title>AlurLayanan</title>
@endsection
@section('content')
    {{-- @dd(request()->path()) --}}
    <div class="w-full alur-page relative mt-20 lg:mt-24 alur-page">
        <div
            class="text-center alur-title py-3 px-10 border-2 w-fit rounded-lg text-white bg-primary mx-auto font-semibold text-2xl mb-3">
            <h1>Alur Layanan</h1>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 w-full sm:w-[80%] mx-auto lg:w-[60%] justify-center gap-3 px-5">
            <a href="http://127.0.0.1:8000/pdfAlurLayanan/1">
                <div class="p-3 flex alur-card  items-center gap-7 rounded-lg ring-2 ring-primary/30 group hover:bg-primary shadow-xl bg-white transition-all ease-in-out duration-300">
                    <img src="{{ asset('img/upscalemedia-transformed (12).png') }}" alt="LSP" class="w-15 h-15">
                    <h1 class="text-primary font-semibold group-hover:text-white">
                        Penyambungan Baru PB / Perubahan Daya PD
                        Layanan Satu Pintu
                    </h1>
                </div>
            </a>
            <a href="http://127.0.0.1:8000/pdfAlurLayanan/2">
                <div class="p-3 flex alur-card items-center gap-7  rounded-lg ring-2 ring-primary/30 group hover:bg-primary shadow-xl bg-white transition-all ease-in-out duration-300">
                    <img src="{{ asset('img/upscalemedia-transformed (13).png') }}" alt="LSP" class="w-15 h-15">
                    <h1 class="text-primary font-semibold group-hover:text-white">
                        Penyambungan Baru (PB) / Perubahan Daya (PD)
                    </h1>
                </div>
            </a>
            <a href="http://127.0.0.1:8000/pdfAlurLayanan/3">
                <div class="p-3 flex alur-card items-center gap-7  rounded-lg ring-2 ring-primary/30 group hover:bg-primary shadow-xl bg-white transition-all ease-in-out duration-300">
                    <img src="{{ asset('img/upscalemedia-transformed (14).png') }}" alt="LSP" class="w-15 h-15">
                    <h1 class="text-primary font-semibold group-hover:text-white">
                        Pengaduan - Gangguan
                    </h1>
                </div>
            </a>
            <a href="http://127.0.0.1:8000/pdfAlurLayanan/4">
                <div class="p-3 flex alur-card items-center gap-7  rounded-lg ring-2 ring-primary/30 group hover:bg-primary shadow-xl bg-white transition-all ease-in-out duration-300">
                    <img src="{{ asset('img/upscalemedia-transformed (15).png') }}" alt="LSP" class="w-15 h-15">
                    <h1 class="text-primary font-semibold group-hover:text-white">
                        Pengaduan - Keluhan
                    </h1>
                </div>
            </a>
            <a href="http://127.0.0.1:8000/pdfAlurLayanan/5">
                <div class="p-3 flex alur-card items-center gap-7   rounded-lg ring-2 ring-primary/30 group hover:bg-primary shadow-xl bg-white transition-all ease-in-out duration-300">
                    <img src="{{ asset('img/upscalemedia-transformed (16).png') }}" alt="LSP" class="w-15 h-15">
                    <h1 class="text-primary font-semibold group-hover:text-white">
                        Pemutusan Sementara dan Bongkar Rampung
                    </h1>
                </div>
            </a>
        </div>
    </div>
@endsection
