-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 09 août 2023 à 05:15
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pms_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `medicine_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `medicines`
--

INSERT INTO `medicines` (`id`, `medicine_name`) VALUES
(1, 'Amoxicillin'),
(4, 'Antibiotic'),
(5, 'Antihistamine'),
(6, 'Atorvastatin'),
(3, 'Losartan'),
(2, 'Mefenamic'),
(7, 'Oxymetazoline');

-- --------------------------------------------------------

--
-- Structure de la table `medicine_details`
--

CREATE TABLE `medicine_details` (
  `id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `packing` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `medicine_details`
--

INSERT INTO `medicine_details` (`id`, `medicine_id`, `packing`) VALUES
(1, 1, '50'),
(2, 4, '50'),
(3, 5, '50'),
(4, 6, '25'),
(5, 3, '80'),
(6, 2, '100'),
(7, 7, '25');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(60) NOT NULL,
  `address` varchar(100) NOT NULL,
  `cnic` varchar(17) NOT NULL,
  `date_of_birth` date NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `gender` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `patients`
--

INSERT INTO `patients` (`id`, `patient_name`, `address`, `cnic`, `date_of_birth`, `phone_number`, `gender`) VALUES
(1, 'Mark Cooper', 'Sample Address 101 - Updated', '123654789', '1999-06-23', '091235649879', 'Male'),
(2, 'Nguyen Van A', '02 Rue George Sand', '43434545', '0000-00-00', '0770403280', 'Male'),
(3, 'Nguyen Van B', '03 Rue George Sand', '23145641564', '2023-04-17', '234545', 'Male'),
(4, 'Tran Van Tam', '02 Rue George Sand', '2121212121', '2023-04-05', '545454545', 'Female'),
(5, 'Nguyen Van', '02 Rue George Sand', '43434545', '2023-05-13', '234545', 'Male');

-- --------------------------------------------------------

--
-- Structure de la table `patient_diagnostic`
--

