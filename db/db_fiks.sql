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
(214,	'produk',	'index',	'Index'),
(215,	'produk',	'view',	'View'),
(216,	'produk',	'create',	'Create'),
(217,	'produk',	'update',	'Update'),
(218,	'produk',	'delete',	'Delete'),
(219,	'toko',	'index',	'Index'),
(220,	'toko',	'view',	'View'),
(221,	'toko',	'create',	'Create'),
(222,	'toko',	'update',	'Update'),
(223,	'toko',	'delete',	'Delete');

DROP TABLE IF EXISTS `foto_produk`;
CREATE TABLE `foto_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `produk_id` (`produk_id`),
  CONSTRAINT `foto_produk_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `foto_produk` (`id`, `foto`, `produk_id`, `flag`) VALUES
(1,	'6JgYop-U4lUI7I3qAf2e3bLxQgqao-Xy.jpeg',	2,	0),
(2,	'FCjlx9akw3faG29erOmsvLRxO9zhh5h7.jpeg',	2,	0);

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
(2,	'Sepak Bola',	'0aae8b17d1dd41e12fad4f6effb0e6ce745cdd5e.jpeg',	NULL,	0);

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
(9,	'Van Gurt',	NULL,	'vangurt@wadejcollc.com',	'Greetings, \r\n \r\nMy Name is Van Gurt. I am writing to extend a business request for an investment opportunity. \r\n \r\nI will provide exclusive details to you upon your acceptance and response to van.gurt111@gmail.com \r\n \r\nSincerely, \r\nVan Gurt \r\nvan.gurt111@gmail.com \r\nVGPG',	0,	'2022-04-14 11:48:07',	NULL),
(10,	'Henrygog',	NULL,	'watchongers@yahoo.com',	'Thousands of bucks are guaranteed if you use this robot. \r\nhttps://profit-gold-strategy.life/?u=bdlkd0x&o=x7t8nng',	0,	'2022-04-15 12:47:42',	NULL),
(11,	'Henrygog',	NULL,	'watchongers@yahoo.com',	'Thousands of bucks are guaranteed if you use this robot. \r\nhttps://profit-gold-strategy.life/?u=bdlkd0x&o=x7t8nng',	0,	'2022-04-15 12:47:46',	NULL),
(12,	'Henrygog',	NULL,	'watchongers@yahoo.com',	'Thousands of bucks are guaranteed if you use this robot. \r\nhttps://profit-gold-strategy.life/?u=bdlkd0x&o=x7t8nng',	0,	'2022-04-15 12:47:50',	NULL),
(13,	'Henrygog',	NULL,	'watchongers@yahoo.com',	'Thousands of bucks are guaranteed if you use this robot. \r\nhttps://profit-gold-strategy.life/?u=bdlkd0x&o=x7t8nng',	0,	'2022-04-15 12:47:56',	NULL),
(14,	'Henrygog',	NULL,	'watchongers@yahoo.com',	'Thousands of bucks are guaranteed if you use this robot. \r\nhttps://profit-gold-strategy.life/?u=bdlkd0x&o=x7t8nng',	0,	'2022-04-15 12:48:03',	NULL),
(15,	'AlbertmicNT',	NULL,	'f.ort.h.i.sw.esu.f.f.e.r.@gmail.com',	'<a href=\"https://toronto-alcohol-delivery.com/\">Toronto Alcohol Delivery Service</a> \r\nToronto Alcohol Delivery - an approved firm that delivers beer, liquor, wine, alcohol, dial-a-bottle, spirits, mix, soda, and other alcohol to private households around Toronto, Mississauga, Brampton, Richmond Hill, Vaughan, Markham, etc. \r\n \r\nCall +1 (647) 800-00-66 to take advantage of our quick and courteous bottle delivery service in Toronto. We offer a wide selection of beer and liquor products that may be included in your beer and liquor delivery order. If you are unsure about any item, our representatives will be happy to assist you in the selection process. \r\n \r\nContact our Toronto operators at +1 (647) 800-00-66, and they will explain how the <a href=\"https://toronto-alcohol-delivery.com/\">dial-a-bottle</a> service works and answer any questions you may have. \r\n \r\nOur Smart Serve certified drivers are dedicated to offering exceptional and pleasant Toronto Alcohol Delivery service by delivering all orders to your door within 45 minutes while maintaining your privacy and confidentiality.',	0,	'2022-04-15 14:22:26',	NULL),
(16,	'lorem\'',	NULL,	'defrindr@gmail.com',	'-',	0,	'2022-04-16 02:07:09',	NULL),
(17,	'AlbertmicNT',	NULL,	'fo.rth.is.w.e.s.u.ffer@gmail.com',	'<a href=\"https://toronto-alcohol-delivery.com/\">Toronto Alcohol Delivery Service</a> \r\nToronto Alcohol Delivery - an approved firm that delivers beer, liquor, wine, alcohol, dial-a-bottle, spirits, mix, soda, and other alcohol to private households around Toronto, Mississauga, Brampton, Richmond Hill, Vaughan, Markham, etc. \r\n \r\nCall +1 (647) 800-00-66 to take advantage of our quick and courteous bottle delivery service in Toronto. We offer a wide selection of beer and liquor products that may be included in your beer and liquor delivery order. If you are unsure about any item, our representatives will be happy to assist you in the selection process. \r\n \r\nContact our Toronto operators at +1 (647) 800-00-66, and they will explain how the <a href=\"https://toronto-alcohol-delivery.com/\">dial-a-bottle</a> service works and answer any questions you may have. \r\n \r\nOur Smart Serve certified drivers are dedicated to offering exceptional and pleasant Toronto Alcohol Delivery service by delivering all orders to your door within 45 minutes while maintaining your privacy and confidentiality.',	0,	'2022-04-16 05:38:00',	NULL),
(18,	'AghfuirOceafFC',	NULL,	'korobkinalena32@mail.ru',	'Зубцов А.|Тронин обвинялся в совершении двух преступлений, предусмотренных ч.|Реализуя свой преступный умысел, Тронин пришел на участок местности, расположенный с северной стороны домовладения, где произрастали кусты дикорастущей конопли марихуаны.|Затем обвиняемый собрал листья и стебли дикорастущей конопли марихуаны , которые сложил в принесенный с собой полимерный пакет.|Суммарная масса вещества,<a href=https://hydraxmarket.com>tor browser 32 bit mac вход на гидру </a> являющегося каннабисом марихуаной , составляет граммов, что образует крупный размер.|На другой день у Тронина вновь возник преступный умысел на незаконное приобретение и хранение наркотического средства без цели сбыта.|Реализуя свой преступный умысел, Тронин пришел на участок, расположенный в северо-западном направлении от гаражного кооператива, где произрастали кусты дикорастущей конопли марихуаны.|Затем обвиняемый собрал листья и стебли дикорастущей конопли марихуаны , которые сложил в найденный на дороге полимерный пакет.|Суммарная масса вещества, являющегося каннабисом марихуаной , составляла ,76 грамма, что образует крупный размер.|В результате суд признал Тронина виновным в совершении указанных преступлений.|Зарегистрируйтесь и получите пробный доступ к системе КонсультантПлюс бесплатно на 2 дня <a href=https://hydraxmarket.com>как качать торренты через тор браузер hyrda </a> Открыть документ в вашей системе КонсультантПлюс: Попова Е.|Подготовлен для системы КонсультантПлюс, При этом суд указал, что в сформулированном органом дознания обвинении по незаконному приобретению и хранению без цели сбыта растений, содержащих наркотические средства, в значительном размере не указано количество, вес и размер приобретенного подсудимым дикорастущего растения - конопли, а вес и размер указан в отношении наркотического средства - каннабиса марихуаны ; измельчение, высушивание или растирание наркотикосодержащих растений, в результате чего не меняется химическая структура вещества, не могут рассматриваться как изготовление наркотических средств.|Нормативные акты: Каннабис размер.   ',	0,	'2022-04-16 09:01:55',	NULL),
(19,	'EverettMayogGI',	NULL,	'grushina.manya@mail.ru',	'Официальный сайт Государственного Военного госпиталя Китая. \r\nПервый государственный военный госпиталь в Китае, получивший лицензию на прием иностранных граждан. Профессиональный коллектив которого проводит лечение пациентов и обучение иностранных студентов для прохождения интернатуры и клинической ординатуры. Китайские врачи работают с больными, страдающими от различных тяжелых и хронических заболеваний. В знак признания выдающегося результатов в области обслуживания международных пациентов с 1947 года китайское правительство наградило госпиталь званием «Международный госпиталь Далянь Красного Креста» в июне 2015. В июле 2016 года, был получен особый статус — «Международный госпиталь традиционной китайской медицины Красного Креста ». В 2021 году, во время пандемии короновируса, госпиталь начал провдить программы удаленного лечения, с помощью видео консультации с профессорами и отправки китайских лекарств пациентам почтой. \r\nРекомендации и назначение плана удаленного <a href=https://medchina.kz/diagnozy/lechenie-zubov-v-kitae/>лечение в китае</a>\r\n  лечения для иностранных пациентов составляются индивидуально и бесплатно. \r\n \r\n \r\n \r\n \r\nRHzs43hgndIpuiSy',	0,	'2022-04-16 18:43:06',	NULL),
(20,	'AlbertmicNT',	NULL,	'f.orthi.swe.su.f.f.e.r@gmail.com',	'<a href=\"https://toronto-alcohol-delivery.com/\">Toronto Alcohol Delivery Service</a> \r\nToronto Alcohol Delivery - an approved firm that delivers beer, liquor, wine, alcohol, dial-a-bottle, spirits, mix, soda, and other alcohol to private households around Toronto, Mississauga, Brampton, Richmond Hill, Vaughan, Markham, etc. \r\n \r\nCall +1 (647) 800-00-66 to take advantage of our quick and courteous bottle delivery service in Toronto. We offer a wide selection of beer and liquor products that may be included in your beer and liquor delivery order. If you are unsure about any item, our representatives will be happy to assist you in the selection process. \r\n \r\nContact our Toronto operators at +1 (647) 800-00-66, and they will explain how the <a href=\"https://toronto-alcohol-delivery.com/\">dial-a-bottle</a> service works and answer any questions you may have. \r\n \r\nOur Smart Serve certified drivers are dedicated to offering exceptional and pleasant Toronto Alcohol Delivery service by delivering all orders to your door within 45 minutes while maintaining your privacy and confidentiality.',	0,	'2022-04-16 19:50:21',	NULL),
(21,	'Henrygog',	NULL,	'ca686@yahoo.com',	'Trust the financial Bot to become rich. \r\nhttps://profit-gold-strategy.life/?u=bdlkd0x&o=x7t8nng',	0,	'2022-04-16 21:31:39',	NULL),
(22,	'Henrygog',	NULL,	'ssmith@yahoo.com',	'Attention! Financial robot may bring you millions! https://deruyteryachting.nl/gotodate/go',	0,	'2022-04-17 02:13:06',	NULL),
(23,	'Henrygog',	NULL,	'ssmith@yahoo.com',	'Attention! Financial robot may bring you millions! https://deruyteryachting.nl/gotodate/go',	0,	'2022-04-17 02:13:12',	NULL),
(24,	'Henrygog',	NULL,	'ssmith@yahoo.com',	'Attention! Financial robot may bring you millions! https://deruyteryachting.nl/gotodate/go',	0,	'2022-04-17 02:13:23',	NULL),
(25,	'Henrygog',	NULL,	'rudi.mlajsi@gmail.com',	'The best online investment tool is found. Learn more! https://deruyteryachting.nl/gotodate/go',	0,	'2022-04-18 12:19:06',	NULL),
(26,	'Henrygog',	NULL,	'rudi.mlajsi@gmail.com',	'The best online investment tool is found. Learn more! https://deruyteryachting.nl/gotodate/go',	0,	'2022-04-18 12:19:11',	NULL),
(27,	'Henrygog',	NULL,	'rudi.mlajsi@gmail.com',	'The best online investment tool is found. Learn more! https://deruyteryachting.nl/gotodate/go',	0,	'2022-04-18 12:19:17',	NULL),
(28,	'Henrygog',	NULL,	'rudi.mlajsi@gmail.com',	'The best online investment tool is found. Learn more! https://deruyteryachting.nl/gotodate/go',	0,	'2022-04-18 12:19:29',	NULL),
(29,	'Henrygog',	NULL,	'rudi.mlajsi@gmail.com',	'The best online investment tool is found. Learn more! https://deruyteryachting.nl/gotodate/go',	0,	'2022-04-18 12:19:32',	NULL),
(30,	'BobbyRowHI',	NULL,	'jvdmjyriyl@ggowzdhrw.xmail.bond',	'bea baylor alexis grams arctic survival shoulder height <a href=https://mvid.top/video/deze+pedofiel>deze pedofiel</a> 1602 culbreath amidst holder screen recording faqs eligibility dundas nyfw',	0,	'2022-04-18 16:28:47',	NULL),
(31,	'Henrygog',	NULL,	'compcam58@yahoo.com',	'Make your laptop a financial instrument with this program. https://deruyteryachting.nl/gotodate/go',	0,	'2022-04-19 05:33:42',	NULL),
(32,	'Henrygog',	NULL,	'compcam58@yahoo.com',	'Make your laptop a financial instrument with this program. https://deruyteryachting.nl/gotodate/go',	0,	'2022-04-19 05:33:46',	NULL),
(33,	'Henrygog',	NULL,	'compcam58@yahoo.com',	'Make your laptop a financial instrument with this program. https://deruyteryachting.nl/gotodate/go',	0,	'2022-04-19 05:33:49',	NULL),
(34,	'Henrygog',	NULL,	'compcam58@yahoo.com',	'Make your laptop a financial instrument with this program. https://deruyteryachting.nl/gotodate/go',	0,	'2022-04-19 05:33:52',	NULL),
(35,	'Henrygog',	NULL,	'compcam58@yahoo.com',	'Make your laptop a financial instrument with this program. https://deruyteryachting.nl/gotodate/go',	0,	'2022-04-19 05:33:57',	NULL),
(36,	'BrentPlolaZO',	NULL,	'f.ort.h.i.s.w.esuf.fe.r.@gmail.com',	'<b>Professional <a href=\"https://alcohol-delivery-toronto.ca/\">Alcohol Delivery Service</a></b> \r\n \r\nAlcohol delivery is available 24 hours a day, seven days a week. \r\nWhether you’re having a noon brunch or a late-night drink, <a href=\"https://alcohol-delivery-toronto.ca/\">Alcohol Delivery Toronto</a>. \r\nDelivers choice drinks to your door, so you never have to worry about the alhocohol shop shutting early.',	0,	'2022-04-19 08:19:19',	NULL),
(37,	'OAMatthewVG',	NULL,	'jefferydax8745@gmail.com',	'Read please our <a href=http://caidenciuq372.huicopper.com/best-office-chair-for-tall-person>topic</a>',	0,	'2022-04-19 18:45:15',	NULL),
(38,	'Henrygog',	NULL,	'cobb.shar@yahoo.com',	'Financial robot is your success formula is found. Learn more about it. https://get-profitshere.life/?u=bdlkd0x&o=x7t8nng',	0,	'2022-04-21 01:11:22',	NULL),
(39,	'Henrygog',	NULL,	'cobb.shar@yahoo.com',	'Financial robot is your success formula is found. Learn more about it. https://get-profitshere.life/?u=bdlkd0x&o=x7t8nng',	0,	'2022-04-21 01:11:50',	NULL),
(40,	'Henrygog',	NULL,	'cobb.shar@yahoo.com',	'Financial robot is your success formula is found. Learn more about it. https://get-profitshere.life/?u=bdlkd0x&o=x7t8nng',	0,	'2022-04-21 01:11:55',	NULL),
(41,	'Henrygog',	NULL,	'cobb.shar@yahoo.com',	'Financial robot is your success formula is found. Learn more about it. https://get-profitshere.life/?u=bdlkd0x&o=x7t8nng',	0,	'2022-04-21 01:11:59',	NULL),
(42,	'Henrygog',	NULL,	'cobb.shar@yahoo.com',	'Financial robot is your success formula is found. Learn more about it. https://get-profitshere.life/?u=bdlkd0x&o=x7t8nng',	0,	'2022-04-21 01:12:02',	NULL),
(43,	'world-crypt-daQI',	NULL,	'georgegrant@crypt-world-ar.site',	'<a href=https://world-crypt-da.site>bedste kryptovaluta</a>\r\n \r\nDenmark is included in the record of countries where simpatico conditions receive been created for the development of cryptocurrency business. A ample hundred of cryptocurrency exchanges control here, and the trade and trading of understood currency is not prohibited. Notwithstanding, village legislation does not govern this buy in any way. The Danish authorities allow the capitalize on of bitcoins and altcoins as a payment factor, asset or commodity. But cryptocurrencies are not legitimate row-boat and no one of a kind legislation applies to them. The papal bull of accepted currency in Denmark instantly depends on the plan of the transaction and what function crypto plays in it. \r\n<a href=https://world-crypt-da.site>kina kryptovaluta</a>\r\n',	0,	'2022-04-21 13:31:35',	NULL),
(44,	'Henrygog',	NULL,	'CT0221@AIM.COM',	'Launch the best investment instrument to start making money today. \r\nhttps://get-profitshere.life/?u=bdlkd0x&o=x7t8nng',	0,	'2022-04-21 13:53:05',	NULL),
(45,	'Henrygog',	NULL,	'matthew.jenkins279@gmail.com',	'# 1 financial expert in the net! Check out the new Robot. \r\nhttps://get-profitshere.life/?u=bdlkd0x&o=x7t8nng',	0,	'2022-04-21 19:15:44',	NULL),
(46,	'Henrygog',	NULL,	'timforeman12@myemail.com',	'Financial robot is the best companion of rich people. \r\nhttps://get-profitshere.life/?u=bdlkd0x&o=x7t8nng',	0,	'2022-04-22 00:15:15',	NULL),
(47,	'Henrygog',	NULL,	'suja02@gmail.com',	'Let your money grow into the capital with this Robot. \r\nhttps://get-profitshere.life/?u=bdlkd0x&o=x7t8nng',	0,	'2022-04-22 05:16:08',	NULL),
(48,	'Henrygog',	NULL,	'rabbitt0ro@yahoo.com',	'The online job can bring you a fantastic profit. \r\nhttps://get-profitshere.life/?u=bdlkd0x&o=x7t8nng',	0,	'2022-04-22 10:15:04',	NULL),
(49,	'BrentPlolaZO',	NULL,	'fo.r.thi.swe.s.uf.f.e.r.@gmail.com',	'<b>Professional <a href=\"https://alcohol-delivery-toronto.ca/\">Alcohol Delivery Service</a></b> \r\n \r\nAlcohol delivery is available 24 hours a day, seven days a week. \r\nWhether you’re having a noon brunch or a late-night drink, <a href=\"https://alcohol-delivery-toronto.ca/\">Alcohol Delivery Toronto</a>. \r\nDelivers choice drinks to your door, so you never have to worry about the alhocohol shop shutting early.',	0,	'2022-04-22 16:17:31',	NULL),
(50,	'Henrygog',	NULL,	'amckay@nsps.us',	'The huge income without investments is available. \r\nhttps://get-profitshere.life/?u=bdlkd0x&o=x7t8nng',	0,	'2022-04-22 16:17:54',	NULL),
(51,	'Henrygog',	NULL,	'secertlover21@yahoo.com',	'We have found the fastest way to be rich. Find it out here. \r\nhttps://get-profitshere.life/?u=bdlkd0x&o=x7t8nng',	0,	'2022-04-22 21:17:04',	NULL),
(52,	'BrentPlolaZO',	NULL,	'fo.r.th.isw.esu.ff.e.r@gmail.com',	'<b>Professional <a href=\"https://alcohol-delivery-toronto.ca/\">Alcohol Delivery Service</a></b> \r\n \r\nAlcohol delivery is available 24 hours a day, seven days a week. \r\nWhether you’re having a noon brunch or a late-night drink, <a href=\"https://alcohol-delivery-toronto.ca/\">Alcohol Delivery Toronto</a>. \r\nDelivers choice drinks to your door, so you never have to worry about the alhocohol shop shutting early.',	0,	'2022-04-23 01:01:26',	NULL),
(53,	'Henrygog',	NULL,	'babudoom@gmail.com',	'Make your computer to be you earning instrument. \r\nhttps://get-profitshere.life/?u=bdlkd0x&o=x7t8nng',	0,	'2022-04-23 02:39:56',	NULL),
(54,	'Henrygog',	NULL,	'ozlem_cakir76@hotmail.com',	'Have no money? It’s easy to earn them online here. \r\nhttps://get-profitshere.life/?u=bdlkd0x&o=x7t8nng',	0,	'2022-04-23 07:37:36',	NULL),
(55,	'BrentPlolaZO',	NULL,	'for.thiswes.u.ffe.r.@gmail.com',	'<b>Professional <a href=\"https://alcohol-delivery-toronto.ca/\">Alcohol Delivery Service</a></b> \r\n \r\nAlcohol delivery is available 24 hours a day, seven days a week. \r\nWhether you’re having a noon brunch or a late-night drink, <a href=\"https://alcohol-delivery-toronto.ca/\">Alcohol Delivery Toronto</a>. \r\nDelivers choice drinks to your door, so you never have to worry about the alhocohol shop shutting early.',	0,	'2022-04-23 09:32:06',	NULL),
(56,	'Henrygog',	NULL,	'djhalin@aol.com',	'Automatic robot is the best start for financial independence. https://take-profitnow.life/?u=bdlkd0x&o=x7t8nng ',	0,	'2022-04-23 12:34:34',	NULL),
(57,	'Henrygog',	NULL,	'lfalkenhagen32@yahoo.com',	'Wow! This is a fastest way for a financial independence. https://take-profitnow.life/?u=bdlkd0x&o=x7t8nng ',	0,	'2022-04-23 17:28:56',	NULL),
(58,	'Henrygog',	NULL,	'rollasystem@yahoo.com',	'Most successful people already use Robot. Do you? https://take-profitnow.life/?u=bdlkd0x&o=x7t8nng ',	0,	'2022-04-23 22:25:35',	NULL),
(59,	'Henrygog',	NULL,	'martelm@nychhc.org',	'We know how to increase your financial stability. https://take-profitnow.life/?u=bdlkd0x&o=x7t8nng ',	0,	'2022-04-24 03:22:36',	NULL),
(60,	'Henrygog',	NULL,	'KATHYMALM@HOTMAIL.COM',	'The fastest way to make your wallet thick is found. https://take-profitnow.life/?u=bdlkd0x&o=x7t8nng ',	0,	'2022-04-24 08:21:57',	NULL),
(61,	'Henrygog',	NULL,	'wjmdcm@mail2world.com',	'Perhatian! Di sini Anda bisa mendapatkan uang secara online! https://take-profitnow.life/?u=bdlkd0x&o=x7t8nng ',	0,	'2022-04-24 13:22:43',	NULL),
(62,	'Eric Jones',	NULL,	'eric.jones.z.mail@gmail.com',	'Hi, my name is Eric and I’m betting you’d like your website ikmbatu.com to generate more leads.\r\n\r\nHere’s how:\r\nTalk With Web Visitor is a software widget that’s works on your site, ready to capture any visitor’s Name, Email address and Phone Number.  It signals you as soon as they say they’re interested – so that you can talk to that lead while they’re still there at ikmbatu.com.\r\n\r\nTalk With Web Visitor – CLICK HERE https://jumboleadmagnet.com for a live demo now.\r\n\r\nAnd now that you’ve got their phone number, our new SMS Text With Lead feature enables you to start a text (SMS) conversation – answer questions, provide more info, and close a deal that way.\r\n\r\nIf they don’t take you up on your offer then, just follow up with text messages for new offers, content links, even just “how you doing?” notes to build a relationship.\r\n\r\nCLICK HERE https://jumboleadmagnet.com to discover what Talk With Web Visitor can do for your business.\r\n\r\nThe difference between contacting someone within 5 minutes versus a half-hour means you could be converting up to 100X more leads today!\r\n\r\nTry Talk With Web Visitor and get more leads now.\r\n\r\nEric\r\nPS: The studies show 7 out of 10 visitors don’t hang around – you can’t afford to lose them!\r\nTalk With Web Visitor offers a FREE 14 days trial – and it even includes International Long Distance Calling. \r\nYou have customers waiting to talk with you right now… don’t keep them waiting. \r\nCLICK HERE https://jumboleadmagnet.com to try Talk With Web Visitor now.\r\n\r\nIf you\'d like to unsubscribe click here http://jumboleadmagnet.com/unsubscribe.aspx?d=ikmbatu.com\r\n',	0,	'2022-04-24 18:08:17',	NULL),
(63,	'Henrygog',	NULL,	'lyvonner@yahoo.com',	'Menghasilkan uang sangat mudah jika Anda menggunakan robot keuangan. https://take-profitnow.life/?u=bdlkd0x&o=x7t8nng ',	0,	'2022-04-24 18:41:07',	NULL),
(64,	'BrentPlolaZO',	NULL,	'f.or.this.w.e.s.u.f.fer@gmail.com',	'<b>Professional <a href=\"https://alcohol-delivery-toronto.ca/\">Alcohol Delivery Service</a></b> \r\n \r\nAlcohol delivery is available 24 hours a day, seven days a week. \r\nWhether you’re having a noon brunch or a late-night drink, <a href=\"https://alcohol-delivery-toronto.ca/\">Alcohol Delivery Toronto</a>. \r\nDelivers choice drinks to your door, so you never have to worry about the alhocohol shop shutting early.',	0,	'2022-04-25 04:30:45',	NULL),
(65,	'Henrygog',	NULL,	'eusouscott@gmail.com',	'Robot keuangan menjamin stabilitas dan pendapatan semua orang. https://take-profitnow.life/?u=bdlkd0x&o=x7t8nng ',	0,	'2022-04-25 10:49:26',	NULL),
(66,	'Henrygog',	NULL,	'kandyg_99@yahoo.com',	'Pelajari cara membuat ratusan punggung setiap hari. https://breweriana.it/gotodate/promo ',	0,	'2022-04-25 16:00:53',	NULL),
(67,	'MichaelhoonsRG',	NULL,	'KsenofontMaidanov+2b8d@mail.ru',	'<html> \r\n<a href=\"https://google.com\"><img src=\"https://blogger.googleusercontent.com/img/a/AVvXsEgXM4xrSRAnQQOLZImSaLdACcB-BosbLfsYEsXB-lLBl71Ma4AFA4xbB22ruqkub9W8nQCJVUXuXvJQeNLG2yoUL-OxTbhSvuyduxRSQI5RsQSu6DbfkMCVMuCuRB1uzs4KNkp3gZjcKQeubD_3RZ6p3xDAEpOwy6LnNnGhSa3h4V04dq3zc3oZajp_=s16000\"></a> \r\n</br> \r\nikmbatu.com griufheufhruifejyut5784467489rfugrgjedw0ooegjokoeghtitg3r94tuirjgoerfkeoghiytgjierjtirhyj \r\n</html>',	0,	'2022-04-25 20:42:53',	NULL),
(68,	'Henrygog',	NULL,	'miguel_ceda@yahoo.com',	'Menggunakan Robot ini adalah cara terbaik untuk membuat Anda kaya. https://breweriana.it/gotodate/promo ',	0,	'2022-04-25 21:04:38',	NULL),
(69,	'Henrygog',	NULL,	'erincronin09@yahoo.com',	'Memberikan keluarga Anda dengan uang di usia. Luncurkan Robot! https://breweriana.it/gotodate/promo ',	0,	'2022-04-26 02:04:48',	NULL),
(70,	'Henrygog',	NULL,	'hogenson8373@gmail.com',	'Ubah $ 1 menjadi $ 100 secara instan. Gunakan robot keuangan. https://breweriana.it/gotodate/promo ',	0,	'2022-04-26 07:16:08',	NULL),
(71,	'Henrygog',	NULL,	'dani_shyam20@yahoo.com',	'Kami telah menemukan cara tercepat untuk menjadi kaya. Temukan di sini. https://breweriana.it/gotodate/promo ',	0,	'2022-04-26 12:14:19',	NULL),
(72,	'Henrygog',	NULL,	'viewkaaa_@hotmail.com',	'Bahkan seorang anak tahu cara menghasilkan uang. Robot ini adalah apa yang Anda butuhkan! https://breweriana.it/gotodate/promo ',	0,	'2022-04-26 17:31:15',	NULL),
(73,	'AndrewPsypePE',	NULL,	'forthiswesuffer@gmail.com',	'If you are injured in a car accident in Ontario, \r\nyou are probably entitled to certain “no-fault benefits”, \r\nbut you may also have the right to sue at-fault partiesfor your injuries. \r\nThe right to sue is not unlimited in Ontario. \r\nGet free case consultation and open <a href=\"https://caraccidentlawyertoronto.com/\">car accident injury claim</a>!',	0,	'2022-04-26 19:08:34',	NULL),
(74,	'Henrygog',	NULL,	'queen_mLqe@hotmail.com',	'Butuh uang tunai? Peluncuran robot ini dan melihat apa yang bisa. https://breweriana.it/gotodate/promo ',	0,	'2022-04-26 23:10:41',	NULL),
(75,	'Henrygog',	NULL,	'lancebentley6@gmail.com',	'Perhatian! Di sini Anda bisa mendapatkan uang secara online! https://breweriana.it/gotodate/promo ',	0,	'2022-04-27 04:29:51',	NULL),
(76,	'Henrygog',	NULL,	'sefalhanan@hotmail.com',	'Mulai pekerjaan online Anda menggunakan robot keuangan. https://2f-2f.de/gotodate/promo ',	0,	'2022-04-27 09:57:13',	NULL),
(77,	'Eric Jones',	NULL,	'eric.jones.z.mail@gmail.com',	'Hey there, I just found your site, quick question…\r\n\r\nMy name’s Eric, I found ikmbatu.com after doing a quick search – you showed up near the top of the rankings, so whatever you’re doing for SEO, looks like it’s working well.\r\n\r\nSo here’s my question – what happens AFTER someone lands on your site?  Anything?\r\n\r\nResearch tells us at least 70% of the people who find your site, after a quick once-over, they disappear… forever.\r\n\r\nThat means that all the work and effort you put into getting them to show up, goes down the tubes.\r\n\r\nWhy would you want all that good work – and the great site you’ve built – go to waste?\r\n\r\nBecause the odds are they’ll just skip over calling or even grabbing their phone, leaving you high and dry.\r\n\r\nBut here’s a thought… what if you could make it super-simple for someone to raise their hand, say, “okay, let’s talk” without requiring them to even pull their cell phone from their pocket?\r\n  \r\nYou can – thanks to revolutionary new software that can literally make that first call happen NOW.\r\n\r\nTalk With Web Visitor is a software widget that sits on your site, ready and waiting to capture any visitor’s Name, Email address and Phone Number.  It lets you know IMMEDIATELY – so that you can talk to that lead while they’re still there at your site.\r\n  \r\nYou know, strike when the iron’s hot!\r\n\r\nCLICK HERE https://jumboleadmagnet.com to try out a Live Demo with Talk With Web Visitor now to see exactly how it works.\r\n\r\nWhen targeting leads, you HAVE to act fast – the difference between contacting someone within 5 minutes versus 30 minutes later is huge – like 100 times better!\r\n\r\nThat’s why you should check out our new SMS Text With Lead feature as well… once you’ve captured the phone number of the website visitor, you can automatically kick off a text message (SMS) conversation with them. \r\n \r\nImagine how powerful this could be – even if they don’t take you up on your offer immediately, you can stay in touch with them using text messages to make new offers, provide links to great content, and build your credibility.\r\n\r\nJust this alone could be a game changer to make your website even more effective.\r\n\r\nStrike when  the iron’s hot!\r\n\r\nCLICK HERE https://jumboleadmagnet.com to learn more about everything Talk With Web Visitor can do for your business – you’ll be amazed.\r\n\r\nThanks and keep up the great work!\r\n\r\nEric\r\nPS: Talk With Web Visitor offers a FREE 14 days trial – you could be converting up to 100x more leads immediately!   \r\nIt even includes International Long Distance Calling. \r\nStop wasting money chasing eyeballs that don’t turn into paying customers. \r\nCLICK HERE https://jumboleadmagnet.com to try Talk With Web Visitor now.\r\n\r\nIf you\'d like to unsubscribe click here http://jumboleadmagnet.com/unsubscribe.aspx?d=ikmbatu.com\r\n',	0,	'2022-04-27 13:35:56',	NULL),
(78,	'Henrygog',	NULL,	'slam7275@gmail.com',	'Bahkan seorang anak tahu cara menghasilkan $ 100 hari ini. https://2f-2f.de/gotodate/promo ',	0,	'2022-04-27 15:10:17',	NULL),
(79,	'Henrygog',	NULL,	'rexadclifxyfebriadena@hotmail.com',	'Tidak memiliki keterampilan keuangan? Biarkan Robot menghasilkan uang untuk anda. https://2f-2f.de/gotodate/promo ',	0,	'2022-04-27 20:12:35',	NULL),
(80,	'Vicki',	NULL,	'hr@marksolspl.com',	'World\'s Best Neck Massager Get it Now 50% OFF + Free Shipping!\r\n\r\nWellness Enthusiasts! There has never been a better time to take care of your neck pain! \r\n\r\nOur clinical-grade TENS technology will ensure you have neck relief in as little as 20 minutes.\r\n\r\nGet Yours: https://hineck.online\r\n\r\nBest regards,\r\n\r\nVicki\r\nIKM Jatim',	0,	'2022-04-27 21:16:25',	NULL),
(81,	'Eric Jones',	NULL,	'eric.jones.z.mail@gmail.com',	'Cool website!\r\n\r\nMy name’s Eric, and I just found your site - ikmbatu.com - while surfing the net. You showed up at the top of the search results, so I checked you out. Looks like what you’re doing is pretty cool.\r\n \r\nBut if you don’t mind me asking – after someone like me stumbles across ikmbatu.com, what usually happens?\r\n\r\nIs your site generating leads for your business? \r\n \r\nI’m guessing some, but I also bet you’d like more… studies show that 7 out 10 who land on a site wind up leaving without a trace.\r\n\r\nNot good.\r\n\r\nHere’s a thought – what if there was an easy way for every visitor to “raise their hand” to get a phone call from you INSTANTLY… the second they hit your site and said, “call me now.”\r\n\r\nYou can –\r\n  \r\nTalk With Web Visitor is a software widget that’s works on your site, ready to capture any visitor’s Name, Email address and Phone Number.  It lets you know IMMEDIATELY – so that you can talk to that lead while they’re literally looking over your site.\r\n\r\nCLICK HERE https://jumboleadmagnet.com to try out a Live Demo with Talk With Web Visitor now to see exactly how it works.\r\n\r\nTime is money when it comes to connecting with leads – the difference between contacting someone within 5 minutes versus 30 minutes later can be huge – like 100 times better!\r\n\r\nThat’s why we built out our new SMS Text With Lead feature… because once you’ve captured the visitor’s phone number, you can automatically start a text message (SMS) conversation.\r\n  \r\nThink about the possibilities – even if you don’t close a deal then and there, you can follow up with text messages for new offers, content links, even just “how you doing?” notes to build a relationship.\r\n\r\nWouldn’t that be cool?\r\n\r\nCLICK HERE https://jumboleadmagnet.com to discover what Talk With Web Visitor can do for your business.\r\n\r\nYou could be converting up to 100X more leads today!\r\nEric\r\n\r\nPS: Talk With Web Visitor offers a FREE 14 days trial – and it even includes International Long Distance Calling. \r\nYou have customers waiting to talk with you right now… don’t keep them waiting. \r\nCLICK HERE https://jumboleadmagnet.com to try Talk With Web Visitor now.\r\n\r\nIf you\'d like to unsubscribe click here http://jumboleadmagnet.com/unsubscribe.aspx?d=ikmbatu.com\r\n',	0,	'2022-04-28 00:45:21',	NULL),
(82,	'Henrygog',	NULL,	'MVLehr@att.net',	'Kita tahu bagaimana menjadi kaya dan apakah anda? https://2f-2f.de/gotodate/promo ',	0,	'2022-04-28 01:13:55',	NULL),
(83,	'AndrewPsypePE',	NULL,	'forthiswesuffer@gmail.com',	'If you are injured in a car accident in Ontario, \r\nyou are probably entitled to certain “no-fault benefits”, \r\nbut you may also have the right to sue at-fault partiesfor your injuries. \r\nThe right to sue is not unlimited in Ontario. \r\nGet free case consultation and open <a href=\"https://caraccidentlawyertoronto.com/\">car accident injury claim</a>!',	0,	'2022-04-28 02:36:55',	NULL),
(84,	'Henrygog',	NULL,	'abaffuto2@aol.com',	'Kemandirian finansial adalah apa yang dijamin robot ini. https://2f-2f.de/gotodate/promo ',	0,	'2022-04-28 06:31:57',	NULL),
(85,	'Henrygog',	NULL,	'jessicahennington@yahoo.com',	'Tidak punya uang? Dapatkan secara online. https://2f-2f.de/gotodate/promo ',	0,	'2022-04-28 11:56:39',	NULL),
(86,	'Henrygog',	NULL,	'Caitlinnn32@yahoo.com',	'Pendapatan online adalah cara termudah untuk membuat Anda bermimpi menjadi kenyataan. https://2f-2f.de/gotodate/promo ',	0,	'2022-04-28 16:56:29',	NULL),
(87,	'AndrewPsypePE',	NULL,	'forthiswesuffer@gmail.com',	'If you are injured in a car accident in Ontario, \r\nyou are probably entitled to certain “no-fault benefits”, \r\nbut you may also have the right to sue at-fault partiesfor your injuries. \r\nThe right to sue is not unlimited in Ontario. \r\nGet free case consultation and open <a href=\"https://caraccidentlawyertoronto.com/\">car accident injury claim</a>!',	0,	'2022-04-28 17:28:50',	NULL),
(88,	'Henrygog',	NULL,	'Moustafaahmad16@gmail.com',	'Pelajari cara membuat ratusan punggung setiap hari. https://2f-2f.de/gotodate/promo ',	0,	'2022-04-28 22:03:49',	NULL),
(89,	'AndrewPsypePE',	NULL,	'forthiswesuffer@gmail.com',	'If you are injured in a car accident in Ontario, \r\nyou are probably entitled to certain “no-fault benefits”, \r\nbut you may also have the right to sue at-fault partiesfor your injuries. \r\nThe right to sue is not unlimited in Ontario. \r\nGet free case consultation and open <a href=\"https://caraccidentlawyertoronto.com/\">car accident injury claim</a>!',	0,	'2022-04-29 00:23:51',	NULL),
(90,	'Henrygog',	NULL,	'Lollicoon@me.com',	'Alat investasi Online Terbaik ditemukan. Pelajari lebih lanjut! https://2f-2f.de/gotodate/promo ',	0,	'2022-04-29 03:05:57',	NULL),
(91,	'Henrygog',	NULL,	'jahgaflash@icloud.com',	'Robot keuangan adalah cara yang bagus untuk mengelola dan meningkatkan penghasilan Anda. https://2f-2f.de/gotodate/promo ',	0,	'2022-04-29 08:30:03',	NULL),
(92,	'Henrygog',	NULL,	'chsmom59@yahoo.com',	'Membuat ribuan dolar. Bayar apa-apa. https://2f-2f.de/gotodate/promo ',	0,	'2022-04-29 13:46:12',	NULL),
(93,	'Henrygog',	NULL,	'overlordmao@rocketmail.com',	'Kami tahu cara meningkatkan stabilitas keuangan Anda. https://2f-2f.de/gotodate/promo ',	0,	'2022-04-29 18:50:54',	NULL),
(94,	'Henrygog',	NULL,	'tcredmon@gmail.com',	'Satu dolar bukan apa-apa, tetapi bisa tumbuh menjadi $100 di sini. https://2f-2f.de/gotodate/promo ',	0,	'2022-04-29 23:50:52',	NULL),
(95,	'BeaisholeReLH',	NULL,	'boksijk1@superbox.pl',	'https://www.wakacjejeziorohancza.online \r\nnoclegi nad morzem bon turystyczny gdynia https://www.wakacjejeziorohancza.online/gra-noclegi-noclegi-agroturystyka-podlaskie-podlaskie',	0,	'2022-04-30 03:59:32',	NULL),
(96,	'Henrygog',	NULL,	'cookiesandcream1994@hotmail.com',	'Robot ini dapat membawa Anda uang 24/7. https://2f-2f.de/gotodate/promo ',	0,	'2022-04-30 05:05:06',	NULL),
(97,	'Henrygog',	NULL,	'haile.theboy@yahoo.com',	'Mencari uang tambahan? Cobalah instrumen keuangan terbaik. https://2f-2f.de/gotodate/promo ',	0,	'2022-04-30 10:26:31',	NULL),
(98,	'Regena',	NULL,	'pub.momo@wanadoo.fr',	'Hi \r\n\r\nDon\'t you hate carrying a big bulky backpack when you are only going out for the day? This high quality shoulder bag solves that problem. \r\nCarry enough without bogging yourself down! Perfect for that fishing trip or day hike!\r\n\r\n50% OFF for the next 24 Hours ONLY + FREE Worldwide Shipping for a LIMITED time\r\n\r\nBuy now: https://fashionbag.sale\r\n\r\nKind Regards, \r\n\r\nRegena',	0,	'2022-04-30 15:52:18',	NULL),
(99,	'Henrygog',	NULL,	'abn_a2001@yahoo.com',	'Kemandirian finansial adalah apa yang dijamin robot ini. https://2f-2f.de/gotodate/promo ',	0,	'2022-04-30 16:00:45',	NULL),
(100,	'JennynubJT',	NULL,	'orlenokmisha80@rambler.ru',	'В сетях канализации очень часто устанавливают специфические инженерные сооружения - КНС. Они представляют собой тех.комплекс насосного и вспомогательного оборудования, конкретно: насосы. \r\nУказанные устройства помещается в бака из стеклокомпозитных материалов. КНС длительное время делали из кирпича и бетона - установка таких изделий дорогой. На сегодняшний день все это изготавливают из стеклокомпозитных материалов. \r\n<a href=http://worldhist.ru/club/user/23295/blog/3740/>посетить сайт автора</a> \r\nВажные достоинства канализационных станций из стеклокомпозита не заканчивается легкостью установки на объекты заказчика. Стеклопластики предоставляют продолжительный срок применения бака без отрицательного влияния окружающей среды, гнилостных поражений, ржавчины. Явным достоинством стеклопластиков является присутствие разнообразных марок этого материала. Качественные и количественные показатели стеклопластиков создали явные преимущества в сравнении с обычными строительными составами: стеклом, пластиком, деревом.',	0,	'2022-04-30 18:12:14',	NULL),
(101,	'Henrygog',	NULL,	'sterman14@hotmail.com',	'Menghasilkan uang sangat mudah jika Anda menggunakan robot keuangan. https://2f-2f.de/gotodate/promo ',	0,	'2022-04-30 21:20:43',	NULL),
(102,	'Henrygog',	NULL,	'thewhiteswag@gmail.com',	'Luncurkan robot dan biarkan itu memberi Anda uang. https://2f-2f.de/gotodate/promo ',	0,	'2022-05-01 02:26:28',	NULL),
(103,	'Henrygog',	NULL,	'pimpology8706@yahoo.com',	'Luncurkan bot keuangan sekarang untuk mulai menghasilkan. https://2f-2f.de/gotodate/promo ',	0,	'2022-05-01 08:15:12',	NULL),
(104,	'Henrygog',	NULL,	'c.minniefield@yahoo.com',	'Butuh uang? Robot keuangan adalah solusi Anda. https://2f-2f.de/gotodate/promo ',	0,	'2022-05-01 13:31:40',	NULL),
(105,	'Henrygog',	NULL,	'contact@katrinaelliott.com',	'Butuh uang? Dapatkan di sini dengan mudah! Cukup tekan ini untuk meluncurkan robot. https://2f-2f.de/gotodate/promo ',	0,	'2022-05-01 18:58:15',	NULL),
(106,	'Henrygog',	NULL,	'MusicCityTNBear@gmail.com',	'Membuat ribuan dolar. Bayar apa-apa. https://2f-2f.de/gotodate/promo ',	0,	'2022-05-02 00:31:02',	NULL),
(107,	'NikalBabTC',	NULL,	'sdfx39975@gmail.com',	'https://dompodkluchkirov.ru/vyvoz-zavalov-s-edan/\r\n',	0,	'2022-05-02 01:04:34',	NULL),
(108,	'NormanlaultFE',	NULL,	'jackpeogonich@gmail.com',	'<a href=\"https://disabilitylawyerbrampton.ca/\">Long-term disability insurance plans</a> are complicated and include several requirements. \r\nA lawyer can assist you in filing long-term disability claims, communicating with the insurance company, negotiating a fair settlement, and representing you in court if you file a lawsuit. \r\n \r\n<a href=\"https://disabilitylawyerbrampton.ca/\">Disability Lawyery Brampton</a> have assisted several clients in obtaining payments from insurance companies or the at-fault party. \r\nIf you’ve been unjustly refused disability payments, be assured that our team of experienced attorneys will fight for your rights. \r\n \r\nWe have the means, expertise, and experience to assist you in obtaining the necessary medical and supporting evidence and pursuing other legal alternatives, such as filing a lawsuit. \r\nWe work closely with our customers with individualized service, compassion, attention to detail, and professionalism to provide the best possible outcome. \r\n \r\nWe understand how an accident may affect your health, career, and family. That is why we fight relentlessly to get the best possible compensation for you. \r\nWe are dedicated to providing you with the most satisfactory possible service and interpreting and translating complicated legal matters.',	0,	'2022-05-02 04:57:44',	NULL),
(109,	'Henrygog',	NULL,	'SB130@AOL.COM',	'Pelajari cara membuat ratusan punggung setiap hari. https://2f-2f.de/gotodate/promo ',	0,	'2022-05-02 05:59:38',	NULL),
(110,	'Henrygog',	NULL,	'ziggety@aol.com',	'Kami tahu cara meningkatkan stabilitas keuangan Anda. https://2f-2f.de/gotodate/promo ',	0,	'2022-05-02 11:10:06',	NULL),
(111,	'Henrygog',	NULL,	'annielee20-@hotmail.com',	'Lihat Bot Otomatis, yang berfungsi untuk Anda 24/7. https://2f-2f.de/gotodate/promo ',	0,	'2022-05-02 16:19:51',	NULL),
(112,	'Henrygog',	NULL,	'jenstiernagle@yahoo.com',	'Bot Online akan memberi Anda kekayaan dan kepuasan. https://2f-2f.de/gotodate/promo ',	0,	'2022-05-02 21:46:38',	NULL),
(113,	'Henrygog',	NULL,	'marielpolly@hotmail.com',	'Cobalah robot Otomatis untuk terus mendapatkan penghasilan sepanjang hari. https://2f-2f.de/gotodate/promo ',	0,	'2022-05-03 03:04:39',	NULL),
(114,	'HaroldHurgyHT',	NULL,	'macmonth@optusnet.com.au',	'Earning online from $206 in 24 minutes https://310usd-in25minutes.blogspot.kr/?id2158',	0,	'2022-05-03 05:38:07',	NULL),
(115,	'Henrygog',	NULL,	'deemeyers@msn.com',	'Perhatikan uang Anda tumbuh saat Anda berinvestasi dengan Robot. https://2f-2f.de/gotodate/promo ',	0,	'2022-05-03 08:32:48',	NULL),
(116,	'Henrygog',	NULL,	'kyra.durden@yahoo.com',	'Mulailah menghasilkan ribuan dolar setiap minggu. https://2f-2f.de/gotodate/promo ',	0,	'2022-05-03 14:27:47',	NULL),
(117,	'Henrygog',	NULL,	'janelle_m_murphy@hotmail.com',	'Check out cara terbaru untuk membuat keuntungan yang fantastis. https://2f-2f.de/gotodate/promo ',	0,	'2022-05-03 19:42:02',	NULL),
(118,	'Henrygog',	NULL,	'empasche@yahoo.com',	'Biarkan uang Anda tumbuh menjadi modal dengan Robot ini. https://2f-2f.de/gotodate/promo ',	0,	'2022-05-04 01:08:24',	NULL),
(119,	'Henrygog',	NULL,	'cuteshoes2000@hotmail.com',	'Masih bukan jutawan? Perbaiki sekarang! https://2f-2f.de/gotodate/promo ',	0,	'2022-05-04 06:10:05',	NULL),
(120,	'Henrygog',	NULL,	'tekartdj@hotmail.com',	'Mulai pekerjaan online Anda menggunakan robot keuangan. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-04 11:18:00',	NULL),
(121,	'Henrygog',	NULL,	'jokko@cash.com',	'Bergabunglah dengan masyarakat orang-orang sukses yang menghasilkan uang di sini. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-04 16:24:05',	NULL),
(122,	'Henrygog',	NULL,	'mammie431l@aol.com',	'Hasilkan uang, bukan perang! Robot keuangan adalah apa yang Anda butuhkan. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-04 21:23:14',	NULL),
(123,	'Henrygog',	NULL,	'shatophia_white@yahoo.com',	'Investasi kecil dapat membawa ton Dolar cepat. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-05 02:19:21',	NULL),
(124,	'Dewitt',	NULL,	'pforster@sundevtech.com',	'Hi there \r\n \r\nDefrost frozen foods in minutes safely and naturally with our THAW KING™. \r\n\r\n50% OFF for the next 24 Hours ONLY + FREE Worldwide Shipping for a LIMITED \r\n\r\nBuy now: https://thawking.store\r\n \r\nThanks and Best Regards, \r\n \r\nDewitt',	0,	'2022-05-05 03:45:54',	NULL),
(125,	'Henrygog',	NULL,	'hagenme@mchsi.com',	'Membuat ribuan setiap minggu bekerja online di sini. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-05 05:29:09',	NULL),
(126,	'Henrygog',	NULL,	'saulonicole@hotmail.com;nicole23',	'Robot keuangan adalah alat keuangan paling efektif di Internet! https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-05 11:04:08',	NULL),
(127,	'Henrygog',	NULL,	'rfochek@yahoo.com',	'Luncurkan robot keuangan dan lakukan bisnis anda. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-05 16:03:47',	NULL),
(128,	'RobertsefZE',	NULL,	'jillies10@outlook.com.au',	'Real income on Pinterest from $15,000 per month https://telegra.ph/How-to-make-money-on-pinterest-from-15000-per-month---id358722-05-05',	0,	'2022-05-05 17:24:19',	NULL),
(129,	'Henrygog',	NULL,	'amy_s_sanchez@yahoo.com',	'Setiap orang yang membutuhkan uang harus mencoba Robot ini. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-05 21:24:52',	NULL),
(130,	'Henrygog',	NULL,	'jennmikestanley@comcast.net',	'Membuat Dolar hanya duduk di rumah. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-06 02:22:13',	NULL),
(131,	'Henrygog',	NULL,	'tngcg1@gmail.com',	'Robot keuangan adalah teman terbaik orang kaya. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-06 07:33:01',	NULL),
(132,	'Henrygog',	NULL,	'denzellboham@yahoo.com',	'Penghasilan tambahan untuk semua orang. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-06 12:39:56',	NULL),
(133,	'Henrygog',	NULL,	'sumeetdubey10009@gmail.com',	'Robot keuangan adalah cara yang bagus untuk mengelola dan meningkatkan penghasilan Anda. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-06 17:38:42',	NULL),
(134,	'Henrygog',	NULL,	'wclose123@sbcglobal.net',	'Setiap dolar Anda bisa berubah menjadi $100 setelah Anda makan siang Robot ini. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-06 22:37:48',	NULL),
(135,	'Henrygog',	NULL,	'blazer239@rocketmail.com',	'Ribuan dolar dijamin jika Anda menggunakan robot ini. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-07 03:37:26',	NULL),
(136,	'Henrygog',	NULL,	'Jesse_Radike@gmail.com',	'Masih bukan jutawan? Robot keuangan akan membuat Anda dia! https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-07 08:46:07',	NULL),
(137,	'Henrygog',	NULL,	'4chocolate@gmail.com',	'Pekerjaan Online bisa sangat efektif jika Anda menggunakan Robot ini. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-07 14:05:00',	NULL),
(138,	'VasyaPhiftCN',	NULL,	'contabo_mer@outlook.com',	' \r\n \r\n \r\n<a href=https://adoctor247.com/wp-content/lib/in-person-warnings-issued-again-as-illinois-sets-records.html>online</a>\r\n<a href=http://nnvision6000.com/wp-content/lib/festive-fun-with-microgaming.html>online</a>\r\n<a href=https://mulherdodigital.com.br/wp-content/lib/jimi-hendrix-slot-machine-play-for-free.html>online</a>\r\n<a href=https://softmixportal.com/netherlands-strives-for-online-safety-with-remote-gambling-bill-adoption.html>marksville la casino</a>\r\n<a href=https://cracksoftonline.com/phoenix-fire-slot-machine-play-for-free.html>snabbare casino</a>\r\n<a href=https://missoldcarfinance.com/wp-content/lib/dragon-kingdom-slot-machine-play-for-free.html>online</a>\r\n<a href=http://hollywoodjesus.thrivenly.com/wp-content/lib/mermaids-millions-slot-machine-play-for-free.html>aquarius casino resort</a>\r\n<a href=https://bongoulb.com/wp-content/lib/explosive-reels-slot-machine-from-gameart-play-for-free.html>casinos in california</a>\r\n<a href=https://blissfulexplorer.com/wp-content/lib/la-meilleure-machine-a-sous-lutin-en-ligne-cinq-candidats-meritants.html>online</a>\r\n<a href=http://rkenterprize.in/wp-content/lib/baccara-gratuit-jeux-francais-sans-telechargement-en-ligne.html>online</a>\r\n \r\n \r\nThe Grand Villa Casino in Edmonton, Canada will see dozens of workers laid off as part of a restructuring addressing slow economy.\r\nвЂњStakelogic is taking the industry by storm so it was an absolute must for us to add its full suite of slots to our market-leading casino game lobby,вЂќ stated Oleh Moroz, head of gambling business development of Parimatch.\r\nOne interesting proposal by Allwyn is to reduce ticket prices to ВЈ1 ($1.3) and have two draws on the same night. Currently, the price for one ticket is ВЈ2 ($2.6).\r\nHeathcliff Farrugia, MGA CEO, added: вЂњThis is a very important milestone for the MGA.\r\nWilliam Hill, overall, reported that it had processed in excess of ВЈ8bn in sports wagers during 2018, and that the company had continually pushed for sustained growth and market share across the United States.\r\n \r\n 6c7ea9e  \r\n \r\n7bcf5b79eba2ad7852254d79dafe5b4dse',	0,	'2022-05-07 15:22:42',	NULL),
(139,	'Henrygog',	NULL,	'eion007@yahoo.com',	'Tidak punya uang? Sangat mudah untuk mendapatkannya secara online di sini. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-07 19:14:29',	NULL),
(140,	'Henrygog',	NULL,	'erodeetyw@gmail.com',	'Uang Anda bekerja bahkan ketika Anda tidur. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-08 00:20:58',	NULL),
(141,	'Henrygog',	NULL,	'jose_maglantay@yahoo.com',	'Membuat Dolar tinggal di rumah dan meluncurkan Bot ini. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-08 05:18:58',	NULL),
(142,	'GeraldzopVB',	NULL,	'mymail@mymails.cmo',	'I will send out messages advertising your site or your business or services through a unique mailing list and site feedback forms. \r\n \r\nThis kwork includes mailing via feedback forms to 9,450,000 sites \r\n \r\nGEO: Worldwide \r\n \r\nhttp://www.google.com/url?q=http%3A%2F%2Fccl1.xyz%2FhfXW&sa=D&sntz=1&usg=AOvVaw2EhRW8Flx5vmE0m5NZATwH \r\n \r\nWhy is it beneficial: \r\n \r\n+ fast; \r\n \r\n+ quality; \r\n \r\n+ effective; \r\n \r\n+ your messages will be sent to the official mail of hundreds of thousands of organizations through their websites; \r\n \r\n+ your messages will be read by hundreds of thousands of people (managers, businessmen, directors, webmasters); \r\n \r\n+ you will get a significant increase in traffic to your resource and much more. \r\n \r\nP.S. This is NOT a mailing list by e-mail database, we send out only via feedback forms and this is much cooler! \r\n \r\nhttp://www.google.com/url?q=http%3A%2F%2Fccl1.xyz%2FhfXW&sa=D&sntz=1&usg=AOvVaw2EhRW8Flx5vmE0m5NZATwH',	0,	'2022-05-08 08:23:42',	NULL),
(143,	'Henrygog',	NULL,	'sabaumihai@yahoo.com',	'Kemandirian finansial adalah apa yang dijamin robot ini. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-08 10:17:14',	NULL),
(144,	'Henrygog',	NULL,	'rodrigotolda@hotmail.com',	'Dapatkan uang tambahan tanpa upaya. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-08 15:19:45',	NULL),
(145,	'Henrygog',	NULL,	'saffordscholarship@gmail.com',	'Robot keuangan adalah alat keuangan paling efektif di Internet! https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-08 18:23:20',	NULL),
(146,	'Henrygog',	NULL,	'milesemail@hotmail.com',	'Robot keuangan online adalah kunci kesuksesan Anda. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-08 23:50:55',	NULL),
(147,	'Henrygog',	NULL,	'dikostarco84@yahoo.com',	'Lihat Bot Otomatis, yang berfungsi untuk Anda 24/7. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-09 05:20:50',	NULL),
(148,	'CharlesErodyUF',	NULL,	'c_brano17@internode.on.au',	'How To Earn Passive Income: Play To Earn NFT Games https://telegra.ph/Passive-income-on-NFT-characters-from-1549943-05-08?id35467',	0,	'2022-05-09 07:43:25',	NULL),
(149,	'Henrygog',	NULL,	'tman6130@gmail.com',	'Lihat Bot Otomatis, yang berfungsi untuk Anda 24/7. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-09 10:45:22',	NULL),
(150,	'Henrygog',	NULL,	'lieneriquez53004@hotmail.com',	'# 1 ahli keuangan di Internet! Periksa Robot baru. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-09 16:18:28',	NULL),
(151,	'Henrygog',	NULL,	'pammyjoy98@yahoo.com',	'Butuh uang tunai? Peluncuran robot ini dan melihat apa yang bisa. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-09 21:35:19',	NULL),
(152,	'Henrygog',	NULL,	'asabi5901@yahoo.com',	'Ribuan dolar dijamin jika Anda menggunakan robot ini. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-09 22:30:23',	NULL),
(153,	'Henrygog',	NULL,	'jl131854@hotmail.com',	'Pekerjaan online dapat membawa Anda keuntungan yang fantastis. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-10 03:41:44',	NULL),
(154,	'Henrygog',	NULL,	'misscassandracarter@hotmail.com',	'Dapatkan uang tambahan tanpa upaya. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-10 09:10:42',	NULL),
(155,	'CharlesErodyUF',	NULL,	'merryhdz76@hotmail.com',	'Your return on investment is more than $578459s per week http://n1pyr.bagimsiz.click/e8c3f974e0',	0,	'2022-05-10 11:07:08',	NULL),
(156,	'Henrygog',	NULL,	'lesleydexter@hotmail.com',	'Cara terbaik untuk semua orang yang bergegas untuk kemandirian finansial. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-10 14:10:59',	NULL),
(157,	'Henrygog',	NULL,	'heijker_94@hotmail.com',	'Robot keuangan adalah cara yang bagus untuk mengelola dan meningkatkan penghasilan Anda. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-11 05:06:13',	NULL),
(158,	'CharlesErodyUF',	NULL,	'coppens_lorraine@hotmail.com',	'FROM $3000 A DAY! https://1300usd-for-10-minutes.blogspot.pt/2022/05/how-to-earn-1300-in-10-minutes.html?yes2084108',	0,	'2022-05-11 05:45:41',	NULL),
(159,	'HolandbydayHW',	NULL,	'kfdss@betting-melbets9.ru',	' рабочее зеркало 1хбет<a href=http://5stihija.ru>скачать бесплатно приложение 1xbet</a> Кроме того букмекерская контора предлагает игрокам   специальный раздел «конструктор ставок»,  при помощи этого инструмента  компания позволяет находить и  сочетать между собой  состязания  между командами разных лиг и дивизионов .  Важно знать, что  спрогнозировать результат такого матча нельзя,  победителя определяет ГСЧ.  На спортивных пари  букмекер не останавливается. Пари можно заключать  на  политические и культурны мероприятия, а также на киберспортивные матчи .',	0,	'2022-05-11 06:21:18',	NULL),
(160,	'Henrygog',	NULL,	'gomezcd@live.com',	'Mencari cara mudah untuk membuat uang? Periksa robot keuangan. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-11 10:08:42',	NULL),
(161,	'Henrygog',	NULL,	'peacemonth9@aol.com',	'Robot adalah cara terbaik bagi semua orang yang mencari kemandirian finansial. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-11 15:07:28',	NULL),
(162,	'Henrygog',	NULL,	'qnycrazystud20@yahoo.com',	'Pendapatan online adalah cara termudah untuk membuat Anda bermimpi menjadi kenyataan. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-11 20:03:08',	NULL),
(163,	'KjabutiToonyZL',	NULL,	'sanja.fila.t.o.vy.g.99.s@gmail.com',	'My cunt is wet. Fuck me in my home https://your-dating-place.life/?u=wh5kd06&o=qxpp80k&m=1',	0,	'2022-05-11 20:47:28',	NULL),
(164,	'KayteroyToonyEZ',	NULL,	'sanja.fila.t.o.vy.g.9.9.s@gmail.com',	'My nipples are hard and I\'m caressing my pussy right now. Lick my clitoris https://your-dating-place.life/?u=wh5kd06&o=qxpp80k&m=1',	0,	'2022-05-11 20:47:45',	NULL),
(165,	'CegeicuToonyPR',	NULL,	'sanja.fila.t.o.vy.g.99s@gmail.com',	'Fuck me right now. How much longer to wait here https://your-dating-place.life/?u=wh5kd06&o=qxpp80k&m=1',	0,	'2022-05-11 20:53:45',	NULL),
(166,	'Henrygog',	NULL,	'laurablaire@gmail.com',	'Setiap orang bisa mendapatkan sebanyak yang dia inginkan sekarang. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-12 01:29:31',	NULL),
(167,	'RobbztvJX',	NULL,	'r.ob.e.r.t.br.o.wn.moon.m.ans@gmail.com\r\n',	'<a href=https://bit.ly/3we9uwW>A new video is waiting! Click to watch!</a> \r\n<a href=https://bit.ly/3we9uwW><img src=\"https://i.ibb.co/qyXwBDc/beautiful-people-2.png\"></a>',	0,	'2022-05-12 06:01:29',	NULL),
(168,	'Henrygog',	NULL,	'tarunavirneni@gmail.com',	'Membuat ribuan dolar. Bayar apa-apa. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-12 06:35:15',	NULL),
(169,	'CharlesErodyUF',	NULL,	'theamanda8@yahoo.com',	'Binance NFT game has become very popular http://sv4.azurecompact.life/5b9759',	0,	'2022-05-12 09:56:06',	NULL),
(170,	'Henrygog',	NULL,	'tsingis1980@gmail.com',	'Penghasilan besar tanpa investasi Tersedia, sekarang! https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-12 11:34:30',	NULL),
(171,	'Henrygog',	NULL,	'abhilash333@yahoo.com',	'Butuh uang? Dapatkan tanpa meninggalkan rumah Anda. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-12 16:35:54',	NULL),
(172,	'Henrygog',	NULL,	'fplancarte@yahoo.com',	'Lihat bagaimana Robot membuat $1000 dari $ 1 Investasi. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-12 21:35:36',	NULL),
(173,	'Miquel',	NULL,	'support@modernwastesolutions.com',	'Morning, \r\n\r\nI hope this email finds you well. I wanted to let you know about our new BANGE backpacks and sling bags that just released.\r\n\r\nBange is perfect for students, professionals and travelers. The backpacks and sling bags feature a built-in USB charging port, making it easy to charge your devices on the go.  Also they are waterproof and anti-theft design, making it ideal for carrying your valuables.\r\n\r\nBoth bags are made of durable and high-quality materials, and are perfect for everyday use or travel.\r\n\r\nOrder yours now at 50% OFF with FREE Shipping: https://bangeonline.shop\r\n\r\nAll the best,\r\n\r\nMiquel',	0,	'2022-05-12 22:32:29',	NULL),
(174,	'Henrygog',	NULL,	'eric1755@gmail.com',	'Robot keuangan terus membawa Anda uang saat Anda tidur. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-13 02:32:01',	NULL),
(175,	'Henrygog',	NULL,	'kiranmudaliar78@gmail.com',	'Butuh uang tunai? Peluncuran robot ini dan melihat apa yang bisa. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-13 07:59:30',	NULL),
(176,	'Henrygog',	NULL,	'jtaggs@comcast.net',	'Bahkan seorang anak tahu cara menghasilkan $100 hari ini dengan bantuan robot ini. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-13 12:56:30',	NULL),
(177,	'Henrygog',	NULL,	'emily_b08@live.com',	'Butuh uang? Dapatkan di sini dengan mudah? https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-13 17:52:37',	NULL),
(178,	'GabrielKiCCD',	NULL,	'jeankendry@hotmail.com',	'Have time to be one of the first in the new NFT game that is gaining more and more popularity every day. Grab your piece of the pie. \r\nYour personal invitation link: http://gz58.findality.com/48dd76c36 \r\nHow can you secure a lifetime passive income of $1,800 per day by investing $100,000 just once in the beginning? \r\nThis NFT game has the most expensive character RALPH who brings passive income to his owner in the amount of $180 per day, one such character costs $10,000, buy 10 of these characters and you will have a lifetime passive income of $1800 per day. \r\nYour personal invitation link: http://coz1ig.cheapconsumers.club/a9b9f0 \r\nThe number of characters is strictly limited, so you need to hurry up before other people have time to snap up these characters. \r\nRegister now: http://6e1dlo7.findality.com/750444afdb \r\nAlso, for each RALPH character you will receive 10000000 BGW tokens, in total for 10 characters you will receive 100000000 BGW tokens, one BGW token currently costs $0.002392 and 100000000 tokens is $239200. \r\nHurry up to snatch your piece of the pie: http://66eh.findality.com/cad4fafdf2',	0,	'2022-05-13 19:43:34',	NULL),
(179,	'Henrygog',	NULL,	'msz.lewiz@gmail.com',	'Robot keuangan adalah alat keuangan paling efektif di Internet! https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-13 21:20:02',	NULL),
(180,	'Henrygog',	NULL,	'wreck.tlxu@gmail.com',	'Menghasilkan $ 1000 sehari mudah jika Anda menggunakan Robot keuangan ini. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-14 02:14:20',	NULL),
(181,	'Henrygog',	NULL,	'aburadi11@gmail.com',	'Biarkan Robot membawa Anda uang saat Anda beristirahat. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-14 07:16:26',	NULL),
(182,	'Henrygog',	NULL,	'supervic@live.com',	'Beli semua yang Anda inginkan untuk menghasilkan uang secara online. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-14 12:16:52',	NULL),
(183,	'SonyadutBO',	NULL,	'woodthighgire1988@gmail.com',	' \r\nHei! Saya super pribadi foto / video https://bunnyvv.space/click?o=6&a=1036',	0,	'2022-05-14 13:28:16',	NULL),
(184,	'Henrygog',	NULL,	'daltonlandry@gmail.com',	'Lihat Bot Otomatis, yang berfungsi untuk Anda 24/7. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-14 17:16:11',	NULL),
(185,	'CharlesErodyUF',	NULL,	'mayangsegara@rocketmail.com',	'NFT that generates passive income http://xznco.cheapconsumers.club/ec',	0,	'2022-05-14 18:04:44',	NULL),
(186,	'GarryymycleOO',	NULL,	'jac.k.pr.o.gonich.2.@gmail.com',	'There was an accident. Then what? If you follow these steps, here is how to get the maximum benefit from Toronto <a href=\"https://whattodoafteracaraccident.ca/\">Car accident Lawyer</a>. \r\nYou’ve been involved in a vehicle accident. So, what exactly do you do? Unfortunately, accidents happen to even the finest drivers. Here are step-by-step guidelines on what to do if you are involved in a car accident. \r\n \r\nSTEP 1 \r\nSTOPPING You could face criminal charges if your car is involved in an accident and you do not stop. \r\n \r\nSTEP 2 \r\nCall the police if anyone is wounded, if the total damage to all the vehicles involved appears to be more than $2,000, or you suspect that any of the other drivers involved are guilty of a Criminal Code infraction (such as driving under the influence of drugs or alcohol) (such as driving under the influence of drugs or alcohol). The emergency operator will give you instructions to follow. The cops will be there as quickly as possible. You should not attempt to transfer anyone who has been hurt in the accident since you may aggravate their injuries. \r\n \r\nIf no one is hurt and the total damage to all of the vehicles is less than $2,000, contact a Collision Reporting Center within 24 hours. The police established these facilities to help motorists in reporting car accidents. You will fill out a police report and have the damage to your vehicle photographed at the reporting center. Find the Collision Reporting Centre closest to you, or call (416) 745-3301. \r\n \r\nGet it touch - https://whattodoafteracaraccident.ca/',	0,	'2022-05-14 20:37:32',	NULL),
(187,	'CharlesErodyUF',	NULL,	'aurethouvenot@orange.fr',	'OBTENEZ 35000 EUR CHAQUE SEMAINE ! http://gcx.azurecompact.life/8d41c91476',	0,	'2022-05-14 22:17:31',	NULL),
(188,	'Henrygog',	NULL,	'CharlesComeger538@yahoo.com',	'Robot keuangan adalah alat keuangan paling efektif di Internet! https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-14 22:38:35',	NULL),
(189,	'GarryymycleOO',	NULL,	'ja.ckpr.og.oni.ch.2.@gmail.com',	'There was an accident. Then what? If you follow these steps, here is how to get the maximum benefit from Toronto <a href=\"https://whattodoafteracaraccident.ca/\">Car accident Lawyer</a>. \r\nYou’ve been involved in a vehicle accident. So, what exactly do you do? Unfortunately, accidents happen to even the finest drivers. Here are step-by-step guidelines on what to do if you are involved in a car accident. \r\n \r\nSTEP 1 \r\nSTOPPING You could face criminal charges if your car is involved in an accident and you do not stop. \r\n \r\nSTEP 2 \r\nCall the police if anyone is wounded, if the total damage to all the vehicles involved appears to be more than $2,000, or you suspect that any of the other drivers involved are guilty of a Criminal Code infraction (such as driving under the influence of drugs or alcohol) (such as driving under the influence of drugs or alcohol). The emergency operator will give you instructions to follow. The cops will be there as quickly as possible. You should not attempt to transfer anyone who has been hurt in the accident since you may aggravate their injuries. \r\n \r\nIf no one is hurt and the total damage to all of the vehicles is less than $2,000, contact a Collision Reporting Center within 24 hours. The police established these facilities to help motorists in reporting car accidents. You will fill out a police report and have the damage to your vehicle photographed at the reporting center. Find the Collision Reporting Centre closest to you, or call (416) 745-3301. \r\n \r\nGet it touch - https://whattodoafteracaraccident.ca/',	0,	'2022-05-15 02:49:37',	NULL),
(190,	'Henrygog',	NULL,	'zstein94@gmail.com',	'Menghasilkan $ 1000 sehari mudah jika Anda menggunakan Robot keuangan ini. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-15 03:42:33',	NULL),
(191,	'Henrygog',	NULL,	'a.q.s.s.201212.2.5@gmail.com',	'Pekerjaan online dapat membawa Anda keuntungan yang fantastis. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-15 06:49:26',	NULL),
(192,	'GarryymycleOO',	NULL,	'j.ack.pr.o.go.n.ic.h.2.@gmail.com',	'There was an accident. Then what? If you follow these steps, here is how to get the maximum benefit from Toronto <a href=\"https://whattodoafteracaraccident.ca/\">Car accident Lawyer</a>. \r\nYou’ve been involved in a vehicle accident. So, what exactly do you do? Unfortunately, accidents happen to even the finest drivers. Here are step-by-step guidelines on what to do if you are involved in a car accident. \r\n \r\nSTEP 1 \r\nSTOPPING You could face criminal charges if your car is involved in an accident and you do not stop. \r\n \r\nSTEP 2 \r\nCall the police if anyone is wounded, if the total damage to all the vehicles involved appears to be more than $2,000, or you suspect that any of the other drivers involved are guilty of a Criminal Code infraction (such as driving under the influence of drugs or alcohol) (such as driving under the influence of drugs or alcohol). The emergency operator will give you instructions to follow. The cops will be there as quickly as possible. You should not attempt to transfer anyone who has been hurt in the accident since you may aggravate their injuries. \r\n \r\nIf no one is hurt and the total damage to all of the vehicles is less than $2,000, contact a Collision Reporting Center within 24 hours. The police established these facilities to help motorists in reporting car accidents. You will fill out a police report and have the damage to your vehicle photographed at the reporting center. Find the Collision Reporting Centre closest to you, or call (416) 745-3301. \r\n \r\nGet it touch - https://whattodoafteracaraccident.ca/',	0,	'2022-05-15 10:16:49',	NULL),
(193,	'Henrygog',	NULL,	'tuetle22@Hotmail.com',	'Satu dolar bukan apa-apa, tetapi bisa tumbuh menjadi $100 di sini. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-15 11:47:25',	NULL),
(194,	'Henrygog',	NULL,	'9559501529626135@gmx.com',	'Uang, uang! Membuat lebih banyak uang dengan robot keuangan! https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-15 16:45:01',	NULL),
(195,	'Henrygog',	NULL,	'hermesmontana@gmail.com',	'Robot keuangan terus membawa Anda uang saat Anda tidur. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-15 21:54:10',	NULL),
(196,	'Henrygog',	NULL,	'tonizokpr@aol.com',	'Lihat Bot Otomatis, yang berfungsi untuk Anda 24/7. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-15 23:08:00',	NULL),
(197,	'Gar22symyclePV',	NULL,	'd.uo.pu.m.b.o@gmail.com',	'There was an accident. Then what? If you follow these steps, here is how to get the maximum benefit from Toronto <a href=\"https://whattodoafteracaraccident.ca/\">Car accident Lawyer</a>. \r\nYou’ve been involved in a vehicle accident. So, what exactly do you do? Unfortunately, accidents happen to even the finest drivers. Here are step-by-step guidelines on what to do if you are involved in a car accident. \r\n \r\nSTEP 1 \r\nSTOPPING You could face criminal charges if your car is involved in an accident and you do not stop. \r\n \r\nSTEP 2 \r\nCall the police if anyone is wounded, if the total damage to all the vehicles involved appears to be more than $2,000, or you suspect that any of the other drivers involved are guilty of a Criminal Code infraction (such as driving under the influence of drugs or alcohol) (such as driving under the influence of drugs or alcohol). The emergency operator will give you instructions to follow. The cops will be there as quickly as possible. You should not attempt to transfer anyone who has been hurt in the accident since you may aggravate their injuries. \r\n \r\nIf no one is hurt and the total damage to all of the vehicles is less than $2,000, contact a Collision Reporting Center within 24 hours. The police established these facilities to help motorists in reporting car accidents. You will fill out a police report and have the damage to your vehicle photographed at the reporting center. Find the Collision Reporting Centre closest to you, or call (416) 745-3301. \r\n \r\nGet it touch - https://whattodoafteracaraccident.ca/',	0,	'2022-05-16 00:31:42',	NULL),
(198,	'Henrygog',	NULL,	'angy.caliandro@laposte.net',	'Robot keuangan terus membawa Anda uang saat Anda tidur. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-16 04:09:37',	NULL),
(199,	'Henrygog',	NULL,	'brittany.m.clark@chase.com',	'Butuh uang? Robot keuangan adalah solusi Anda. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-16 09:12:27',	NULL),
(200,	'Henrygog',	NULL,	'ashleighmayphotography@hotmail.com',	'Percayai Bot keuangan untuk menjadi kaya. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-16 14:09:11',	NULL),
(201,	'Diane',	NULL,	'info@wastewood.com.au',	'Morning \r\n\r\nI wanted to reach out and let you know about our new dog harness. It\'s really easy to put on and take off - in just 2 seconds - and it\'s personalized for each dog. \r\nPlus, we offer a lifetime warranty so you can be sure your pet is always safe and stylish.\r\n\r\nWe\'ve had a lot of success with it so far and I think your dog would love it. \r\n\r\nGet yours today with 50% OFF: https://caredogbest.com\r\n\r\nFREE Shipping - TODAY ONLY! \r\n\r\nSincerely, \r\n\r\nDiane',	0,	'2022-05-16 17:51:03',	NULL),
(202,	'Henrygog',	NULL,	'gabby8391@aol.com',	'Butuh uang tunai? Peluncuran robot ini dan melihat apa yang bisa. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-16 19:52:42',	NULL),
(203,	'Henrygog',	NULL,	'ruthhill48@yahoo.com',	'Bergabunglah dengan masyarakat orang-orang sukses yang menghasilkan uang di sini. https://gog.187sued.de/gotodate/promo ',	0,	'2022-05-17 01:13:12',	NULL);

