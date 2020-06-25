--
-- Table structure for table `anime`
--

CREATE TABLE `anime` (
  `anime_parent_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `poster_url_medium` varchar(255) NOT NULL,
  `poster_url_small` varchar(255) NOT NULL,
  `full_episode` int(11) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `season` varchar(21) NOT NULL,
  `year` varchar(50) NOT NULL,
  `sinopsis` mediumtext NOT NULL,
  `credits` tinytext NOT NULL,
  `rating` varchar(25) NOT NULL,
  `trailer` varchar(255) NOT NULL,
  `ket` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `download_count` int(255) NOT NULL,
  `view_count` int(255) NOT NULL,
  `kitsu_info` varchar(100) NOT NULL,
  `progress` int(10) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(55) NOT NULL,
  `user_id` int(55) NOT NULL,
  `anime_parent_id` int(50) NOT NULL,
  `comment` text NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `episodes`
--

CREATE TABLE `episodes` (
  `anime_child_id` int(11) NOT NULL,
  `anime_parent_id` int(11) NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `links` text NOT NULL,
  `website` varchar(255) NOT NULL,
  `link_status` varchar(100) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fansub_preferences`
--

CREATE TABLE `fansub_preferences` (
  `id` int(1) NOT NULL,
  `fansub_name` varchar(55) NOT NULL,
  `rows_perpage_tile` int(11) NOT NULL,
  `rows_perpage_list` int(11) NOT NULL,
  `about_text` text NOT NULL,
  `custom_menu_name` varchar(100) NOT NULL,
  `status_custom_menu` int(1) NOT NULL,
  `link_custom_menu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fansub_preferences`
--

INSERT INTO `fansub_preferences` (`id`, `fansub_name`, `rows_perpage_tile`, `rows_perpage_list`, `about_text`, `custom_menu_name`, `status_custom_menu`, `link_custom_menu`) VALUES
(1, 'Koreksubs Makina', 9, 15, 'KorekSubs adalah Fansub dan Fanshare anime sub indo (subtitle indonesia). <br>Semua konten yang ada di website ini adalah hasil dari orang-orang hebat yang tercantum di \"credits\". <br>KorekSubs sama sekali bukanlah pemilik asli dari konten subtitle, apalagi anime yang dipajang di setiap halaman website ini.', '[Custom Menu]', 0, 'nama_item1@http://link_item1@nama_item2@http://link_item2');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `from` varchar(55) NOT NULL,
  `to` varchar(55) NOT NULL,
  `text` text NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stat`
--

CREATE TABLE `stat` (
  `id` int(66) NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `tahun` year(4) NOT NULL,
  `download_count` int(255) NOT NULL,
  `view_count` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `themes_collection`
--

CREATE TABLE `themes_collection` (
  `theme_id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `image` varchar(255) NOT NULL,
  `navbar_skin` varchar(55) NOT NULL,
  `navbar_varian` varchar(55) NOT NULL,
  `brand_color` varchar(55) NOT NULL,
  `sidebar_color` varchar(55) NOT NULL,
  `accent_color` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `themes_collection`
--

INSERT INTO `themes_collection` (`theme_id`, `name`, `image`, `navbar_skin`, `navbar_varian`, `brand_color`, `sidebar_color`, `accent_color`) VALUES
(1, 'Emilia', 'emilia.png', 'navbar-light', 'navbar-white', 'indigo', 'sidebar-light-indigo', 'purple'),
(2, 'Hestia', 'hestia.png', 'navbar-dark', 'navbar-navy', 'primary', 'sidebar-light-primary', 'primary'),
(3, 'Katou_Megumi', 'katou_megumi.jpg', 'navbar-light', 'navbar-white', 'maroon', 'sidebar-dark-danger', 'danger'),
(4, 'Maid_Saber', 'maid_saber.png', 'navbar-dark', 'navbar-gray-dark', 'warning', 'sidebar-light-warning', 'warning'),
(5, 'Megumin', 'megumin.jpg', 'navbar-light', 'navbar-orange', 'orange', 'sidebar-dark-orange', 'danger'),
(6, 'Miku_Cold_Eyes', 'miku_cold_eyes.png', 'navbar-dark', 'navbar-lightblue', 'lightblue', 'sidebar-light-primary', 'lightblue'),
(7, 'Sakura_Chiyo', 'sakura_chiyo.png', 'navbar-dark', 'navbar-pink', 'success', 'sidebar-light-orange', 'primary'),
(8, 'Sakurajima_Mai', 'sakurajima_mai.png', 'navbar-dark', 'navbar-navy', 'info', 'sidebar-light-navy', 'info'),
(9, 'Tatsumaki', 'tatsumaki.png', 'navbar-light', 'navbar-white', 'success', 'sidebar-light-success', 'olive'),
(10, 'Tomoe', 'tomoe.jpg', 'navbar-light', 'navbar-white', 'lightblue', 'sidebar-light-danger', 'info'),
(11, 'Kaneki_x_Tsukiyama', 'kaneki_x_tsukiyama.jpg', 'navbar-light', 'navbar-white', 'purple', 'sidebar-dark-danger', 'purple'),
(12, 'Yato', 'yato.jpg', 'navbar-dark', 'navbar-navy', 'primary', 'sidebar-dark-primary', 'primary'),
(13, 'Sakamoto', 'sakamoto.jpg', 'navbar-light', 'navbar-white', 'maroon', 'sidebar-light-navy', 'danger'),
(14, 'Levi_2', 'levi2.jpg', 'navbar-dark', 'navbar-gray-dark', 'olive', 'sidebar-dark-gray', 'warning'),
(15, 'L', 'L.jpg', 'navbar-light', 'navbar-white', 'lightblue', 'sidebar-light-lightblue', 'lightblue'),
(16, 'Levi', 'levi.jpg', 'navbar-dark', 'navbar-gray-dark', 'navy', 'sidebar-dark-navy', 'navy'),
(17, 'Shoto', 'shoto.jpg', 'navbar-dark', 'navbar-pink', 'success', 'sidebar-light-orange', 'primary');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `kota_asal` varchar(255) NOT NULL,
  `skills` varchar(200) NOT NULL,
  `message_read` int(11) NOT NULL,
  `admin` int(1) NOT NULL,
  `timestamp` datetime NOT NULL,
  `navbar_skin` varchar(25) NOT NULL,
  `navbar_varian` varchar(25) NOT NULL,
  `brand_color` varchar(55) NOT NULL,
  `sidebar_color` varchar(55) NOT NULL,
  `accent_color` varchar(55) NOT NULL,
  `theme` varchar(55) NOT NULL,
  `sidebar_bg` varchar(255) NOT NULL,
  `subscription` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `kota_asal`, `skills`, `message_read`, `admin`, `timestamp`, `navbar_skin`, `navbar_varian`, `brand_color`, `sidebar_color`, `accent_color`, `theme`, `sidebar_bg`, `subscription`) VALUES
(1, 'admin', 'admin@admin', 'admin', 'Surakarta', 'Encoding/Compressing, Translate, Typesetting, Programming', 0, 2, '2020-02-23 14:36:48', 'navbar-dark', 'navbar-navy', 'primary', 'sidebar-dark-primary', 'primary', 'Yato', 'http://localhost/fansub_new/assets/img/theme/yato.jpg', 1);

--
-- Indexes for dumped tables
--



--
-- Table structure for table `stat_num`
--

CREATE TABLE `stat_num` (
  `view` int(11) NOT NULL,
  `download` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stat_num`
--

INSERT INTO `stat_num` (`view`, `download`) VALUES
(0, 0);
COMMIT;



--
-- Indexes for table `anime`
--
ALTER TABLE `anime`
  ADD PRIMARY KEY (`anime_parent_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`anime_child_id`),
  ADD KEY `anime_parent_id` (`anime_parent_id`);

--
-- Indexes for table `fansub_preferences`
--
ALTER TABLE `fansub_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stat`
--
ALTER TABLE `stat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes_collection`
--
ALTER TABLE `themes_collection`
  ADD PRIMARY KEY (`theme_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anime`
--
ALTER TABLE `anime`
  MODIFY `anime_parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `anime_child_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fansub_preferences`
--
ALTER TABLE `fansub_preferences`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stat`
--
ALTER TABLE `stat`
  MODIFY `id` int(66) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `themes_collection`
--
ALTER TABLE `themes_collection`
  MODIFY `theme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `episodes`
--
ALTER TABLE `episodes`
  ADD CONSTRAINT `episodes_ibfk_1` FOREIGN KEY (`anime_parent_id`) REFERENCES `anime` (`anime_parent_id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;
