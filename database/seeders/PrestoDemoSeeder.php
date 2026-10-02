<?php

namespace Database\Seeders;

use App\Models\Prestasi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PrestoDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('password');

        // 1. Akun Admin HIMATRIS
        $admin = User::firstOrCreate(
            ['email' => 'himatris@presto.com'],
            [
                'name' => 'Admin HIMATRIS',
                'nim' => 'admin',
                'role' => 'admin',
                'prodi' => 'Sistem Informasi',
                'password' => $password,
            ]
        );

        // 2. Akun Mahasiswa
        $studentsData = [
            [
                'name' => 'Nadya Adella Putri',
                'nim' => '240102054',
                'email' => 'nadya@presto.com',
                'role' => 'mahasiswa',
                'prodi' => 'Sistem Informasi',
                'password' => $password,
            ],
            [
                'name' => 'Ahmad Rizky Pratama',
                'nim' => '230101012',
                'email' => 'ahmad@presto.com',
                'role' => 'mahasiswa',
                'prodi' => 'Teknik Informatika',
                'password' => $password,
            ],
            [
                'name' => 'Siti Nurhaliza',
                'nim' => '240102019',
                'email' => 'siti@presto.com',
                'role' => 'mahasiswa',
                'prodi' => 'Sistem Informasi',
                'password' => $password,
            ],
            [
                'name' => 'Budi Santoso',
                'nim' => '230102088',
                'email' => 'budi@presto.com',
                'role' => 'mahasiswa',
                'prodi' => 'Teknik Komputer',
                'password' => $password,
            ],
            [
                'name' => 'Fajar Ramadhan',
                'nim' => '240102041',
                'email' => 'fajar@presto.com',
                'role' => 'mahasiswa',
                'prodi' => 'Sistem Informasi',
                'password' => $password,
            ],
            [
                'name' => 'Dimas Aditya Saputra',
                'nim' => '230102044',
                'email' => 'dimas@presto.com',
                'role' => 'mahasiswa',
                'prodi' => 'Teknik Informatika',
                'password' => $password,
            ],
            [
                'name' => 'Kezia Aurelia',
                'nim' => '240102081',
                'email' => 'kezia@presto.com',
                'role' => 'mahasiswa',
                'prodi' => 'Sistem Informasi',
                'password' => $password,
            ],
            [
                'name' => 'Farhan Maulana',
                'nim' => '230103015',
                'email' => 'farhan@presto.com',
                'role' => 'mahasiswa',
                'prodi' => 'Teknik Komputer',
                'password' => $password,
            ],
        ];

        $users = [];
        $users['admin'] = $admin;

        foreach ($studentsData as $st) {
            $user = User::firstOrCreate(
                ['nim' => $st['nim']],
                $st
            );
            $users[$st['nim']] = $user;
        }

        // 3. Data Prestasi Demo
        $achievements = [
            [
                'user_key' => '240102054',
                'judul' => 'Juara 1 UI/UX Design Competition National Techfest 2024',
                'kategori' => 'Teknologi & Desain',
                'tingkat' => 'Nasional',
                'peringkat' => 'Juara 1',
                'penyelenggara' => 'Institut Teknologi Bandung & HIMATIF',
                'tanggal' => '2024-05-18',
                'tahun' => '2024',
                'poin' => 200,
                'status' => 'Terverifikasi',
                'catatan' => 'Sertifikat dan Surat Tugas telah divalidasi oleh Tim Verifikasi HIMATRIS.',
                'berkas' => 'sertifikat-techfest-2024.pdf',
            ],
            [
                'user_key' => '240102054',
                'judul' => 'Juara 2 International Web Development Hackathon 2024',
                'kategori' => 'Teknologi & Desain',
                'tingkat' => 'Internasional',
                'peringkat' => 'Juara 2',
                'penyelenggara' => 'Global Tech Innovators Singapore',
                'tanggal' => '2024-07-12',
                'tahun' => '2024',
                'poin' => 250,
                'status' => 'Terverifikasi',
                'catatan' => 'Validasi internasional terkonfirmasi via portal resmi penyelenggara.',
                'berkas' => 'international-hackathon-cert.pdf',
            ],
            [
                'user_key' => '240102054',
                'judul' => 'Finalis Capture The Flag Cybersecurity National 2024',
                'kategori' => 'Teknologi & Desain',
                'tingkat' => 'Nasional',
                'peringkat' => 'Finalis',
                'penyelenggara' => 'Badan Siber dan Sandi Negara (BSSN)',
                'tanggal' => '2024-09-28',
                'tahun' => '2024',
                'poin' => 50,
                'status' => 'Menunggu Verifikasi',
                'catatan' => 'Menunggu validasi dokumen sertifikat dari BSSN.',
                'berkas' => 'bssn-ctf-finalist.pdf',
            ],
            [
                'user_key' => '230101012',
                'judul' => 'Juara 1 Gemastik Divisi Pemrograman 2024',
                'kategori' => 'Akademik & Sains',
                'tingkat' => 'Nasional',
                'peringkat' => 'Juara 1',
                'penyelenggara' => 'Puspresnas Kemendikbudristek',
                'tanggal' => '2024-08-20',
                'tahun' => '2024',
                'poin' => 200,
                'status' => 'Terverifikasi',
                'catatan' => 'Sertifikat juara dan medali emas resmi.',
                'berkas' => 'gemastik-juara-1.pdf',
            ],
            [
                'user_key' => '230101012',
                'judul' => 'Juara 2 National Data Science Challenge 2024',
                'kategori' => 'Akademik & Sains',
                'tingkat' => 'Nasional',
                'peringkat' => 'Juara 2',
                'penyelenggara' => 'Universitas Indonesia',
                'tanggal' => '2024-09-05',
                'tahun' => '2024',
                'poin' => 180,
                'status' => 'Terverifikasi',
                'catatan' => 'Dokumen terverifikasi lengkap.',
                'berkas' => 'ui-datascience-cert.pdf',
            ],
            [
                'user_key' => '240102019',
                'judul' => 'Juara 2 Competitive Programming Contest ASC 2024',
                'kategori' => 'Akademik & Sains',
                'tingkat' => 'Nasional',
                'peringkat' => 'Juara 2',
                'penyelenggara' => 'Asian Science Council',
                'tanggal' => '2024-06-14',
                'tahun' => '2024',
                'poin' => 180,
                'status' => 'Terverifikasi',
                'catatan' => 'Terverifikasi oleh departemen.',
                'berkas' => 'sertifikat-asc-2024.pdf',
            ],
            [
                'user_key' => '240102019',
                'judul' => 'Juara 3 Business Plan Competition Regional Java 2024',
                'kategori' => 'Wirausaha & Bisnis',
                'tingkat' => 'Regional',
                'peringkat' => 'Juara 3',
                'penyelenggara' => 'Kadin Jawa Timur',
                'tanggal' => '2024-10-02',
                'tahun' => '2024',
                'poin' => 140,
                'status' => 'Terverifikasi',
                'catatan' => 'Dokumen lengkap dan absensi valid.',
                'berkas' => 'sertifikat-business-plan.pdf',
            ],
            [
                'user_key' => '230102088',
                'judul' => 'Juara 1 Lomba Karya Tulis Ilmiah Nasional 2024',
                'kategori' => 'Karya Ilmiah',
                'tingkat' => 'Nasional',
                'peringkat' => 'Juara 1',
                'penyelenggara' => 'Universitas Gadjah Mada',
                'tanggal' => '2024-09-10',
                'tahun' => '2024',
                'poin' => 200,
                'status' => 'Terverifikasi',
                'catatan' => 'Sertifikat dan naskah terverifikasi.',
                'berkas' => 'lkti-ugm-2024.pdf',
            ],
            [
                'user_key' => '240102041',
                'judul' => 'Juara Harapan 1 Mobile App Innovation Summit 2024',
                'kategori' => 'Teknologi & Desain',
                'tingkat' => 'Nasional',
                'peringkat' => 'Juara Harapan 1',
                'penyelenggara' => 'Google Developer Student Clubs Indonesia',
                'tanggal' => '2024-09-22',
                'tahun' => '2024',
                'poin' => 90,
                'status' => 'Terverifikasi',
                'catatan' => 'Aplikasi lolos tahap final nasional.',
                'berkas' => 'gdsc-cert-2024.pdf',
            ],
            [
                'user_key' => '230102044',
                'judul' => 'Juara 1 Web Design Festival 2024',
                'kategori' => 'Teknologi & Desain',
                'tingkat' => 'Nasional',
                'peringkat' => 'Juara 1',
                'penyelenggara' => 'Universitas Airlangga',
                'tanggal' => '2024-04-15',
                'tahun' => '2024',
                'poin' => 140,
                'status' => 'Terverifikasi',
                'catatan' => 'Portofolio dan sertifikat juara telah divalidasi.',
                'berkas' => 'web-design-fest.pdf',
            ],
            [
                'user_key' => '230102044',
                'judul' => 'Finalis Hackathon Coding Nasional 2024',
                'kategori' => 'Teknologi & Desain',
                'tingkat' => 'Nasional',
                'peringkat' => 'Finalis',
                'penyelenggara' => 'Kementerian Kominfo',
                'tanggal' => '2024-08-11',
                'tahun' => '2024',
                'poin' => 50,
                'status' => 'Terverifikasi',
                'catatan' => 'Lolos 10 besar finalis hackathon.',
                'berkas' => 'hackathon-kominfo.pdf',
            ],
            [
                'user_key' => '240102081',
                'judul' => 'Juara 2 National Pitching Battle 2024',
                'kategori' => 'Wirausaha & Bisnis',
                'tingkat' => 'Nasional',
                'peringkat' => 'Juara 2',
                'penyelenggara' => 'Startup Campus Indonesia',
                'tanggal' => '2024-07-25',
                'tahun' => '2024',
                'poin' => 170,
                'status' => 'Terverifikasi',
                'catatan' => 'Validasi presentasi dan sertifikat juara.',
                'berkas' => 'pitching-battle-2024.pdf',
            ],
            [
                'user_key' => '230103015',
                'judul' => 'Juara 1 IoT Prototype Expo 2024',
                'kategori' => 'Teknologi & Desain',
                'tingkat' => 'Regional',
                'peringkat' => 'Juara 1',
                'penyelenggara' => 'Politeknik Negeri Bandung',
                'tanggal' => '2024-06-30',
                'tahun' => '2024',
                'poin' => 150,
                'status' => 'Terverifikasi',
                'catatan' => 'Alat dan dokumen fungsional teruji.',
                'berkas' => 'iot-expo-2024.pdf',
            ],
        ];

        foreach ($achievements as $item) {
            $userKey = $item['user_key'];
            $targetUser = $users[$userKey] ?? null;

            Prestasi::updateOrCreate(
                [
                    'judul' => $item['judul'],
                    'nim' => $targetUser ? $targetUser->nim : $userKey,
                ],
                [
                    'user_id' => $targetUser ? $targetUser->id : null,
                    'mahasiswa' => $targetUser ? $targetUser->name : 'Mahasiswa',
                    'prodi' => $targetUser ? ($targetUser->prodi ?? 'Sistem Informasi') : 'Sistem Informasi',
                    'kategori' => $item['kategori'],
                    'tingkat' => $item['tingkat'],
                    'peringkat' => $item['peringkat'],
                    'penyelenggara' => $item['penyelenggara'],
                    'tanggal' => $item['tanggal'],
                    'tahun' => $item['tahun'],
                    'poin' => $item['poin'],
                    'status' => $item['status'],
                    'catatan' => $item['catatan'],
                    'berkas' => $item['berkas'],
                    'verified_at' => $item['status'] === 'Terverifikasi' ? now() : null,
                    'verified_by' => $item['status'] === 'Terverifikasi' ? $admin->id : null,
                ]
            );
        }
    }
}