DROP TABLE IF EXISTS `kategori_produk`;
CREATE TABLE `kategori_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kategori_produk` (`id`, `nama`, `icon`) VALUES
(1,	'Makanan',	'fa-heart'),
(2,	'Minuman',	'fa-heartbeat'),
(3,	'Rumah Tangga',	'fa-anchor'),
(4,	'Baju',	'fa-group'),
(6,	'Sekolah',	'fa-bicycle'),
(7,	'Kendaraan',	'fa-building');

DROP TABLE IF EXISTS `keuntungan`;
CREATE TABLE `keuntungan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `keuntungan` (`id`, `icon`, `nama`, `isi`) VALUES
(1,	'fa fa-money',	'Langkah Usaha Mudah',	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(2,	'fa fa-money',	'Langkah Usaha Mudah',	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(3,	'fa fa-money',	'Langkah Usaha Mudah',	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');

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
(26,	'Slider',	'slides',	'index',	'fa fa-ambulance',	8,	2),
(28,	'Galeri',	'galeri',	'index',	'fa fa-photo',	7,	2),
(36,	'Produk',	'produk',	'index',	'fa fa-cubes',	1,	2),
(37,	'Toko',	'toko',	'index',	'fa fa-shopping-cart',	1,	2);

DROP TABLE IF EXISTS `nilai_sikap`;
CREATE TABLE `nilai_sikap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `nilai_sikap` (`id`, `nama`, `isi`) VALUES
(1,	'Integrity',	'-'),
(2,	'Totality',	'-'),
(3,	'Creativity',	'-');

DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `kategori_produk_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `deskripsi_singkat` text NOT NULL,
  `deksripsi_lengkap` text NOT NULL,
  `status_online` tinyint(4) NOT NULL DEFAULT '0',
  `foto_banner` varchar(255) NOT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `diskon_status` tinyint(4) NOT NULL DEFAULT '0',
  `diskon` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `kategori_produk_id` (`kategori_produk_id`),
  KEY `toko_id` (`toko_id`),
  CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`kategori_produk_id`) REFERENCES `kategori_produk` (`id`),
  CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`toko_id`) REFERENCES `toko` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `produk` (`id`, `nama`, `harga`, `stok`, `kategori_produk_id`, `toko_id`, `deskripsi_singkat`, `deksripsi_lengkap`, `status_online`, `foto_banner`, `flag`, `created_at`, `diskon_status`, `diskon`) VALUES
(2,	'Sepatu',	50000,	10,	1,	1,	'<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',	'<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>',	1,	'KlJwEvXJZ9qtaeB74WJvtRSHNHNn96g-.jpeg',	0,	NULL,	1,	5);

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
  CONSTRAINT `review_produk_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `role` (`id`, `name`) VALUES
(1,	'Super Administrator'),
(3,	'Regular User'),
(4,	'Admin');

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
(98,	3,	12),
(99,	3,	13),
(100,	3,	14),
(101,	3,	15),
(102,	3,	16),
(103,	3,	17),
(104,	3,	18),
(105,	3,	19),
(106,	3,	20),
(107,	3,	21),
(108,	3,	22),
(109,	3,	23),
(110,	3,	24),
(111,	3,	25),
(112,	3,	26),
(113,	3,	27),
(114,	3,	28),
(115,	3,	29),
(116,	3,	30),
(117,	3,	31),
(118,	3,	32),
(119,	3,	33),
(3388,	4,	145),
(3389,	4,	12),
(3390,	4,	13),
(3391,	4,	14),
(3392,	4,	15),
(3393,	4,	16),
(3394,	4,	17),
(3395,	4,	29),
(3396,	4,	30),
(3397,	4,	31),
(3398,	4,	32),
(3399,	4,	33),
(3415,	4,	165),
(3416,	4,	166),
(3417,	4,	167),
(3418,	4,	168),
(3419,	4,	169),
(3420,	4,	179),
(3421,	4,	180),
(3422,	4,	181),
(3423,	4,	182),
(3424,	4,	183),
(3455,	4,	79),
(3456,	4,	80),
(3457,	4,	81),
(3458,	4,	82),
(3459,	4,	83),
(3506,	1,	12),
(3507,	1,	13),
(3508,	1,	14),
(3509,	1,	15),
(3510,	1,	17),
(3511,	1,	18),
(3512,	1,	19),
(3513,	1,	20),
(3514,	1,	21),
(3515,	1,	22),
(3516,	1,	23),
(3517,	1,	24),
(3518,	1,	25),
(3519,	1,	26),
(3520,	1,	27),
(3521,	1,	28),
(3522,	1,	29),
(3523,	1,	30),
(3524,	1,	31),
(3525,	1,	32),
(3526,	1,	33),
(3527,	1,	165),
(3528,	1,	166),
(3529,	1,	167),
(3530,	1,	168),
(3531,	1,	169),
(3532,	1,	179),
(3533,	1,	180),
(3534,	1,	181),
(3535,	1,	182),
(3536,	1,	183),
(3537,	1,	214),
(3538,	1,	215),
(3539,	1,	216),
(3540,	1,	217),
(3541,	1,	218),
(3542,	1,	219),
(3543,	1,	220),
(3544,	1,	221),
(3545,	1,	222),
(3546,	1,	223),
(3547,	1,	79),
(3548,	1,	80),
(3549,	1,	81),
(3550,	1,	82),
(3551,	1,	83);

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
(71,	3,	1),
(72,	3,	2),
(73,	3,	3),
(74,	3,	4),
(75,	3,	5),
(700,	4,	1),
(701,	4,	2),
(702,	4,	5),
(706,	4,	26),
(707,	4,	28),
(711,	4,	12),
(722,	1,	1),
(723,	1,	2),
(724,	1,	3),
(725,	1,	4),
(726,	1,	5),
(727,	1,	26),
(728,	1,	28),
(729,	1,	36),
(730,	1,	37),
(731,	1,	12);

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
  `banner` varchar(255) DEFAULT NULL,
  `embed_ig` text,
  `embed_ig2` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `setting` (`id`, `logo`, `judul_web`, `tentang_kami`, `judul_tentang_kami`, `foto_tentang_kami`, `foto_member`, `facebook`, `instagram`, `telepon`, `email`, `twitter`, `telegram`, `nama_web`, `alamat`, `visi`, `misi`, `slogan_web`, `banner`, `embed_ig`, `embed_ig2`) VALUES
