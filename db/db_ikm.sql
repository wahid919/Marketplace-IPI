-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `action`;
CREATE TABLE `action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller_id` varchar(50) NOT NULL,
  `action_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `action` (`id`, `controller_id`, `action_id`, `name`) VALUES
(12,	'site',	'index',	'Index'),
(13,	'site',	'profile',	'Profile'),
(14,	'site',	'login',	'Login'),
(15,	'site',	'logout',	'Logout'),
(16,	'site',	'contact',	'Contact'),
(17,	'site',	'about',	'About'),
(18,	'menu',	'index',	'Index'),
(19,	'menu',	'view',	'View'),
(20,	'menu',	'create',	'Create'),
(21,	'menu',	'update',	'Update'),
(22,	'menu',	'delete',	'Delete'),
(23,	'role',	'index',	'Index'),
(24,	'role',	'view',	'View'),
(25,	'role',	'create',	'Create'),
(26,	'role',	'update',	'Update'),
(27,	'role',	'delete',	'Delete'),
(28,	'role',	'detail',	'Detail'),
(29,	'user',	'index',	'Index'),
(30,	'user',	'view',	'View'),
(31,	'user',	'create',	'Create'),
(32,	'user',	'update',	'Update'),
(33,	'user',	'delete',	'Delete'),
(34,	'site',	'register',	'Register'),
(35,	'site',	'pemasukkan',	'Pemasukkan'),
(36,	'site',	'pengeluaran',	'Pengeluaran'),
(37,	'site',	'list-perhitungan',	'List Perhitungan'),
(38,	'site',	'list-hutang',	'List Hutang'),
(39,	'site',	'jurnal',	'Jurnal'),
(40,	'site',	'neraca',	'Neraca'),
(41,	'site',	'arus-kas',	'Arus Kas'),
(42,	'site',	'proyeksi',	'Proyeksi'),
(43,	'site',	'cetak-neraca',	'Cetak Neraca'),
(44,	'site',	'cetak-list-perhitungan',	'Cetak List Perhitungan'),
(45,	'site',	'cetak-arus-kas',	'Cetak Arus Kas'),
(46,	'site',	'cetak-proyeksi',	'Cetak Proyeksi'),
(47,	'site',	'generate',	'Generate'),
(48,	'menu',	'save',	'Save'),
(79,	'setting',	'index',	'Index'),
(80,	'setting',	'view',	'View'),
(81,	'setting',	'create',	'Create'),
(82,	'setting',	'update',	'Update'),
(83,	'setting',	'delete',	'Delete'),
(139,	'hubungi-kami',	'index',	'Index'),
(140,	'hubungi-kami',	'view',	'View'),
(141,	'hubungi-kami',	'create',	'Create'),
(142,	'hubungi-kami',	'update',	'Update'),
(143,	'hubungi-kami',	'delete',	'Delete'),
(144,	'hubungi-kami',	'sudah-dihubungi',	'Sudah Dihubungi'),
(145,	'site',	'error',	'Error'),
(146,	'setting',	'unduh',	'Unduh'),
(163,	'site',	'lupa-password',	'Lupa Password'),
(164,	'site',	'ganti-password',	'Ganti Password'),
(165,	'slides',	'index',	'Index'),
(166,	'slides',	'view',	'View'),
(167,	'slides',	'create',	'Create'),
(168,	'slides',	'update',	'Update'),
(169,	'slides',	'delete',	'Delete'),
(179,	'galeri',	'index',	'Index'),
(180,	'galeri',	'view',	'View'),
(181,	'galeri',	'create',	'Create'),
(182,	'galeri',	'update',	'Update'),
(183,	'galeri',	'delete',	'Delete'),
(194,	'struktur-organisasi',	'index',	'Index'),
(195,	'struktur-organisasi',	'view',	'View'),
(196,	'struktur-organisasi',	'create',	'Create'),
(197,	'struktur-organisasi',	'update',	'Update'),
(198,	'struktur-organisasi',	'delete',	'Delete');

DROP TABLE IF EXISTS `foto_produk`;
CREATE TABLE `foto_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `produk_id` (`produk_id`),
  CONSTRAINT `foto_produk_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `galeri`;
CREATE TABLE `galeri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `isi` text,
  `flag` int(11) NOT NULL DEFAULT '0' COMMENT '0:aktif;1:tidak aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `galeri` (`id`, `nama`, `foto`, `isi`, `flag`) VALUES
