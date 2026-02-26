@extends('layout.master')
@section('tittle')
<title>Rating</title>
@endsection
@section('content')
    {{-- @dd(session('token_petugas')) --}}
    <div
        class="relative mt-20 w-11/12 rounded-lg sm:w-[60%] md:w-[65%] bg-white shadow-xl p-3 md:px-6 mx-auto lg:w-[40%] xl:w-[35%]">
        <div class="grid justify-center w-fit mx-auto">
            <img src="{{ asset('svg/1661781006-removebg-preview (1).svg') }}" alt="logo pln" class="h-20 md:h-24 mx-auto">
            <div class="text-center">
                <h1 class="text-primary text-xl md:text-2xl self-center uppercase font-semibold">Berikan Rating Anda</h1>
                <span class="text-black/50 text-base">Kami Ingin Mendengar Pendapat Anda</span>
            </div>
        </div>
        <form action="{{ route('submit.rating') }}" id="formRating" method="POST" class="mt-7">
            @csrf
            <input type="hidden" name="kode_kunjungan" value="{{ $token }}">
            <div class="h-fit grid gap-2 mx-auto">
                <h1
                    class="self-start text-primary text-base font-medium md:text-lg before after:content-['*'] after:text-red-400">
                    Pilih Kepuasan Anda:</h1>
                <div class="grid gap-2 lg:flex lg:gap-0">
                    <div class="flex gap-11 lg:gap-2 mx-auto w-full ">
                        <label
                            class="bg-primary px-3.5 rounded-lg w-[47%] has-[:checked]:ring-primary has-[:checked]:ring-2 has-[:checked]:bg-primary/50 transition-all ease-in-out duration-150">
                            <img src="{{ asset('svg/SangatBaik.svg') }}" alt="Emoticon pln"
                                class="w-24 md:w-28 mx-auto hover:scale-110  transition-all ease-in-out duration-300 ">
                            <h1 class="text-center font-semibold text-lg text-white lg:text-sm">Sangat Baik</h1>
                            <input type="radio" name="rating" class="hidden" value="sangat_baik"">
                        </label>
                        <label
                            class="bg-primary px-3.5 rounded-lg w-[47%] has-[:checked]:ring-primary has-[:checked]:ring-2 has-[:checked]:bg-primary/50 transition-all ease-in-out duration-150">
                            <img src="{{ asset('svg/Baik.svg') }}" alt="Emoticon pln"
                                class="w-24 md:w-28 mx-auto hover:scale-110  transition-all ease-in-out duration-300 ">
                            <h1 class="text-center font-semibold text-lg text-white lg:text-sm">Baik</h1>
                            <input type="radio" name="rating" class="hidden" value="sangat_baik">
                        </label>
                    </div>
                    <div class="flex gap-11 mx-auto lg:gap-2 w-full">
                        <label
                            class="bg-primary px-3.5 rounded-lg w-[47%] has-[:checked]:ring-primary has-[:checked]:ring-2 has-[:checked]:bg-primary/50 transition-all ease-in-out duration-150">
                            <img src="{{ asset('svg/KurangBaik.svg') }}" alt="Emoticon pln"
                                class="w-24 md:w-28 mx-auto hover:scale-110  transition-all ease-in-out duration-300 ">
                            <h1 class="text-center font-semibold text-lg text-white lg:text-sm">Kurang Baik</h1>
                            <input type="radio" name="rating" class="hidden" value="sangat_baik">
                        </label>
                        <label
                            class="bg-primary px-3.5 rounded-lg w-[47%] has-[:checked]:ring-primary has-[:checked]:ring-2 has-[:checked]:bg-primary/50 transition-all ease-in-out duration-150">
                            <img src="{{ asset('svg/SangatBuruk.svg') }}" alt="Emoticon pln"
                                class="w-24 md:w-28 mx-auto hover:scale-110  h-fit transition-all ease-in-out duration-300 ">
                            <h1 class="text-center font-semibold text-lg text-white lg:text-sm">Sangat Buruk</h1>
                            <input type="radio" name="rating" class="hidden" value="sangat_baik">
                        </label>
                    </div>
                    @error('rating')
                        <h1 class="text-center text-red-600 font-semibold">Anda harus memilih rating!</h1>
                    @enderror
                </div>
            </div>

            <div class="grid mt-3 gap-1.5">
                <h1 class="self-start text-primary text-base font-medium after:content-['*'] after:text-red-600">Pilih
                    Kategori:</h1>

                <label for="satpam"
                    class="flex md:text-lg justify-between w-full ring-1 ring-primary shadow-lg py-4 rounded-lg px-3 items-center
                            has-[:checked]:bg-primary/30 text-primary has-[:checked]:text-white has-[:checked]:font-semibold transition-all duration-300 ease-in-out">

                    <div>
                        <i class='bx bx-shield-quarter'></i> Satpam
                    </div>

                    <input type="checkbox" name="kategori[]" id="satpam"
                        class="appearance-none w-5 h-5 border-gray-400 rounded-full bg-gray
      checked:border-4 checked:bg-primary focus:ring-primary/30 text-primary"
                        value="satpam">
                </label>

                <label for="pegawai"
                    class="flex md:text-lg justify-between w-full ring-1 ring-primary shadow-lg py-4 rounded-lg px-3 items-center
    has-[:checked]:bg-primary/30 text-primary has-[:checked]:text-white has-[:checked]:font-semibold transition-all duration-300 ease-in-out">

                    <div>
                        <i class='bx bx-group'></i>Pegawai
                    </div>

                    <input type="checkbox" id="pegawai" name="kategori[]"
                        class="appearance-none w-5 h-5 border-gray-400 rounded-full bg-gray
      checked:border-4 checked:bg-primary focus:ring-primary/30 text-primary checked:border-primary"
                        value="pegawai">
                </label>

                <label for="fasilitas"
                    class="flex md:text-lg justify-between w-full ring-1 ring-primary shadow-lg py-4 rounded-lg px-3 items-center
    has-[:checked]:bg-primary/30 text-primary has-[:checked]:text-white has-[:checked]:font-semibold transition-all duration-300 ease-in-out">

                    <div>
                        <i class='bx bx-building-house'></i>
                        Fasilitas
                    </div>

                    <input type="checkbox" id="fasilitas" name="kategori[]"
                        class="appearance-none w-5 h-5 border-gray-400 rounded-full bg-gray
      checked:border-4 checked:bg-primary focus:ring-primary/30 text-primary"
                        value="fasilitas">
                </label>
                @error('kategori')
                    <h1 class="text-center text-red-600 font-semibold">Anda harus memilih kategori 1 atau lebih</h1>
                @enderror
            </div>

            <div class="mt-3">
                <label for="message" class="block mb-2.5 text-base font-semibold text-primary">Komentar:</label>
                <textarea id="message" rows="6" name="komentar"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-primary/30 focus:border-primary/30 block w-full p-3.5 shadow-xs placeholder:text-body"
                    placeholder="Write your thoughts here..."></textarea>
            </div>

            <div class="w-full mt-3 text-center">
                <button type="submit"
                    class="border w-[90%] bg-primary rounded-full py-3 px-5 text-white font-semibold">Kirim</button>
            </div>
        </form>
    </div>

    <div id="loadingOverlay"
        class="fixed hidden flex inset-0 z-50 items-center justify-center bg-black/40 backdrop-blur-sm">

        <div class="bg-white rounded-2xl shadow-2xl px-8 py-6 flex flex-col items-center gap-4">

            <div class="w-12 h-12 rounded-full border-4 border-gray-200 border-t-primary animate-spin"></div>

            <div class="text-center">
                <h1 class="text-base font-semibold text-gray-800">Memproses...</h1>
            </div>
        </div>
    </div>

    <script>
        const formRating = document.getElementById('formRating');
        const loadingOverlay = document.getElementById('loadingOverlay');
        formRating.addEventListener('submit', () => {
            loadingOverlay.classList.remove('hidden')
        })

        @if (session()->has('berhasil'))
            Swal.fire({
                title: "Berhasil",
                text: '{{ session('berhasil') }}',
                icon: 'success',
                confirmButtonText: "OK"
            });
        @endif

        @if (session()->has('gagal'))
            Swal.fire({
                title: "Gagal",
                text: '{{ session('gagal') }}',
                icon: 'error',
                confirmButtonText: "OK"
            });
        @endif

    </script>
@endsection
