-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2020 at 09:29 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dtr`
--

-- --------------------------------------------------------

--
-- Table structure for table `accomplishment`
--

CREATE TABLE `accomplishment` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(40) NOT NULL,
  `accomplishment` text NOT NULL,
  `accomplished_date` varchar(50) NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accomplishment`
--

INSERT INTO `accomplishment` (`id`, `employee_id`, `accomplishment`, `accomplished_date`, `remarks`) VALUES
(11, 'FA-001', 'Checking of students answer sheets online and printed activities.', '2020-10-30', 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(40) NOT NULL,
  `am_in` varchar(40) NOT NULL,
  `am_out` varchar(40) NOT NULL,
  `pm_in` varchar(40) NOT NULL,
  `pm_out` varchar(40) NOT NULL,
  `status_am` varchar(40) NOT NULL,
  `status_pm` varchar(40) NOT NULL,
  `mins_late` varchar(40) NOT NULL,
  `attendance_date` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `am_in`, `am_out`, `pm_in`, `pm_out`, `status_am`, `status_pm`, `mins_late`, `attendance_date`) VALUES
(86, 'FA-001', '8:00 AM', '12:01 PM', '01:01 PM', '05:01 PM', 'NOT LATE', 'LATE', '1', '2020-10-28'),
(87, 'FA-001', '8:00 AM', '12:01 PM', '01:01 PM', '05:01 PM', 'NOT LATE', 'LATE', '1', '2020-10-27'),
(88, 'FA-001', '8:00 AM', '12:01 PM', '01:01 PM', '05:01 PM', 'NOT LATE', 'LATE', '1', '2020-10-26'),
(89, 'AS-002', '08:05 AM', '12:01 PM', '01:06 PM', '05:01 PM', 'LATE', 'LATE', '11', '2020-10-26'),
(90, 'FA-001', '08:11 AM', '01:12 PM', '01:12 PM', '', 'LATE', 'LATE', '23', '2020-10-30'),
(91, 'AS-002', '08:12 AM', '01:12 PM', '01:12 PM', '', 'LATE', 'LATE', '24', '2020-10-30'),
(92, 'AS-001', '08:12 AM', '01:13 PM', '01:13 PM', '', 'LATE', 'LATE', '25', '2020-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `d` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`d`) VALUES
(0),
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `parent_id`, `name`) VALUES
(6, 0, 'University'),
(7, 6, 'Admin Department'),
(8, 7, 'Human Resource'),
(9, 6, 'Academic Affairs'),
(11, 9, 'College of Teacher Education'),
(12, 9, 'College of Business and Management'),
(13, 9, 'College of Computer Studies'),
(14, 7, 'Physical Plant and Facilities'),
(15, 7, 'Planning');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(40) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `mname` varchar(40) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `suffix` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `employee_id`, `fname`, `mname`, `lname`, `suffix`) VALUES
(18, 'CD-001', 'Cynthia', 'Pantaleon', 'Sajot', ''),
(19, 'ACD-001', 'Bernardita', 'G', 'Quevedo', ''),
(20, 'HR-001', 'Emelita', 'A', 'Sinday', ''),
(21, 'ADO-001', 'Anecito', 'C', 'Sanchez', ''),
(22, 'FA-001', 'Dariel', 'Cuartero', 'Bongabong', ''),
(25, 'AS-002', 'Phaebe Ria', 'Morgado', 'Ajero', ''),
(26, 'AS-001', 'Stephen Nichole', 'Villanueva', 'Mantiza', ''),
(27, 'FA-002', 'Sandy Christopher', 'Murillo', 'Jabagat', '');

--
-- Triggers `employee`
--
DELIMITER $$
CREATE TRIGGER `after_employee_delete` AFTER DELETE ON `employee` FOR EACH ROW DELETE FROM userlogin WHERE employee_id ='AS-001'
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `emp_department`
--

