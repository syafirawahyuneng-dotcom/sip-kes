<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\HealthService;
use App\Models\Information;
use App\Models\PublicMessage;
use App\Models\SystemSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        $admin = User::updateOrCreate(
            ['email' => 'admin@sipkes.go.id'],
            [
                'name' => 'Administrator SIP-Kes Poltek Jember',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. System Settings
        $settings = [
            ['key' => 'site_name', 'value' => 'SIP-Kes Poltek Jember', 'label' => 'Nama Website', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Sistem Informasi Pelayanan Kesehatan Politeknik Negeri Jember', 'label' => 'Slogan Website', 'group' => 'general'],
            ['key' => 'agency_name', 'value' => 'Politeknik Negeri Jember — Jawa Timur', 'label' => 'Instansi Pembina', 'group' => 'general'],
            ['key' => 'emergency_hotline', 'value' => '119 / (0331) 333-119', 'label' => 'Call Center Darurat', 'group' => 'contact'],
            ['key' => 'office_phone', 'value' => '(0331) 333-120', 'label' => 'Telepon Kantor', 'group' => 'contact'],
            ['key' => 'office_whatsapp', 'value' => '0812-3456-7890', 'label' => 'WhatsApp Layanan', 'group' => 'contact'],
            ['key' => 'office_email', 'value' => 'sipkes@polije.ac.id', 'label' => 'Email Resmi', 'group' => 'contact'],
            ['key' => 'office_address', 'value' => 'Jl. Mastrip PO Box 164, Sumbersari, Jember, Jawa Timur 68101', 'label' => 'Alamat Kantor', 'group' => 'contact'],
            ['key' => 'office_hours', 'value' => 'Senin - Jumat: 08:00 - 16:00 WIB (Layanan IGD & PSC 119 Siaga 24 Jam)', 'label' => 'Jam Operasional', 'group' => 'contact'],
            ['key' => 'about_summary', 'value' => 'SIP-Kes adalah portal resmi informasi pelayanan kesehatan yang dikembangkan oleh Politeknik Negeri Jember (Poltek Jember), Jawa Timur. Sistem ini memudahkan masyarakat memperoleh edukasi kesehatan, informasi fasilitas kesehatan terdekat di wilayah Jember, serta menyampaikan aspirasi layanan secara transparan dan terintegrasi.', 'label' => 'Tentang SIP-Kes', 'group' => 'general'],
        ];

        foreach ($settings as $st) {
            SystemSetting::updateOrCreate(['key' => $st['key']], $st);
        }

        // 3. Categories
        $categoriesData = [
            [
                'name' => 'Layanan & Fasilitas Medis',
                'slug' => 'layanan-fasilitas-medis',
                'description' => 'Informasi jam operasional poli, alur pendaftaran, dan fasilitas pendukung rumah sakit serta puskesmas.',
                'icon' => 'fa-solid fa-hospital',
                'color' => 'teal',
            ],
            [
                'name' => 'Promosi & Edukasi Kesehatan',
                'slug' => 'promosi-edukasi-kesehatan',
                'description' => 'Panduan gaya hidup sehat, gizi seimbang, kebugaran, dan pencegahan faktor risiko penyakit.',
                'icon' => 'fa-solid fa-heart-pulse',
                'color' => 'emerald',
            ],
            [
                'name' => 'Pencegahan & Info Penyakit',
                'slug' => 'pencegahan-info-penyakit',
                'description' => 'Waspada penularan penyakit menular maupun tidak menular beserta langkah pencegahan medisnya.',
                'icon' => 'fa-solid fa-shield-virus',
                'color' => 'amber',
            ],
            [
                'name' => 'Berita & Agenda Kegiatan',
                'slug' => 'berita-agenda-kegiatan',
                'description' => 'Kabar terkini seputar kegiatan puskesmas keliling, posyandu balita & lansia, serta bakti sosial kesehatan.',
                'icon' => 'fa-solid fa-newspaper',
                'color' => 'blue',
            ],
            [
                'name' => 'Pengumuman Resmi',
                'slug' => 'pengumuman-resmi',
                'description' => 'Pengumuman resmi surat edaran kesehatan, program vaksinasi berkala, dan regulasi dinas.',
                'icon' => 'fa-solid fa-bullhorn',
                'color' => 'purple',
            ],
            [
                'name' => 'Siaga Darurat Medis 119',
                'slug' => 'siaga-darurat-medis-119',
                'description' => 'Prosedur penanganan darurat kecelakaan, henti jantung, ambulans jemput pasien, dan bencana.',
                'icon' => 'fa-solid fa-truck-medical',
                'color' => 'red',
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $cat) {
            $categories[$cat['slug']] = Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        // 4. Informations (Health Articles & Announcements)
        $informationsData = [
            [
                'category_id' => $categories['siaga-darurat-medis-119']->id,
                'user_id' => $admin->id,
                'title' => 'Layanan Ambulans Gawat Darurat PSC 119 Siap Siaga 24 Jam Penuh Tanpa Biaya',
                'slug' => 'layanan-ambulans-gawat-darurat-psc-119-siap-siaga-24-jam',
                'summary' => 'Masyarakat dapat menghubungi hotline 119 untuk penanganan kondisi kritis medis, kecelakaan di jalan, maupun rujukan gawat darurat dengan respons cepat paramedis terstandar.',
                'content' => "<p>Pusat Komando Tanggap Darurat Medis (Public Safety Center / PSC 119) SIP-Kes telah mengoptimalkan armada ambulans yang dilengkapi monitor tanda vital, tabung oksigen bertekanan tinggi, defibrilator (AED), serta tim perawat dan dokter siaga 24 jam nonstop.</p>
                <h3>Kapan Harus Menghubungi PSC 119?</h3>
                <p>Masyarakat dihimbau menghubungi 119 apabila mendapati situasi darurat berikut:</p>
                <ul>
                    <li>Pasien tidak sadarkan diri atau pingsan mendadak.</li>
                    <li>Nyeri dada hebat yang menjalar ke lengan kiri dan leher (gejala serangan jantung akut).</li>
                    <li>Kesulitan bernapas berat atau tersedak benda asing.</li>
                    <li>Korban kecelakaan lalu lintas dengan luka berat atau patah tulang terbuka.</li>
                    <li>Kejang berulang atau penurunan kesadaran pada bayi dan lansia.</li>
                </ul>
                <p>Layanan panggilan 119 bebas pulsa dari semua operator seluler maupun telepon rumah. Operator akan memandu tindakan pertolongan pertama (First Aid) sembari mengarahkan ambulans terdekat menuju lokasi kejadian.</p>",
                'image' => 'https://images.unsplash.com/photo-1587745416684-47953f16f02f?auto=format&fit=crop&w=1200&q=80',
                'status' => 'published',
                'views' => 428,
                'is_featured' => true,
                'published_at' => now()->subDays(1),
            ],
            [
                'category_id' => $categories['layanan-fasilitas-medis']->id,
                'user_id' => $admin->id,
                'title' => 'Jadwal Poliklinik Terpadu dan Alur Pelayanan Pasien BPJS Kesehatan',
                'slug' => 'jadwal-poliklinik-terpadu-dan-alur-pelayanan-pasien-bpjs',
                'summary' => 'Simak ketentuan rujukan berjenjang, jadwal dokter spesialis penyakit dalam, anak, gigi, dan kebidanan di puskesmas serta rumah sakit daerah.',
                'content' => "<p>Untuk memberikan pelayanan kesehatan yang tertib dan tanpa antrean panjang, SIP-Kes merilis panduan alur pendaftaran poliklinik terpadu bagi pemegang kartu JKN-KIS / BPJS Kesehatan maupun pasien umum.</p>
                <h3>Alur Pelayanan Berjenjang:</h3>
                <ol>
                    <li><strong>Fasilitas Kesehatan Tingkat Pertama (FKTP):</strong> Pasien terlebih dahulu mendatangi Puskesmas atau Klinik Pratama terdaftar pada kartu BPJS dengan membawa KTP dan kartu identitas kepesertaan.</li>
                    <li><strong>Pemeriksaan Dokter Umum / Dokter Gigi:</strong> Dokter di FKTP akan melakukan diagnosa awal. Apabila memerlukan tindakan lanjutan, dokter menerbitkan Surat Rujukan Online (V-Claim).</li>
                    <li><strong>Pelayanan di Fasilitas Kesehatan Tingkat Lanjut (FKRTL / RSUD):</strong> Pasien menuju poliklinik spesialis sesuai jadwal dokter yang tertera pada rujukan.</li>
                </ol>
                <p>Jam pendaftaran loket dibuka mulai pukul 07.30 hingga 11.30 WIB setiap hari kerja. Pelayanan poliklinik berlangsung hingga pukul 14.30 WIB.</p>",
                'image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1200&q=80',
                'status' => 'published',
                'views' => 612,
                'is_featured' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'category_id' => $categories['pencegahan-info-penyakit']->id,
                'user_id' => $admin->id,
                'title' => 'Waspada Lonjakan Demam Berdarah Dengue: Galakkan Gerakan 3M Plus',
                'slug' => 'waspada-lonjakan-demam-berdarah-dengue-gerakan-3m-plus',
                'summary' => 'Memasuki musim penghujan, masyarakat diimbau menguras tempat penampungan air dan memantau jentik nyamuk Aedes aegypti secara berkala di pemukiman.',
                'content' => "<p>Kasus Demam Berdarah Dengue (DBD) cenderung meningkat seiring terbentuknya genangan air hujan di wadah terbuka. SIP-Kes mengajak seluruh warga mengaktifkan kembali peran Juru Pemantau Jentik (Jumantik) mandiri di rumah masing-masing.</p>
                <h3>Prinsip 3M Plus yang Efektif:</h3>
                <ul>
                    <li><strong>Menguras:</strong> Membersihkan bak mandi, vas bunga, dan tempat minum hewan peliharaan minimal satu kali seminggu.</li>
                    <li><strong>Menutup:</strong> Menutup rapat semua wadah penampungan air bersih seperti tandon, gentong, dan ember.</li>
                    <li><strong>Mendaur Ulang:</strong> Memanfaatkan kembali atau memusnahkan barang bekas yang berpotensi menampung air hujan (ban bekas, kaleng, botol plastik).</li>
                    <li><strong>Plus:</strong> Menggunakan kelambu saat tidur, memelihara ikan pemakan jentik, menanam tanaman pengusir nyamuk (serai, lavender), dan mengoleskan losion antinyamuk.</li>
                </ul>
                <p>Bila anggota keluarga mengalami demam tinggi mendadak lebih dari 2 hari disertai nyeri sendi dan bintik merah, segera bawa ke Puskesmas terdekat untuk pemeriksaan darah hematologi lengkap.</p>",
                'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=1200&q=80',
                'status' => 'published',
                'views' => 318,
                'is_featured' => false,
                'published_at' => now()->subDays(3),
            ],
            [
                'category_id' => $categories['promosi-edukasi-kesehatan']->id,
                'user_id' => $admin->id,
                'title' => 'Panduan Skrining Kesehatan Penyakit Tidak Menular (PTM) untuk Usia Produktif',
                'slug' => 'panduan-skrining-kesehatan-penyakit-tidak-menular-ptm',
                'summary' => 'Deteksi dini hipertensi, diabetes melitus, dan kolesterol tinggi dapat dilakukan secara gratis di Posbindu PTM dan Puskesmas binaan SIP-Kes.',
                'content' => "<p>Penyakit Tidak Menular (PTM) seperti stroke, penyakit jantung koroner, dan gagal ginjal sering kali dijuluki 'silent killer' karena tidak menunjukkan gejala yang khas pada fase awal perkembangannya.</p>
                <p>Melalui program SIP-Kes Sehat Berkelanjutan, setiap warga berusia 15 tahun ke atas dianjurkan melakukan pemeriksaan rutin minimal sekali setiap 6 bulan:</p>
                <ul>
                    <li>Pengukuran Indeks Massa Tubuh (IMT) dan lingkar perut untuk deteksi obesitas sentral.</li>
                    <li>Pengecekan tekanan darah (tensi) untuk deteksi hipertensi.</li>
                    <li>Pemeriksaan gula darah puasa / sewaktu untuk deteksi diabetes melitus.</li>
                    <li>Pemeriksaan kolesterol total dan asam urat bagi kelompok berisiko.</li>
                </ul>
                <p>Pemeriksaan ini dilayani gratis di seluruh Pos Pembinaan Terpadu (Posbindu) tingkat RW dan Puskesmas pada jam kerja hanya dengan menunjukkan identitas KTP.</p>",
                'image' => 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?auto=format&fit=crop&w=1200&q=80',
                'status' => 'published',
                'views' => 245,
                'is_featured' => false,
                'published_at' => now()->subDays(4),
            ],
            [
                'category_id' => $categories['pengumuman-resmi']->id,
                'user_id' => $admin->id,
                'title' => 'Pekan Imunisasi Nasional dan Pemberian Vitamin A Gratis di Posyandu Terdekat',
                'slug' => 'pekan-imunisasi-nasional-dan-pemberian-vitamin-a-gratis',
                'summary' => 'Orang tua yang memiliki bayi dan balita usia 0 hingga 59 bulan diundang membawa buah hati ke Posyandu binaan guna melengkapi imunisasi rutin dan suplementasi kapsul vitamin A.',
                'content' => "<p>Dalam rangka menurunkan angka kesakitan anak serta mencegah stunting secara menyeluruh, Dinas Kesehatan melalui sistem SIP-Kes mengumumkan pelaksanaan Bulan Penimbangan Balita dan Pemberian Kapsul Vitamin A gratis.</p>
                <h3>Jadwal & Sasaran:</h3>
                <ul>
                    <li><strong>Bayi Usia 6-11 Bulan:</strong> Mendapatkan kapsul Vitamin A Biru (100.000 IU).</li>
                    <li><strong>Anak Usia 12-59 Bulan:</strong> Mendapatkan kapsul Vitamin A Merah (200.000 IU) dan obat cacing albendazole dosis pencegahan.</li>
                    <li><strong>Imunisasi Kejar (Catch-up):</strong> Melengkapi vaksin Polio (bOPV & IPV), DPT-HB-Hib, PCV, dan Campak-Rubela bagi anak yang belum lengkap.</li>
                </ul>
                <p>Silakan berkonsultasi dengan kader kesehatan di balai RT/RW setempat atau bidan desa penanggung jawab wilayah.</p>",
                'image' => 'https://images.unsplash.com/photo-1576765608535-5f04d1e3f289?auto=format&fit=crop&w=1200&q=80',
                'status' => 'published',
                'views' => 389,
                'is_featured' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'category_id' => $categories['berita-agenda-kegiatan']->id,
                'user_id' => $admin->id,
                'title' => 'Puskesmas Keliling Sambangi Daerah Perbatasan: Layani Ratusan Lansia dan Ibu Hamil',
                'slug' => 'puskesmas-keliling-sambangi-daerah-perbatasan-layani-lansia',
                'summary' => 'Tim dokter gabungan dan perawat bergerak menyisir dusun pelosok guna memastikan keadilan akses pelayanan kesehatan primer bagi seluruh lapisan masyarakat.',
                'content' => "<p>Komitmen pemerataan layanan kesehatan diwujudkan melalui armada Puskesmas Keliling (Pusling) terpadu SIP-Kes. Pekan lalu, tim menyambangi lima wilayah desa terluar dengan membawa obat-obatan esensial dan peralatan ultrasonografi (USG) portabel untuk pemeriksaan kehamilan.</p>
                <p>Lebih dari 320 warga lansia dan 45 ibu hamil mendapatkan pemeriksaan langsung dari dokter spesialis obstetri ginekologi dan dokter umum. Kegiatan ini rencananya akan diagendakan berkala setiap dua pekan sekali.</p>",
                'image' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=1200&q=80',
                'status' => 'published',
                'views' => 195,
                'is_featured' => false,
                'published_at' => now()->subDays(6),
            ]
        ];

        foreach ($informationsData as $info) {
            Information::updateOrCreate(['slug' => $info['slug']], $info);
        }

        // 5. Health Services (Faskes di Jember)
        $servicesData = [
            [
                'name' => 'RSUD dr. Soebandi Jember',
                'type' => 'RSUD',
                'address' => 'Jl. dr. Soebandi No. 124, Patrang, Jember, Jawa Timur',
                'phone' => '(0331) 487564',
                'emergency_phone' => '(0331) 487564 ext. 119',
                'operational_hours' => '24 Jam (IGD, ICU, Rawat Inap)',
                'description' => 'Rumah Sakit Umum Daerah Kelas A milik Pemerintah Kabupaten Jember dengan fasilitas lengkap: poliklinik spesialis, CT-Scan, MRI, hemodialisis, laboratorium patologi, dan bank darah.',
                'is_active' => true,
            ],
            [
                'name' => 'Puskesmas Sumbersari Jember',
                'type' => 'Puskesmas',
                'address' => 'Jl. Kaliurang No. 2, Sumbersari, Jember, Jawa Timur',
                'phone' => '(0331) 334455',
                'emergency_phone' => '(0331) 334456',
                'operational_hours' => '24 Jam (IGD & Pelayanan Bersalin)',
                'description' => 'Puskesmas rawat inap berakreditasi Paripurna dengan fasilitas rawat inap, unit gawat darurat, poli gigi, klinik sanitasi, dan layanan konseling gizi terpadu di wilayah Sumbersari.',
                'is_active' => true,
            ],
            [
                'name' => 'Puskesmas Patrang Jember',
                'type' => 'Puskesmas',
                'address' => 'Jl. Muria No. 10, Patrang, Jember, Jawa Timur',
                'phone' => '(0331) 485123',
                'emergency_phone' => null,
                'operational_hours' => 'Senin - Sabtu: 07:30 - 15:00 WIB',
                'description' => 'Puskesmas non-rawat inap fokus pencegahan dan penanganan primer: poli anak/MTBS, poli lansia, konseling KB, dan imunisasi lengkap di kecamatan Patrang.',
                'is_active' => true,
            ],
            [
                'name' => 'Puskesmas Kaliwates Jember',
                'type' => 'Puskesmas',
                'address' => 'Jl. PB Sudirman No. 29, Kaliwates, Jember, Jawa Timur',
                'phone' => '(0331) 321789',
                'emergency_phone' => '0812-3344-5566',
                'operational_hours' => 'Senin - Sabtu: 07:30 - 14:30 WIB',
                'description' => 'Puskesmas dengan layanan lengkap termasuk poli umum, poli gigi, laboratorium sederhana, dan program kesehatan lingkungan di wilayah Kaliwates Jember.',
                'is_active' => true,
            ],
            [
                'name' => 'Unit PSC 119 Jember',
                'type' => 'PSC 119',
                'address' => 'Dinas Kesehatan Kabupaten Jember, Jl. Srikoyo No. 1, Jember',
                'phone' => '119',
                'emergency_phone' => '119 / (0331) 333-119',
                'operational_hours' => '24 Jam Setiap Hari Tanpa Libur',
                'description' => 'Pusat komando respons cepat darurat medis terintegrasi Kabupaten Jember dengan ambulans transfer advance, peralatan resusitasi, dan dokter spesialis emergency on-call.',
                'is_active' => true,
            ],
        ];

        foreach ($servicesData as $serv) {
            HealthService::updateOrCreate(['name' => $serv['name']], $serv);
        }

        // 6. Public Messages (Pertanyaan masyarakat Jember)
        $messagesData = [
            [
                'name' => 'Rahmat Hidayat',
                'email' => 'rahmat.hidayat@example.com',
                'phone' => '081298765432',
                'subject' => 'Tanya Jadwal Vaksinasi Booster untuk Lansia di Jember',
                'message' => 'Selamat pagi admin SIP-Kes, apakah di Puskesmas Sumbersari masih menyediakan vaksinasi booster gratis untuk warga lansia usia di atas 60 tahun? Syarat apa saja yang perlu dibawa? Terima kasih.',
                'status' => 'replied',
                'admin_reply' => 'Selamat pagi Bapak Rahmat. Layanan vaksinasi booster lansia tersedia setiap hari Selasa dan Kamis pukul 08.30 - 11.30 WIB di Puskesmas Sumbersari Jember. Cukup membawa KTP dan kartu BPJS/sertifikat vaksin sebelumnya.',
                'replied_at' => now()->subDays(1),
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nur@example.com',
                'phone' => '085712348899',
                'subject' => 'Alur Pendaftaran Poli Gigi Pasien Rujukan BPJS di RSUD Soebandi',
                'message' => 'Halo, saya mau menanyakan bagaimana cara mendaftar poli gigi di RSUD dr. Soebandi Jember dengan rujukan faskes 1? Apakah bisa daftar online atau harus datang langsung ke loket?',
                'status' => 'unread',
                'admin_reply' => null,
                'replied_at' => null,
            ]
        ];

        foreach ($messagesData as $msg) {
            PublicMessage::updateOrCreate(['email' => $msg['email'], 'subject' => $msg['subject']], $msg);
        }
    }
}
