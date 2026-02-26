
const datePicker = document.getElementById('datepicker-actions')
const bodyRating = document.getElementById('tBody-rating')
const alertRating = document.getElementById('alertRating')
const loading = document.getElementById('loadingOverlay')
const btnToken = document.getElementById('btnToken')
const wadahToken = document.getElementById('wadahToken')
const valueHidden = document.getElementById('valueToken');
const formPetugas = document.getElementById('formKunjungan')
const notToken = document.getElementById('errorToken')
const btnPetugas = document.getElementById('btnKunjungan')
const btnHapus = document.getElementById('btnHapus')
const logOut = document.getElementById('logOut')
const csUpdate = document.getElementById('updateCS')
let laporanRating = document.getElementById('laporanRating')
let csNomor = document.getElementById('nomorCS')
let csLama = document.getElementById('csLama')
function loadPDF() {
    loading.classList.remove('hidden')
}
datePicker.addEventListener('change', async () => {
    loading.classList.toggle('hidden')
    laporanRating.href = ''
    try {
        await $.ajax({
            url: "/filter/rating",
            method: "GET",
            data: {
                tanggal: datePicker.value,
            },
            success: async function (res) {
                console.log(datePicker.value)

                if (res.status) {
                    alertRating.innerHTML = ''
                    bodyRating.innerHTML = ''
                    res.data.forEach(item => {
                        let isi = ` <tr class="bg-neutral-primary">
                                <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                    ${item.id}
                                </th>
                                <td class="px-6 py-4">
                                    ${item.kode_kunjungan}
                                </td>
                                <td class="px-6 py-4">
                                    ${item.pembuat_kunjungan} 
                                </td>
                                <td class="px-6 py-4">
                                    ${item.tujuan_kunjungan} 
                                </td>
                                <td class="px-6 py-4">
                                    ${item.status} 
                                </td>
                                <td class="px-6 py-4">
                                    ${item.rating} 
                                </td>
                                <td class="px-6 py-4">
                                    ${item.kategori} 
                                </td>
                                <td class="px-6 py-4">
                                    ${item.komentar} 
                                </td>
                                <td class="px-6 py-4">
                                    ${item.created_at}
                                </td>
                            </tr>`

                        bodyRating.innerHTML += isi
                    });
                    laporanRating.href = `http://127.0.0.1:8000/download/pdf/${res.data[0].created_at}`
                } else {
                    bodyRating.innerHTML = ''
                    alertRating.innerHTML = ''
                    alertRating.innerHTML += `<div class="p-4 mt-2 mb-4 text-sm text-white rounded-base bg-primary/40" role="alert">
  <span class="font-medium">${res.message}.
</div>`
                }
            },

            complete: function () {
                // btnToken.innerHTML = 'Generate'
            }
        });
    } catch (err) {
        let message = err.responseJSON.message;
        loading.classList.toggle('hidden')
        bodyRating.innerHTML = ''
        alertRating.innerHTML = ''
        alertRating.innerHTML += `<div class="p-4 mt-2 mb-4 text-sm text-white rounded-base bg-primary/40" role="alert">
  <span class="font-medium">${message}.
</div>`
    } finally {
        loading.classList.toggle('hidden')
    }
})