CREATE TABLE `emp_department` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `employee_id` varchar(40) NOT NULL,
  `group_id` int(11) NOT NULL,
  `position` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_department`
--

INSERT INTO `emp_department` (`id`, `department_id`, `employee_id`, `group_id`, `position`) VALUES
(1, 13, 'FA-001', 4, 'Contractual Instructor'),
(2, 9, 'ACD-001', 3, 'Assistant Campus Director'),
(3, 8, 'HR-001', 3, 'Human Resource'),
(4, 7, 'ADO-001', 3, 'Administrative Officer IV'),
(8, 15, 'AS-002', 5, 'Job Order'),
(10, 14, 'AS-001', 5, 'Assistant Plant Engineer'),
(11, 12, 'FA-002', 4, 'Contractual Instructor');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `permission` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `role_weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permission`, `is_admin`, `role_weight`) VALUES
(1, 'System Administrator', 'is_admin', 1, 0),
(2, 'Campus Director', 'is_cd', 1, 1),
(3, 'Department Head', 'is_dh', 1, 2),
(4, 'Faculty', 'is_fac', 0, 3),
(5, 'Staff', 'is_staff', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tally`
--

CREATE TABLE `tally` (
  `n` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tally`
--

INSERT INTO `tally` (`n`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(44),
(45),
(46),
(47),
(48),
(49),
(50),
(51),
(52),
(53),
(54),
(55),
(56),
(57),
(58),
(59),
(60),
(61),
(62),
(63),
(64),
(65),
(66),
(67),
(68),
(69),
(70),
(71),
(72),
(73),
(74),
(75),
(76),
(77),
(78),
(79),
(80),
(81),
(82),
(83),
(84),
(85),
(86),
(87),
(88),
(89),
(90),
(91),
(92),
(93),
(94),
(95),
(96),
(97),
(98),
(99),
(100),
(101),
(102),
(103),
(104),
(105),
(106),
(107),
(108),
(109),
(110),
(111),
(112),
(113),
(114),
(115),
(116),
(117),
(118),
(119),
(120),
(121),
(122),
(123),
(124),
(125),
(126),
(127),
(128),
(129),
(130),
(131),
(132),
(133),
(134),
(135),
(136),
(137),
(138),
(139),
(140),
(141),
(142),
(143),
(144),
(145),
(146),
(147),
(148),
(149),
(150),
(151),
(152),
(153),
(154),
(155),
(156),
(157),
(158),
(159),
(160),
(161),
(162),
(163),
(164),
(165),
(166),
(167),
(168),
(169),
(170),
(171),
(172),
(173),
(174),
(175),
(176),
(177),
(178),
(179),
(180),
(181),
(182),
(183),
(184),
(185),
(186),
(187),
(188),
(189),
(190),
(191),
(192),
(193),
(194),
(195),
(196),
(197),
(198),
(199),
(200),
(201),
(202),
(203),
(204),
(205),
(206),
(207),
(208),
(209),
(210),
(211),
(212),
(213),
(214),
(215),
(216),
(217),
(218),
(219),
(220),
(221),
(222),
(223),
(224),
(225),
(226),
(227),
(228),
(229),
(230),
(231),
(232),
(233),
(234),
(235),
(236),
(237),
(238),
(239),
(240),
(241),
(242),
(243),
(244),
(245),
(246),
(247),
(248),
(249),
(250),
(251),
(252),
(253),
(254),
(255),
(256),
(257),
(258),
(259),
(260),
(261),
(262),
(263),
(264),
(265),
(266),
(267),
(268),
(269),
(270),
(271),
(272),
(273),
(274),
(275),
(276),
(277),
(278),
(279),
(280),
(281),
(282),
(283),
(284),
(285),
(286),
(287),
(288),
(289),
(290),
(291),
(292),
(293),
(294),
(295),
(296),
(297),
(298),
(299),
(300),
(301),
(302),
(303),
(304),
(305),
(306),
(307),
(308),
(309),
(310),
(311),
(312),
(313),
(314),
(315),
(316),
(317),
(318),
(319),
(320),
(321),
(322),
(323),
(324),
(325),
(326),
(327),
(328),
(329),
(330),
(331),
(332),
(333),
(334),
(335),
(336),
(337),
(338),
(339),
(340),
(341),
(342),
(343),
(344),
(345),
(346),
(347),
(348),
(349),
(350),
(351),
(352),
(353),
(354),
(355),
(356),
(357),
(358),
(359),
(360),
(361),
(362),
(363),
(364),
(365),
(366),
(367),
(368),
(369),
(370),
(371),
(372),
(373),
(374),
(375),
(376),
(377),
(378),
(379),
(380),
(381),
(382),
(383),
(384),
(385),
(386),
(387),
(388),
(389),
(390),
(391),
(392),
(393),
(394),
(395),
(396),
(397),
(398),
(399),
(400),
(401),
(402),
(403),
(404),
(405),
(406),
(407),
(408),
(409),
(410),
(411),
(412),
(413),
(414),
(415),
(416),
(417),
(418),
(419),
(420),
(421),
(422),
(423),
(424),
(425),
(426),
(427),
(428),
(429),
(430),
(431),
(432),
(433),
(434),
(435),
(436),
(437),
(438),
(439),
(440),
(441),
(442),
(443),
(444),
(445),
(446),
(447),
(448),
(449),
(450),
(451),
(452),
(453),
(454),
(455),
(456),
(457),
(458),
(459),
(460),
(461),
(462),
(463),
(464),
(465),
(466),
(467),
(468),
(469),
(470),
(471),
(472),
(473),
(474),
(475),
(476),
(477),
(478),
(479),
(480),
(481),
(482),
(483),
(484),
(485),
(486),
(487),
(488),
(489),
(490),
(491),
(492),
(493),
(494),
(495),
(496),
(497),
(498),
(499),
(500),
(501),
(502),
(503),
(504),
(505),
(506),
(507),
(508),
(509),
(510),
(511),
(512),
(513),
(514),
(515),
(516),
(517),
(518),
(519),
(520),
(521),
(522),
(523),
(524),
(525),
(526),
(527),
(528),
(529),
(530),
(531),
(532),
(533),
(534),
(535),
(536),
(537),
(538),
(539),
(540),
(541),
(542),
(543),
(544),
(545),
(546),
(547),
(548),
(549),
(550),
(551),
(552),
(553),
(554),
(555),
(556),
(557),
(558),
(559),
(560),
(561),
(562),
(563),
(564),
(565),
(566),
(567),
(568),
(569),
(570),
(571),
(572),
(573),
(574),
(575),
(576),
(577),
(578),
(579),
(580),
(581),
(582),
(583),
(584),
(585),
(586),
(587),
(588),
(589),
(590),
(591),
(592),
(593),
(594),
(595),
(596),
(597),
(598),
(599),
(600),
(601),
(602),
(603),
(604),
(605),
(606),
(607),
(608),
(609),
(610),
(611),
(612),
(613),
(614),
(615),
(616),
(617),
(618),
(619),
(620),
(621),
(622),
(623),
(624),
(625),
(626),
(627),
(628),
(629),
(630),
(631),
(632),
(633),
(634),
(635),
(636),
(637),
(638),
(639),
(640),
(641),
(642),
(643),
(644),
(645),
(646),
(647),
(648),
(649),
(650),
(651),
(652),
(653),
(654),
(655),
(656),
(657),
(658),
(659),
(660),
(661),
(662),
(663),
(664),
(665),
(666),
(667),
(668),
(669),
(670),
(671),
(672),
(673),
(674),
(675),
(676),
(677),
(678),
(679),
(680),
(681),
(682),
(683),
(684),
(685),
(686),
(687),
(688),
(689),
(690),
(691),
(692),
(693),
(694),
(695),
(696),
(697),
(698),
(699),
(700),
(701),
(702),
(703),
(704),
(705),
(706),
(707),
(708),
(709),
(710),
(711),
(712),
(713),
(714),
(715),
(716),
(717),
(718),
(719),
(720),
(721),
(722),
(723),
(724),
(725),
(726),
(727),
(728),
(729),
(730),
(731),
(732),
(733),
(734),
(735),
(736),
(737),
(738),
(739),
(740),
(741),
(742),
(743),
(744),
(745),
(746),
(747),
(748),
(749),
(750),
(751),
(752),
(753),
(754),
(755),
(756),
(757),
(758),
(759),
(760),
(761),
(762),
(763),
(764),
(765),
(766),
(767),
(768),
(769),
(770),
(771),
(772),
(773),
(774),
(775),
(776),
(777),
(778),
(779),
(780),
(781),
(782),
(783),
(784),
(785),
(786),
(787),
(788),
(789),
(790),
(791),
(792),
(793),
(794),
(795),
(796),
(797),
(798),
(799),
(800),
(801),
(802),
(803),
(804),
(805),
(806),
(807),
(808),
(809),
(810),
(811),
(812),
(813),
(814),
(815),
(816),
(817),
(818),
(819),
(820),
(821),
(822),
(823),
(824),
(825),
(826),
(827),
(828),
(829),
(830),
(831),
(832),
(833),
(834),
(835),
(836),
(837),
(838),
(839),
(840),
(841),
(842),
(843),
(844),
(845),
(846),
(847),
(848),
(849),
(850),
(851),
(852),
(853),
(854),
(855),
(856),
(857),
(858),
(859),
(860),
(861),
(862),
(863),
(864),
(865),
(866),
(867),
(868),
(869),
(870),
(871),
(872),
(873),
(874),
(875),
(876),
(877),
(878),
(879),
(880),
(881),
(882),
(883),
(884),
(885),
(886),
(887),
(888),
(889),
(890),
(891),
(892),
(893),
(894),
(895),
(896),
(897),
(898),
(899),
(900),
(901),
(902),
(903),
(904),
(905),
(906),
(907),
(908),
(909),
(910),
(911),
(912),
(913),
(914),
(915),
(916),
(917),
(918),
(919),
(920),
(921),
(922),
(923),
(924),
(925),
(926),
(927),
(928),
(929),
(930),
(931),
(932),
(933),
(934),
(935),
(936),
(937),
(938),
(939),
(940),
(941),
(942),
(943),
(944),
(945),
(946),
(947),
(948),
(949),
(950),
(951),
(952),
(953),
(954),
(955),
(956),
(957),
(958),
(959),
(960),
(961),
(962),
(963),
(964),
(965),
(966),
(967),
(968),
(969),
(970),
(971),
(972),
(973),
(974),
(975),
(976),
(977),
(978),
(979),
(980),
(981),
(982),
(983),
(984),
(985),
(986),
(987),
(988),
(989),
(990),
(991),
(992),
(993),
(994),
(995),
(996),
(997),
(998),
(999),
(1000);

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `id` int(11) NOT NULL,
  `permission` int(11) NOT NULL,
  `employee_id` varchar(40) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(50) NOT NULL,
  `joined` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`id`, `permission`, `employee_id`, `username`, `password`, `avatar`, `joined`) VALUES
(2, 1, '', 'admin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1590480980.png', '2019-10-21 15:24:32'),
(75, 2, 'CD-001', 'Cynthia', '2482517c61352f9578a40d4a8d34e5bf8509286247d32f69522d01cf9c0f24a6', '', '2020-10-29 19:02:48'),
(76, 3, 'ACD-001', 'Bernardita', '319d6250a2e4a5b0fc2d87684cdcfd1135c1d4abadbe79a217f93ef92a5b3d03', '', '2020-10-29 19:59:12'),
(77, 3, 'HR-001', 'Emelita', '1e86689880ab797883c4d778075c5beef0c45111b015138c0670c06268beffec', '', '2020-10-29 20:06:29'),
(78, 3, 'ADO-001', 'Anecito', 'ec16fece53c8969378d9aadea91187ce9b5112a993027ad68a2bb2bb5a736625', '', '2020-10-29 20:25:35'),
(79, 4, 'FA-001', 'Dariel', '588d67b09406ded91b9839c0738bfa66b9b7194b6dbc3a596afab04124a6d195', '', '2020-10-29 20:38:27'),
(82, 5, 'AS-002', 'Ajero', 'd177e08fd9f01afe5d0720c0c51642a5b073c41ff5cce997bcd144d4a635007d', '', '2020-10-29 23:38:17'),
(83, 5, 'AS-001', 'Mantiza', '41de5837bd65403d55868742a485af017f26784e2413925c3b0faf08762beeb0', '', '2020-10-29 23:42:12'),
(84, 4, 'FA-002', 'Jabagat', '4482f37ed397cbe47bd95b90ff300c896931126ec30f69333cb7722be442c6ae', '', '2020-10-30 15:00:07');

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE `users_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accomplishment`
--
ALTER TABLE `accomplishment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`d`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_department`
--
ALTER TABLE `emp_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tally`
--
ALTER TABLE `tally`
  ADD PRIMARY KEY (`n`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accomplishment`
--
ALTER TABLE `accomplishment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `emp_department`
--
ALTER TABLE `emp_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
