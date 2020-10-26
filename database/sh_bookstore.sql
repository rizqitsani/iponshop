-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2020 at 10:12 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sh_bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `name`, `email`, `phone`) VALUES
(1, 'admin', '$2y$10$DATdppR4gxLS8AUFoosF4./qui.Cc80lgr0aVZ3lUlN5gC023NpZ6', 'Admin', 'admin@gmail.com', '081234567890');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `book_isbn` varchar(13) NOT NULL,
  `book_image` varchar(50) NOT NULL,
  `book_title` varchar(100) NOT NULL,
  `book_author` varchar(100) NOT NULL,
  `book_publisher` varchar(100) NOT NULL,
  `book_publication` int(4) NOT NULL,
  `book_price` int(20) NOT NULL,
  `book_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `book_isbn`, `book_image`, `book_title`, `book_author`, `book_publisher`, `book_publication`, `book_price`, `book_desc`) VALUES
(1, '9786020639536', 'nebula.jpg', 'Nebula', 'Tere Liye', 'Gramedia Pustaka Utama', 2020, 85000, 'SELENA dan NEBULA adalah buku ke-8 dan ke-9 yang menceritakan siapa orangtua Raib dalam serial petualangan dunia paralel. Dua buku ini sebaiknya dibaca berurutan. Kedua buku ini juga bercerita tentang Akademi Bayangan Tingkat Tinggi, sekolah terbaik di seluruh Klan Bulan. Tentang persahabatan tiga mahasiswa, yang diam-diam memiliki rencana bertualang ke tempat-tempat jauh. Tapi petualangan itu berakhir buruk, saat persahabatan mereka diuji dengan rasa suka, egoisme, dan pengkhianatan. Ada banyak karakter baru, tempat-tempat baru, juga sejarah dunia paralel yang diungkap. Di dua buku ini kalian akan berkenalan dengan salah satu karakter paling kuat di dunia paralel sejauh ini. Tapi itu jika kalian bisa menebaknya. Dua buku ini bukan akhir. Justru awal terbukanya kembali portal menuju Klan Aldebaran.'),
(2, '9786020351179', 'bintang.jpg', 'Bintang', 'Tere Liye', 'Gramedia Pustaka Utama', 2017, 88000, 'Kami bertiga teman baik. Remaja, murid kelas sebelas. Penampilan kami sama seperti murid SMA lainnya. Tapi kami menyimpan rahasia besar.\r\n\r\n\r\nNamaku Raib, aku bisa menghilang. Seli, teman semejaku, bisa mengeluarkan petir dari telapak tangannya. Dan Ali, si biang kerok sekaligus si genius, bisa berubah menjadi beruang raksasa. Kami bertiga kemudian bertualang ke dunia paralel yang tidak diketahui banyak orang, yang disebut Klan Bumi, Klan Bulan, Klan Matahari, dan Klan Bintang. Kami bertemu tokoh-tokoh hebat. Penduduk klan lain.\r\n\r\n\r\nIni petualangan keempat kami. Setelah tiga kali berhasil menyelamatkan dunia paralel dari kehancuran besar, kami harus menyaksikan bahwa kamilah yang melepaskan “musuh besar”-nya.\r\nIni ternyata bukan akhir petualangan, ini justru awal dari semuanya…\r\nBuku keempat dari serial “BUMI”'),
(3, '9786024526986', 'bodo_amat.jpg', 'Sebuah Seni untuk Bersikap Bodo Amat', 'Mark Manson', 'Gramedia Widiasarana Indonesia', 2005, 67000, '\"Selama beberapa tahun belakangan, Mark Manson—melalui blognya yang sangat populer—telah membantu mengoreksi harapan-harapan delusional kita, baik mengenai diri kita sendiri maupun dunia. Ia kini menuangkan buah pikirnya yang keren itu di dalam buku hebat ini.\r\n\r\n“Dalam hidup ini, kita hanya punya kepedulian dalam jumlah yang terbatas. Makanya, Anda harus bijaksana dalam menentukan kepedulian Anda.” Manson menciptakan momen perbincangan yang serius dan mendalam, dibungkus dengan cerita-cerita yang menghibur dan “kekinian”, serta humor yang cadas. Buku ini merupakan tamparan di wajah yang menyegarkan untuk kita semua, supaya kita bisa mulai menjalani kehidupan yang lebih memuaskan, dan apa adanya.\r\n\"'),
(4, '9786020312583', 'cantik.jpg', 'Cantik Itu Luka', 'Eka Kurniawan', 'Gramedia Pustaka Utama', 2018, 125000, 'Di satu sore, seorang perempuan bangkit dari kuburannya setelah dua puluh satu tahun kematian. Kebangkitannya menguak kutukan dan tragedi keluarga, yang terentang sejak akhir masa kolonial perpaduan antara epik keluarga yang dibalut roman, kisah hantu, kekejaman politik, mitologi, dan petualangan. Dari kekasih yang lenyap ditelan kabut hingga seorang ibu yang menginginkan bayi buruk rupa.'),
(5, '9786020337593', 'china_rich_girlfriend.jpg', 'China Rich Girlfriend', 'Kevin Kwan', 'Gramedia Pustaka Utama', 2017, 98000, '\"Sekarang malam pernikahan Rachel Chu. Ia memakai cincin bermata berlian Asscher-cut, gaun pengantin yang sangat ia sukai, dan memiliki tunangan yang rela kehilangan semua harta warisan demi menikahinya. Namun, gadis itu sedih. Ayah kandungnya, yang tidak pernah ia kenal, takkan mengantarnya menuju altar.\r\n\r\n\r\nLalu suatu kejadian mendadak membuat identitas pria tersebut terungkap. Dan Rachel pun terseret ke dalam dunia gemerlap Shanghai, yang berisi kemewahan tak terbayangkan dan orang-orang yang bukan sekadar kaya raya… mereka kaya tujuh turunan.\"'),
(6, '9786020314433', 'crazy_rich_asians.jpg', 'Crazy Rich Asians', 'Kevin Kwan', 'Gramedia Pustaka Utama', 2016, 105000, 'Ketika Rachel Chu, dosen ekonomi keturunan Cina, setuju untuk pergi\r\nke Singapura bersama kekasihnya, Nick, ia membayangkan\r\nrumah sederhana, jalan-jalan keliling pulau, dan menghabiskan waktu\r\nbersama pria yang mungkin akan menikah dengannya itu. Ia tidak tahu\r\nbahwa rumah keluarga Nick bagai istana, bahwa ia akan lebih sering\r\nnaik pesawat pribadi daripada mobil, dan dengan pria incaran se-Asia\r\ndalam pelukannya, Rachel seperti dimusuhi semua wanita.\r\n\r\nDi dunia yang kemewahannya tak pernah terbayangkan oleh Rachel itu,\r\nia bertemu Astrid, si It Girl Singapura; Eddie, yang keluarganya jadi\r\npenghuni tetap majalah-majalah sosialita Hong Kong; dan Eleanor,\r\nibu Nick, yang punya pendapat sangat kuat tentang\r\nsiapa yang boleh—dan tidak boleh—dinikahi putranya.\r\n\r\nDengan latar berbagai tempat paling eksklusif di Timur Jauh—dari\r\npenthouse-penthouse mewah Shanghai hingga pulau-pulau pribadi\r\ndi Laut Cina Selatan—Crazy Rich Asians bercerita tentang\r\nkalangan jet set Asia, dengan sempurna menggambarkan friksi antara\r\ngolongan Orang Kaya Lama dan Orang Kaya Baru, serta\r\nantara Cina Perantauan dan Cina Daratan.'),
(7, '9786020333397', 'meniti_bianglala.jpg', 'Meniti Bianglala', 'Mitch Albom', 'Gramedia Pustaka Utama', 2019, 75000, 'Eddie bekerja di taman hiburan hampir sepanjang hidupnya, memperbaiki dan merawat berbagai wahana. Tahun-tahun berlalu, dan Eddie merasa terperangkap dalam pekerjaan yang dirasanya tak berarti. Hari-harinya hanya berupa rutinitas kerja, kesepian, dan penyesalan. Pada ulang tahunnya yang ke-83, Eddie tewas dalam kecelakaan tragis ketika mencoba menyelamatkan seorang gadis kecil dari wahana yang rusak. Saat mengembuskan napas terakhir, terasa olehnya sepasang tangan kecil menggenggam tanggannya. Cerita kemudian bergulir ketika Eddie “terbangun” setelah kematiannya. Alih-alih berada di surga, taman yang indah yang selama ini ia bayangkan, ia malah berada di tengah padang awan, di mana Eddie akan dipertemukan dengan lima orang yang tanpa ia sadari telah mengubah jalan hidupnya. Kelima orang ini akan menjawab setiap pertanyaan Eddie mengenai hidupnya yang selama ini ia anggap tidak bermakna. Bagaimana kemudian Eddie memaknai hidupnya setelah kematian menghampirinya? Benarkah ada kehidupan seusai kematian? Meniti Bianglala adalah novel karya Mitch Albom, penulis asal New Jersey, Amerika, yang kerap menulis tentang kehidupan dari beragam sisi yang berbeda.'),
(8, '9786020333403', 'satu_hari.jpg', 'Satu Hari Bersamamu', 'Mitch Albom', 'Gramedia Pustaka Utama', 2019, 70000, 'For One More Day adalah kisah tentang seorang ibu dan anak laki-lakinya, kasih sayang abadi seorang ibu, dan pertanyaan berikut ini: Apa yang akan kaulakukan seandainya kau diberi satu hari lagi bersama orang yang kausayangi, yang telah tiada? Ketika masih kecil, Charley Benetto diminta untuk memilih oleh ayahnya, hendak menjadi “anak mama atau anak papa, tapi tidak bisa dua-duanya.” Maka dia memilih ayahnya, memujanya---namun sang ayah pergi begitu saja ketika Charley menjelang remaja. Dan Charley dibesarkan oleh ibunya, seorang diri, meski sering kali dia merasa malu akan keadaan ibunya serta merindukan keluarga yang utuh. Bertahun-tahun kemudian, ketika hidupnya hancur oleh minuman keras dan penyesalan, Charley berniat bunuh diri. Tapi gagal. Dia justru dibawa kembali ke rumahnya yang lama dan menemukan hal yang mengejutkan. Ibunya---yang meninggal delapan tahun silam masih tinggal di sana, dan menyambut kepulangannya seolah tak pernah terjadi apa-apa.'),
(9, '9786020388175', 'tangga.jpg', 'Mendaki Tangga yang Salah', 'Eric Barker', 'Gramedia Pustaka Utama', 2019, 108000, 'Sebagian Besar Hal yang anda Ketahui tentang Kesuksesan Adalah Salah Besar\r\n\r\nBanyak saran yang diberikan kepada kita tentang kesuksesan terdengar masuk akal, serius-dan jelas-jelas salah. Eric Barker mengungkap fakta-fakta luar biasa tentang penentu kesuksesan-yang mungkin sebelumnya tidak kita pikirkan, seperti:\r\n- Mengapa murid paling pintar di sekolah jarang menjadi miliarder dan bagaimana kelemahan terbesar Anda bisa menjadi kekuatan terhebat Anda.\r\n- Apakah orang baik selalu menjadi yang terakhir mencapai garis akhir dan mengapa pelajaran terbaik tentang kerja sama datang dari anggota geng, bajak laut, dan pembunuh berantai.\r\n- Mengapa mencoba meningkatkan kepercayaan diri selalu gagal dan bagaimana filosofi Buddha memberi solusi yang terbaik.\r\n- Bagaimana menemukan keseimbangan hidup dan kerja dengan menggunakan strategi Genghis Khan, kesalahan-kesalahan yang dilakukan Albert Einstein, dan satu pelajaran kecil dari Speder-Man.\r\n\r\nDengan mencermati yang memisahkan kesuksesan yang luar biasa dari yang biasa-biasa saja, kita bisa berhenti menebak-nebak rahasia mencapai kesuksesan dan memulai kehidupan yang Anda inginkan.'),
(10, '9786020822341', 'tentang_kamu.jpg', 'Tentang Kamu', 'Tere Liye', 'Republika Penerbit', 2016, 85000, 'Terima kasih untuk kesempatan mengenalmu,\r\nitu adalah salah satu anugerah terbesar hidupku.\r\nCinta memang tidak perlu ditemukan,\r\ncintalah yang akan menemukan kita.\r\n\r\n\r\n\r\nTerima kasih. Nasihat lama itu benar sekali.\r\naku tidak akan menangis karena sesuatu telah\r\nberakhir, tapi aku akan tersenyum karena sesuatu itu pernah terjadi.\r\n\r\n\r\n\r\nMasa lalu, Rasa sakit, Masa depan. Mimpi-mimpi.\r\nSemua akan berlalu, seperti sungai yang mengalir.\r\nMaka biarlah hidupku mengalir seperti sungai kehidupan.'),
(12, '9786020639581', '9786020639581.jpg', 'Cadl-Sebuah Novel Tanpa Huruf E', 'Triskaidekaman', 'Gramedia Pustaka Utama', 2020, 88000, 'Jika kusisipkan Huruf Itu di antara huruf D dan huruf L, maka kita akan ingat pada orang-orang yang tak mampu lafalkan huruf R. Itu jugalah yang dialami warga Wiranacita. Namun, alih-alih huruf R, yang jadi tumbal adalah Huruf Itu. Lidah kami bukan lidah pilihan. Lidah rakyat sudah dilumpuhkan habis-habisan. Tak salah lagi: C-A-D-dan-L ini pastilah satu kata utuh. Ini bukan judul hasil cocok-cocokan atau akronim asal-asalan. Ini judul yang disiapkan baik-baik. *** Hidup rakyat Wiranacita kian rumit saat Huruf Itu dimusnahkan sang diktator, Zaliman Yang Mulia. Aturan bicara dibatasi, buku-buku mulai disortir, dan kamus harus diganti. Di balik larangan itu, ada rahasia suram dan kisah masa lalu yang ditutupi rapat-rapat. Saat satu-dua potongan rahasia itu muncul, Lamin hanya ikuti apa kata hatinya. Dia tak sadar akan ambang bahaya yang dia hadapi.'),
(13, '9786026486356', '9786026486356.jpg', 'Mindset', 'Carol S. Dweck, Ph.D.', 'PENERBIT BACA', 2019, 111000, 'Buku ini menjelaskan dengan gamblang bagaimana keyakinan atas kemampuan yang kita miliki amat berpengaruh terhadap cara kita belajar dan menentukan pilihan di dalam kehidupan.'),
(14, '9789797946029', '9789797946029.jpg', 'Kepada Kamu Yang Tidak Pernah Jadi Satu-Satunya', 'Chacha Thaib', 'Mediakita', 2020, 82500, 'kau akan mengantongi banyak sekali alasan untuk hengkang dari apa yang disebut hidup. maka saat kau memutuskan untuk berdampingan ... akan kusampaikan kepada semesta bahwa kau harus jadi satu-satunya. (C.)');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `total` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total`, `date`, `status`) VALUES
(1, 1, 203000, '2020-07-11 05:42:23', 3),
(4, 1, 125000, '2020-07-11 04:19:08', 1),
(5, 1, 207500, '2020-07-10 23:13:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_id` int(10) NOT NULL,
  `book_isbn` varchar(13) NOT NULL,
  `book_price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_id`, `book_isbn`, `book_price`) VALUES
(1, '9786020337593', 98000),
(1, '9786020314433', 105000),
(2, '978602063958', 0),
(3, '9786020312583', 125000),
(4, '9786020312583', 125000),
(5, '9786020312583', 125000),
(5, '9789797946029', 82500);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `status_code` tinyint(3) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`status_code`, `status`) VALUES
(0, 'Diproses'),
(1, 'Dikemas'),
(2, 'Dikirim'),
(3, 'Sampai');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `provinsi` varchar(20) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `kelurahan` varchar(50) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `phone`, `provinsi`, `kota`, `kelurahan`, `kode_pos`, `alamat`) VALUES
(1, 'rizqitsani', '$2y$10$.hmw84FVp/i2eQVEZKAAzuol8giHp/p.jJaCzUKE6yl9KgdQXkZWC', 'Muhammad Rizqi Tsani', 'rizqitsani@gmail.com', '085649070769', 'Jawa Timur', 'Kota Kediri', 'Mojoroto', '64112', 'Perumahan Mojoroto Indah R/21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`status_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
