 <div class="grid gap-4 p-2 items-center justify-center mb-4 bg-yellow-300/50">
     <div>
         <h1 class="text-xl p-3 font-bold text-white text-center bg-primary ">Majemen Akun Pekerja</h1>
     </div>
     <div
         class="relative xl:w-full overflow-auto max-h-96 bg-neutral-primary-soft shadow-xs rounded-base border border-default">
         <table class="w-full  text-sm text-left rtl:text-right text-body">
             <thead class="text-sm text-white bg-primary/60 border-b border-default-medium">
                 <tr>
                     <th scope="col" class="px-6 py-3 font-medium text-center">
                         ID
                     </th>
                     <th scope="col" class="px-6 py-3 font-medium text-center">
                         Nama
                     </th>
                     <th scope="col" class="px-6 py-3 font-medium text-center">
                         Role Pekerja
                     </th>
                     <th scope="col" class="px-6 py-3 font-medium text-center">
                         Status Active
                     </th>
                     <th scope="col" class="px-6 py-3 font-medium text-center">
                         Waktu Di Buat
                     </th>
                     <th scope="col" class="px-6 py-3 font-medium text-center">
                         Qr_Token
                     </th>
                     <th scope="col" class="px-6 py-3 font-medium text-center">
                         Tindakan
                     </th>

                 </tr>
             </thead>
             <tbody>
                 @foreach ($petugas as $p)
                     <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                         <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                             {{ $p->id }}
                         </th>
                         <td class="px-6 py-4 truncate max-w-[200px]">
                             {{ $p->nama }}
                         </td>
                         <td class="px-6 py-4 truncate max-w-[200px]">
                             {{ $p->role }}
                         </td>
                         <td class="px-6 py-4 truncate max-w-[200px]">
                             {{ $p->petugasQR->is_active }}
                         </td>
                         <td class="px-6 py-4 truncate max-w-[200px]">
                             {{ $p->created_at }}
                         </td>
                         <td class="px-6 py-4 truncate max-w-full">
                             {{ $p->petugasQR->qr_token }}
                         </td>
                         <td class="px-6 py-4 truncate max-w-full flex gap-1">
                             <div class="rounded-sm shadow-xl p-1 bg-yellow-300 text-white">
                                 <a href="http://127.0.0.1:8000/cetakqr/{{ $p->id }}" onclick="loadPDF()">
                                     <span><i class='bx bx-printer'></i>
                                     </span>
                                     <span class="font-semibold">Cetak</span>
                                 </a>
                             </div>
                             <button type="button" class="rounded-sm shadow-xl p-1 bg-red-400 text-white"
                                 id="btnHapus" data-id="{{ $p->id }}">
                                 <i class='bx bx-trash'></i>
                                 </span>
                                 <span class="font-semibold">Hapus</span>
                             </button>
                             <button type="button" class="rounded-sm shadow-xl p-1 bg-primary text-white"
                                 onclick='openModalUpdate({{ $p->id }}, @json($p->nama), @json($p->role), {{ $p->petugasQR->is_active }})'>
                                 <i class='bx bx-refresh'></i>
                                 </span>
                                 <span class="font-semibold">Update</span>
                             </button>
                         </td>
                     </tr>
                 @endforeach
             </tbody>
         </table>
     </div>

     <div class="w-full flex items-center justify-center">
         <button type="button"
             class="flex ml-auto w-fit p-3 h-fit hover:scale-110 transition-all ease-in-out duration-300 rounded-lg bg-primary shrink"
             onclick="openModal()">
             <h1 class="text-white h-fit md:font-semibold md:text-xl">Tambah</h1>
             <i class='bx bx-plus text-white self-center'></i>
         </button>
         @include('admin.updateCS')
     </div>
 </div>

 <div id="loginModal" class="fixed hidden inset-0 bg-black/50  items-center justify-center z-50">
     <div class="bg-white w-11/12 max-w-md rounded-2xl shadow-2xl p-8 relative animate-fadeIn">
         <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 text-xl">
             &times;
         </button>
         <div class=" mx-auto w-fit">
             <img src="{{ asset('svg/1661781006-removebg-preview (1).svg') }}" alt="logoPLN"
                 class="w-20 h-20 mx-auto rounded-lg shadow-lg">
             <h1 class="text-2xl bottom-0 font-semibold mt-1.5 text-primary text-center mb-3">Buat Akun Layanan</h1>
         </div>
         <form id="formKunjungan" class="grid gap-2 w-full" method="POST" action="{{ route('create.petugas') }}">
             @csrf
             <div class="flex gap-5">
                 <input type="hidden" required id="valueToken" name="tokenPetugas">
                 <div class="w-full h-10 ring-2 ring-primary/50 rounded-sm flex items-center pl-2"><span
                         class="text-black/50" id="wadahToken">QR Token</span></div>
                 <div class="bg-primary grow-0 transition-all ease-in-out duration-150 p-2 rounded-sm text-white font-semibold"
                     id="btnToken">Generate</div>
             </div>

             <div class="w-full">
                 <label for="name" class="block  mb-1.5 text-sm font-medium text-primary">Nama</label>
                 <input type="text" required placeholder="Masukkan nama...." name="nama"
                     class="w-full p-3 focus:ring-3 focus:ring-primary rounded-sm border-none placeholder:text-black/50 ring-1 ring-primary/30">
             </div>

             <ul class="select-none grid gap-2">
                 <li>
                     <h1 class="text-base text-primary font-semibold">Pilih Role :</h1>
                 </li>
                 <li
                     class="w-full p-3 rounded-base bg-primary/40 transition-all ease-in-out duration-300 has-[:checked]:bg-primary/60  has-[:checked]:ring-2  has-[:checked]:ring-primary">
                     <label class="flex w-full text-white font-base gap-2">
                         <img src="{{ asset('svg/guard (1).svg') }}" alt="" class="w-6 h-6">
                         <h1>Satpam</h1>
                         <input type="radio" name="role" value="satpam" class="opacity-0" required>
                     </label>
                 </li>
                 <li
                     class="w-full p-3 rounded-base bg-primary/40 transition-all ease-in-out duration-300 has-[:checked]:bg-primary/60  has-[:checked]:ring-2  has-[:checked]:ring-primary">
                     <label class="flex w-full text-white font-base gap-2">
                         <img src="{{ asset('svg/employees.svg') }}" alt="" class="w-6 h-6">
                         <h1>Pegawai</h1>
                         <input type="radio" name="role" value="pegawai" class="opacity-0" required>
                     </label>
                 </li>
                 <li
                     class="w-full p-3 rounded-base bg-primary/40 transition-all ease-in-out duration-300 has-[:checked]:bg-primary/60  has-[:checked]:ring-2  has-[:checked]:ring-primary">
                     <label class="flex w-full text-white font-base gap-2">
                         <img src="{{ asset('svg/user__4_-removebg-preview.svg') }}" alt="" class="w-5 h-5">
                         <h1>Admin</h1>
                         <input type="radio" name="role" value="admin" class="opacity-0" required>
                     </label>
                 </li>
             </ul>
             <div class="w-full px-1.5">
                 <button type="submit" class="as w-full bg-primary rounded-lg p-3 text-white font-semibold"
                     id="btnKunjungan" disabled>Buat</button>
             </div>
         </form>
     </div>
 </div>
 
 <div id="updateModal"
     class="fixed inset-0 bg-black/50 hidden opacity-0 items-center justify-center z-[100]
             transition-opacity duration-300">

     <div id="modalBox"
         class="bg-white w-11/12 sm:w-10/12 md:w-[50%] lg:w-[35%] opacity-0 rounded-2xl shadow-xl p-6 relative
                transform  transition-all duration-300 scale-95p">

         <button onclick="closeModalUpdate()" class="absolute top-3 right-3 text-gray-500 hover:text-black">
             ✕
         </button>

         <div class="flex items-center justify-center py-2 px-5 mx-auto rounded-sm bg-primary w-fit text-white">
             <h2 class="text-xl font-semibold">Update Petugas</h2>
             <i class='bx bx-refresh self-center'></i>
         </div>
         <form id="updateFormPetugas">
            <input type="hidden" value="" id="idUpdate">
             <div class="mb-4">
                 <label class="block text-sm mb-1 text-primary">Nama</label>
                 <input type="text" name="name" id="nameUpdate"
                     class="w-full outline-none border-primary/70 rounded-sm px-3 py-2 focus:ring-2 focus:ring-primary">
             </div>

             <ul class="select-none grid gap-2">
                 <li>
                     <h1 class="text-base text-primary font-semibold">Pilih Role :</h1>
                 </li>
                 <li
                     class="w-full p-3 rounded-base bg-primary/40 transition-all ease-in-out duration-300 has-[:checked]:bg-primary/60  has-[:checked]:ring-2  has-[:checked]:ring-primary">
                     <label class="flex w-full text-white font-base gap-2">
                         <img src="{{ asset('svg/guard (1).svg') }}" alt="" class="w-6 h-6">
                         <h1>Satpam</h1>
                         <input type="radio" name="roleUpdate" value="satpam" class="opacity-0" required id="roleUpdate">
                     </label>
                 </li>
                 <li
                     class="w-full p-3 rounded-base bg-primary/40 transition-all ease-in-out duration-300 has-[:checked]:bg-primary/60  has-[:checked]:ring-2  has-[:checked]:ring-primary">
                     <label class="flex w-full text-white font-base gap-2">
                         <img src="{{ asset('svg/employees.svg') }}" alt="" class="w-6 h-6">
                         <h1>Pegawai</h1>
                         <input type="radio" name="roleUpdate" value="pegawai" class="opacity-0" required id="roleUpdate">
                     </label>
                 </li>
                 <li
                     class="w-full p-3 rounded-base bg-primary/40 transition-all ease-in-out duration-300 has-[:checked]:bg-primary/60  has-[:checked]:ring-2  has-[:checked]:ring-primary">
                     <label class="flex w-full text-white font-base gap-2">
                         <img src="{{ asset('svg/user__4_-removebg-preview.svg') }}" alt="" class="w-5 h-5">
                         <h1>Admin</h1>
                         <input type="radio" name="roleUpdate" value="admin" class="opacity-0" required id="roleUpdate">
                     </label>
                 </li>
             </ul>

             <div class="mt-3">
                 <h1 class="text-primary font-semibold text-base">Status</h1>
                 <div class="flex gap-2">
                     <label
                         class="flex bg-primary/40 relative rounded-base shrink has-[]: w-full p-3 justify-center items-center has-[:checked]:bg-primary/60 transition-all duration-300 ease-in-out has-[:checked]:ring-2  has-[:checked]:ring-primary
                     ">
                         <h1 class="text-white font">
                             active
                         </h1>
                         <input type="radio" name="statusUpdate" id="statusUpdate" class="hidden absolute" value="1">
                     </label>
                     <label
                         class="flex bg-primary/40 rounded-base shrink w-full relative p-3 justify-center items-center has-[:checked]:bg-primary/60 transition-all duration-300 ease-in-out has-[:checked]:ring-2  has-[:checked]:ring-primary">
                         <h1 class="text-white font">
                             non_active
                         </h1>
                         <input type="radio" name="statusUpdate" id="statusUpdate" class="hidden absolute" value="0">
                     </label>
                 </div>
             </div>

             <button type="submit" class="w-full bg-primary text-white mt-3 py-2 rounded-lg hover:bg-primary/80 ">
                 Update
             </button>
         </form>

     </div>
 </div>
