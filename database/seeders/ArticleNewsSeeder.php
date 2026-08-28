<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArticleNews;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Support\Str;

class ArticleNewsSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();
        $author = Author::first();

        if ($categories->isEmpty() || !$author) {
            return;
        }

        // Pastikan folder storage app/public ada
        $storagePath = storage_path('app/public');
        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        $publicImagesPath = public_path('assets/images/siapindo');
        
        $imagesToCopy = [
            'carousel-1.jpg',
            'carousel-2.jpg',
            'layanan-satu.webp',
            'layanan-dua.webp',
            'layanan-tiga.webp',
            'layanan-empat.webp',
            'layanan-lima.webp',
            'layanan-enam.webp',
            'layanan-tujuh.webp',
            'about.jpg'
        ];

        foreach ($imagesToCopy as $imgName) {
            $sourceFile = $publicImagesPath . '/' . $imgName;
            $destFile = $storagePath . '/' . $imgName;
            
            if (file_exists($sourceFile)) {
                copy($sourceFile, $destFile);
            }
        }

        $thumbnails = $imagesToCopy;

        $articles = [
            // Category: Kegiatan Pelatihan (4 articles)
            [
                'name' => 'Tata Upacara Resmi dan Penempatan Lambang Negara dalam Acara Protokoler',
                'category_name' => 'Kegiatan Pelatihan',
                'is_featured' => 'featured',
                'thumbnail' => $thumbnails[0],
                'content' => '<h2>Pedoman Resmi Tata Upacara Kenegaraan</h2><p>Penyelenggaraan tata upacara resmi di Indonesia diatur secara ketat dalam undang-undang keprotokolan negara. Hal ini bertujuan untuk menjaga kehormatan lambang negara, bendera merah putih, lagu kebangsaan Indonesia Raya, serta kewibawaan instansi penyelenggara.</p><p>Pengaturan bendera negara harus selalu ditempatkan di posisi kanan dari mimbar pidato atau di barisan paling utama apabila dipasang berkelompok. Selain itu, pemasangan lambang Garuda Pancasila wajib diletakkan lebih tinggi daripada foto Presiden dan Wakil Presiden.</p><h3>Aspek Kritis dalam Upacara:</h3><ul><li>Tata letak bendera merah putih dan lambang Garuda Pancasila yang benar.</li><li>Susunan tata urutan acara mulai dari pembukaan hingga doa penutup.</li><li>Pengaturan waktu masuk dan keluar bagi tamu VVIP agar tidak terjadi bentrokan arus.</li></ul>'
            ],
            [
                'name' => 'Pedoman Tata Tempat (Preseance) Tamu VVIP pada Event Protokoler Instansi',
                'category_name' => 'Kegiatan Pelatihan',
                'is_featured' => 'not_featured',
                'thumbnail' => $thumbnails[1],
                'content' => '<h2>Mengenal Aturan Seating Arrangement (Tata Tempat)</h2><p>Pengaturan tata tempat atau preseance merupakan aturan dasar dalam menentukan urutan prioritas tempat duduk pejabat negara, pejabat daerah, maupun tokoh penting lainnya. Prinsip utamanya adalah pejabat dengan kedudukan tertinggi menempati tempat duduk paling depan dan paling tengah.</p><p>Bila susunan kursi ganjil, maka posisi nomor satu berada di tengah. Bila genap, posisi nomor satu berada di sebelah kanan dari posisi tengah. Kesalahan kecil dalam seating arrangement dapat menyinggung sensitivitas instansi yang bersangkutan.</p><h3>Langkah Menyiapkan Tata Tempat:</h3><ul><li>Buat seating plan berdasarkan status ketatanegaraan tamu kehormatan.</li><li>Pastikan penandaan kartu nama di kursi (name tag) terbaca dengan jelas.</li><li>Gunakan koordinasi radio HT bagi LO (Liaison Officer) untuk menyambut kedatangan tamu.</li></ul>'
            ],
            [
                'name' => 'Mengenal Peran Penting Pranata Humas dan Protokoler Pemerintah',
                'category_name' => 'Kegiatan Pelatihan',
                'is_featured' => 'not_featured',
                'thumbnail' => $thumbnails[2],
                'content' => '<h2>Tugas di Balik Layar Petugas Protokol</h2><p>Seorang petugas protokol atau pranata humas memiliki tanggung jawab besar dalam memastikan sebuah acara formal berjalan lancar tanpa kendala teknis sedikit pun. Mulai dari persiapan tata ruang, penjemputan tamu di bandara, koordinasi dengan pasukan pengamanan, hingga kepastian konsumsi.</p><p>Kecakapan berkomunikasi, ketahanan fisik, serta kesigapan dalam mencari jalan keluar cepat saat terjadi kendala mendadak di lapangan (crisis management) merupakan modal utama profesi ini.</p>'
            ],
            [
                'name' => 'Alur Pelayanan Tamu Asing VVIP Menurut Protokol Diplomatik Internasional',
                'category_name' => 'Kegiatan Pelatihan',
                'is_featured' => 'not_featured',
                'thumbnail' => $thumbnails[3],
                'content' => '<h2>Standar Penyambutan Delegasi Luar Negeri</h2><p>Menyambut tamu kehormatan asing setingkat menteri atau duta besar memerlukan pemahaman mendalam tentang aturan diplomatik internasional. Setiap aspek penyambutan di bandara, pengawalan bermotor, hingga fasilitas lounge VIP harus diatur sesuai dengan asas resiprositas (timbal balik).</p><p>Koordinasi erat antara kedutaan besar negara pengirim dan protokol Kementerian Luar Negeri wajib dijalin untuk menghindari kesalahan prosedur penghormatan negara.</p>'
            ],

            // Category: Artikel & Insight (3 articles)
            [
                'name' => 'Meningkatkan Kompetensi Petugas Protokol Melalui Pelatihan Berkelanjutan',
                'category_name' => 'Artikel & Insight',
                'is_featured' => 'featured',
                'thumbnail' => $thumbnails[4],
                'content' => '<h2>Pengembangan Karakter SDM Protokoler</h2><p>Petugas keprotokolan adalah wajah terdepan dari suatu instansi. Oleh karena itu, pengembangan kualitas sumber daya manusia protokoler harus terus diasah secara periodik. Program pelatihan berkelanjutan tidak hanya memfokuskan pada aturan tertulis keprotokolan saja.</p><p>Aspek kepribadian (grooming), etika komunikasi telepon, tata suara saat bertugas sebagai Master of Ceremony (MC), serta pengendalian emosi dalam situasi tertekan merupakan bagian integral dari silabus pengembangan SDM.</p><h3>Target Utama Pelatihan Kompetensi:</h3><ul><li>Peningkatan keterampilan tata laksana upacara resmi.</li><li>Penguasaan tata krama pergaulan tingkat eksekutif.</li><li>Keahlian memecahkan masalah taktis di lapangan secara mandiri.</li></ul>'
            ],
            [
                'name' => 'Penerapan Standar Operasional Prosedur (SOP) Kerja bagi Tim Protokol Instansi',
                'category_name' => 'Artikel & Insight',
                'is_featured' => 'not_featured',
                'thumbnail' => $thumbnails[5],
                'content' => '<h2>Pentingnya SOP Pelayanan Protokol yang Konsisten</h2><p>Setiap instansi pemerintah maupun BUMN memerlukan Standar Operasional Prosedur (SOP) yang jelas untuk meminimalisasi ruang kesalahan dalam pelayanan tamu VVIP. SOP yang terperinci mencakup daftar periksa (checklist) kesiapan gedung, ketersediaan pengawalan, hingga prosedur pelaporan darurat.</p><p>Evaluasi berkala terhadap SOP keprotokolan setelah event besar selesai (post-event evaluation) terbukti meningkatkan profesionalisme kerja tim humas dan keprotokolan.</p>'
            ],
            [
                'name' => 'Pengembangan Etos Kerja Profesional dan Kedisiplinan Pranata Protokol',
                'category_name' => 'Artikel & Insight',
                'is_featured' => 'not_featured',
                'thumbnail' => $thumbnails[6],
                'content' => '<h2>Membangun Karakter Sigap, Rapi, dan Loyal</h2><p>Kedisiplinan waktu adalah urat nadi keprotokolan. SDM protokoler dituntut hadir minimal dua jam sebelum acara dimulai untuk melakukan gladi bersih. Selain itu, etos kerja profesional mencakup kemampuan menjaga kerahasiaan instansi serta loyalitas penuh kepada pimpinan.</p><p>Sikap santun namun tegas dalam menghadapi tamu yang melanggar prosedur juga diajarkan sebagai wujud dari integritas pribadi petugas protokol modern.</p>'
            ],

            // Category: Tips & Edukasi (3 articles)
            [
                'name' => 'Etiket Jamuan Makan Resmi (Table Manner) dalam Diplomasi Internasional',
                'category_name' => 'Tips & Edukasi',
                'is_featured' => 'featured',
                'thumbnail' => $thumbnails[7],
                'content' => '<h2>Seni Diplomasi di Meja Makan</h2><p>Jamuan resmi diplomatik bukan sekadar ajang bersantap, melainkan sarana lobi internasional yang sangat vital bagi kepentingan nasional. Pemahaman tata cara makan (table manner) sangat menentukan citra dan kehormatan delegasi suatu negara.</p><p>Mulai dari cara menggunakan garpu dan pisau dari urutan terluar, memegang gelas berkaki, memakan sup dengan arah menjauhi tubuh, hingga etiket bersulang (toasting) memiliki aturan ketat yang wajib dikuasai para diplomat dan pejabat tinggi.</p><h3>Prinsip Dasar Table Manner Internasional:</h3><ul><li>Duduk tegak dan tidak menyandarkan siku di atas meja makan.</li><li>Menggunakan serbet makan (napkin) di pangkuan paha secara benar.</li><li>Berbicara dengan suara tenang dan menghindari topik yang memicu kontroversi.</li></ul>'
            ],
            [
                'name' => 'Grooming Profesional: Tata Busana dan Etika Berpenampilan Resmi Acara Negara',
                'category_name' => 'Tips & Edukasi',
                'is_featured' => 'not_featured',
                'thumbnail' => $thumbnails[8],
                'content' => '<h2>Etiket Berpakaian Formal dan Semi-Formal</h2><p>Penampilan fisik yang rapi dan sesuai dengan dress code acara resmi kenegaraan mencerminkan penghargaan kita terhadap penyelenggara acara. Terdapat berbagai kategori pakaian resmi yang diakui secara keprotokolan nasional.</p><p>Kategori tersebut di antaranya Pakaian Sipil Lengkap (PSL) dengan jas gelap dan dasi, Pakaian Sipil Resmi (PSR), baju adat daerah/Batik lengan panjang sutra, hingga gaun malam formal (formal gown) untuk jamuan makan malam internasional.</p>'
            ],
            [
                'name' => 'Etiket Komunikasi dan Tata Penghormatan Lintas Budaya bagi Diplomat Indonesia',
                'category_name' => 'Tips & Edukasi',
                'is_featured' => 'not_featured',
                'thumbnail' => $thumbnails[9],
                'content' => '<h2>Menghormati Keberagaman Budaya Lintas Negara</h2><p>Interaksi lintas negara mengharuskan kita peka terhadap norma kesopanan budaya setempat. Cara memberikan salam kehormatan, bertukar kartu nama dengan dua belah tangan di negara Asia Timur, hingga etika berbicara dengan lawan jenis di Timur Tengah memiliki batasan yang beraneka ragam.</p><p>Dengan menguasai etika pergaulan internasional, delegasi Indonesia dapat membangun relasi kerja sama yang harmonis, saling menghargai, dan produktif.</p>'
            ]
        ];

        foreach ($articles as $art) {
            $category = $categories->where('name', $art['category_name'])->first();

            if ($category) {
                ArticleNews::updateOrCreate(
                    ['name' => $art['name']],
                    [
                        'content' => $art['content'],
                        'thumbnail' => $art['thumbnail'],
                        'is_featured' => $art['is_featured'],
                        'category_id' => $category->id,
                        'author_id' => $author->id,
                        'slug' => Str::slug($art['name']),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}