(1,	'Panjat Tebing',	'c00abc02cd9038d1a693dc75a3ecdad944aed759.jpeg',	'<p>Melakukan Kecepatan Memanjat</p>',	0),
(2,	'Sepak Bola',	'0aae8b17d1dd41e12fad4f6effb0e6ce745cdd5e.jpeg',	'',	0);

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `hubungi_kami`;
CREATE TABLE `hubungi_kami` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `nomor_hp` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:baru,1:sudah dibaca,2:ditolak',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `hubungi_kami` (`id`, `nama`, `nomor_hp`, `email`, `pesan`, `flag`, `created_at`, `updated_at`) VALUES
(1,	NULL,	NULL,	'indahbersama@gmail.com',	'website bagus',	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `kategori_produk`;
CREATE TABLE `kategori_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `keuntungan`;
CREATE TABLE `keuntungan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `controller` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL DEFAULT 'index',
  `icon` varchar(50) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `menu` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `menu` (`id`, `name`, `controller`, `action`, `icon`, `order`, `parent_id`) VALUES
(1,	'Home',	'site',	'index',	'fa fa-home',	1,	NULL),
(2,	'Master',	'',	'index',	'fa fa-database',	2,	NULL),
(3,	'Menu',	'menu',	'index',	'fa fa-circle-o',	11,	2),
(4,	'Role',	'role',	'index',	'fa fa-circle-o',	12,	2),
(5,	'User',	'user',	'index',	'fa fa-circle-o',	13,	2),
(12,	'Setting Website',	'setting',	'index',	'fa fa-align-justify',	16,	NULL),
(22,	'Hubungi Kami',	'hubungi-kami',	'index',	'fa fa-envelope-o',	15,	NULL),
(26,	'Slider',	'slides',	'index',	'fa fa-ambulance',	8,	2),
(28,	'Galeri',	'galeri',	'index',	'fa fa-photo',	7,	2),
(31,	'Struktur Organisasi',	'struktur-organisasi',	'index',	'fa fa-users',	4,	2);

DROP TABLE IF EXISTS `nilai_sikap`;
CREATE TABLE `nilai_sikap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `kategori_produk_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `deskripsi_singkat` text NOT NULL,
  `deksripsi_lengkap` text NOT NULL,
  `status_online` tinyint(4) NOT NULL DEFAULT '1',
  `foto_banner` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `diskon_status` tinyint(4) NOT NULL DEFAULT '0',
  `diskon` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kategori_produk_id` (`kategori_produk_id`),
  KEY `toko_id` (`toko_id`),
  CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`kategori_produk_id`) REFERENCES `kategori_produk` (`id`),
  CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`toko_id`) REFERENCES `toko` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `review_produk`;
CREATE TABLE `review_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produk_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `review` text NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produk_id` (`produk_id`),
  CONSTRAINT `review_produk_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `role` (`id`, `name`) VALUES
(1,	'Super Administrator'),
(3,	'Regular User');

DROP TABLE IF EXISTS `role_action`;
CREATE TABLE `role_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `action_id` (`action_id`),
  CONSTRAINT `role_action_ibfk_3` FOREIGN KEY (`action_id`) REFERENCES `action` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_action_ibfk_4` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `role_action` (`id`, `role_id`, `action_id`) VALUES
(3073,	1,	12),
(3074,	1,	13),
(3075,	1,	14),
(3076,	1,	15),
(3077,	1,	17),
(3078,	1,	18),
(3079,	1,	19),
(3080,	1,	20),
(3081,	1,	21),
(3082,	1,	22),
(3083,	1,	23),
(3084,	1,	24),
(3085,	1,	25),
(3086,	1,	26),
(3087,	1,	27),
(3088,	1,	28),
(3089,	1,	29),
(3090,	1,	30),
(3091,	1,	31),
(3092,	1,	32),
(3093,	1,	33),
(3109,	1,	165),
(3110,	1,	166),
(3111,	1,	167),
(3112,	1,	168),
(3113,	1,	169),
(3114,	1,	179),
(3115,	1,	180),
(3116,	1,	181),
(3117,	1,	182),
(3118,	1,	183),
(3129,	1,	194),
(3130,	1,	195),
(3131,	1,	196),
(3132,	1,	197),
(3133,	1,	198),
(3139,	1,	79),
(3140,	1,	80),
(3141,	1,	81),
(3142,	1,	82),
(3143,	1,	83),
(3144,	1,	139),
(3145,	1,	140),
(3146,	1,	141),
(3147,	1,	142),
(3148,	1,	143),
(3154,	3,	12),
(3155,	3,	13),
(3156,	3,	14),
(3157,	3,	15),
(3158,	3,	16),
(3159,	3,	17);

DROP TABLE IF EXISTS `role_menu`;
CREATE TABLE `role_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `menu_id` (`menu_id`),
  CONSTRAINT `role_menu_ibfk_3` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_menu_ibfk_4` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `role_menu` (`id`, `role_id`, `menu_id`) VALUES
(640,	1,	1),
(641,	1,	2),
(642,	1,	3),
(643,	1,	4),
(644,	1,	5),
(648,	1,	26),
(649,	1,	28),
(652,	1,	31),
(654,	1,	12),
(655,	1,	22),
(657,	3,	1);

DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) DEFAULT NULL,
  `judul_web` varchar(255) DEFAULT NULL,
  `tentang_kami` text,
  `judul_tentang_kami` varchar(255) DEFAULT NULL,
  `foto_tentang_kami` varchar(255) DEFAULT NULL,
  `foto_member` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `telegram` varchar(255) DEFAULT NULL,
  `nama_web` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `visi` text,
  `misi` text,
  `slogan_web` text NOT NULL,
  `banner` varchar(255) NOT NULL,
  `embed_ig` text,
  `embed_ig2` text,
  `nama_motivasi` varchar(255) DEFAULT NULL,
  `jabatan_motiviasi` varchar(255) DEFAULT NULL,
  `isi_motivasi` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `setting` (`id`, `logo`, `judul_web`, `tentang_kami`, `judul_tentang_kami`, `foto_tentang_kami`, `foto_member`, `facebook`, `instagram`, `telepon`, `email`, `twitter`, `telegram`, `nama_web`, `alamat`, `visi`, `misi`, `slogan_web`, `banner`, `embed_ig`, `embed_ig2`, `nama_motivasi`, `jabatan_motiviasi`, `isi_motivasi`) VALUES
