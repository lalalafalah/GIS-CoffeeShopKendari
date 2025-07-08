-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jul 2025 pada 05.37
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gis_coffee`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'Admin123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `coffee_shops`
--

CREATE TABLE `coffee_shops` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `link_share_loc` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `coffee_shops`
--

INSERT INTO `coffee_shops` (`id`, `name`, `lat`, `lng`, `alamat`, `link_share_loc`) VALUES
(1, 'Discuss Coffee', -4.017403092557095, 122.53600726365606, '', ''),
(2, 'Toko Kopi Sinar', -4.000480249108086, 122.52774149769179, '', ''),
(3, 'Kafe Musik Kopi Kita', -3.9723691707173647, 122.52258168880404, '', ''),
(4, 'Kopi Kita', -3.9764000494369474, 122.51647651960467, '', ''),
(5, 'Infinite Coffee Kendari', -4.000007344855211, 122.52061552205203, '', ''),
(6, 'onz coffee', -4.012260907854256, 122.53045810922552, '', ''),
(7, 'Coffee Shop Kopi +62', -4.002685596333913, 122.53433103487694, '', ''),
(8, 'Kopi Radja', -3.975182337319186, 122.52202857696274, '', ''),
(9, 'Unlimited Coffee', -3.96621813133284, 122.54998915270538, '', ''),
(10, 'Kopi NongkronG kendari', -4.01643184462879, 122.52962909291594, '', ''),
(11, 'LOCAL Coffee & Chill', -3.9757628217404273, 122.51503427033383, '', ''),
(12, 'Punala Coffee & Eatery', -3.971173487068861, 122.52593331062762, '', ''),
(13, 'Café Langit', -4.0078112899858525, 122.53396792371379, '', ''),
(14, 'SEMPATKAN COFFEE', -3.9686653302596087, 122.52409302925089, '', ''),
(15, 'Treecoffee', -3.9763517219856386, 122.52670170238488, '', ''),
(16, 'EKopi', -4.002092858208391, 122.53172100923734, '', ''),
(17, 'RIN\'S Coffee', -4.00952397504545, 122.53025519259411, '', ''),
(18, 'Kopi Lain Hati Kambu Kendari', -3.99975987314089, 122.52681005243772, '', ''),
(19, 'looka Coffee space', -3.97188765095395, 122.5202504152405, '', ''),
(20, 'Teko Coffee', -3.9783507587642153, 122.51992157218632, '', ''),
(21, 'Kopi Soe', -3.9909367784692606, 122.50950582018173, '', ''),
(22, 'Roemah Kopi 41', -3.981196714725816, 122.52275039239579, '', ''),
(23, 'Otentik Coffee', -3.977761891600437, 122.51952494025801, '', ''),
(24, 'KOPI DARI HATI,OurssCaffe', -3.978323306313602, 122.52129200201807, '', ''),
(25, 'Ar\'s', -4.007121119107952, 122.53436879868134, '', ''),
(26, 'Epps Coffee', -4.002614952050495, 122.51817491148641, '', ''),
(27, 'Ruang Kopi', -3.9886593064509945, 122.5176543998723, '', ''),
(28, 'KOSAKATA Kendari', -4.008755666458103, 122.53132275562776, '', ''),
(29, 'Dua Sinar', -3.9796291351814266, 122.51974446001499, '', ''),
(30, 'Dolce Coffee Kendari', -3.9724942560613017, 122.52183259167681, '', ''),
(31, 'Bin Haroon', -4.006081182188475, 122.5303717797764, '', ''),
(32, 'Sudut Kopi Coffee & Space', -3.9668150323813003, 122.52935893277, '', ''),
(33, 'TUANTANA KENDARI', -3.9785485547531394, 122.51736330172957, '', ''),
(34, 'Cozy café', -4.019431545171086, 122.50818059082616, '', ''),
(35, 'di Coffee Space', -3.97133645329489, 122.5189467511475, '', ''),
(36, 'Nostalgiakopi.Indonesia', -3.9839241378366026, 122.51435851834636, '', ''),
(37, 'Kopi Ana Wonua', -4.012148179061399, 122.50378508460065, '', ''),
(38, 'INDISCHE COFFEE', -3.973031288379311, 122.52371387953575, '', ''),
(39, 'Mondae Coffee', -3.971011290604963, 122.5187842913473, '', ''),
(40, 'GOOLLA DE NARANG', -3.974147658439759, 122.51974396961792, '', ''),
(41, 'Gold Coffee Kendari', -4.002824776495876, 122.53390615800106, '', ''),
(42, 'Konoki café', -4.0385729363411444, 122.49456751594158, '', ''),
(43, 'MADECCA', -4.010416545229852, 122.52839692390556, '', ''),
(44, 'MADECCA 2.0', -4.011250593401441, 122.52874016328191, '', ''),
(45, 'Tanamera Coffee Kendari', -3.9679299038146865, 122.52158199205971, '', ''),
(46, 'Manual Coffee Kendari', -3.977334958417317, 122.52686058850375, '', ''),
(47, 'Kopi Janji Jiwa Kendari', -3.9678628218413365, 122.51938037653511, '', ''),
(48, 'Excelso', -3.9776181589507544, 122.51299426724509, '', ''),
(49, 'One Line Coffee', -3.9804477315779243, 122.51931541159102, '', ''),
(50, 'WK5 pujasera&café', -3.9708043848053807, 122.51855184920872, '', ''),
(51, 'RESIDIVIS KOPI KENDARI', -3.9703066364199295, 122.52803013268769, '', ''),
(52, 'Kopi Kenangan - Ruko Andounohu Kendari', -4.002026432795417, 122.53318167917347, '', ''),
(53, 'ARA ARA COFFEE EXPERIENCE', -3.975835521476431, 122.51524560990816, '', ''),
(54, 'Ruma Hagia', -4.001300944170359, 122.53324400791533, '', ''),
(55, 'Bertiga coffee', -3.966771588112639, 122.52910844806425, '', ''),
(56, 'Ramai Semeja Coffee & Space', -3.9727967161488644, 122.52321588673475, '', ''),
(57, 'Disemeja Coffee & Chill', -3.9836942145208263, 122.51427782145176, '', ''),
(58, 'Kopi Kopi Coffee Bar', -3.970068559664164, 122.51975274590279, '', ''),
(59, 'Rich-O Donuts & Cafe Kendari', -3.9777653147235057, 122.52401241921551, '', ''),
(60, 'Kopi Trotoar 2', -3.9706601106576005, 122.51794131551982, '', ''),
(61, 'Radar Caffee', -4.026462408295218, 122.50254250017474, '', ''),
(62, 'KOPI GARASI', -3.9791967248954796, 122.48633600017475, '', ''),
(63, 'Pang5 Kopi', -3.9884045116490947, 122.51808987319237, '', ''),
(64, 'GOFFEE KENDARI', -3.9942498807610223, 122.51231398482967, '', ''),
(65, 'Kopi Kenangan - Ruko Rabam Kendari', -3.979464323420071, 122.51016891126628, '', ''),
(66, 'Mujur Coffee & Roster', -3.97856953149389, 122.5202344308649, '', ''),
(67, 'FIND COFFEE KENDARI', -4.0005965273358095, 122.52780593086491, '', ''),
(68, 'Kendari Town Square (K-Toz)', -3.9700421349109063, 122.5197574092969, '', ''),
(69, 'MAXX Coffee', -3.9922214938351295, 122.51196778417625, '', ''),
(70, 'MAXX Coffee The Park Kendari', -3.9830447091332606, 122.51958364360048, '', ''),
(71, 'Sky lake', -4.039531858794654, 122.53056946356726, '', ''),
(72, 'Kopi Kenangan - Ruko Edi Sabara Kendari', -3.9758525929420356, 122.52424158032852, '', ''),
(73, 'Summer Millenial', -4.001608834178684, 122.5183371160275, '', ''),
(74, 'BRUNOS COFFEE & EATERY', -4.006505827988905, 122.53429787896849, '', ''),
(78, 'matcha enak', -4.00926527735737, 122.52377031766262, 'Jalan UHO', 'https://maps.app.goo.gl/bNxuF9Hb1CF3dau97');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `coffee_shops`
--
ALTER TABLE `coffee_shops`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `coffee_shops`
--
ALTER TABLE `coffee_shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
