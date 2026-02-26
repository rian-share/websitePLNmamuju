{{-- @dd(session('token_petugas')) --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DashBoard Admin</title>
    @vite(['resources/css/app.css'])
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>

    <div class="flex h-fit items-center p-2 bg-gradient-to-r b from-primary via-primary/50 to-white">
        <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar"
            aria-controls="default-sidebar" type="button"
            class="text-heading self-center bg-transparent box-border  hover:bg-neutral-secondary-medium focus:ring-4 group focus:ring-neutral-tertiary font-medium leading-5 rounded-base ms-3  text-sm p-2 focus:outline-none inline-flex sm:hidden">
            <span class="sr-only text-white">Open sidebar</span>
            <svg class="w-6 h-6 text-white group-hover:text-primary " aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10" />
            </svg>
        </button>
    </div>

    @include('admin.sidebar')

    <div class="p-2 sm:ml-64">
        <div class="border-1 border-default border-dashed rounded-base grid gap-3 ">
            <div class="grid gap-2 bg-primary/30 p-2">
                <h1 class="text-white h-fit font-bold text-center text-xl p-3 bg-yellow-300">Daftar Rating</h1>
                <div class="flex gap-2">
                    <label class="relative w-full lg:w-fit shrink-1">
                        <input id="datepicker-actions" type="date"
                            class="block w-full lg:w-fit focus:ring-1 focus:ring-white ps-9 pe-3 py-2.5 bg-primary border-none  text-white text-sm rounded-base px-3 shadow-xs placeholder:text-white"
                            placeholder="Filter Data">
                    </label>

                    <a href="{{ url('/download/pdf/alldata') }}" id="laporanRating" onclick="loadPDF()"
                        class="w-full bg-primary gap-2 lg:p-2 lg:w-fit text-white text-base shrink-1 shadow-2xl  flex justify-center items-center rounded-base px-2">
                        <i class='bx bx-download text-lg'></i>
                        <p class="text-sm">Download CSV</p>
                    </a>

                </div>
                <div class="relative  overflow-auto max-h-96" id="table-rating">
                    <table class="text-sm mx-auto text-left rtl:text-right text-body">
                        <thead class="text-sm text-white bg-primary/60">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center  font-medium">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-center font-medium">
                                    Kode Kunjungan
                                </th>
                                <th scope="col" class="px-6 py-3 text-center  font-medium">
                                    Pembuat Kunjungan
                                </th>
                                <th scope="col" class="px-6 py-3 text-center  font-medium">
                                    Tujuan Kunjungan
                                </th>
                                <th scope="col" class="px-6 py-3 text-center  font-medium">
                                    Status Kunjungan
                                </th>
                                <th scope="col" class="px-6 py-3 text-center  font-medium">
                                    Rating
                                </th>
                                <th scope="col" class="px-6 py-3 text-center  font-medium">
                                    Kategori
                                </th>
                                <th scope="col" class="px-6 py-3 text-center  font-medium">
                                    Komentar
                                </th>
                                <th scope="col" class="px-6 py-3 text-center  font-medium">
                                    Tanggal
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tBody-rating">
                            @foreach ($rating as $r)
                                <tr class="bg-neutral-primary">
                                    <th scope="row" class="px-6 py-4 max-w-[200px] truncate font-medium text-heading whitespace-nowrap">
                                        {{ $r->id }}
                                    </th>
                                    <td class="px-6 py-4 max-w-[200px] truncate">
                                        {{ $r->kunjungan->kode_kunjungan }}
                                    </td>
                                    <td class="px-6 py-4 max-w-[200px] truncate">
                                        {{ $r->kunjungan->petugas->nama }}
                                    </td>
                                    <td class="px-6 py-4 max-w-[200px] truncate">
                                        {{ $r->kunjungan->tujuan_kunjungan }}
                                    </td>
                                    <td class="px-6 py-4 max-w-[200px] truncate">
                                        {{ $r->kunjungan->status }}
                                    </td>
                                    <td class="px-6 py-4 max-w-[200px] truncate">
                                        {{ $r->rating }}
                                    </td>
                                    <td class="px-6 py-4 max-w-[200px] truncate">
                                        {{ $r->kategori }}
                                    </td>
                                    <td class="px-6 py-4 max-w-[200px] truncate">
                                        {{ $r->komentar }}
                                    </td>
                                    <td class="px-6 py-4 max-w-[200px] truncate">
                                        {{ $r->created_at }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div id="alertRating"></div>
                </div>
            </div>
            @include('admin.manajemenPekerja')
        </div>
    </div>

    <div id="loadingOverlay"
        class="fixed hidden flex inset-0 z-[100] items-center justify-center bg-black/40 backdrop-blur-sm">

        <div class="bg-white rounded-2xl shadow-2xl px-8 py-6 flex flex-col items-center gap-4">

            <!-- Spinner -->
            <div class="w-12 h-12 rounded-full border-4 border-gray-200 border-t-primary animate-spin"></div>

            <div class="text-center">
                <h1 class="text-base font-semibold text-gray-800">Memproses...</h1>
            </div>
        </div>
    </div>
    <hr class="border-4 border-yellow-400">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script>
        @if (session()->has('success'))
            Swal.fire({
                title: "Berhasil",
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: "OK"
            });
        @endif

        @if (session()->has('error'))
            Swal.fire({
                title: "Gagal",
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: "OK"
            });
        @endif
    </script>
</body>

</html>
