<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\Petugas;
use App\Models\Petugas_QR;
use App\Models\Kunjungan;
use App\Models\Rating;
use Exception;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Carbon;
use function Illuminate\Support\minutes;
use function PHPSTORM_META\map;
use function PHPUnit\Framework\isEmpty;
use function Symfony\Component\Clock\now;
use Barryvdh\DomPDF\Facade\Pdf;
use Nette\Utils\Random;
use Throwable;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Symfony\Component\Mime\Message;
use App\Models\Whatsapp_cs;
// use Carbon\Carbon;
class plnMamuju extends Controller
{
    protected $cs;
    public function __construct()
    {
        $this->cs = Whatsapp_cs::find(1);
    }

    public function alertCustomer()
    {
        return redirect(uri('/'))->with('alertCustomer', 'Anda Harus Di Buatkan Daftar Kunjungan Oleh Petugas Terkait Agar Bisa Mengisi Rating');
    }

    public function downloadPDF($request)
    {
        // dd($request);
        if (strtoupper($request) === 'ALLDATA') {
            $data = Rating::all();
        } else {
            $data = Rating::whereDate('created_at', $request)->get();
        }
        // dd($data);
        $pdf = PDF::loadView('laporanRating', compact('data'));
        return $pdf->stream('laporan.pdf');
    }

    public function tentangPln()
    {
        return view('berita');
    }

    public function scanQR()
    {
        $cs = $this->cs;
        return view('scanQR', compact('cs'));
    }

    public function dashboardAdmin()
    {
        $rating = Rating::with('kunjungan.petugas')->get();
        $petugas = Petugas::with('petugasQR')->get();
        $jumlah_rating = $rating->count();
        $cs = Whatsapp_cs::find(1);
        return view('admin.dashboardAdmin', compact('rating', 'petugas', 'jumlah_rating', 'cs'));
    }

    public function addRating(Request $r)
    {
        // dd($r->token);
        if (!$r->has('token')) {
            return abort(404);
        }
        $cs = Whatsapp_cs::find(1);
        $token = $r->token;
        return view('rating', compact('token', 'cs'));
    }

    public function submitRating(Request $r)
    {
        $now = Carbon::now();
        $r->validate([
            'kode_kunjungan' => 'required',
            'rating' => 'required',
            'kategori' => 'required|array|min:1',
        ]);
        try {
            $kunjungan_id = Kunjungan::where('kode_kunjungan', $r->kode_kunjungan)->first();
            if (!$kunjungan_id) {
                throw new Exception('Token Kunjungan Tidak Valid');
            }
            if ($now->greaterThan($kunjungan_id->expired_at)) {
                $kunjungan_id->update([
                    'status' => 'kadaluarsa'
                ]);
                throw new Exception('Token Kunjungan Telah Kadaluarsa');
            }
            if ($kunjungan_id->status === 'selesai') {
                throw new Exception('Token Kunjungan Sudah Pernah Digunakan');
            }
            $kategori = '';
            $data = new Rating();
            $data->kunjungan_id = $kunjungan_id->id;
            $data->rating = $r->rating;
            foreach ($r->kategori as $a) {
                $kategori .= $a . ' ';
            }
            $data->kategori = $kategori;
            $data->komentar = $r->komentar ?? 'Tidak Ada Komentar';
            $status = $data->save();
            if ($status) {
                $kunjungan_id->update([
                    'status' => 'selesai'
                ]);
                return back()->with('berhasil', 'Anda Berhasil Menambahkan Rating');
            }
            return back()->with('gagal', 'Anda Gagal Menambahkan Data');
        } catch (Exception $e) {
            return back()->with('gagal', $e->getMessage());
        }
    }