(4,	'5YZijhp2loaA0hfsUWh0imJx4UdlEAK0-removebg-preview.png',	'IKM Jatim',	'<p>-</p>',	'-',	'cD9AOWkDXKKAV-0smjPS5w4lFzJ0ATQF.jpeg',	'',	'-',	'https://www.instagram.com/forumikmbatu/?hl=id',	'08',	'-',	'-',	'-',	'IKM Jatim',	'Jl.Suropati No 111B Pesanggrahan KotaBatu,Kota Batu,Jawa Timur 65313',	'<p>-</p>',	'<p>-</p>',	'-',	'5S_DsrmixE612tfaWasB7uemA8-3O110.jpeg',	NULL,	NULL);

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
(3,	'Jadilah Bagian Dari Kami',	'Segera daftarkan produk ukm anda',	'6f13ddc8ef5f91fae248f9156c0d074acbdf5b9a.jpeg',	'left',	1),
(4,	'Jadilah Bagian Dari Kami',	'Segera daftarkan produk ukm anda',	'c45a87699e3f142069bb51aa47a47c3629c020da.jpeg',	'center',	1);

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
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat` text NOT NULL,
  `no_whatsapp` varchar(18) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `toko_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `toko` (`id`, `id_user`, `nama`, `deskripsi`, `alamat`, `no_whatsapp`, `created_at`, `updated_at`, `flag`) VALUES