function openModal() {
    document.getElementById('loginModal').classList.remove('hidden');
    document.getElementById('loginModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('loginModal').classList.add('hidden');
    document.getElementById('loginModal').classList.remove('flex');
}

window.onclick = function (event) {
    const modal = document.querySelectorAll('#loginModal');
    if (event.target === modal) {
        closeModal();
    }
}


btnToken.addEventListener('click', async () => {
    btnToken.innerHTML =
        '<div class="h-7 w-7 rounded-full border-2 border-black/30 border-t-white animate-spin"></div>'
    try {
        let token = await $.ajax({
            url: "/create/token/petugas",
            method: "GET",
            xhrFields: {
                withCredentials: true
            }
        })
        valueHidden.value = token.token
        wadahToken.innerHTML = "<span class='text - black font - semibold '>" + token.token + "</span>"
        await Swal.fire({
            title: "Berhasil!",
            text: 'Anda berhasil membuat token',
            icon: 'success',
            confirmButtonText: "OK"
        })
    } catch (err) {
        let message = err.responseJSON?.message ?? 'Ada Masalaj Pada Server';
        await Swal.fire({
            title: "Gagal!",
            text: message,
            icon: 'error',
            confirmButtonText: "OK"
        })
    } finally {
        btnToken.innerHTML = 'Generate'
        cekToken()
    }
})

function cekToken() {
    btnPetugas.disabled = valueHidden.value === ''
    console.log(btnPetugas.disable)
    console.log(valueHidden.value)
    if (valueHidden.value === '') {
        console.log('berhasil')
        btnPetugas.classList.remove('bg-primary')
        btnPetugas.classList.add('bg-primary/30')
    } else {
        btnPetugas.classList.add('bg-primary')
        btnPetugas.classList.remove('bg-primary/30')
    }
}

cekToken()

formPetugas.addEventListener('submit', () => {
    loading.classList.remove('hidden')
})

document.addEventListener('click', async (a) => {
    let btn = a.target.closest("#btnHapus");
    console.log(btn)
    console.log(a)
    if (btn) {
        loading.classList.remove('hidden')
        try {
            let res = await $.ajax({
                url: "/delete/petugas",
                method: "DELETE",
                xhrFields: {
                    withCredentials: true
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // kalau POST
                },
                data: {
                    id: btn.dataset.id
                }
            })
            await Swal.fire({
                title: "Berhasil!",
                text: res.message,
                icon: 'success',
                confirmButtonText: "OK",
                didClode: () => {
                    loading.classList.remove('hidden')
                }
            })
        } catch (err) {
            let message = err.responseJSON?.message ?? 'Terjadi Masalah Pada Server';
            await Swal.fire({
                title: "Gagal!",
                text: message,
                icon: 'error',
                confirmButtonText: "OK"
            })
        } finally {
            loading.classList.add('hidden')
        }
    }
})

logOut.addEventListener('click', async () => {
    await Swal.fire({
        title: "Yakin?",
        text: "Anda akan logout",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, LogOut",
        cancelButtonText: "Tidak",
    }).then(async (result) => {
        if (result.isConfirmed) {
            loading.classList.remove('hidden')
            try {
                let res = await $.ajax({
                    url: "/logout/admin",
                    method: "GET",
                    xhrFields: {
                        withCredentials: true
                    },
                })
                Swal.fire({
                    title: "Berhasil!",
                    text: res.message,
                    icon: 'success',
                    confirmButtonText: "OK",
                }).then(() => {
                    loading.classList.remove('hidden')
                    window.location.href = 'http://127.0.0.1:8000/rating'
                })
            } catch (err) {
                let message = err.responseJSON?.message ?? 'Terjadi Masalah Pada Server';
                await Swal.fire({
                    title: "Gagal!",
                    text: message,
                    icon: 'error',
                    confirmButtonText: "OK"
                })
            } finally {
                loading.classList.add('hidden')
            }
        }

    });

})

function toggleModal(show = true) {
    const modal = document.getElementById('updatePhoneModal');
    const content = modal.querySelector('div'); // modal content

    if (show) {
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100');

        content.classList.remove('translate-y-10', 'scale-95');
        content.classList.add('translate-y-0', 'scale-100');
    } else {
        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0', 'pointer-events-none');

        content.classList.remove('translate-y-0', 'scale-100');
        content.classList.add('translate-y-10', 'scale-95');
    }
}

csUpdate.addEventListener('submit', async (e) => {
    e.preventDefault();
    console.log(csLama.value)
    loading.classList.remove('hidden')
    let nomor = csNomor.value.trim()
    nomor.replace(/[^0-9]/g, "")
    console.log(nomor)
    if (nomor == csLama.value.trim()) {
        await Swal.fire({
            title: "Gagal",
            text: `Nomor ini : ${csNomor.value} Adalah Nomor Lama, Ulangi Lagi!!`,
            icon: 'error',
            confirmButtonText: "OK",
        }).then((a) => {
            if (a.isConfirmed) {
                loading.classList.add('hidden')
            }
        })

        return
    }
    if (nomor.startsWith("0")) {
        nomor = "62" + nomor.slice(1);
    }
    try {
        let res = await $.ajax({
            url: "/update/wa/cs",
            method: "POST",
            xhrFields: {
                withCredentials: true
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // kalau POST
            },
            data: {
                _method: 'PUT',
                nomor: nomor
            }
        })
        Swal.fire({
            title: "Berhasil!",
            text: res.message,
            icon: 'success',
            confirmButtonText: "OK",
        }).then((a) => {
            if (a.isConfirmed) {
                toggleModal(false)
            }
        })
    } catch (err) {
        let message = err.responseJSON?.message ?? 'Terjadi Masalah Pada Server';
        await Swal.fire({
            title: "Gagal!",
            text: message,
            icon: 'error',
            confirmButtonText: "OK"
        })
    } finally {
        loading.classList.add('hidden')
    }

})

const modal = document.getElementById('updateModal');
const box = document.getElementById('modalBox');
const updateFormPetugas = document.getElementById('updateFormPetugas');
const roleUpdate = document.querySelectorAll('#roleUpdate');
const nameUpdate = document.getElementById('nameUpdate')
const statusUpdate = document.querySelectorAll('#statusUpdate')
const idUpdate = document.getElementById('idUpdate')
function openModalUpdate(id, name, role, status) {

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    setTimeout(() => {
        modal.classList.remove('opacity-0');
        box.classList.remove('opacity-0', 'scale-95');
        box.classList.add('opacity-100', 'scale-100');
    }, 10);

    idUpdate.value = id
    nameUpdate.value = name
    roleUpdate.forEach((n) => {
        if (n.value === role) {
            n.checked = true
        }
    })
    statusUpdate.forEach((n) => {
        if (n.value === status.toString()) n.checked = true
    })
}

function closeModalUpdate() {
    const modal = document.getElementById('updateModal');
    const box = document.getElementById('modalBox');

    modal.classList.add('opacity-0');
    box.classList.add('opacity-0', 'scale-95');
    box.classList.remove('opacity-100', 'scale-100');

    setTimeout(() => {
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }, 300);
}

modal.addEventListener('click', function (e) {
    if (!modalBox.contains(e.target)) {
        closeModalUpdate();
    }
});

updateFormPetugas.addEventListener('submit', async (a) => {
    loading.classList.remove('hidden')
    a.preventDefault()
    const selectedRole = document.querySelector('input[name="roleUpdate"]:checked');
    const selectedStatus = document.querySelector('input[name="statusUpdate"]:checked');
    try {
        let res = await $.ajax({
            url: "/update/petugas/pln",
            method: "POST",
            xhrFields: {
                withCredentials: true
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // kalau POST
            },
            data: {
                _method: 'PUT',
                id: idUpdate.value,
                nama: nameUpdate.value,
                role: selectedRole.value,
                status: selectedStatus.value
            }
        })
        Swal.fire({
            title: "Berhasil!",
            text: res.message,
            icon: 'success',
            confirmButtonText: "OK",
        }).then((a) => {
            if (a.isConfirmed) {
                closeModalUpdate()
            }
        })
    } catch (err) {
        let message = err.responseJSON?.message ?? 'Terjadi Masalah Pada Server';
        await Swal.fire({
            title: "Gagal!",
            text: message,
            icon: 'error',
            confirmButtonText: "OK"
        })
    } finally {
        loading.classList.add('hidden')
    }
})