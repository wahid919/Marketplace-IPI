-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Apr 2023 pada 23.48
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kormi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `kategori_berita_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `flag` int(11) NOT NULL DEFAULT 0,
  `image_summary` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `kategori_berita_id`, `user_id`, `judul`, `slug`, `gambar`, `isi`, `view_count`, `flag`, `image_summary`, `created_at`, `updated_at`) VALUES
(23, 2, 1, 'Jadwal Indonesia di Piala AFF U-23: Lawan Malaysia di Partai Akhir', 'Jadwal-Indonesia-di-Piala-AFF-U-23:-Lawan-Malaysia-di-Partai-Akhir2022-02-04', '3c996ac60b5bea19d52c93e66b0d585a250259ab.jpg', '<p>Jadwal&nbsp;Timnas Indonesia U-23 di Piala AFF U-23 2022 akan dimulai pada 15 Februari mendatang. Laos akan jadi lawan perdana tim arahan Shin Tae Yong di Kamboja.<br />Indonesia tergabung dalam Grup B di Piala AFF U-23 bersama Malaysia, Myanmar, dan Laos. Tak ada perbedaan waktu antara Indonesia dan Kamboja.<br /><br />Duel Indonesia vs Laos akan digelar di Stadion Prince, Phnom Penh, Selasa (15/2) pukul 19.00 WIB. Sebelumnya, Malaysia lebih dulu bertanding lawan Myanmar di venue yang sama.</p>\r\n<p>Tiga hari berselang, giliran Myanmar yang akan jadi penantang Indonesia. Kemudian, Indonesia akan menghadapi tim rival Malaysia di Stadion Nasional Morodok Techno pada 21 Februari 2022.<br /><br />Duel Indonesia vs Malaysia diprediksi akan menjadi penentu juara Grup B karena memiliki kekuatan yang terbilang setara.<br /><br />Dari tiga grup yang bersaing, hanya akan ada satu tim yang otomatis lolos ke semifinal. Sementara satu slot terakhir akan ditentukan lewat perhitungan runner up terbaik.<br /><br />Timnas Indonesia U-23 mulai berkumpul untuk pemusatan latihan pada Kamis (3/2) malam dan dijadwalkan mulai berlatih pada Jumat (4/2) pagi.<br />Timnas Indonesia U-23 mulai berkumpul untuk pemusatan latihan pada Kamis (3/2) malam dan dijadwalkan mulai berlatih pada Jumat (4/2) pagi.<br /><br />Garuda Muda dijadwalkan berangkat ke Kamboja untuk Piala AFF U-23 2022 pada 10 Februari. Belum diketahui apakah Shin Tae Yong akan membawa 23 pemain atau 28 pemain.<br /><br />Yang pasti, Indonesia bertolak ke Kamboja dengan ambisi mempertahankan gelar juara. Sebelumnya, tim Merah Putih berhasil menjuarai Piala AFF U-23 2019 usai mengalahkan Thailand 2-0.<br /><br /></p>', 38, 0, NULL, '2022-02-04 14:06:30', '2022-12-02 15:30:41'),
(24, 2, 1, 'KORMI Jatim Siap Maju dan Terus Ajak Masyarakat Gemar Berolahraga', 'KORMI-Jatim-Siap-Maju-dan-Terus-Ajak-Masyarakat-Gemar-Berolahraga2022-02-07', '9c1ab4eda3b5cc2fc26c2f7624c5e68a643f68dd.jpg', '<p><strong>SRYA.co.id | SURABAYA -</strong>&nbsp;Kepengurusan Komite Olahraga Rekreasi Masyarakat Indonesia (KORMI) Jawa Timur periode 2021-2025 secara resmi dikukuhkan di Surabaya, Kamis (28/10/2021) malam.</p>\r\n<p>Ketua Umum KORMI Pusat,&nbsp;<a title=\"Hayono&nbsp;Isman\" href=\"https://surabaya.tribunnews.com/tag/hayono-isman\" aria-label=\"link\">Hayono&nbsp;Isman</a>&nbsp;secara langsung mengukuhkan kepengurusan KORMI Jatim untuk empat tahun kedepan.&nbsp;<a title=\"Hudiyono\" href=\"https://surabaya.tribunnews.com/tag/hudiyono\" aria-label=\"link\">Hudiyono</a>&nbsp;menjadi komando tertinggi alias Ketua KORMI Jatim periode 2021-2025.</p>\r\n<p>Hudiyono menuturkan, KORMI Jatim kedepan harus menjadi organisasi yang maju dan berkembang dalam partisipasinya menggairahkan dan mendorong masyarakat gemar berolahraga. Sehingga diharapkan masyarakat Jatim bisa mencapai tujuan utama pembangunan olahraga yaitu untuk mengingkatkan kualitas hidup.</p>\r\n<p>\"Artinya, olahraga bila disandingkan dengan dunia kerja bisa memberikan dampak peningkatan produktivitas kerja. Tenaga kerja yang bugar pasti lebih produktif,\" sebut&nbsp;<a title=\"Hudiyono\" href=\"https://surabaya.tribunnews.com/tag/hudiyono\" aria-label=\"link\">Hudiyono</a>&nbsp;usai pelatikan KORMI Jatim di salah satu hotel di Surabaya, Kamis (28/10/2021) malam.</p>\r\n<p>Selain itu, lanjut&nbsp;<a title=\"Hudiyono\" href=\"https://surabaya.tribunnews.com/tag/hudiyono\" aria-label=\"link\">Hudiyono</a>, jika olahraga disandingkan kesehatan, maka akan menjaga kesehatan seseorang. Sehingga akan mengurangi biaya penanganan kesehatan. Sedangkan bila disandingkan dengan dunia pendidikan, olahraga akan meningkatkan capaian pembelajaran.</p>\r\n<p>\"Karena dengan berolahraga, konsentrasi siswa akan meningkat. Ketika anak belajar, diperlukan konsentrasi dan bisa terwujud bila asupan nutrisi dan oksigen yang dibawa olah darah ke otak mencukupi,\" terang&nbsp;<a title=\"Hudiyono\" href=\"https://surabaya.tribunnews.com/tag/hudiyono\" aria-label=\"link\">Hudiyono</a>&nbsp;dalam rilis tertulisnya yang diterima Surya.co.id.</p>\r\n<p>Menurut&nbsp;<a title=\"Hudiyono\" href=\"https://surabaya.tribunnews.com/tag/hudiyono\" aria-label=\"link\">Hudiyono</a>, jika salah satu tidak seimbang, anak akan cepat ngantuk, lelah, konsentrasi berkurang. Olahraga juga akan meningkatkan kualitas hidup.</p>\r\n<p>\"Masyarakan bisa berolahraga sekaligus rekreasi. Olahraga juga bisa meningkatkan interaksi sosial, menjaga silaturahmi sesama warga,\" terang pria yang juga Kadis Kominfo Pemprov Jatim ini.</p>\r\n<p>Ketua Umum KORMI Pusat,&nbsp;<a title=\"Hayono&nbsp;Isman\" href=\"https://surabaya.tribunnews.com/tag/hayono-isman\" aria-label=\"link\">Hayono&nbsp;Isman</a>&nbsp;mengatakan, peran dari KORMI cukup penting dalam peran masyarakat gemar berolahraga. Olahraga itu tidak hanya mengejar prestasi, tapi menjadikan tubuh sehat dan gembira.</p>\r\n<div id=\"_popIn_recommend_word\"></div>\r\n<p>\"Kalau olahraga prestasi jalurnya ditangani KONI, kalu kita (KORMI) lebih mengurusi oalahraga nonprestasi. Kendati ada juga olahraga prestasi yang menjadi anggota kita, sepertu surffing,\" sebut&nbsp;<a title=\"Hayono&nbsp;Isman\" href=\"https://surabaya.tribunnews.com/tag/hayono-isman\" aria-label=\"link\">Hayono&nbsp;Isman</a>.</p>\r\n<p>Hayono Isman menuturkan, jika olahraga dilakukan secara gembira akan membuat orang tidak merasa terpaksa melakukannya. Sehingga kedepannya diharapkan banyak mayarakat yang gemar berolahraga.</p>\r\n<p>\"Jika sudah banyak, maka kita akan menajdi pemasok atlet ke KONI. Biar menjadi atlet yang berprestasi,\" ucap pria yang pernah jadi Menpora RI ini.</p>\r\n<p><br /><br />Artikel ini telah tayang di&nbsp;<a href=\"https:\">Surya.co.id</a>&nbsp;dengan judul KORMI Jatim Siap Maju dan Terus Ajak Masyarakat Gemar Berolahraga,&nbsp;<a href=\"https://surabaya.tribunnews.com/2021/10/29/kormi-jatim-siap-maju-dan-terus-ajak-masyarakat-gemar-berolahraga\">https://surabaya.tribunnews.com/2021/10/29/kormi-jatim-siap-maju-dan-terus-ajak-masyarakat-gemar-berolahraga</a>.</p>', 12, 0, NULL, '2022-02-07 14:55:24', '2023-04-04 04:46:18'),
(25, 2, 1, 'KORMI Jatim Memassalkan Olahraga Masyarakat', 'KORMI-Jatim-Memassalkan-Olahraga-Masyarakat2022-02-07', '0757f2d456bd09b0c7db37968bca9233d7a5f41b.jpg', '<p><strong>Surabaya, InfoPublik -</strong>&nbsp;Komite Olahraga Rekreasi Masyarakat Indonesia (KORMI) sebagai pengemban amanah UU 3 Tahun 2005 tentang Sistem Keolahragaan Nasional berfokus pada Olahraga Rekreasi Masyarakat.</p>\r\n<p>Dalam pembinaan olahraga, pemassalan olahraga perlu terwujud, sehingga olahraga menjadi budaya, artinya olahraga menjadi kebutuhan setiap orang. Pada konteks olahraga sudah menjadi budaya seperti ini, maka masyarakat telah menempatkan olahraga sebagai investasi menuju sehat.<br /><br />Hal ini disampaikan Wakil Ketua II KORMI, Edi Purwinato mewakili Ketua KORMI Jatim, Hudiyono saat melantik KORMI Trenggalek, Sabtu (27/11/2021) di Aula Kantor Dispora Trenggalek.<br /><br />Lebih lanjut,Edi menjelaskan, membangun kesejahteraan meletakkan masyarakat sebagai obyek, masyarakat sebagai obyek perlu sehat dan bugar.</p>\r\n<p>Dalam tugasnya dalam lingkup olahraga rekreasi masyarakat, KORMI bertugas menetapkan dan melaksanakan kebijakan penyelenggaraan olahraga rekreasi masyarakat.</p>\r\n<p>Untuk itu, KORMI berewenang untuk mengarahkan, mengatur, mengoordinasikan, membimbing, memberdayakan, mengembangkan dan mengawasi penyelenenggraaan olahraga rekreasi masyarakat.<br /><br />Hubungan antara KORMI dengan Induk Organisasi Cabor adalah dalam konteks pembinaan karena Induk Organisasi adalah anggota KORMI di masing-masing tingkatan.</p>\r\n<p>Telahan atas UU 3 Tahun 2005, kata rekreasi perlu ditinjau kembali karena hakekatnya sasaran yang menjadi pembinaan KORMI tidak sebatas pada olahraga rekreasi. Untuk itu penyebutan olahraga rekreasi masyarakat perlu diubah menjadi olahraga masyarakat.<br /><br />Sumber pendanaan menurut UU 3 Tahun 2005 jelas mengatur bahwa Pemerintah dan Pemerintah Daerah wajib mengalokasikan pendanaan olahraga dari APBN dan APBD harus dilaksanakan secara konsisten, karena hakekatnya apa yang dilakukan oleh KORMI adalah bentuk inside government. Hal ini seharusnya sama dengan pengalokasian anggaran untuk KONI.<br /><br />Pada kesempatan yang sama, Bupati Trenggalek yang diwakili Assisten Pemerintahan Kesra Trenggalek, Widarsono mengatakan, kegiatan pelantikan ini merupakan momentum yang sangat berharga bagi kelangsungan prestasi olahraga di Kabupaten Trenggalek.<br /><br />Selain olahraga olahraga prestasi yang sudah ada. Olahraga tradisional yang merupakan warisan leluhur kita memiliki nilai-nilai filosofi yang tinggi. Rasa kebersamaan, kerjasama, semangat gotong royong serta saling menghargai merupakan nilai luhur yang patut kita lestasrikan.</p>\r\n<p>Bahkan terlebih lagi, dewasa ini anak-anak kita banyak yang terpengaruh dengan gadget, dan dapat kita lihat secara umum lebih banyak berdampak buruk dari pada manfaatnya.<br /><br />\"Saya berharap, setelah kegiatan pelantikan ada follow up dan benar-benar dipraktikkan kepada masing-masing anak didik saudara sekalian. Saya memahami bahwa semuanya memerlukan proses yang tidak mudah, tetapi juga tidak ada yang tidak mungkin selama kita mau berusaha. Agar anak-anak kita juga kembali menemukan jatid irinya,kembali menumbuhkembangkan rasa kemasyarakatan pada para peserta didik saudara sekalian,\"ujarnya.<br /><br />\"Ada Balap Egrang yang menuntut konsentrasi dan keseimbangan, balap terompah yang harus solid dalam tim atau olahraga permainan yang lain yang kesemuanya itu mengandung nilai posistif bagi anak kita dan tentunya jerih lelah saudara-saudara sekalian tidak akan sia-sia karena kita ikut membangun generasi di Kabupaten Trenggalek menjadi generasi yang unggul,\" imbuhnya.<br /><br />Ketua KORMI Trenggalek, H Edianto Agus Winarno menyatakan, dengan dilantiknya KORMI Trenggalek untuk menyosialisasikan dan mengembangkan olahraga rekreasi masyarakat dengan membentuk wadah bagi komunitas atau perkumpulan olahraga rekreasi di lingkungan masyarakat Trenggalek di bawah pembinaan KORMI kabupaten Trenggalek.<br /><br />Program kerja pengurus KORMI Trenggalek melantik tiga pengurus cabor di bawah pembinaan KORMI kabupaten Trenggalek yaitu pengurus Persatuan olahraga senam masyarakat Trenggalek, Persatuan olahraga Tradisional Masyarakat Trenggalek dan Persatuan olahraga Layang-layang Masyarakat Trenggalek.<br /><br />Hadir dalam pelantikan tersebut yaitu Asisten pemerintahan dan kesra. Trenggalek, Kepala Dinas Pendidikan Pemuda dan Olahraga kab.Trenggalek dan sebagai narasumber Sembodo Sukmamukti dan Moh.Soelhfudin, Spd Mpd, Acara dibuka line dance dan ditutup senam poco poco bersama Wakil ketua KORMI Jatim. (MC Diskominfo Prov Jatim/non-her/eyv)</p>', 10, 0, NULL, '2022-02-07 14:58:27', '2022-11-19 10:37:45'),
(26, 3, 1, 'Pengurus Kormi Dilantik, Olah Raga Rekreasi Harus Lebih Produktif di Jawa Timur', 'Pengurus-Kormi-Dilantik,-Olah-Raga-Rekreasi-Harus-Lebih-Produktif-di-Jawa-Timur2022-02-07', '7dbb8092234523ada33338f67beff47874ef27fb.jpeg', '<p><strong>Surabaya (beritajatim.com)&nbsp;</strong>&ndash; Olah Raga rekreasi kini menjadi salah satu kebutuhan di tengah pandemi, tak salah jika Ketua Umum Komite Olahraga Rekreasi Masyarakat Indonesia (KORMI) Jatim Hudiyono berharap KORMI Jatim kedepan menjadikan organisasi ini menjadi maju dan besar.</p>\r\n<p>Pasalnya sedikit menengok dan menjadi pengalaman sebelumnya, supaya olah raga rekreasi ini lebih maju, lebih produktif, inovativ dan lebih energik, untuk itu perlu komitmen semua pengurus KORMI Jatim serta kerja sama yang kuat untuk menjalankannya hal ini di sampaikan saat pelantikan KORMI Jatim 2021-2025 di Surabaya, Jumat (29/10/2021).</p>\r\n<p>Lebih lanjut Hudiyono menegaskan ingin mengajak bersama-sama melalui organisasi kita ini menciptakan masyarakat gemar berolahraga sehingga masyarakat Jatim umumnya bisa mencapai tujuan utama pembangunan olahraga yaitu untuk mengingkatkan kualitas hidup (to improve the quality of life).</p>\r\n<p>&ldquo;Artinya, olahraga bila disandingkan dengan dunia kerja, memberikan dampak peningkatan produktivitas. tenaga kerja yang bugar pasti lebih produktif. bila disandingkan dengan kesehatan, olahraga akan menjaga kesehatan, menurunkan cost penanganan kesehatan,&rdquo;ungkap Hudiyono.</p>\r\n<p>Sedangkan Olahraga bila disandingkan dengan dunia pendidikan, olahraga akan meningkatkan capaian pembelajaran, karena dengan berolahraga konsentrasi siswa akan meningkat. ketika anak belajar, diperlukan konsentrasi. konsentrasi bisa terwujud bila asupan nutrisi dan oksigen yang dibawa olah darah ke otak mencukupi.</p>', 11, 0, NULL, '2022-02-07 14:59:14', '2022-08-18 09:29:19');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_berita_id` (`kategori_berita_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_ibfk_1` FOREIGN KEY (`kategori_berita_id`) REFERENCES `kategori_berita` (`id`),
  ADD CONSTRAINT `berita_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
