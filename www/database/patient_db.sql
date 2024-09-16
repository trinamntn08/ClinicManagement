--
-- Table structure for table `patient_diagnostic`
--

CREATE TABLE `patient_examen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_name` varchar(60) NOT NULL,
  `cmnd` varchar(17) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone_number` varchar(12) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `visit_date` date DEFAULT NULL,
  `weight` varchar(12) DEFAULT NULL,
  `patient_diagnostic_id` int(11) DEFAULT NULL,
  `diachi` varchar(100) DEFAULT NULL,
  `chandoan` varchar(100) DEFAULT NULL,
  `lamsang` varchar(100) DEFAULT NULL,
  `gan` varchar(100) DEFAULT NULL,
  `duongmat` varchar(100) DEFAULT NULL,
  `ongmatchu` varchar(100) DEFAULT NULL,
  `tuimat` varchar(100) DEFAULT NULL,
  `thantrai` varchar(100) DEFAULT NULL,
  `thanphai` varchar(100) DEFAULT NULL,
  `tuy` varchar(100) DEFAULT NULL,
  `lach` varchar(100) DEFAULT NULL,
  `bangquang` varchar(100) DEFAULT NULL,
  `tuicung` varchar(100) DEFAULT NULL,
  `tucung` varchar(100) DEFAULT NULL,
  `buongtrungtrai` varchar(100) DEFAULT NULL,
  `buongtrungphai` varchar(100) DEFAULT NULL,
  `ghinhankhac` varchar(100) DEFAULT NULL,
  `hinhanhsieuam` LONGBLOB DEFAULT NULL,
  `ketluan` varchar(100) DEFAULT NULL,
  `loikhuyen` varchar(100) DEFAULT NULL,
  `ghichukhac` varchar(100) DEFAULT NULL,
  `hentaikham` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for table `patient_examen`
--
ALTER TABLE `patient_examen`
  ADD PRIMARY KEY (`id`);

  
--
-- AUTO_INCREMENT for table `patient_examen`
--
ALTER TABLE `patient_examen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  