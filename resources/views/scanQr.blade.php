@extends('layout.master')
@section('tittle')
<title>buat kunjungan</title>
@endsection
@section('content')
    {{-- @dd(session('token_petugas')) --}}
    @vite(['resources/js/app.js'])
    @cannot('is_petugas')
        <div id="modal-alert"
            class="overflow-y-auto transition-all duration-500 ease-in-out bg-black/80 z-[100] overflow-x-hidden fixed top-0 right-0 left-0  flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] h-full">
            <div class="relative p-4 w-full max-w-md max-h-full ">
                <div class="relative transition-all duration-500 ease-in-out  bg-neutral-primary-soft rounded-base shadow-sm p-4 md:p-6"
                    id="modal-delete">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18 17.94 6M18 18 6.06 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-fg-disabled w-12 h-12" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-6 text-body">Apakah anda adalah seorang Customer atau security?</h3>
                        <div class="flex items-center space-x-4 justify-center">
                            <button type="button" id="isCustomer"
                                class="text-white bg-primary box-border border border-transparent hover:bg-primary/70 focus:ring-4 focus:ring-danger-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                                Saya customer
                            </button>
                            <button type="button" id="isSecurity"
                                class="text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Saya
                                Security</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcannot


    @cannot('is_petugas')
        <div class="object-cover min-h-screen bg-black relative">
            <video id="qr-video" class="w-full h-screen object-cover lg:object-contain"></video>
            <div class="absolute w-full lg:mt-2 sm:w-[65%] lg:w-[35%] top-16 right-1/2 translate-x-1/2 p-4">
                <div class="bg-black/50 text-white rounded-xl p-3 text-center">
                    <h2 class="text-lg font-semibold">Scan QR Security</h2>
                    <p class="text-sm opacity-80">Arahkan kamera ke QR Code</p>
                </div>
            </div>

            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                <div class="w-64 h-64 border-4 border-white/80 rounded-2xl"></div>
            </div>
        </div>
    @endcannot

    <div class="absolute hidden w-16 h-16 rounded-lg bg-primary right-1/2 translate-x-1/2 top-1/2 -translate-y-1/2"
        id="reloadScanning">
        <img src="{{ asset('svg/Reload_mark_bg_RGB_black_x8-removebg-preview.svg') }}" alt="reload">
        {{-- <h1 class="text-white font-light">Ulangi Lagi?</h1> --}}
    </div>

    <div class="absolute hidden rounded-lg p-3 bg-primary right-1/2 translate-x-1/2 top-1/2 -translate-y-1/2"
        id="codeQR">
        <div class="w-fit shadow-xl overflow-hidden rounded-lg ">
            <canvas id="qrcode"></canvas>
        </div>

        <div class="w-fit p-2 rounded-lg bg-primary ring-2 shadow-[0_5px_5px_rgba(0,0,0,.5)] ring-white mt-2.5 mx-auto">
            <a id="linkRating" class="text-white font-light">Klik disini untuk langsung mengisi</a>
        </div>
    </div>


    <div class="absolute hidden flex justify-center bg-black/50 items-center w-full h-full z-[100] rounded-lg  right-1/2 translate-x-1/2 top-1/2 -translate-y-1/2 backdrop-blur-lg"
        id="LoadingScan">
        <div class=" rounded-full w-14 h-14 border-8 animate-spin border-b-primary border-t-primary border-gray-300"></div>
    </div>

    <div class="absolute hidden shadow-xl justify-center w-10/12 sm:w-1/2 lg:w-[35%] lg:mt-15 xl:mt-0  h-fit items-center px-5 pb-5 pt-2 rounded-lg  right-1/2 translate-x-1/2 top-1/2 -translate-y-1/2 backdrop-blur-lg  bg-white"
        id="Kunjungan">
        <div id="logOutPetugas" class="flex items-center bg-primary w-fit p-1.5 rounded-lg">
            <i class='bx bx-log-out text-3xl text-white'></i><span class="text-white">LogOut</span>
        </div>
        <div class=" mx-auto w-fit">
            <img src="{{ asset('svg/1661781006-removebg-preview (1).svg') }}" alt="logoPLN"
                class="w-20 h-20 mx-auto rounded-lg shadow-lg">
            <h1 class="text-2xl bottom-0 font-semibold text-primary text-center mb-3">Buat Kunjungan</h1>
            <input type="hidden" value="{{ session()->has('token_petugas') ? session('token_petugas') : '' }}"
                id="token_petugas">
        </div>
        <form id="formKunjungan" class="grid gap-2 w-full">
            <div class="flex gap-5">
                <input type="hidden" name="petugas_id" id="petugas_id"
                    value="{{ session()->has('petugas_id') ? session('petugas_id') : '' }}">
                <input type="hidden" required id="valueToken" name="kode_kunjungan">
                <div class="w-full h-10 ring-2 ring-primary/50 rounded-sm flex items-center pl-2"><span
                        class="text-black/50" id="wadahToken">Belum ada token</span></div>
                <div class="bg-primary grow-0 transition-all ease-in-out duration-150 p-2 rounded-sm text-white font-semibold"
                    id="btnToken">Generate</div>
            </div>
            <div class="w-full">
                <label for="message" class="block mb-1.5 text-sm font-medium text-heading">Tujuan Kunjungan</label>
                <textarea id="tujuanKunjungan" rows="6" required name="tujuan_kunjungan"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base  focus:ring-primary focus:border-primary block w-full p-3.5 shadow-xs placeholder:text-body"
                    placeholder="Tujuan Kunjungan....."></textarea>
            </div>
            <div class="w-full px-1.5">
                <button type="submit" class="w-full bg-primary rounded-lg p-3 text-white font-semibold" disabled
                    id="btnKunjungan">Buat</button>
            </div>
        </form>

        @can('is_petugas')
            <div id="alert-5"
                class="flex items-center w-full mt-5 md:sm-1/2  p-4 text-sm text-white rounded-base bg-primary"
                role="alert">
                <svg class="w-4 h-4 shrink-0 mt-0.5 md:mt-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-2 text-sm ">
                    Identitasa anda sudah di kenali silahkan buat kunjungan
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 rounded focus:ring-2 focus:ring-neutral-tertiary p-1.5 hover:bg-neutral-tertiary-medium inline-flex items-center justify-center h-8 w-8 shrink-0 shrink-0"
                    data-dismiss-target="#alert-5" aria-label="Close">
                    <span class="sr-only">Dismiss</span>
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                </button>
            </div>
        @endcan
    </div>

    <script>
        //Generate Token dan berbagai aturan submit Buat kunjungan
        const valueHidden = document.getElementById('valueToken');
        const btnToken = document.getElementById('btnToken');
        const wadahToken = document.getElementById('wadahToken')
        const tujuanKunjungan = document.getElementById('tujuanKunjungan')
        const loadingScan = document.getElementById('LoadingScan')
        const btnSubmit = document.getElementById('btnKunjungan')
        const token_petugas = document.getElementById('token_petugas')
        const kunjungan = document.getElementById('Kunjungan')

        @if (session('token_petugas'))
            let status = kunjungan.classList.contains('hidden')
            if (status) kunjungan.classList.remove('hidden')
        @endif

        function cekToken() {
            btnSubmit.disabled = valueHidden.value.trim() === "";
        }
        btnToken.addEventListener('click', async () => {
            btnToken.innerHTML =
                '<div class="h-7 w-7 rounded-full border-2 border-black/30 border-t-white animate-spin"></div>'
            data = '{{ session('token_petugasss') }}'
            // console.log("{{ session('petugas_idd') }}")
            // console.log({{ session('token_petugasss') }})
            try {
                await $.ajax({
                    url: "/buattoken",
                    method: "POST",
                    // dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    xhrFields: {
                        withCredentials: true
                    }, //
                    data: {
                        tokenPetugas: token_petugas.value,
                    },
                    success: async function(res) {
                        console.log(res.status)
                        valueHidden.value = res.token
                        wadahToken.innerHTML = "<span class='text - black font - semibold '>" + res
                            .token + "</span>"
                        await Swal.fire({
                            title: "Berhasil!",
                            text: 'Anda berhasil membuat token',
                            icon: 'success',
                            confirmButtonText: "OK"
                        })
                        cekToken()
                    },
                    complete: function() {
                        btnToken.innerHTML = 'Generate'
                    }
                });
            } catch (err) {
                let message = err.responseJSON.message;
                await Swal.fire({
                    title: "Gagal!",
                    text: message,
                    icon: 'error',
                    confirmButtonText: "OK"
                })
            }
        })
        cekToken()
    </script>
@endsection