(1,	51,	'Toko Bagus Ceria',	'-',	'Pemalang',	'089658798162',	NULL,	NULL,	0),
(3,	1,	'Toko Baguss',	'Toko ini menjual banyak perabotan',	'Jalan Raya',	'089658798162',	'2022-04-06 21:15:43',	'2022-04-07 12:30:04',	0),
(4,	52,	'Toko Wildan',	'Deksripsi Toko WIldan',	'Alamat Toko Wildan',	'089776786',	'2022-04-08 11:29:06',	NULL,	0);

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
(1,	'admin@admin.com',	'$2y$13$ld9QJh6MUeyC1IFJf8lxP.Mq9512dhGc/67pTMRacZdItrGZHA8oW',	'Administrator',	4,	1,	1,	'',	'AFnqgcjpeTg7_AfQqQYG-Gcp_ro2Xbso.png',	'ISALAMMTYyNzIrSkNULU1vT0xHNXNIKzNQNk51NWFFS2_mpzQv_V2UGJiQk1hWnROUXR5Y2ZpVGtLeWpPKzE1NjYzS3CRETKEY',	NULL,	'6289658798162',	'2022-04-06 20:50:02',	'2022-04-05 11:42:48',	NULL,	NULL,	NULL),
(2,	'user',	'ee11cbb19052e40b07aac0ca060c23ee',	'Regular User',	3,	1,	1,	NULL,	'default.png',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(3,	'budi@gmail.com',	'21232f297a57a5a743894a0e4a801fc3',	'budi@gmail.com',	3,	0,	1,	NULL,	'default.png',	NULL,	NULL,	'0876786876',	NULL,	'2022-02-10 15:24:18',	NULL,	NULL,	NULL),
(4,	'budi1@gmail.com',	'827ccb0eea8a706c4c34a16891f84e7b',	'Name budi',	3,	0,	1,	NULL,	'default.png',	NULL,	NULL,	'08767868761',	NULL,	NULL,	NULL,	NULL,	NULL),
(11,	'fachruwildan13@gmail.com',	'81dc9bdb52d04dc20036dbd8313ed055',	'fachru wildans',	3,	0,	1,	NULL,	'default.png',	NULL,	NULL,	'089658798125',	NULL,	NULL,	NULL,	NULL,	NULL),
(14,	'fachruwildan12@gmail.com',	'81dc9bdb52d04dc20036dbd8313ed055',	'fachru wildans',	3,	0,	1,	NULL,	'default.png',	NULL,	NULL,	'0896587981254',	NULL,	NULL,	NULL,	NULL,	NULL),
(50,	'lukmanhakim.idris@gmail.com',	'$2y$13$fukx/l9xAZ3nma844HMk/et6SyGnaE/NpWSbe7PCR/GnXDn60QNkC',	'Lukman Hakim',	1,	1,	1,	'12345',	'default.png',	NULL,	NULL,	'0811547227',	'2021-08-02 12:24:57',	NULL,	NULL,	NULL,	NULL),
(51,	'superadmin@admin.com',	'$2y$13$cFeXDLn.RI9H97vDkPd/QeBn2CGV6.e6TDn7V.oIMb1DFOGo6QuYa',	'Super Admin',	1,	1,	1,	'123456',	'default.png',	NULL,	NULL,	'0877867687',	'2022-04-14 18:30:22',	'2022-04-07 14:58:25',	NULL,	NULL,	NULL),
(52,	'wildan@gmail.com',	'$2y$13$IUVawoDCk2QM5PUy9g24UemUX3aV3Kci/fFRcA.noXbkEEbdvhEU6',	'wildannn',	3,	1,	1,	NULL,	NULL,	NULL,	NULL,	'628976877787',	'2022-04-08 11:28:26',	NULL,	NULL,	NULL,	NULL),
(53,	'qudikxpth@gmail.com',	'$2y$13$JaPQTAUNp3jZMgWaVZ3Wq.1iyUiXrJn8tgBacDwMJQkkdbmLt7E86',	'qudikx',	3,	1,	1,	NULL,	'20220414_53389e591d829ff241412dd612bf77735e5acdfc.png',	NULL,	NULL,	'123123123123',	'2022-04-14 09:00:12',	NULL,	NULL,	NULL,	NULL),
(55,	'defrindr@gmail.com',	'$2y$13$5LbIgZAUM7lTEJl6hZy53eWbndgZufJzZTMUtNosNFsfabRpUewpm',	'Defri Indra Mahardika',	3,	1,	1,	NULL,	NULL,	NULL,	NULL,	'628560485437',	'2022-04-14 20:19:05',	NULL,	NULL,	NULL,	NULL),
(56,	'edo.rabmadhani@gmail.com',	'$2y$13$ZVO3harC3VxVFrhfiBlp7.Wj.UtMyETvITsya0qkeao1TizYjXKOO',	'Edo Rabmadhani',	3,	1,	1,	NULL,	NULL,	NULL,	NULL,	'6281333489098',	'2022-04-19 08:44:41',	'2022-04-19 08:47:01',	NULL,	NULL,	NULL);

-- 2022-07-11 04:01:35
