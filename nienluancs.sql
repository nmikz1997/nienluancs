-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2018 at 02:10 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nienluancs`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitiettruyen`
--

CREATE TABLE IF NOT EXISTS `chitiettruyen` (
  `matruyen` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `tinhtrang` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `ngaynhap` date NOT NULL,
  `bia` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gia` double NOT NULL,
  `soluong` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chitiettruyen`
--

INSERT INTO `chitiettruyen` (`matruyen`, `tinhtrang`, `ngaynhap`, `bia`, `gia`, `soluong`) VALUES
('1', 'new', '2018-10-11', '1new_img639.jpg', 22000, 7),
('111', 'new', '2018-10-08', '111new_f342bf01e0695bfb9429a5f3ee.jpg', 20000, 70),
('111', 'old', '2018-10-08', '111old_46747075_489475841574802_5933167689273966592_n.jpg', 12000, 11),
('1110', 'new', '2018-11-26', '1110new_sst310.jpg', 22000, 5),
('1110', 'old', '2018-11-25', '1110old_stt3_t10.jpg', 18000, 1),
('222', 'new', '2018-10-08', '222new_ef108a47cd32bfa1fadb12e64fbaa170.jpg', 21000, 202),
('222', 'old', '2018-10-08', '222old_ff7f453a3a5dbb39df4aec35616a058b.jpg', 11000, 197),
('333', 'new', '2018-10-08', '333new_doraemon-dai-tuyen-tap---truyen-ngan.u4972.d20170531.t163159.716408.jpg', 110000, 100),
('333', 'old', '2018-10-08', '333old_434972176b2be3a581793126e16382da.jpg', 12000, 326),
('444', 'new', '2018-10-08', '444new_img806.png', 17000, 50),
('444', 'old', '2018-10-08', '444old_truyen-conan-tap-86-1474096488-1384871-1480566767.jpg', 8000, 200);

-- --------------------------------------------------------

--
-- Table structure for table `cthoadon`
--

CREATE TABLE IF NOT EXISTS `cthoadon` (
  `mahd` int(10) NOT NULL,
  `matruyen` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `tinhtrang` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `soluong` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cthoadon`
--

INSERT INTO `cthoadon` (`mahd`, `matruyen`, `tinhtrang`, `soluong`) VALUES
(2, '222', 'new', 1),
(11, '1', 'new', 1),
(12, '1', 'new', 3),
(13, '111', 'new', 5),
(13, '222', 'new', 2),
(13, '222', 'old', 1),
(13, '444', 'old', 2),
(14, '111', 'old', 2),
(16, '222', 'old', 1),
(16, '333', 'old', 1),
(18, '1', 'new', 4);

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE IF NOT EXISTS `hoadon` (
`mahd` int(10) NOT NULL,
  `sdtkh` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `diachi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tonggt` int(11) NOT NULL,
  `ngaylap` date NOT NULL,
  `giaohang` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`mahd`, `sdtkh`, `diachi`, `tonggt`, `ngaylap`, `giaohang`) VALUES
(2, 'admin', '3/2 Xuân Khánh, Ninh Kiều', 2222, '2018-11-22', 1),
(11, 'admin', '3/2 Xuân Khánh, Ninh Kiều', 22000, '2018-11-25', 1),
(12, 'admin', '3/2 Xuân Khánh, Ninh Kiều', 66000, '2018-11-25', 1),
(13, 'admin', 'Mạc thiên tích', 169000, '2018-11-25', 1),
(14, 'admin', 'Mạc thiên tích', 24000, '2018-11-25', 1),
(16, 'admin', 'Mạc thiên tích', 23000, '2018-11-25', 1),
(18, 'admin', '116A, Đường 3/2, P.Xuân Khánh, Q.Ninh Kiều, TP.Cần Thơ', 88000, '2018-11-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE IF NOT EXISTS `khachhang` (
  `sdtkh` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `tenkh` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `emailkh` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`sdtkh`, `tenkh`, `emailkh`) VALUES
('0772190710', 'Võ Chí Thanh', 'trinhthenguyen123@gmail.com'),
('0772190719', 'Võ Chí Thanh', 'namtemmo2015@gmail.com'),
('0912399123', 'Từ Thanh Nhã', 'tuthanhnha1997@gmail.com'),
('0946730447', 'Nguyễn Văn A', 'trinhthenguyen123@gmail.com'),
('0946730452', 'trịnh thế nguyễn', 'trinhthenguyen123@gmail.com'),
('admin', 'Trịnh Thế Nguyễn', 'trinhthenguyen123@gmail.com'),
('user', 'A A A', 'aaa@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `loai_truyen`
--

CREATE TABLE IF NOT EXISTS `loai_truyen` (
  `matruyen` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `maloai` char(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loai_truyen`
--

INSERT INTO `loai_truyen` (`matruyen`, `maloai`) VALUES
('1111', 'action'),
('222', 'action'),
('444', 'action'),
('1111', 'advent'),
('333', 'advent'),
('0101', 'comedy'),
('1', 'comedy'),
('1100', 'comedy'),
('111', 'comedy'),
('1110', 'comedy'),
('333', 'comedy'),
('1100', 'cooking'),
('0101', 'detective'),
('444', 'detective'),
('1', 'DT'),
('111', 'DT'),
('1110', 'DT'),
('333', 'DT'),
('333', 'fantasy'),
('333', 'mecha'),
('1', 'psy'),
('111', 'psy'),
('1110', 'psy'),
('1', 'school'),
('111', 'school'),
('1110', 'school'),
('222', 'school'),
('333', 'school'),
('444', 'school'),
('222', 'scifi'),
('333', 'scifi'),
('222', 'VT');

-- --------------------------------------------------------

--
-- Table structure for table `nhaxuatban`
--

CREATE TABLE IF NOT EXISTS `nhaxuatban` (
  `manxb` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `tennxb` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nhaxuatban`
--

INSERT INTO `nhaxuatban` (`manxb`, `tennxb`) VALUES
('DT', 'Đinh Tị'),
('KD', 'NXB Kim Đồng'),
('TAB', 'T.A Books'),
('TRE', 'NXB Trẻ'),
('TV', 'Trí Việt');

-- --------------------------------------------------------

--
-- Table structure for table `tacgia`
--

CREATE TABLE IF NOT EXISTS `tacgia` (
  `matg` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `tentg` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `imgtg` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `info` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tacgia`
--

INSERT INTO `tacgia` (`matg`, `tentg`, `imgtg`, `info`) VALUES
('222', 'Fujiko Fujio', '222_img_fujiko.jpg', 'https://vi.wikipedia.org/wiki/Fujiko_Fujio'),
('333', 'Chica Umino', '333_Chica_Umino.jpg', 'https://vi.wikipedia.org/wiki/Umino_Chica'),
('aaa', 'Eiichiro Oda', 'aaa_Eiichiro_Oda.jpg', 'https://vi.wikipedia.org/wiki/Oda_Eiichiro'),
('N4', 'Arakawa Hiromu', 'N4_Hiromu_Arakawa.jpg', 'https://vi.wikipedia.org/wiki/Arakawa_Hiromu');

-- --------------------------------------------------------

--
-- Table structure for table `tacgia_truyen`
--

CREATE TABLE IF NOT EXISTS `tacgia_truyen` (
  `matg` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `matruyen` char(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tacgia_truyen`
--

INSERT INTO `tacgia_truyen` (`matg`, `matruyen`) VALUES
('aaa', '0101'),
('333', '1'),
('333', '1100'),
('N4', '1100'),
('333', '111'),
('333', '1110'),
('222', '1111'),
('333', '1111'),
('333', '222'),
('222', '333'),
('333', '444'),
('N4', '444');

-- --------------------------------------------------------

--
-- Table structure for table `theloai`
--

CREATE TABLE IF NOT EXISTS `theloai` (
  `maloai` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `tenloai` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `theloai`
--

INSERT INTO `theloai` (`maloai`, `tenloai`) VALUES
('action', 'Hành Động'),
('advent', 'Phiêu lưu'),
('comedy', 'Hài hước'),
('cooking', 'Ẩm Thực'),
('detective', 'Trinh Thám'),
('DT', 'Đời thường'),
('fantasy', 'Kỳ ảo'),
('mecha', 'Robot'),
('psy', 'Tâm lí học'),
('school', 'Học đường'),
('scifi', 'khoa học viễn tưởng'),
('VT', 'Võ thuật');

-- --------------------------------------------------------

--
-- Table structure for table `truyen`
--

CREATE TABLE IF NOT EXISTS `truyen` (
  `matruyen` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `tentruyen` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `manxb` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `ngayxb` date NOT NULL,
  `noidung` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `truyen`
--

INSERT INTO `truyen` (`matruyen`, `tentruyen`, `manxb`, `ngayxb`, `noidung`) VALUES
('0101', 'test', 'TAB', '2012-11-12', '222\r\n								'),
('1', 'Sư tử tháng 3 (tập 7)', 'KD', '2018-10-10', 'Là học sinh lớp 9, Hinata đang phải đắn đo lựa chọn lối đi cho riêng mình. Cô bé không biết mình muốn gì song lại không cho phép mình với tới... \r\nRei và gia đình Hina vẫn trìu mến theo dõi cô. Trong khi đó, tại giải Danh Nhân, Soya cùng Dobashi cửu đẳng, đối thủ từ thời thơ ấu, đã thi đấu những ván cờ nảy lửa. \r\nVẫn chưa theo kịp được Soya, Dobashi nhận được sự ủng hộ hết mình từ gia đình... \r\nAi mới là người thực sự quan trọng? Đó là câu hỏi được đặt ra trong tập truyện này.'),
('1100', 'aaa', 'DT', '2011-11-11', 'asdasd\r\n								'),
('111', 'Sư tử tháng 3 (tập 11)', 'KD', '2018-11-10', 'Rei quyết tâm tranh đấu tới cùng, nhất định không lùi bước trước ông Seijiro - ba của chị em Hina, người hết lần này đến lần khác tự ý đặt gia đình Kawamoto vào những kế hoạch ích kỉ của mình. Akari, Hinata, dì Misaki, ông Someji, tất cả mọi người trong nhà Kawamoto đều cảm nhận được sự tồn tại lớn lao của Rei trong cuộc đời họ... Chặng đường Rei đã đi qua suốt từ thời thơ ấu đến giờ sẽ được ghi lại trong những trang phụ bản "Fighter" đính kèm của tập 11.'),
('1110', 'Sư tử tháng 3 (tập 10)', 'KD', '2014-11-10', 'Hinata lên lớp 10, vào học cùng trường với Rei. \r\nRei lên lớp 12, cuộc sống được lấp đầy bằng những giờ học trên lớp và những ván đấu. \r\nTháng ngày yên ả ấy bỗng dưng xáo trộn. \r\nMột vị khách không mời đột nhiên xuất hiện ở nhà Kawamoto...? \r\nNhững diễn biến ở tập 10 sẽ giúp độc giả cảm nhận được sự trưởng thành của cậu thiếu niên Kiriyama. \r\nSư tử tháng 3 Câu chuyện ấm áp khơi gợi nhiều suy nghiệm trong lòng mỗi người. \r\n								'),
('1111', 'aaa', 'KD', '2012-11-11', 'asdasd\r\n								'),
('222', 'Học viện anh hùng (tập 5)', 'TRE', '2017-02-12', 'ĐẦU TRẬN CUỐI CÙNG trong VÒNG ĐẤU CHÍNH THỨC!! Trước một đối thủ siêu đáng gờm như Bakugo, Uraraka vẫn giữ tinh thần hăng hái. Cả hai bên đều dốc hết sức mình vào cuộc so tài. Mọi người vừa là bạn , vừa là ĐỐI THỦ ! Mình cũng phải đấu một trận không hổ thẹn để trở thành siêu anh hùng giống như anh hai mới được!'),
('333', 'Doreamon (Tập 1-10)', 'KD', '2001-03-31', 'Bộ sách là phiên bản tập hợp đầy đủ nhất các truyện ngắn Doraemon, trong đó đã bao gồm những truyện ngắn quen thuộc trong bộ 45 tập cùng những sáng tác chưa từng ra mắt của tác giả Fujiko F Fujio được đăng rải rác trên các tạp chí dành cho lứa tuổi Nhi Đồng tại Nhật Bản.								'),
('444', 'Conan (tập 86)', 'DT', '2004-04-04', 'Thi thể đã biến đi đâu!? “Vụ án xác chết biến mất trong bể bơi” sẽ được làm sáng tỏ! Bên cạnh đó, bóng dáng “Rum”, nhân vật quyền lực thứ 2 của tổm chức Áo Đen sẽ theo sát Conan và haibara!? Cũng trong tập này, “vụ án người cô thân thiết”, vụ án mạng quái vật “kamaitachi” với sự tham gia của heiji... và mở đầu của “án mạng kawanakajima” nơi máu của các cảnh sát hình sự sẽ đổ xuống chiến trường xưa ở tỉnh Nagano... hứa hẹn sẽ mang tới nhiều điều bất ngờ!');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quyen` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user`, `pass`, `quyen`) VALUES
('0772190710', '4297f44b13955235245b2497399d7a93', 0),
('0772190719', '4297f44b13955235245b2497399d7a93', 0),
('0912399123', '4297f44b13955235245b2497399d7a93', 0),
('0946730447', '4297f44b13955235245b2497399d7a93', 0),
('0946730452', '4297f44b13955235245b2497399d7a93', 0),
('admin', '4297f44b13955235245b2497399d7a93', 1),
('user', '4297f44b13955235245b2497399d7a93', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitiettruyen`
--
ALTER TABLE `chitiettruyen`
 ADD PRIMARY KEY (`matruyen`,`tinhtrang`);

--
-- Indexes for table `cthoadon`
--
ALTER TABLE `cthoadon`
 ADD PRIMARY KEY (`mahd`,`matruyen`,`tinhtrang`), ADD KEY `matruyen` (`matruyen`,`tinhtrang`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
 ADD PRIMARY KEY (`mahd`), ADD KEY `sdtkh` (`sdtkh`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
 ADD PRIMARY KEY (`sdtkh`);

--
-- Indexes for table `loai_truyen`
--
ALTER TABLE `loai_truyen`
 ADD PRIMARY KEY (`matruyen`,`maloai`), ADD KEY `maloai` (`maloai`);

--
-- Indexes for table `nhaxuatban`
--
ALTER TABLE `nhaxuatban`
 ADD PRIMARY KEY (`manxb`);

--
-- Indexes for table `tacgia`
--
ALTER TABLE `tacgia`
 ADD PRIMARY KEY (`matg`);

--
-- Indexes for table `tacgia_truyen`
--
ALTER TABLE `tacgia_truyen`
 ADD PRIMARY KEY (`matg`,`matruyen`), ADD KEY `matruyen` (`matruyen`);

--
-- Indexes for table `theloai`
--
ALTER TABLE `theloai`
 ADD PRIMARY KEY (`maloai`);

--
-- Indexes for table `truyen`
--
ALTER TABLE `truyen`
 ADD PRIMARY KEY (`matruyen`), ADD KEY `manxb` (`manxb`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
MODIFY `mahd` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitiettruyen`
--
ALTER TABLE `chitiettruyen`
ADD CONSTRAINT `chitiettruyen_ibfk_1` FOREIGN KEY (`matruyen`) REFERENCES `truyen` (`matruyen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cthoadon`
--
ALTER TABLE `cthoadon`
ADD CONSTRAINT `cthoadon_ibfk_1` FOREIGN KEY (`mahd`) REFERENCES `hoadon` (`mahd`) ON DELETE CASCADE,
ADD CONSTRAINT `cthoadon_ibfk_2` FOREIGN KEY (`matruyen`, `tinhtrang`) REFERENCES `chitiettruyen` (`matruyen`, `tinhtrang`);

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`sdtkh`) REFERENCES `khachhang` (`sdtkh`);

--
-- Constraints for table `loai_truyen`
--
ALTER TABLE `loai_truyen`
ADD CONSTRAINT `loai_truyen_ibfk_1` FOREIGN KEY (`matruyen`) REFERENCES `truyen` (`matruyen`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `loai_truyen_ibfk_2` FOREIGN KEY (`maloai`) REFERENCES `theloai` (`maloai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tacgia_truyen`
--
ALTER TABLE `tacgia_truyen`
ADD CONSTRAINT `tacgia_truyen_ibfk_1` FOREIGN KEY (`matruyen`) REFERENCES `truyen` (`matruyen`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tacgia_truyen_ibfk_2` FOREIGN KEY (`matg`) REFERENCES `tacgia` (`matg`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `truyen`
--
ALTER TABLE `truyen`
ADD CONSTRAINT `truyen_ibfk_1` FOREIGN KEY (`manxb`) REFERENCES `nhaxuatban` (`manxb`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user`) REFERENCES `khachhang` (`sdtkh`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
