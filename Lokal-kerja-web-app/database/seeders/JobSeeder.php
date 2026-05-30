<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\JobPosting;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        // =============================================
        // 5 PERUSAHAAN (firstOrCreate agar aman dijalankan ulang)
        // =============================================
        $companies = [
            ['name' => 'PT. Tambang Emas Nusantara',   'email' => 'hr@tambangemas.id'],
            ['name' => 'CV. Teknologi Palu Jaya',       'email' => 'rekrut@teknopalu.com'],
            ['name' => 'PT. Distribusi Logistik Sulteng','email' => 'hrd@logistiksulteng.co.id'],
            ['name' => 'UD. Rasa Nusantara Kuliner',    'email' => 'info@rasanusantara.id'],
            ['name' => 'PT. Kreasi Digital Palu',       'email' => 'career@kreasipalu.com'],
        ];

        $companyUsers = [];
        foreach ($companies as $company) {
            $companyUsers[] = User::firstOrCreate(
                ['email' => $company['email']],
                [
                    'name'     => $company['name'],
                    'password' => Hash::make('password123'),
                    'role'     => 'company',
                ]
            );
        }

        // =============================================
        // 20 LOWONGAN (12 Normal + 8 Aneh/Unik)
        // =============================================
        $jobs = [

            // --- NORMAL (12) ---
            [
                'company'   => $companyUsers[0],
                'title'     => 'Operator Alat Berat',
                'location'  => 'Palu, Sulawesi Tengah',
                'salary'    => 'Rp 5.000.000 - Rp 7.000.000',
                'type'      => 'Full-time',
                'desc'      => 'Mengoperasikan ekskavator dan dozer untuk kebutuhan tambang. Bertanggung jawab atas keselamatan dan perawatan alat.',
                'req'       => "- Berpengalaman min. 2 tahun mengoperasikan alat berat\n- Memiliki SIO (Surat Izin Operator) aktif\n- Siap ditempatkan di lokasi tambang\n- Sehat jasmani dan rohani",
            ],
            [
                'company'   => $companyUsers[0],
                'title'     => 'Supervisor Keselamatan Kerja (HSE)',
                'location'  => 'Morowali, Sulawesi Tengah',
                'salary'    => 'Rp 8.000.000 - Rp 12.000.000',
                'type'      => 'Full-time',
                'desc'      => 'Memastikan seluruh operasional tambang berjalan sesuai standar K3. Melakukan inspeksi rutin dan pelatihan keselamatan.',
                'req'       => "- S1 Teknik Lingkungan / K3 / Pertambangan\n- Memiliki sertifikasi Ahli K3 Umum\n- Pengalaman min. 3 tahun di industri pertambangan",
            ],
            [
                'company'   => $companyUsers[1],
                'title'     => 'Web Developer (Full Stack)',
                'location'  => 'Palu, Sulawesi Tengah',
                'salary'    => 'Rp 6.000.000 - Rp 10.000.000',
                'type'      => 'Full-time',
                'desc'      => 'Mengembangkan aplikasi web internal perusahaan dari sisi front-end dan back-end.',
                'req'       => "- Menguasai Laravel / React.js atau Vue.js\n- Memahami konsep REST API\n- Pengalaman min. 1 tahun",
            ],
            [
                'company'   => $companyUsers[1],
                'title'     => 'IT Support Technician',
                'location'  => 'Palu, Sulawesi Tengah',
                'salary'    => 'Rp 3.500.000 - Rp 5.000.000',
                'type'      => 'Full-time',
                'desc'      => 'Memberikan dukungan teknis kepada pengguna internal, melakukan instalasi perangkat, dan pemeliharaan jaringan kantor.',
                'req'       => "- D3/S1 Teknik Informatika atau setara\n- Menguasai troubleshooting hardware dan software\n- Berpengalaman dengan jaringan LAN/WAN",
            ],
            [
                'company'   => $companyUsers[2],
                'title'     => 'Supir Truk Antar Kota',
                'location'  => 'Palu, Sulawesi Tengah',
                'salary'    => 'Rp 4.000.000 - Rp 5.500.000',
                'type'      => 'Full-time',
                'desc'      => 'Mengantarkan barang dari gudang pusat ke titik distribusi di berbagai kota di Sulawesi Tengah.',
                'req'       => "- Memiliki SIM B2 aktif\n- Berpengalaman min. 2 tahun mengemudi truk besar\n- Jujur, disiplin, dan bertanggung jawab",
            ],
            [
                'company'   => $companyUsers[2],
                'title'     => 'Staff Gudang & Inventaris',
                'location'  => 'Palu, Sulawesi Tengah',
                'salary'    => 'Rp 3.000.000 - Rp 4.000.000',
                'type'      => 'Full-time',
                'desc'      => 'Mengelola penerimaan, penyimpanan, dan pengeluaran barang di gudang. Melakukan pencatatan stok secara akurat.',
                'req'       => "- Min. SMA/SMK sederajat\n- Teliti dan terorganisir\n- Mampu menggunakan komputer dasar (Excel)",
            ],
            [
                'company'   => $companyUsers[3],
                'title'     => 'Juru Masak (Chef) Spesialis Masakan Indonesia',
                'location'  => 'Palu, Sulawesi Tengah',
                'salary'    => 'Rp 4.500.000 - Rp 6.000.000',
                'type'      => 'Full-time',
                'desc'      => 'Memasak dan menjaga kualitas sajian masakan khas Indonesia untuk restoran kami. Bertanggung jawab atas konsistensi rasa dan kebersihan dapur.',
                'req'       => "- Berpengalaman min. 2 tahun di bidang kuliner\n- Menguasai masakan khas Sulawesi\n- Sanggup bekerja di bawah tekanan",
            ],
            [
                'company'   => $companyUsers[3],
                'title'     => 'Kasir & Pelayan Restoran',
                'location'  => 'Palu, Sulawesi Tengah',
                'salary'    => 'Rp 2.500.000 - Rp 3.500.000',
                'type'      => 'Part-time',
                'desc'      => 'Melayani tamu restoran dengan ramah, mengelola transaksi pembayaran, dan menjaga kebersihan area makan.',
                'req'       => "- Min. SMA/SMK\n- Berpenampilan rapi dan sopan\n- Bersedia bekerja shift (termasuk akhir pekan)",
            ],
            [
                'company'   => $companyUsers[4],
                'title'     => 'Graphic Designer',
                'location'  => 'Palu, Sulawesi Tengah (Remote)',
                'salary'    => 'Rp 4.000.000 - Rp 6.000.000',
                'type'      => 'Full-time',
                'desc'      => 'Merancang materi visual untuk konten media sosial, iklan digital, dan branding klien perusahaan.',
                'req'       => "- Menguasai Adobe Photoshop, Illustrator, dan Figma\n- Memiliki portofolio yang kuat\n- Kreatif dan mengikuti tren desain terkini",
            ],
            [
                'company'   => $companyUsers[4],
                'title'     => 'Content Creator & Video Editor',
                'location'  => 'Palu, Sulawesi Tengah',
                'salary'    => 'Rp 3.500.000 - Rp 5.500.000',
                'type'      => 'Full-time',
                'desc'      => 'Membuat konten video kreatif untuk platform YouTube, TikTok, dan Instagram klien.',
                'req'       => "- Menguasai Adobe Premiere Pro / DaVinci Resolve\n- Memahami teknik pengambilan gambar yang baik\n- Portofolio video menjadi nilai utama",
            ],
            [
                'company'   => $companyUsers[1],
                'title'     => 'Data Analyst Intern',
                'location'  => 'Palu, Sulawesi Tengah',
                'salary'    => 'Rp 1.500.000 - Rp 2.500.000',
                'type'      => 'Internship',
                'desc'      => 'Membantu tim data dalam menganalisis dan memvisualisasikan data operasional perusahaan.',
                'req'       => "- Mahasiswa aktif S1 Statistik / Informatika / Matematika\n- Menguasai Python atau R dasar\n- Familiar dengan SQL",
            ],
            [
                'company'   => $companyUsers[2],
                'title'     => 'Marketing & Sales Executive',
                'location'  => 'Palu, Sulawesi Tengah',
                'salary'    => 'Rp 4.000.000 + Komisi',
                'type'      => 'Full-time',
                'desc'      => 'Mencari dan mengembangkan klien baru untuk layanan logistik perusahaan.',
                'req'       => "- D3/S1 semua jurusan\n- Kemampuan komunikasi dan negosiasi yang kuat\n- Memiliki kendaraan pribadi",
            ],

            // --- ANEH / UNIK (8) ---
            [
                'company'   => $companyUsers[3],
                'title'     => 'Penguji Rasa Es Krim Profesional',
                'location'  => 'Palu, Sulawesi Tengah',
                'salary'    => 'Rp 3.000.000 - Rp 4.000.000',
                'type'      => 'Full-time',
                'desc'      => 'Dibutuhkan seseorang dengan lidah yang sangat sensitif untuk menguji kualitas rasa, tekstur, dan tingkat kemanisan setiap varian es krim baru kami sebelum diluncurkan ke pasar. Ini bukan pekerjaan biasa — ini adalah panggilan jiwa.',
                'req'       => "- Tidak memiliki alergi susu atau gluten\n- Mampu membedakan minimal 50 jenis rasa es krim secara buta\n- Tidak sedang menjalani program diet\n- Bersedia makan es krim minimal 8 kali per hari",
            ],
            [
                'company'   => $companyUsers[0],
                'title'     => 'Penjinak Hewan Liar untuk Kebun Sawit',
                'location'  => 'Donggala, Sulawesi Tengah',
                'salary'    => 'Rp 8.000.000 - Rp 15.000.000',
                'type'      => 'Contract',
                'desc'      => 'Menangani dan merelokasi hewan liar yang memasuki kawasan perkebunan sawit, termasuk babi hutan, biawak, dan ular piton.',
                'req'       => "- Tidak takut dengan hewan apapun (wajib)\n- Pernah bergulat dengan hewan berukuran di atas 50kg\n- Memiliki refleks yang sangat baik",
            ],
            [
                'company'   => $companyUsers[4],
                'title'     => 'Ahli Scroll Media Sosial (Social Media Researcher)',
                'location'  => 'Remote / WFH',
                'salary'    => 'Rp 2.500.000 - Rp 4.000.000',
                'type'      => 'Part-time',
                'desc'      => 'Kami mencari individu yang telah menghabiskan ribuan jam hidupnya untuk scrolling media sosial dan kini siap mengmonetisasi skill tersebut.',
                'req'       => "- Screen time harian di atas 8 jam (wajib dilampirkan tangkapan layar)\n- Punya akun di minimal 7 platform media sosial\n- Tidak pernah ketinggalan satu tren pun sejak 2020",
            ],
            [
                'company'   => $companyUsers[1],
                'title'     => 'Pengetes Tombol Keyboard (QA Hardware)',
                'location'  => 'Palu, Sulawesi Tengah',
                'salary'    => 'Rp 2.800.000 - Rp 3.800.000',
                'type'      => 'Full-time',
                'desc'      => 'Menekan setiap tombol pada setiap keyboard yang kami produksi sebanyak 10.000 kali untuk memastikan durabilitas produk.',
                'req'       => "- Memiliki 10 jari yang lengkap dan berfungsi baik\n- Tidak bosan melakukan pekerjaan berulang\n- Dilarang berkuku panjang",
            ],
            [
                'company'   => $companyUsers[2],
                'title'     => 'Pemandu Wisata di Kapal Selam Mini',
                'location'  => 'Teluk Palu, Sulawesi Tengah',
                'salary'    => 'Rp 6.000.000 - Rp 9.000.000',
                'type'      => 'Full-time',
                'desc'      => 'Memandu wisatawan dalam tur menyelam menggunakan kapal selam mini 2-penumpang untuk melihat keindahan bawah laut Teluk Palu.',
                'req'       => "- Memiliki lisensi menyelam minimal Open Water Diver\n- Tidak klaustrofobia (akan diuji ketat)\n- Fasih berbahasa Inggris dan Mandarin",
            ],
            [
                'company'   => $companyUsers[3],
                'title'     => 'Pendamping Makan Siang Profesional',
                'location'  => 'Palu, Sulawesi Tengah',
                'salary'    => 'Rp 1.800.000 - Rp 2.500.000',
                'type'      => 'Part-time',
                'desc'      => 'Mendampingi pelanggan VIP restoran yang tidak ingin makan sendirian. Tugas utama adalah menjadi teman makan yang menyenangkan.',
                'req'       => "- Extrovert (wajib, bukan pura-pura)\n- Menguasai minimal 5 topik obrolan yang aman\n- Tidak pernah kehabisan bahan pembicaraan",
            ],
            [
                'company'   => $companyUsers[0],
                'title'     => 'Penjaga Aset Digital NFT Perusahaan',
                'location'  => 'Remote',
                'salary'    => 'Rp 5.000.000 - Rp 7.500.000',
                'type'      => 'Full-time',
                'desc'      => 'Bertanggung jawab atas keamanan koleksi NFT milik perusahaan. Posisi ini masih ada karena manajemen kami belum diberitahu bahwa NFT sudah tidak musim.',
                'req'       => "- Paham konsep blockchain dan dompet kripto\n- Sanggup menjelaskan nilai NFT kepada direksi dengan muka serius\n- Tidak tertawa saat mendengar kata 'metaverse'",
            ],
            [
                'company'   => $companyUsers[4],
                'title'     => 'Penguji Ketahanan Wi-Fi di Tempat Terpencil',
                'location'  => 'Berbagai Lokasi Terpencil di Sulawesi Tengah',
                'salary'    => 'Rp 4.500.000 + Tunjangan Kesepian',
                'type'      => 'Contract',
                'desc'      => 'Bepergian ke lokasi terpencil di Sulawesi Tengah untuk menguji cakupan sinyal internet. Pekerjaan ini 90% dilakukan di tempat tanpa sinyal.',
                'req'       => "- Betah sendirian di alam terbuka selama berhari-hari\n- Bisa membaca peta analog (karena GPS tidak akan berfungsi)\n- Membawa buku bacaan sendiri",
            ],
        ];

        // Hapus semua lowongan lama dari perusahaan yang di-seed agar tidak duplikat
        $companyIds = collect($companyUsers)->pluck('id')->toArray();
        JobPosting::whereIn('company_id', $companyIds)->delete();

        foreach ($jobs as $job) {
            JobPosting::create([
                'company_id'       => $job['company']->id,
                'title'            => $job['title'],
                'description'      => $job['desc'],
                'location'         => $job['location'],
                'salary'           => $job['salary'],
                'type'             => $job['type'],
                'status'           => 'Aktif',
                'deadline'         => now()->addDays(rand(14, 60)),
                'requirements'     => $job['req'] ?? null,
                'responsibilities' => null,
            ]);
        }

        $this->command->info('Seeder berhasil: 5 perusahaan & 20 lowongan kerja ditambahkan.');
    }
}
