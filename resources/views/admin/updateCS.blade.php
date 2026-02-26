 <button onclick="toggleModal(true)" class="w-full shrink mt-5">
        <div class="grid w-11/12 mx-auto">
            <div class="flex p-2 rounded-xl bg-primary items-center justify-center gap-3">
                <img class="w-12" src="{{ asset('svg/icons8-whatsapp-logo-94.png') }}" alt="wa_icons">
                <h1 class="uppercase text-white text-base font-semibold">update nomor cs</h1>
            </div>
        </div>
    </button>

    <div id="updatePhoneModal"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300 z-50">

        <div
            class="bg-white rounded-2xl shadow-2xl w-11/12 mx-auto pb-6 pr-6 pl-6 transform translate-y-10 scale-95 transition-all duration-300">
            <div class="w-full p-3 bg-primary relative mb-3 rounded-sm">
                <button onclick="toggleModal(false)"
                    class="absolute  right-3 text-white hover:text-gray-800 text-lg">
                    ✕
                </button>
                <h2 class="text-2xl font-bold text-white text-center">Update Wa CS</h2>
            </div>
            <form id="updateCS">
                <input type="hidden" value="{{ $cs->nomor ?? '' }}" id="csLama">
                <label for="nomor" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                <input type="number" name="nomor" id="nomorCS"
                    class="w-full border border-gray-300 rounded-lg p-3 mb-5 focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-200"
                    value="{{ $cs->nomor ?? '' }}" placeholder="081234567890" required>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="toggleModal(false)"
                        class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-red-500 transition duration-200">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-primary text-white hover:bg-primary/70 transition duration-200">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>