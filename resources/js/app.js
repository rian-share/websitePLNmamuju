import './bootstrap';
import QrScanner from "qr-scanner";
import QRCode from 'qrcode';
import {
  createTimeline,
  splitText,
  stagger
} from 'animejs';
let b = $('meta[name="csrf-token"]').attr('content')
$.ajaxSetup({
  headers: {
    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
  }
})

const videoElem = document.getElementById("qr-video") ?? '';
let reloadScanning = document.getElementById("reloadScanning");
let loadingScan = document.getElementById("LoadingScan");
var isScanning = false;
let kunjungan = document.getElementById('Kunjungan');
let token_petugas = document.getElementById('token_petugas')
let petugas_id = document.getElementById('petugas_id')
const formSubmit = document.getElementById('formKunjungan');
const valueHidden = document.getElementById('valueToken');
const tujuanKunjungan = document.getElementById('tujuanKunjungan')
const linkRating = document.getElementById('linkRating')
let targetURL = "http://127.0.0.1:8000/rating";
const qrcode = document.getElementById('qrcode');
const codeQR = document.getElementById('codeQR')
const logOut = document.getElementById('logOutPetugas')
let retryCount = 0;
const maxRetry = 3;
const retryDelay = 1000;
let scanner;
linkRating.addEventListener('click', () => loadingScan.classList.remove('hidden'))
if (videoElem != '') {
  scanner = new QrScanner(
    videoElem,
    async (result) => {
      loadingScan.classList.remove('hidden');
      scanner.stop();
      try {
        await $.ajax({
          url: "/cekrole",
          method: "POST",
          // dataType: "json",
          data: {
            token: result.data.toString(),
          },
          success: async function (res) {
            if (token_petugas.value === '') {
              token_petugas.value = res.token_petugas
            }
            if (petugas_id.value === '') {
              petugas_id.value = res.petugas_id
            }
            await Swal.fire({
              title: "Berhasil!",
              text: 'Anda berhasil masuk sebagai ' + res.role,
              icon: 'success',
              confirmButtonText: "OK"
            }).then((result) => {
              if (result.isConfirmed) {
                if (res.role == 'admin') {
                  loadingScan.classList.remove('hidden')
                  window.location.href = 'http://127.0.0.1:8000/dashboard/admin'
                } else {
                  kunjungan.classList.remove('hidden');
                }
              }
            })
          },
          complete: function () {
            loadingScan.classList.add('hidden');
          }
        });
      } catch (xhr) {
        let message = 'Terjadi kesalahan';
        if (xhr.responseJSON?.message) {
          message = xhr.responseJSON.message;
        }
        await Swal.fire({
          title: "Gagal!",
          text: message,
          icon: 'error',
          confirmButtonText: "OK"
        });
        reloadScanning.classList.remove('hidden');
      }
      isScanning = false
    },
    {
      preferredCamera: "environment", // kamera belakang
      highlightScanRegion: false,
      highlightCodeOutline: true,
    }
  );
}

document.getElementById("reloadScanning").addEventListener('click', async () => {
  if (isScanning) return
  scanner.start();
  isScanning = true
  reloadScanning.classList.add('hidden');
})

if (videoElem != '') {
  scanner.start();
}


// submitKunjungan
formSubmit.addEventListener('submit', async (a) => {
  a.preventDefault()
  loadingScan.classList.remove('hidden')
  await $.ajax({
    url: "/buatkunjungan",
    method: "POST",
    xhrFields: {
      withCredentials: true
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // kalau POST
    },
    // dataType: "json",
    data: {
      petugas_id: petugas_id.value,
      kode_kunjungan: valueHidden.value,
      tujuan_kunjungan: tujuanKunjungan.value
    },
    success: async function (res) {
      await Swal.fire({
        title: "Berhasil!",
        text: 'Anda Berhasil Mmebuat Kunjungan',
        icon: 'success',
        confirmButtonText: "OK",
        didClose: () => {
          targetURL += `/customer?token=${res.kode_kunjungan}`
          linkRating.href = targetURL
          codeQR.classList.remove('hidden')
          kunjungan.classList.add('hidden')
          codeQRHalaman();
        }
      })
    },
    error: async function (xhr) {
      let err = JSON.parse(xhr.responseText)
      await Swal.fire({
        title: "Gagal!",
        text: err.message,
        icon: 'error',
        confirmButtonText: "OK"
      })
    },
    complete: function () {
      loadingScan.classList.add('hidden');
    }
  })
});

function codeQRHalaman() {
  QRCode.toCanvas(qrcode, targetURL, {
    width: 270,
    color: {
      dark: "#000000",
      light: "#ffffff"
    }
  }, function (err) {
    if (err) {
      retryCount++;

      if (retryCount < maxRetry) {
        setTimeout(codeQRHalaman, retryDelay);
      } else {
        const ctx = qrcode.getContext('2d');
        ctx.clearRect(0, 0, qrcode.width, qrcode.height);
        ctx.fillStyle = "red";
        ctx.font = "16px Arial";
        ctx.textAlign = "center";
        ctx.textBaseline = "middle";
        ctx.fillText("QR gagal dibuat!", qrcode.width / 2, qrcode.height / 2);
      }
    }
    else console.log("QR Code berhasil dibuat!");
  });
}

logOut.addEventListener('click', async () => {
  await Swal.fire({
    title: "Yakin?",
    text: "Anda akan logout",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Ya, logOut",
    cancelButtonText: "Tidak",
  }).then(async (a) => {
    if (a.isConfirmed) {
      try {
        loadingScan.classList.remove('hidden')
        let res = await $.ajax({
          url: "/logout/petugas",
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
          loadingScan.classList.remove('hidden')
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
        loadingScan.classList.add('hidden')
      }
    }
  })
})