    public function cekRole(Request $r)
    {
        try {
            $data = Petugas_QR::where('qr_token', $r->token)->first();
            if ($data) {
                if($data->is_active === 0) throw new Exception('Token Anda Sudah Tidak Aktif');
                session(['token_petugas' => $data->qr_token, 'petugas_id' => $data->petugas_id, 'role' => $data->petugas->role]);
                return response()->json([
                    'status' => 'success',
                    'role' => $data->petugas->role,
                    'nama' => $data->petugas->nama,
                    'token_petugas' => $data->qr_token,
                    'petugas_id' => $data->petugas_id
                ], 201);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'QR Code tidak dikenali'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function generateToken(Request $r)
    {
        $data = Petugas_QR::where('qr_token', $r->tokenPetugas)->first();
        if ($data) {
            $token = Str::random(10);
            return response()->json([
                'status' => 'Anda berhasil membuat token',
                'token' => $token
            ], 201);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'anda membuat token dari pihak tidak resmi'
        ], 404);
    }

    public function createKunjungan(Request $r)
    {
        try {
            $r->validate([
                'kode_kunjungan' => 'required|unique:kunjungan',
                'petugas_id' => 'required',
                'tujuan_kunjungan' => 'required'
            ]);
            $expired = Carbon::now()->addMinutes(1);
            $add = new Kunjungan();
            $add->kode_kunjungan = $r->kode_kunjungan;
            $add->petugas_id = $r->petugas_id;
            $add->tujuan_kunjungan = $r->tujuan_kunjungan;
            $add->expired_at = $expired;
            $status = $add->save();
            if ($status) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'anda berhasil membuat daftar kunjungan',
                    'kode_kunjungan' => $r->kode_kunjungan
                ], 201);
            }
            throw new \Exception('anda gagal mengirim data');
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'terjadi kesalahan server'
            ], 500);
        }
    }

    public function filterRating(Request $r)
    {
        try {
            if (!$r->has('tanggal')) {
                throw new ('Sepertinya Ada Kesalahan Server');
            }
            $data = Rating::whereDate('created_at', $r->tanggal)->get();
            if ($data->count() > 0) {
                $da = [];
                foreach ($data as $d) {
                    $da[] = [
                        'id' => $d->id,
                        'kode_kunjungan' => $d->kunjungan->kode_kunjungan,
                        'pembuat_kunjungan' => $d->kunjungan->petugas->nama,
                        'tujuan_kunjungan' => $d->kunjungan->tujuan_kunjungan,
                        'status' => $d->kunjungan->status,
                        'rating' => $d->rating,
                        'kategori' => $d->kategori,
                        'komentar' => $d->komentar,
                        'created_at' => Carbon::parse($d->created_at)->format('Y-m-d')
                    ];
                }
                return response()->json([
                    'status' => true,
                    'data' => $da
                ], 200);
            }
            return response()->json([
                'status' => false,
                'message' => 'belum ada data dengan tanggal tersebut'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function tokenPetugas()
    {
        try {
            $inisial = 'PLN';
            $token = $inisial . Str::uuid()->toString();
            return response()->json([
                'status' => true,
                'token' => $token
            ], 200);
        } catch (Exception $r) {
            return response()->json([
                'status' => false,
                'message' => 'Ada Masalah Pada Server :' . $r->getMessage()
            ]);
        }
    }

    public function addPetugas(Request $r)
    {
        try {
            $data = Petugas::create([
                'nama' => $r->nama,
                'role' => $r->role
            ]);
            Petugas_QR::create([
                'petugas_id' => $data->id,
                'qr_token' => $r->tokenPetugas
            ]);
            return back()->with('success', 'Anda Berhasil Membuat Akun');
        } catch (Throwable $e) {
            return back()->with('error', 'Terjadi Kesalahan Pada Server');
        }
    }

    public function cetakQR($id)
    {
        $data = Petugas::where('id', $id)->first();
        $qrCode = base64_encode(
            QrCode::format('svg')
                ->size(250)
                ->margin(1)
                ->generate($data->petugasQR->qr_token)
        );
        $qr = PDF::loadView('cetakQR', compact('data', 'qrCode'))->setPaper('A5', 'portrait');
        return $qr->stream('qrcode');
    }

    public function menghapusPetugas(Request $r)
    {
        try {
            $data = Petugas::findOrFail($r->id);
            $data->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Anda Berhasil Menghapus Data'
            ], 200);
        } catch (Exception $r) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi Kesalan Pada Server'
            ], 500);
        }
    }

    public function alurLayanan()
    {
        $cs = $this->cs;
        return view('layananAlur', compact('cs'));
    }

    public function layanan($id)
    {
        $pdf = Pdf::loadView('fotoLayanan', compact('id'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('poster.pdf');
    }

    public function logOut()
    {
        try {
            session()->forget(['token_petugas', 'role', 'petugas_id']);
            return response()->json([
                'status' => 'success',
                'message' => 'Anda Berhasil LogOut'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function logOutPetugas()
    {
        try {
            session()->forget(['token_petugas', 'role', 'petugas_id']);
            return response()->json([
                'status' => 'success',
                'message' => 'Anda Berhasil LogOut'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ada Masalah Pada Server!!'
            ]);
        }
    }

    public function updateCS(Request $r)
    {
        try {
            Whatsapp_cs::where('id', 1)->update([
                'nomor' => $r->nomor
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Anda Berhasil Melakukan Update NomorCS'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal Melakukan Update Karena: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updatePetugas(Request $r)
    {
        try {
            $data = Petugas::where('id', $r->id)->with('petugasQR')->first();
            if ($data === null) {
                throw new Exception('Tidak Ada Data Yang Sesuai');
            }
            $status = $data->update([
                'nama' => $r->nama,
                'role' => $r->role,
            ]);
            if (!$status) throw new Exception('Gagal Melakukan Update Data');
            $status = $data->petugasQR->update([
                'is_active' => (int) $r->status
            ]);
            if (!$status) throw new Exception('Gagal Melakukan Update Data');
            return response()->json([
                'status' => 'success',
                'message' => 'Anda Berhasil Melakukan Update Data'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'messafe' => $e->getMessage()
            ], 500);
        }
    }
}