CREATE TABLE `patient_diagnostic` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(60) NOT NULL,
  `cmnd` varchar(17) NOT NULL,
  `date_of_birth` date NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `visit_date` date NOT NULL,
  `weight` varchar(12) NOT NULL,
  `patient_diagnostic_id` int(11) NOT NULL,
  `diachi` varchar(100) NOT NULL,
  `chandoan` varchar(100) NOT NULL,
  `lamsang` varchar(100) NOT NULL,
  `gan` varchar(100) NOT NULL,
  `duongmat` varchar(100) NOT NULL,
  `ongmatchu` varchar(100) NOT NULL,
  `tuimat` varchar(100) NOT NULL,
  `thantrai` varchar(100) NOT NULL,
  `thanphai` varchar(100) NOT NULL,
  `tuy` varchar(100) NOT NULL,
  `lach` varchar(100) NOT NULL,
  `bangquang` varchar(100) NOT NULL,
  `tuicung` varchar(100) NOT NULL,
  `tucung` varchar(100) NOT NULL,
  `buongtrungtrai` varchar(100) NOT NULL,
  `buongtrungphai` varchar(100) NOT NULL,
  `ghinhankhac` varchar(100) NOT NULL,
  `hinhanhsieuam` varchar(100) NOT NULL,
  `ketluan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `patient_diagnostic`
--

INSERT INTO `patient_diagnostic` (`id`, `patient_name`, `cmnd`, `date_of_birth`, `phone_number`, `gender`, `visit_date`, `weight`, `patient_diagnostic_id`, `diachi`, `chandoan`, `lamsang`, `gan`, `duongmat`, `ongmatchu`, `tuimat`, `thantrai`, `thanphai`, `tuy`, `lach`, `bangquang`, `tuicung`, `tucung`, `buongtrungtrai`, `buongtrungphai`, `ghinhankhac`, `hinhanhsieuam`, `ketluan`) VALUES
(1, 'John Doe', '25251325', '2022-06-30', '05051325', 'Male', '2023-05-07', '65 kg', 1, 'quang ngai', 'None', 'None', 'None', 'None', 'None', 'None', 'None', 'None', 'None', 'None', 'None', 'None', 'None', 'None', 'None', 'None', 'None', 'None'),
(2, 'Aea', '', '2023-05-05', 'qsdqdsq', 'Male', '0000-00-00', '', 0, '', 'qsdq ', 'cxcwx', 'qaea', 'sdfsdf', 'xcvcxv', 'qsdqsd', 'sdxvcx', 'xcvxcv', 'xvxv', 'xcvxcv', 'xcvxcvcx', 'xcvxcvx', 'xvxcv', 'xvxcv', 'xvxv', 'xvxcv', 'xvxcv', 'xcvxcvxc'),
(3, 'Qsdqsd', '', '2023-05-08', 'azeaz', 'Female', '0000-00-00', '', 0, '', 'azeaz', 'azea', 'azea', 'qsdsq', 'qdqsd', 'qsdq', 'qsdqsd', 'qsdsqd', 'qdqsd', 'qsdsqd', 'qsdsqd', 'qsdqd', 'qsdqsd', 'qsdqsd', 'qsdqd', 'qdqs', 'ũcwxqsd', 'ucwxc'),
(4, 'Le Van A', '', '2021-12-13', '0770421325', 'Male', '0000-00-00', '', 0, '', 'Nhuc dau', 'aze', 'qsd', 'bth', 'baze', 'zaqsd', 'qdqsd', 'fdsf', 'qsda', 'xcvxcv', 'xcvxcvx', 'xcvdsf', 'gfhfgh', 'fghgfhf', 'fsfsdf', 'sdfsf', 'DSC00376.JPG', 'Rat na binh thuong');

-- --------------------------------------------------------

--
-- Structure de la table `patient_examen`
--

CREATE TABLE `patient_examen` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(60) NOT NULL,
  `cmnd` varchar(17) NOT NULL,
  `tuoi` varchar(5) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `visit_date` date NOT NULL ,
  `weight` varchar(12) NOT NULL,
  `patient_diagnostic_id` int(11) NOT NULL,
  `diachi` varchar(100) NOT NULL,
  `chandoan` varchar(100) NOT NULL,
  `lamsang` varchar(100) NOT NULL,
  `gan` varchar(100) NOT NULL,
  `duongmat` varchar(100) NOT NULL,
  `ongmatchu` varchar(100) NOT NULL,
  `tuimat` varchar(100) NOT NULL,
  `thantrai` varchar(100) NOT NULL,
  `thanphai` varchar(100) NOT NULL,
  `tuy` varchar(100) NOT NULL,
  `lach` varchar(100) NOT NULL,
  `bangquang` varchar(100) NOT NULL,
  `tuicung` varchar(100) NOT NULL,
  `tucung` varchar(100) NOT NULL,
  `buongtrungtrai` varchar(100) NOT NULL,
  `buongtrungphai` varchar(100) NOT NULL,
  `ghinhankhac` varchar(100) NOT NULL,
  `hinhanhsieuam` longblob NOT NULL,
  `ketluan` varchar(100) NOT NULL,
  `loikhuyen` varchar(100) NOT NULL,
  `ghichukhac` varchar(100) NOT NULL,
  `hentaikham` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `patient_examen`
--

INSERT INTO `patient_examen` (`id`, `patient_name`, `cmnd`, `tuoi`, `phone_number`, `gender`, `visit_date`, `weight`, `patient_diagnostic_id`, `diachi`, `chandoan`, `lamsang`, `gan`, `duongmat`, `ongmatchu`, `tuimat`, `thantrai`, `thanphai`, `tuy`, `lach`, `bangquang`, `tuicung`, `tucung`, `buongtrungtrai`, `buongtrungphai`, `ghinhankhac`, `hinhanhsieuam`, `ketluan`) VALUES
(2, 'Nguyen Van A', '25251325', '50', '0101010101', 'Nam', '2023-05-20', '', 0, 'Quang Ngai', 'bth', 'bth', 'bth', 'bth', 'bth', 'bth', 'bth', 'bth', 'bth', 'bth', 'bth', 'bth', 'bth', 'bth', 'bth', 'bth', 0x3136383435383331323930355f30352e504e47, 'verybth'),
(3, 'Nguyen Van B', '123456789', '25', '0000', 'Nữ', '2023-05-20', '', 0, 'Hanoi', 'bt', 'bt', 'bt', 'btb', 'bt', 'btb', 'btb', 'bt', 'btba', 'very', 'bv', 'aze', 'qd', 'qsdq', 'dqsd', 'qdsq', 0x3136383435383332323150584c5f32303232313232345f313135303031353036202831292e6a7067, 'ok');

-- --------------------------------------------------------

--
-- Structure de la table `patient_medication_history`
--

CREATE TABLE `patient_medication_history` (
  `id` int(11) NOT NULL,
  `patient_visit_id` int(11) NOT NULL,
  `medicine_details_id` int(11) NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `dosage` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `patient_medication_history`
--

INSERT INTO `patient_medication_history` (`id`, `patient_visit_id`, `medicine_details_id`, `quantity`, `dosage`) VALUES
(1, 1, 1, 5, '250'),
(2, 1, 6, 2, '500'),
(3, 2, 2, 2, '250'),
(4, 2, 7, 2, '250'),
(5, 3, 2, 1, '1');

-- --------------------------------------------------------

--
-- Structure de la table `patient_visits`
--

CREATE TABLE `patient_visits` (
  `id` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `next_visit_date` date DEFAULT NULL,
  `bp` varchar(23) NOT NULL,
  `weight` varchar(12) NOT NULL,
  `disease` varchar(30) NOT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `patient_visits`
--

INSERT INTO `patient_visits` (`id`, `visit_date`, `next_visit_date`, `bp`, `weight`, `disease`, `patient_id`) VALUES
(1, '2022-06-28', '2022-06-30', '120/80', '65 kg.', 'Wounded Arm', 1),
(2, '2022-06-30', '2022-07-02', '120/80', '65 kg.', 'Rhinovirus', 1),
(3, '2023-05-03', '2023-05-10', 'qsdq', 'qdsqd', 'qqsdqsd', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `display_name` varchar(30) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_picture` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `display_name`, `user_name`, `password`, `profile_picture`) VALUES
(1, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', '1656551981avatar.png '),
(2, 'John Doe', 'jdoe', '9c86d448e84d4ba23eb089e0b5160207', '1656551999avatar_.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `medicine_name` (`medicine_name`);

--
-- Index pour la table `medicine_details`
--
ALTER TABLE `medicine_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_medicine_details_medicine_id` (`medicine_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `patient_diagnostic`
--
ALTER TABLE `patient_diagnostic`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `patient_examen`
--
ALTER TABLE `patient_examen`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `patient_medication_history`
--
ALTER TABLE `patient_medication_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patient_medication_history_patients_visits_id` (`patient_visit_id`),
  ADD KEY `fk_patient_medication_history_medicine_details_id` (`medicine_details_id`);

--
-- Index pour la table `patient_visits`
--
ALTER TABLE `patient_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patients_visit_patient_id` (`patient_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `medicine_details`
--
ALTER TABLE `medicine_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `patient_diagnostic`
--
ALTER TABLE `patient_diagnostic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `patient_examen`
--
ALTER TABLE `patient_examen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `patient_medication_history`
--
ALTER TABLE `patient_medication_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `patient_visits`
--
ALTER TABLE `patient_visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `medicine_details`
--
ALTER TABLE `medicine_details`
  ADD CONSTRAINT `fk_medicine_details_medicine_id` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`);

--
-- Contraintes pour la table `patient_medication_history`
--
ALTER TABLE `patient_medication_history`
  ADD CONSTRAINT `fk_patient_medication_history_medicine_details_id` FOREIGN KEY (`medicine_details_id`) REFERENCES `medicine_details` (`id`),
  ADD CONSTRAINT `fk_patient_medication_history_patients_visits_id` FOREIGN KEY (`patient_visit_id`) REFERENCES `patient_visits` (`id`);

--
-- Contraintes pour la table `patient_visits`
--
ALTER TABLE `patient_visits`
  ADD CONSTRAINT `fk_patients_visit_patient_id` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
