@extends('layout.master')
@section('content')
    <div class="w-full">
        <div class="w-full mt-20 text-center flex justify-center items-center">
            <div>
                <h1 class="text-primary font-bold text-2xl uppercase">Tentang Pln</h1>
                <hr class="border-2 border-yellow-400 w-full mx-auto rounded-lg">
            </div>
            <img src="{{ asset('svg/1661781006-removebg-preview (1).svg') }}" alt="logo_pln" class="w-15 h-15">
        </div>

        <div class="w-full px-5 mt-2">
            <div class="overflow-hidden rounded-sm">
                <img src="{{ asset('img/upscalemedia-transformed.jpeg') }}" alt="up3_Mamuju" class="w-full">
            </div>
            <div>
                <ul class="mt-3 grid gap-4">
                    <li class="grid gap-1">
                        <h1 class="font-semibold text-xl text-primary">
                            UP3 MAMUJU
                        </h1>
                        <p class="text-black/90">Unit Pelaksan Layanan Pelanggan</p>
                        <hr class="w-full">
                    </li>
                    <li class="grid gap-1">
                        <div class="flex items-center">
                            <div class="bg-primary rounded-full h-fit w-fit py-2 px-3">
                                <i class='bx bx-map text-white'></i>
                            </div>
                            <h1 class="text-black/90 text-lg font-semibold">Alamat</h1>
                        </div>
                        <h1>Binanga, Mamuju, Mamuju Regency, West Sulawesi 91511, Indonesia</h1>
                        <hr class="w-full">
                    </li>
                    <li class="grid gap-1">
                        <h1 class="font-semibold text-xl text-primary">
                            UP3 MAMUJU
                        </h1>
                        <p class="text-black/90">Unit Pelaksan Layanan Pelanggan</p>
                        <hr class="w-full">
                    </li>
                    <li class="grid gap-1">
                        <h1 class="font-semibold text-xl text-primary">
                            UP3 MAMUJU
                        </h1>
                        <p class="text-black/90">Unit Pelaksan Layanan Pelanggan</p>
                        <hr class="w-full">
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
