<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Petugas;
use App\Models\Petugas_QR;
use App\Models\Whatsapp_cs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use function Symfony\Component\Clock\now;

class PlnMamuju extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ratings')->delete();
        DB::table('kunjungan')->delete();
        DB::table('petugas_qr')->delete();
        DB::table('petugas')->delete();
        DB::statement("ALTER TABLE ratings AUTO_INCREMENT = 1");
        DB::statement("ALTER TABLE kunjungan AUTO_INCREMENT = 1");
        DB::statement("ALTER TABLE petugas_qr AUTO_INCREMENT = 1");
        DB::statement("ALTER TABLE petugas AUTO_INCREMENT = 1");
        $petugasData = [
            ['nama' => 'Ibu Indah', 'role' => 'admin',  'is_active' => true],
            ['nama' => 'Ibu Alfa',  'role' => 'pegawai', 'is_active' => true],
            ['nama' => 'Kak James',   'role' => 'pegawai', 'is_active' => true],
            ['nama' => 'Rina Maulida',  'role' => 'satpam',   'is_active' => true],
            ['nama' => 'Fajar Ramadhan', 'role' => 'satpam',  'is_active' => false],
        ];

        foreach ($petugasData as $p) {
            DB::table('petugas')->insert([
                'nama' => $p['nama'],
                'role' => $p['role'],
                'is_active' => $p['is_active'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Whatsapp_cs::create([
            'id' => 1,
            'nomor' => '685216183643',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $petugas = DB::table('petugas')->get();
        foreach ($petugas as $p) {
            DB::table('petugas_qr')->insert([
                'petugas_id' => $p->id,
                'qr_token' => $p->nama == 'Ibu Indah' ? 'PLNc2f9fbd9-d6d5-430d-b9a0-c461b11cec0a' : 'PLN' . Str::uuid()->toString(),
                'is_active' => $p->is_active,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        $kunjunganIds = [];

        foreach ($petugas as $p) {

            // buat 2 kunjungan per petugas
            for ($i = 1; $i <= 2; $i++) {

                $kode = 'KJ-' . strtoupper(Str::random(8));

                // expired random: ada yang expired, ada yang masih aktif
                $expiredAt = Carbon::now()->addHours(rand(-5, 24));

                $status = collect(['aktif', 'selesai', 'kadaluarsa'])->random();

                $kunjunganId = DB::table('kunjungan')->insertGetId([
                    'kode_kunjungan' => $kode,
                    'petugas_id' => $p->id,
                    'tujuan_kunjungan' => collect([
                        'Ruang Manager',
                        'Ruang Pelayanan',
                        'Ruang Admin',
                        'Gudang',
                        'Ruang Satpam',
                        'Ruang Teknik',
                    ])->random(),
                    'status' => $status,
                    'expired_at' => $expiredAt,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $kunjunganIds[] = $kunjunganId;
            }
        }

        /**
         * ============================
         * 4) INSERT RATINGS (1:1)
         * ============================
         */
        foreach ($kunjunganIds as $kid) {
            DB::table('ratings')->insert([
                'kunjungan_id' => $kid,
                'rating' => (string) rand(1, 5),
                'kategori' => collect([
                    'satpam',
                    'pegawai',
                    'fasilitas',
                    'pelayanan_umum'
                ])->random(),
                'komentar' => collect([
                    'Pelayanan sangat baik.',
                    'Petugas ramah dan membantu.',
                    'Fasilitas cukup nyaman.',
                    'Perlu peningkatan kebersihan.',
                    'Sistem antrian cepat.',
                    null
                ])->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