(4,	'BsoylS6xRq7OWqS9lIz6frSnfdu9TsJQ.png',	'Kormi',	'Ketua Umum Komite Olahraga Rekreasi Masyarakat Indonesia (KORMI) Jatim, Hudiyono mengajak masyarakat Jatim gemar berolahraga untuk meningkatkan kualitas hidup (to improve the quality of life).\r\n\r\nHal ini disampaikannya saat menghadiri Hari Ulang Tahun KORMI Kabupaten Sidoarjo, Sabtu (2/10/2021), di kabupaten Sidoarjo.\r\n\r\nHudiyono yang terpilih menjadi Ketua Umum (KORMI) masa bakti 2021-2025 ini menjelaskan, olahraga bila disandingkan dengan dunia kerja, memberikan dampak peningkatan produktivitas. Tenaga kerja yang bugar pasti lebih produktif, bila disandingkan dengan kesehatan. Olahraga akan menjaga kesehatan, menurunkan cost penanganan kesehatan.',	'-',	NULL,	NULL,	'-',	'https://www.instagram.com/kormijatim/',	'08123127234',	'-',	'-',	NULL,	'Kormi',	'Jl. Kayoon No. 56, Embong Kaliasin,Kec. Genteng SUB',	'-',	'-',	'-',	'5S_DsrmixE612tfaWasB7uemA8-3O110.jpeg',	'<blockquote class=\"instagram-media\" data-instgrm-captioned data-instgrm-permalink=\"https://www.instagram.com/p/CPuZ2f4AA4U/?utm_source=ig_embed&amp;utm_campaign=loading\" data-instgrm-version=\"14\" style=\" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);\"><div style=\"padding:16px;\"> <a href=\"https://www.instagram.com/p/CPuZ2f4AA4U/?utm_source=ig_embed&amp;utm_campaign=loading\" style=\" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;\" target=\"_blank\"> <div style=\" display: flex; flex-direction: row; align-items: center;\"> <div style=\"background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;\"></div> <div style=\"display: flex; flex-direction: column; flex-grow: 1; justify-content: center;\"> <div style=\" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;\"></div> <div style=\" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;\"></div></div></div><div style=\"padding: 19% 0;\"></div> <div style=\"display:block; height:50px; margin:0 auto 12px; width:50px;\"><svg width=\"50px\" height=\"50px\" viewBox=\"0 0 60 60\" version=\"1.1\" xmlns=\"https://www.w3.org/2000/svg\" xmlns:xlink=\"https://www.w3.org/1999/xlink\"><g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\"><g transform=\"translate(-511.000000, -20.000000)\" fill=\"#000000\"><g><path d=\"M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631\"></path></g></g></g></svg></div><div style=\"padding-top: 8px;\"> <div style=\" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;\">View this post on Instagram</div></div><div style=\"padding: 12.5% 0;\"></div> <div style=\"display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;\"><div> <div style=\"background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);\"></div> <div style=\"background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;\"></div> <div style=\"background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);\"></div></div><div style=\"margin-left: 8px;\"> <div style=\" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;\"></div> <div style=\" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)\"></div></div><div style=\"margin-left: auto;\"> <div style=\" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);\"></div> <div style=\" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);\"></div> <div style=\" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);\"></div></div></div> <div style=\"display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;\"> <div style=\" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;\"></div> <div style=\" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;\"></div></div></a><p style=\" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;\"><a href=\"https://www.instagram.com/p/CPuZ2f4AA4U/?utm_source=ig_embed&amp;utm_campaign=loading\" style=\" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;\" target=\"_blank\">A post shared by KORMI JATIM (@kormijatim)</a></p></div></blockquote> <script async src=\"//www.instagram.com/embed.js\"></script>',	'<blockquote class=\"instagram-media\" data-instgrm-permalink=\"https://www.instagram.com/p/CPuZ2f4AA4U/?utm_source=ig_embed&amp;utm_campaign=loading\" data-instgrm-version=\"14\" style=\" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);\"><div style=\"padding:16px;\"> <a href=\"https://www.instagram.com/p/CPuZ2f4AA4U/?utm_source=ig_embed&amp;utm_campaign=loading\" style=\" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;\" target=\"_blank\"> <div style=\" display: flex; flex-direction: row; align-items: center;\"> <div style=\"background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;\"></div> <div style=\"display: flex; flex-direction: column; flex-grow: 1; justify-content: center;\"> <div style=\" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;\"></div> <div style=\" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;\"></div></div></div><div style=\"padding: 19% 0;\"></div> <div style=\"display:block; height:50px; margin:0 auto 12px; width:50px;\"><svg width=\"50px\" height=\"50px\" viewBox=\"0 0 60 60\" version=\"1.1\" xmlns=\"https://www.w3.org/2000/svg\" xmlns:xlink=\"https://www.w3.org/1999/xlink\"><g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\"><g transform=\"translate(-511.000000, -20.000000)\" fill=\"#000000\"><g><path d=\"M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631\"></path></g></g></g></svg></div><div style=\"padding-top: 8px;\"> <div style=\" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;\">View this post on Instagram</div></div><div style=\"padding: 12.5% 0;\"></div> <div style=\"display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;\"><div> <div style=\"background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);\"></div> <div style=\"background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;\"></div> <div style=\"background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);\"></div></div><div style=\"margin-left: 8px;\"> <div style=\" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;\"></div> <div style=\" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)\"></div></div><div style=\"margin-left: auto;\"> <div style=\" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);\"></div> <div style=\" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);\"></div> <div style=\" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);\"></div></div></div> <div style=\"display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;\"> <div style=\" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;\"></div> <div style=\" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;\"></div></div></a><p style=\" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;\"><a href=\"https://www.instagram.com/p/CPuZ2f4AA4U/?utm_source=ig_embed&amp;utm_campaign=loading\" style=\" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;\" target=\"_blank\">A post shared by KORMI JATIM (@kormijatim)</a></p></div></blockquote> <script async src=\"//www.instagram.com/embed.js\"></script>',	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `slides`;
CREATE TABLE `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `sub_judul` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `loc_text` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `slides` (`id`, `judul`, `sub_judul`, `gambar`, `loc_text`, `status`) VALUES
(3,	'Atlet Olahraga',	'Persiapan Sea Games',	'beab76da6766b1876a3c54e25e8df53142485962.jpeg',	'left',	1),
(4,	'Atlet Olahraga',	'Persiapan Sea Games',	'54b121bc8275dda53553ee3c336ea2a782ac5393.png',	'right',	1),
(5,	'Atlet Olahraga',	'Persiapan Sea Games',	'54b121bc8275dda53553ee3c336ea2a782ac5393.png',	'center',	1);

DROP TABLE IF EXISTS `struktur_organisasi`;
CREATE TABLE `struktur_organisasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `struktur_organisasi` (`id`, `nama`, `jabatan`, `foto`, `flag`) VALUES
(8,	'Nama CEO',	'CEO',	'8e273818001784e2fcb0c98f68f35daeba21d506.jpeg',	0);

DROP TABLE IF EXISTS `toko`;
CREATE TABLE `toko` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat` text NOT NULL,
  `no_whatsapp` varchar(18) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `toko_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `confirm` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `pin` varchar(8) DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `secret_token` varchar(255) DEFAULT NULL,
  `visible_token` varchar(255) DEFAULT NULL,
  `nomor_handphone` varchar(20) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL,
  `secret_link` varchar(255) DEFAULT NULL,
  `secret_at` datetime DEFAULT NULL,
  `secret_is_used` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id`, `username`, `password`, `name`, `role_id`, `confirm`, `status`, `pin`, `photo_url`, `secret_token`, `visible_token`, `nomor_handphone`, `last_login`, `last_logout`, `secret_link`, `secret_at`, `secret_is_used`) VALUES
(1,	'admin@admin.com',	'$2y$13$ld9QJh6MUeyC1IFJf8lxP.Mq9512dhGc/67pTMRacZdItrGZHA8oW',	'Administrator',	1,	1,	1,	NULL,	'default.png',	'ISALAMMTYyNzIrSkNULU1vT0xHNXNIKzNQNk51NWFFS2_mpzQv_V2UGJiQk1hWnROUXR5Y2ZpVGtLeWpPKzE1NjYzS3CRETKEY',	NULL,	'6289658798162',	'2022-03-22 10:29:49',	'2022-03-22 13:49:59',	NULL,	NULL,	NULL),
(2,	'user',	'ee11cbb19052e40b07aac0ca060c23ee',	'Regular User',	3,	1,	1,	NULL,	'default.png',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(3,	'budi@gmail.com',	'21232f297a57a5a743894a0e4a801fc3',	'budi@gmail.com',	3,	0,	1,	NULL,	'default.png',	NULL,	NULL,	'0876786876',	NULL,	'2022-02-10 15:24:18',	NULL,	NULL,	NULL),
(4,	'budi1@gmail.com',	'827ccb0eea8a706c4c34a16891f84e7b',	'Name budi',	3,	0,	1,	NULL,	'default.png',	NULL,	NULL,	'08767868761',	NULL,	NULL,	NULL,	NULL,	NULL),
(11,	'fachruwildan13@gmail.com',	'81dc9bdb52d04dc20036dbd8313ed055',	'fachru wildans',	3,	0,	1,	NULL,	'default.png',	NULL,	NULL,	'089658798125',	NULL,	NULL,	NULL,	NULL,	NULL),
(14,	'fachruwildan1@gmail.com',	'$2y$13$ld9QJh6MUeyC1IFJf8lxP.Mq9512dhGc/67pTMRacZdItrGZHA8oW',	'fachru wildans',	3,	1,	1,	NULL,	'default.png',	NULL,	NULL,	'0896587981254',	'2022-03-14 11:59:26',	'2022-03-16 11:16:35',	NULL,	NULL,	NULL),
(51,	'admin2@admin.com',	'$2y$13$ld9QJh6MUeyC1IFJf8lxP.Mq9512dhGc/67pTMRacZdItrGZHA8oW',	'Administrator',	1,	1,	1,	NULL,	'default.png',	'ISALAMMTYyNzIrSkNULU1vT0xHNXNIKzNQNk51NWFFS2_mpzQv_V2UGJiQk1hWnROUXR5Y2ZpVGtLeWpPKzE1NjYzS3CRETKEY',	NULL,	'6289658798162',	'2022-03-14 09:53:32',	'2022-03-14 09:54:39',	NULL,	NULL,	NULL),
(52,	'wildansa@gmail.com',	'$2y$13$P237zH4UifOaLyNnI.R6hOytzEo9h.R2jA5nYf06axAp/5pItu8I2',	'wildanasdsa',	3,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'1232131231231',	'2022-03-22 10:26:12',	'2022-03-22 10:29:35',	NULL,	NULL,	NULL),
(53,	'wildanss@gmail.com',	'$2y$13$dAyg3ZZutrU2UapTzx5iKuNOA0b1h58OYdFDpjhsJt6Qjw1AO9.dq',	'wildans',	3,	1,	1,	NULL,	NULL,	NULL,	NULL,	'12312312312',	'2022-03-22 09:27:58',	'2022-03-22 10:16:04',	NULL,	NULL,	NULL),
(54,	'wildannnn@gmail.com',	'$2y$13$Z1Ftq3/GOQ4g.07VFFqR4eY1DZezTy2A7GJKyCkV9eZKrCRYkEpnO',	'wildannnnn',	3,	1,	1,	NULL,	NULL,	NULL,	NULL,	'1231231231',	NULL,	NULL,	NULL,	NULL,	NULL),
(55,	'will@gmail.com',	'$2y$13$.ouENobU395UQDz3x6AHWOQK.bXmicPxbc2hMOY5Gshb3LhTEwH8C',	'will',	3,	1,	1,	NULL,	NULL,	NULL,	NULL,	'1233333332222',	NULL,	NULL,	NULL,	NULL,	NULL),
(56,	'wilsss@gmail.com',	'$2y$13$eJkb0rwQjdQHDChTiIUbMeIc8g7WzWRrt95apAm5P339dODLugr86',	'wildannn',	3,	1,	1,	NULL,	NULL,	NULL,	NULL,	'1234567876',	NULL,	NULL,	NULL,	NULL,	NULL),
(57,	'asdasda@gmail.com',	'$2y$13$5zK2QOZaOSVG6s.EVB1FLe219F52/rhqYL4x1rAgmLQ9Eao/1XJ3K',	'asdsa',	3,	1,	1,	NULL,	NULL,	NULL,	NULL,	'21312312312312',	NULL,	NULL,	NULL,	NULL,	NULL);

-- 2022-03-23 04:19:27
