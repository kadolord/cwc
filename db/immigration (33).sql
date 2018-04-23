-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2018 at 09:59 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `immigration`
--

-- --------------------------------------------------------

--
-- Table structure for table `imm_admin`
--

CREATE TABLE `imm_admin` (
  `admin_id` int(10) NOT NULL,
  `admin_first_name` varchar(100) NOT NULL,
  `admin_middle_name` varchar(100) NOT NULL,
  `admin_last_name` varchar(100) NOT NULL,
  `admin_birthdate` date NOT NULL,
  `admin_gender_id` int(1) NOT NULL,
  `admin_contact_num` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_country_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_admin`
--

INSERT INTO `imm_admin` (`admin_id`, `admin_first_name`, `admin_middle_name`, `admin_last_name`, `admin_birthdate`, `admin_gender_id`, `admin_contact_num`, `admin_email`, `admin_country_id`, `date_created`, `date_updated`, `enabled`) VALUES
(3, 'Juan', 'Antonio', 'Dela Cruz', '1990-02-02', 1, '123456789800', 'admin@cloudpanda.ph', 1, '2018-01-09 10:31:51', '2018-03-26 11:45:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `imm_announcements`
--

CREATE TABLE `imm_announcements` (
  `announcement_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `display_until` date NOT NULL,
  `posted_by` int(10) NOT NULL,
  `posted_on` date NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `imm_applicant`
--

CREATE TABLE `imm_applicant` (
  `applicant_id` int(10) NOT NULL,
  `applicant_no` varchar(50) NOT NULL,
  `icard_no` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `ext_name` varchar(255) NOT NULL,
  `alias1` varchar(255) NOT NULL,
  `alias2` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender_id` int(1) NOT NULL,
  `civil_status` int(11) NOT NULL,
  `landline` varchar(255) NOT NULL,
  `mobile_num` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `passport_num` varchar(255) NOT NULL,
  `place_of_isssuance` varchar(255) NOT NULL,
  `issuance_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `latest_arrival_date` date DEFAULT NULL,
  `ph_street_no` varchar(255) NOT NULL,
  `ph_village` varchar(255) NOT NULL,
  `ph_barangay` varchar(255) NOT NULL,
  `ph_city` varchar(255) NOT NULL,
  `ph_province` varchar(255) NOT NULL,
  `ph_zipcode` varchar(255) NOT NULL,
  `ab_street_no` varchar(255) NOT NULL,
  `ab_village` varchar(255) NOT NULL,
  `ab_city` varchar(255) NOT NULL,
  `ab_state` varchar(255) NOT NULL,
  `ab_country` int(11) DEFAULT NULL,
  `ab_zipcode` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `enabled` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_applicant`
--

INSERT INTO `imm_applicant` (`applicant_id`, `applicant_no`, `icard_no`, `first_name`, `middle_name`, `last_name`, `ext_name`, `alias1`, `alias2`, `email`, `password`, `birthdate`, `age`, `gender_id`, `civil_status`, `landline`, `mobile_num`, `country_id`, `nationality`, `passport_num`, `place_of_isssuance`, `issuance_date`, `expiry_date`, `latest_arrival_date`, `ph_street_no`, `ph_village`, `ph_barangay`, `ph_city`, `ph_province`, `ph_zipcode`, `ab_street_no`, `ab_village`, `ab_city`, `ab_state`, `ab_country`, `ab_zipcode`, `date_created`, `date_updated`, `enabled`) VALUES
(58, 'WGVxRmdMRG5QQVVkK0czUHAySnB5UT09', '', 'John', 'A', 'Wall', 'Jr', 'Wizard', '', 'applicant@cloudpanda.ph', '$2y$12$iKpA45w4PBaHFGwjsxjSIe.XX.CaESp2EIE6VtL.JSRk89YPFTfIK', '1990-04-07', 27, 2, 2, '033666', '123452222', 5, 'Thai', 'ABCDE123', 'Manila', NULL, NULL, NULL, '123', 'Dasma', 'Magallanessssssss', 'Makati City', 'NCR', '1525', '123', 'Samda', 'Mumbai', 'Mumbai', 0, '0123456', '2018-03-02 19:27:22', '2018-04-05 12:47:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `imm_application_log`
--

CREATE TABLE `imm_application_log` (
  `app_id` int(10) NOT NULL,
  `applicant_email` varchar(255) NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `process_lane` int(11) NOT NULL COMMENT '1 = Regular | 2 - Express Lane',
  `application_type_id` int(11) NOT NULL COMMENT '1 = Undocumented | 2= Illegal Staying | 3= Overstaying',
  `app_branch_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `app_branch_time` int(11) NOT NULL,
  `application_fee` double NOT NULL,
  `convenience_fee` double NOT NULL,
  `total_amount_receipt` double NOT NULL,
  `total_amount` double NOT NULL,
  `payment_mode` int(11) NOT NULL COMMENT '1 = Credit Card | 2 = Debit',
  `payment_status` int(255) NOT NULL DEFAULT '1' COMMENT '0 = Not yet paid | 1 = Paid',
  `OR_NO` varchar(255) NOT NULL,
  `CP_OR_NO` varchar(255) NOT NULL,
  `qr_code` mediumblob NOT NULL,
  `application_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = Not yet appeared || 1 =  Appearance Confirmed',
  `rejection_reason` varchar(255) DEFAULT NULL,
  `application_date` date NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_application_log`
--

INSERT INTO `imm_application_log` (`app_id`, `applicant_email`, `reference_no`, `process_lane`, `application_type_id`, `app_branch_id`, `appointment_date`, `app_branch_time`, `application_fee`, `convenience_fee`, `total_amount_receipt`, `total_amount`, `payment_mode`, `payment_status`, `OR_NO`, `CP_OR_NO`, `qr_code`, `application_status`, `rejection_reason`, `application_date`, `date_created`, `date_updated`, `enabled`) VALUES
(1, 'applicant@cloudpanda.ph', '180737734', 2, 1, 1, '2018-04-11', 1, 15000, 2700, 10000, 17700, 1, 1, '2018CP00000207', '', 0x646174613a696d6167652f706e673b6261736536342c6956424f5277304b47676f414141414e535568455567414141494141414143414341594141414444506d484c4141414738456c45515652345875326432354c694d4178453466382f6d69304b61704d4a766879355a5a504d3944354c747478717457544473506662376661346e656a66343545627a76312b2f7a68645a492b535034577274492b7948743033597664454a786678794f3446323068797946596d5142736c45364444497156697251436b52413832566f4142304151584b34415634484d47794b374347735a4b6636612b314735476a4b55313158694559722b563969347167416d77775a7964734f7a31496f51774164356f525169656e6244733955794148514a30366a5942646770586567654941425268344e465771516271532b303841777855556954353264564a4578753578315069307a57564d394d39616a6d67652b4d686346564153684c6f6f534f6730556d2b5a45666a6f58597a4373344536436966436642477741725176687061415472365247584f4c654146354b71437532774c6f4e4a4d696664636a39702b7938347a514163423957627772635453665530414577427a674a4c4b4c5744672f594f436d3232487378396f5a7961414363412b446c34316c537056517764443953456f556f6d6a7a392b72384c3645417444687a675459454b43465a41494d76415261415159516f497855374b7741566f4150446b52364b583246484f442f667866617a694a784b382f5162674675416577576f4c432b356b757267556f377265426164616e2b787a697a32356d61677a2f356e55424b6e74706e4152462f4579424955537641437a437150454634305479455a7742316331704a46497873386b5153515163307434414f61374b54714a4448424a685234674e724b6c56444352555a4170553136566b475945707a756354664271354b416b3159746c31614e6763574d674536377743727944655175785158453841454f503876684b7971776d7870702b756c6c504c6749766348485a30484e386877752b71314b2b5073733963774157596a66504c31545943544a32683265436241624952507672344a635049457a5134504530415a784771486f4775572f4f6d45485a6c786c586955524e477a524a36726154776d77413470453642424777724f716f716a56624d71486c70786970705a415a4a65375761304a4250676a63437169724d434b4a54626650466e415a4845356f533243374c776939395553694f783043666e307072556c39704656456f7042684f674d77525334745045556a73545947413670386c537762554352485131775862474455524a6f754a724252676768416e516e6f656b4761443063544146664343585852666c4d4c517961304851765a55426c4370413548754c394e7a4638356b414733776d7742734c4b3843384b3667566f4e4d4561425853695439435a727133573043336b343862304353594147324d73644c514759416d4a704a367569613155796f7a456a645646526f334a664f5539777354494a4c366c36304a6b4451734b6857694a43476538703865797435556d694d784b6d7357767842434636524171506475536853336750615674766865344259517162566632414a572f5a3942696c706b4b30446b6c5932716f665161427a2f756675354273614344356249666944414258685368435a7a524e6f736b74514b302b365956494e346969783557414376414d4a555532597a34556c7663587775396e6537684672424451414574346b74746678554273712b424e58426f4c38323247356164786d4d584a5972794c6846706d516f6830782b4354494132355a526b52646f43765a61614142324a5542544a437242445141475353693674726b6862554f493241557941447735516b7035754271425645356b42364a72556a6f4a4c3133766152524a785846654a4a374b7674412b39425644515449443279794c463051536753485865437761572b654553535951566f504854357771514e496d4b464e6232554f4a57346f6e734b2b336a4674436d567951526c3151412b6d6b6776513752616c587461474c6f4666495a4437576c6476534d6b51716d65614434344f3844304933706f565537657342497371677474614e6e4e41456f55703133426672774d754d62515a53514e4d6249544b4951306772517555565135544d42427170596361474152367144326c4937657236767467446c31384a70456949446c694b524b3671564a76574d646b58696d67426e544e57636d4579414e363452355a715469752b7361674b5941422f4d77373856584f4a73704a4b5577596b4f535a34423273715372674372684977535453465a37537a4b6d7053346b654a5334696e756f7779424a6b43383469686d366d4d563373634569436452555353636d4d726643316f424767686d673750712f6349746f464d5753735652337a38374135512b447159794e634e4f71574a6c36497163685a4b4b6e6f58615252534a726f6c2f4c5477436b474a4c41792f7459514a737146416354594142746c6f42426b436a4c705335566f414e416555427a4170416d626d7a2b2f554b384d3165717579744a4f615a5831704a394e6f3234797a4b6d735734365a64434277716c3636494154704d516152564b504970763543776d51494e57566f42757a583059344f384578706675653679716d6d4d6b74537053346c4638725141374242534a73774c30692b356f67525741676c734c675637764b41466f50485466476139733858534d655369596d5141643961485354676b356c754b326c776e51774d634b3048347773674a59415734504d695772456b6372555a457a65756458763231447a7a4a4437756b5a36633343436d41464f4c384366484d516f347045713332476b697037583049425449417478516f68537a6961414a33795551436e665a6857634f32746776716241425370704a644a45324469674c567145726343764a4d3459336852656a736c514859434230526b794558466d313458662f304d59414b3042306754594b672b357a745a415859595a37654b2b656e54647a41425441436452596356696e50545662385471465449716d384530517a5367626232446b4156736e67744e51453257435167412f2f37357a45524a7344417734735649496d34566f416b494b3041744f4f64452f426e564734423852796d6539434847396f4336486f31417541584e66692f684e4c50423262456a596641394b7747467151484e774861536b6f687638516668394b716f64566141306368565862376f49555155533472514b637354414371477850744b504f565a466b424e67542b4156643245753949506567384141414141456c46546b5375516d4343, 0, NULL, '2018-04-08', '2018-04-08 17:14:17', '2018-04-08 17:14:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `imm_application_process`
--

CREATE TABLE `imm_application_process` (
  `process_id` int(1) NOT NULL,
  `process` varchar(25) NOT NULL,
  `processing_fee_debit` double NOT NULL,
  `convenience_fee_debit` double NOT NULL,
  `processing_fee_credit` double DEFAULT NULL,
  `convenience_fee_credit` double NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enabled` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_application_process`
--

INSERT INTO `imm_application_process` (`process_id`, `process`, `processing_fee_debit`, `convenience_fee_debit`, `processing_fee_credit`, `convenience_fee_credit`, `date_created`, `date_updated`, `enabled`) VALUES
(1, 'Regular', 10000, 2125, 10000, 2500, '2018-03-28 16:36:57', '2018-03-28 17:41:14', 1),
(2, 'Express Lane', 15000, 2125, 15000, 2700, '2018-03-28 16:36:57', '2018-03-28 17:41:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `imm_application_requirements_log`
--

CREATE TABLE `imm_application_requirements_log` (
  `uploaded_requirement_id` int(11) NOT NULL,
  `application_reference_no` varchar(50) NOT NULL,
  `uploaded_requirement` varchar(255) NOT NULL,
  `requirement_id` int(11) NOT NULL DEFAULT '1',
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `imm_application_requirements_type`
--

CREATE TABLE `imm_application_requirements_type` (
  `requirement_id` int(11) NOT NULL,
  `requirement_description` varchar(255) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_application_requirements_type`
--

INSERT INTO `imm_application_requirements_type` (`requirement_id`, `requirement_description`, `date_created`, `date_updated`, `enabled`) VALUES
(1, 'Birth Certificate', '2017-12-17', '2018-01-23', 1),
(2, 'Passport', '2017-12-17', '2018-04-05', 1),
(3, 'Sample', '2018-01-03', '2018-01-03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `imm_application_type`
--

CREATE TABLE `imm_application_type` (
  `application_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `application_fee` double NOT NULL,
  `convenience_fee` double NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_application_type`
--

INSERT INTO `imm_application_type` (`application_id`, `description`, `application_fee`, `convenience_fee`, `date_created`, `date_updated`, `enabled`) VALUES
(1, 'Undocumented', 10000, 2125, '0000-00-00', '2018-01-23', 1),
(2, 'Illegal Staying', 10000, 2125, '0000-00-00', '0000-00-00', 1),
(3, 'Over Staying', 10000, 2125, '0000-00-00', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `imm_appointment_log`
--

CREATE TABLE `imm_appointment_log` (
  `appointment_id` int(10) NOT NULL,
  `app_reference_no` varchar(255) NOT NULL,
  `applicant_no` varchar(50) NOT NULL,
  `center_id` int(10) NOT NULL,
  `appointment_datesched` date NOT NULL,
  `appointment_timesched_id` int(11) NOT NULL,
  `is_rescheduled` int(11) NOT NULL COMMENT '0 = No | 1 = Yes',
  `is_rescheduled_counter` int(11) NOT NULL DEFAULT '0',
  `reschedule_fee` double NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `imm_appointment_status`
--

CREATE TABLE `imm_appointment_status` (
  `status_id` int(11) NOT NULL,
  `status_description` varchar(255) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_appointment_status`
--

INSERT INTO `imm_appointment_status` (`status_id`, `status_description`, `date_created`, `date_updated`, `enabled`) VALUES
(0, 'Pending', '2017-12-20', '2017-12-20', 1),
(1, 'Approved', '2017-12-20', '2017-12-20', 1),
(2, 'Rejected', '2018-01-03', '2018-01-03', 1),
(3, 'Cancelled', '2018-01-04', '2018-01-04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `imm_appointment_timesched`
--

CREATE TABLE `imm_appointment_timesched` (
  `id` int(11) NOT NULL,
  `timesched_description` varchar(255) NOT NULL,
  `availability` int(11) NOT NULL COMMENT '1 = Available | 0 = Not Available',
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL,
  `enabled` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_appointment_timesched`
--

INSERT INTO `imm_appointment_timesched` (`id`, `timesched_description`, `availability`, `date_created`, `date_updated`, `enabled`) VALUES
(1, '8:00 AM', 1, '2017-12-17', '2017-12-17', 1),
(2, '9:00 AM', 1, '2017-12-17', '2017-12-17', 1),
(3, '10:00 AM', 1, '2017-12-17', '2017-12-17', 1),
(4, '11:00 AM', 1, '2017-12-17', '2017-12-17', 1),
(5, '12:00 PM', 1, '2017-12-17', '2017-12-17', 1),
(6, '1:00 PM', 1, '2017-12-17', '2017-12-17', 1),
(7, '2:00 PM', 1, '2017-12-17', '2017-12-17', 1),
(8, '3:00 PM', 1, '2017-12-17', '2017-12-17', 1),
(9, '4:00 PM', 1, '2017-12-17', '2017-12-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `imm_bg`
--

CREATE TABLE `imm_bg` (
  `id` int(11) NOT NULL,
  `bg_name` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enabled` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_bg`
--

INSERT INTO `imm_bg` (`id`, `bg_name`, `date_created`, `date_updated`, `enabled`) VALUES
(1, 'coron.jpg', '2018-02-23 00:00:00', '2018-02-23 00:00:00', 1),
(3, 'mydas_apo.jpg', '2018-02-23 18:09:40', '2018-02-23 18:09:40', 1),
(4, 'manila_bay.jpg', '2018-02-23 18:09:40', '2018-02-23 18:09:40', 1),
(5, 'banaue.jpg', '2018-02-23 18:09:40', '2018-02-23 18:09:40', 1),
(6, 'mayon.jpg', '2018-02-23 18:09:40', '2018-02-23 18:09:40', 1),
(7, 'el-nido.jpg', '2018-02-23 18:09:40', '2018-02-23 18:09:40', 1),
(8, 'palawan.jpg', '2018-02-23 18:09:40', '2018-02-23 18:09:40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `imm_branch`
--

CREATE TABLE `imm_branch` (
  `branch_id` int(10) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `branch_code` varchar(100) NOT NULL,
  `branch_address` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_branch`
--

INSERT INTO `imm_branch` (`branch_id`, `branch_name`, `branch_code`, `branch_address`, `date_created`, `date_updated`, `enabled`) VALUES
(1, 'Bureau of Immigration Head Office', 'BIDMAIN', 'Intramuros, Manila, Philippines', '2017-12-15 00:00:00', '2017-12-15 00:00:00', 1),
(2, 'Bureau of Immigration Makati Extension', 'BIDMKT', 'Lasala Bldg, 805 Dr Jose P. Rizal Ave, Makati City, Philippines', '2017-12-15 00:00:00', '2017-12-19 17:01:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `imm_branch_admin`
--

CREATE TABLE `imm_branch_admin` (
  `branch_admin_id` int(10) NOT NULL,
  `branch_admin_assigned_branch_id` int(10) NOT NULL DEFAULT '0',
  `branch_admin_first_name` varchar(100) NOT NULL,
  `branch_admin_middle_name` varchar(100) NOT NULL,
  `branch_admin_last_name` varchar(100) NOT NULL,
  `branch_admin_birthdate` date NOT NULL,
  `branch_admin_gender_id` int(1) NOT NULL,
  `branch_admin_contact_num` varchar(255) NOT NULL,
  `branch_admin_email` varchar(255) NOT NULL,
  `branch_admin_country_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_branch_admin`
--

INSERT INTO `imm_branch_admin` (`branch_admin_id`, `branch_admin_assigned_branch_id`, `branch_admin_first_name`, `branch_admin_middle_name`, `branch_admin_last_name`, `branch_admin_birthdate`, `branch_admin_gender_id`, `branch_admin_contact_num`, `branch_admin_email`, `branch_admin_country_id`, `date_created`, `date_updated`, `enabled`) VALUES
(5, 1, 'Pedro', 'Jayme', 'Gil', '2018-01-09', 1, '7878787787999', 'S0o1eTFDUXJId25xOTRzU3VVVCtGVFlZMWV4OTRvU080cTZzVWZ1c3BuVTZoQWNIRk1VUlpBdkgwQktRZ2FWenRGaFMwR05qeHhpUUluUXlTd1B1ekE9PQ==', 1, '2018-01-09 11:40:23', '2018-01-23 18:00:28', 1),
(9, 3, 'Ferdinand', 'K', 'Santos', '0000-00-00', 0, '454545', 'ferd@ferd.xyz', 0, '2018-01-23 18:10:20', '2018-01-23 18:10:20', 1),
(10, 1, 'Pedro', 'B', 'Gil', '0000-00-00', 0, '12345678900', 'branch_admin@cloudpanda.ph', 0, '2018-01-23 19:40:24', '2018-03-26 11:45:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `imm_branch_staff`
--

CREATE TABLE `imm_branch_staff` (
  `branch_staff_id` int(10) NOT NULL,
  `assigned_branch_id` int(10) NOT NULL DEFAULT '0',
  `branch_staff_first_name` varchar(100) NOT NULL,
  `branch_staff_middle_name` varchar(100) NOT NULL,
  `branch_staff_last_name` varchar(100) NOT NULL,
  `branch_staff_birthdate` date NOT NULL,
  `branch_staff_gender_id` int(1) NOT NULL,
  `branch_staff_contact_num` varchar(255) NOT NULL,
  `branch_staff_country_id` int(11) NOT NULL,
  `branch_staff_email` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_branch_staff`
--

INSERT INTO `imm_branch_staff` (`branch_staff_id`, `assigned_branch_id`, `branch_staff_first_name`, `branch_staff_middle_name`, `branch_staff_last_name`, `branch_staff_birthdate`, `branch_staff_gender_id`, `branch_staff_contact_num`, `branch_staff_country_id`, `branch_staff_email`, `date_created`, `date_updated`, `enabled`) VALUES
(11, 1, 'Joseph', 'H', 'Santos', '0000-00-00', 0, '1234567890', 0, 'branch_staff@cloudpanda.ph', '2018-01-23 20:37:43', '2018-03-26 11:44:53', 1),
(12, 2, 'ss', 'ss', 'ss', '0000-00-00', 0, 'sss', 0, 'ss@aaa.com', '2018-02-09 19:37:33', '2018-02-09 19:37:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `imm_civil_status`
--

CREATE TABLE `imm_civil_status` (
  `civil_status_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enabled` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_civil_status`
--

INSERT INTO `imm_civil_status` (`civil_status_id`, `name`, `date_created`, `date_updated`, `enabled`) VALUES
(1, 'Single', '2018-03-07 06:00:00', '2018-03-07 17:41:41', 1),
(2, 'Married', '2018-03-07 17:41:41', '2018-03-07 17:41:41', 1),
(3, 'Annuled', '2018-03-07 17:41:41', '2018-03-07 17:41:41', 1),
(4, 'Divorced', '2018-03-07 17:41:41', '2018-03-07 17:41:41', 1),
(5, 'Widowed', '2018-03-07 17:41:41', '2018-03-07 17:41:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `imm_country`
--

CREATE TABLE `imm_country` (
  `country_id` int(5) NOT NULL,
  `country` varchar(50) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_country`
--

INSERT INTO `imm_country` (`country_id`, `country`, `date_created`, `date_updated`, `enabled`) VALUES
(1, 'Philippines', '2017-12-18', '2018-01-23', 1),
(2, 'China', '2017-12-18', '2017-12-18', 1),
(3, 'India', '2017-12-18', '2017-12-18', 1),
(4, 'Indonesia', '2017-12-18', '2017-12-18', 1),
(5, 'Thailand', '2018-01-23', '2018-01-23', 1),
(6, 'Malaysia', '2018-01-23', '2018-01-23', 0),
(7, 'Malaysia', '2018-01-23', '2018-01-23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `imm_cp_receipt`
--

CREATE TABLE `imm_cp_receipt` (
  `cp_or_id` int(11) NOT NULL,
  `cp_or_no` varchar(255) NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `isAvailable` int(11) NOT NULL DEFAULT '1' COMMENT '1 = available | 0 - not available',
  `date_uploaded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enabled` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_cp_receipt`
--

INSERT INTO `imm_cp_receipt` (`cp_or_id`, `cp_or_no`, `reference_no`, `isAvailable`, `date_uploaded`, `date_created`, `date_updated`, `enabled`) VALUES
(1, 'CLOUDPANDAPH20180001', '560069280', 0, '2018-03-14 11:30:21', '2018-03-14 11:30:21', '2018-03-14 11:59:11', 1),
(2, 'CLOUDPANDAPH20180002', '818557293', 0, '2018-03-14 11:30:21', '2018-03-14 11:30:21', '2018-03-14 14:09:50', 1),
(3, 'CLOUDPANDAPH20180003', '946028196', 0, '2018-03-14 11:30:21', '2018-03-14 11:30:21', '2018-03-14 14:15:52', 1),
(4, 'CLOUDPANDAPH20180004', '115635295', 0, '2018-03-14 11:30:21', '2018-03-14 11:30:21', '2018-03-14 14:21:28', 1),
(5, 'CLOUDPANDAPH20180005', '238430014', 0, '2018-03-14 11:30:21', '2018-03-14 11:30:21', '2018-03-14 14:22:27', 1),
(6, 'CLOUDPANDAPH20180006', '254932191', 0, '2018-03-14 11:30:21', '2018-03-14 11:30:21', '2018-03-15 19:36:11', 1),
(7, 'CLOUDPANDAPH20180007', '348109777', 0, '2018-03-14 11:30:21', '2018-03-14 11:30:21', '2018-03-15 19:51:12', 1),
(8, 'CLOUDPANDAPH20180008', '754428737', 0, '2018-03-14 11:30:21', '2018-03-14 11:30:21', '2018-03-20 11:16:56', 1),
(9, 'CLOUDPANDAPH20180009', '624106064', 0, '2018-03-14 11:30:21', '2018-03-14 11:30:21', '2018-03-20 15:16:25', 1),
(10, 'CLOUDPANDAPH20180010', '', 1, '2018-03-14 11:30:21', '2018-03-14 11:30:21', '2018-03-14 11:30:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `imm_gender`
--

CREATE TABLE `imm_gender` (
  `gender_id` int(1) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `enabled` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_gender`
--

INSERT INTO `imm_gender` (`gender_id`, `gender`, `enabled`) VALUES
(1, 'Male', 1),
(2, 'Female', 1);

-- --------------------------------------------------------

--
-- Table structure for table `imm_holiday`
--

CREATE TABLE `imm_holiday` (
  `holiday_id` int(11) NOT NULL,
  `holiday_description` varchar(255) NOT NULL,
  `holiday_date` date NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_holiday`
--

INSERT INTO `imm_holiday` (`holiday_id`, `holiday_description`, `holiday_date`, `date_created`, `date_updated`, `enabled`) VALUES
(2, 'All Souls Day Edited', '2018-11-01', '2018-01-09 18:21:38', '2018-03-28 18:38:11', 1),
(3, 'Valentines Day', '2018-02-14', '2018-01-09 18:37:52', '2018-01-09 18:37:52', 1),
(4, 'Christmas', '2018-12-25', '2018-01-09 18:39:34', '2018-01-09 18:39:34', 1),
(5, 'April Fools Day', '2018-04-01', '2018-01-10 11:20:18', '2018-01-10 11:20:18', 0),
(6, 'April Fools Day', '2018-04-01', '2018-01-19 11:48:00', '2018-01-19 11:48:00', 0),
(7, 'sample', '2018-12-27', '2018-01-22 18:55:47', '2018-01-22 18:55:47', 0),
(8, 'Independence Day', '2018-06-12', '2018-01-23 20:47:01', '2018-01-23 20:47:01', 1),
(9, 'aaaa', '0000-00-00', '2018-04-06 16:59:29', '2018-04-06 16:59:29', 0),
(10, '1', '0000-00-00', '2018-04-06 17:00:12', '2018-04-06 17:00:12', 0),
(11, '1', '0000-00-00', '2018-04-06 17:02:18', '2018-04-06 17:02:18', 0),
(12, 'a', '2018-04-04', '2018-04-06 17:11:07', '2018-04-06 17:11:07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `imm_official_receipt`
--

CREATE TABLE `imm_official_receipt` (
  `or_id` int(11) NOT NULL,
  `or_no` varchar(255) NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `isAvailable` int(11) NOT NULL DEFAULT '1' COMMENT '1 = available | 0 - not available',
  `date_uploaded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enabled` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_official_receipt`
--

INSERT INTO `imm_official_receipt` (`or_id`, `or_no`, `reference_no`, `isAvailable`, `date_uploaded`, `date_created`, `date_updated`, `enabled`) VALUES
(1, '2018CP000001', '231571578', 0, '2018-03-13 19:17:38', '2018-03-13 19:17:38', '2018-03-23 14:14:43', 1),
(2, '2018CP000002', '648712627', 0, '2018-03-13 19:17:38', '2018-03-13 19:17:38', '2018-03-23 15:54:14', 1),
(3, '2018CP000003', '437808502', 0, '2018-03-13 19:17:38', '2018-03-13 19:17:38', '2018-03-23 17:18:09', 1),
(4, '2018CP000004', '767576571', 0, '2018-03-13 19:17:38', '2018-03-13 19:17:38', '2018-03-23 17:23:22', 1),
(5, '2018CP000005', '730717588', 0, '2018-03-13 19:17:38', '2018-03-13 19:17:38', '2018-03-23 18:41:42', 1),
(6, '2018CP000006', '265663354', 0, '2018-03-13 19:17:38', '2018-03-13 19:17:38', '2018-03-23 19:09:18', 1),
(7, '2018CP000007', '222862191', 1, '2018-03-13 19:17:38', '2018-03-13 19:17:38', '2018-03-22 19:15:03', 1),
(8, '2018CP000008', '734570859', 1, '2018-03-13 19:17:38', '2018-03-13 19:17:38', '2018-03-23 13:31:43', 1),
(9, '2018CP000009', '946033173', 1, '2018-03-13 19:17:38', '2018-03-13 19:17:38', '2018-03-23 13:33:47', 1),
(10, '2018CP000010', '716196144', 1, '2018-03-13 19:17:38', '2018-03-13 19:17:38', '2018-03-20 18:41:22', 1),
(11, '2018CP000011', '', 1, '2018-03-13 19:17:38', '2018-03-13 19:17:38', '2018-03-13 19:17:38', 1),
(12, '2018CP000012', '', 1, '2018-03-13 19:17:38', '2018-03-13 19:17:38', '2018-03-13 19:17:38', 1),
(13, '2018CP000013', '', 1, '2018-03-13 19:17:38', '2018-03-13 19:17:38', '2018-03-13 19:17:38', 1),
(20, '2018CP000013', '', 1, '2018-03-27 14:52:36', '2018-03-27 14:52:36', '2018-03-27 14:52:36', 1),
(21, '2018CP000014', '', 1, '2018-03-27 14:52:36', '2018-03-27 14:52:36', '2018-03-27 14:52:36', 1),
(22, '2018CP000015', '', 1, '2018-03-27 14:52:36', '2018-03-27 14:52:36', '2018-03-27 14:52:36', 1),
(23, '2018CP000016', '', 1, '2018-03-27 14:52:36', '2018-03-27 14:52:36', '2018-03-27 14:52:36', 1),
(24, '2018CP000017', '', 1, '2018-03-27 14:52:36', '2018-03-27 14:52:36', '2018-03-27 14:52:36', 1),
(25, '2018CP000018', '', 1, '2018-03-27 14:52:37', '2018-03-27 14:52:37', '2018-03-27 14:52:37', 1),
(26, '2018CP000019', '', 1, '2018-03-27 14:52:37', '2018-03-27 14:52:37', '2018-03-27 14:52:37', 1),
(27, '2018CP000020', '', 1, '2018-03-27 14:52:37', '2018-03-27 14:52:37', '2018-03-27 14:52:37', 1),
(28, '2018CP000021', '', 1, '2018-03-27 15:09:00', '2018-03-27 15:09:00', '2018-03-27 15:09:00', 1),
(29, '2018CP000022', '', 1, '2018-03-27 15:09:00', '2018-03-27 15:09:00', '2018-03-27 15:09:00', 1),
(30, '2018CP000023', '', 1, '2018-03-27 15:09:00', '2018-03-27 15:09:00', '2018-03-27 15:09:00', 1),
(31, '2018CP000024', '', 1, '2018-03-27 15:09:00', '2018-03-27 15:09:00', '2018-03-27 15:09:00', 1),
(32, '2018CP000025', '', 1, '2018-03-27 15:09:00', '2018-03-27 15:09:00', '2018-03-27 15:09:00', 1),
(33, '2018CP0000010', '492123164', 0, '2018-03-27 15:11:33', '2018-03-27 15:11:33', '2018-03-28 18:13:54', 1),
(34, '2018CP0000011', '553223163', 0, '2018-03-27 15:11:33', '2018-03-27 15:11:33', '2018-03-28 18:17:55', 1),
(35, '2018CP0000012', '151199612', 0, '2018-03-27 15:11:33', '2018-03-27 15:11:33', '2018-04-02 14:55:42', 1),
(36, '2018CP0000013', '457328194', 0, '2018-03-27 15:11:33', '2018-03-27 15:11:33', '2018-04-02 15:03:38', 1),
(37, '2018CP0000014', '918087371', 0, '2018-03-27 15:11:34', '2018-03-27 15:11:34', '2018-04-02 15:05:51', 1),
(38, '2018CP0000015', '160130185', 0, '2018-03-27 15:11:34', '2018-03-27 15:11:34', '2018-04-02 15:08:42', 1),
(39, '2018CP0000016', '197721378', 0, '2018-03-27 15:11:34', '2018-03-27 15:11:34', '2018-04-02 15:14:11', 1),
(40, '2018CP0000017', '445961552', 0, '2018-03-27 15:11:34', '2018-03-27 15:11:34', '2018-04-02 15:23:19', 1),
(41, '2018CP0000018', '239545947', 0, '2018-03-27 15:11:34', '2018-03-27 15:11:34', '2018-04-04 12:15:48', 1),
(42, '2018CP0000019', '512960604', 0, '2018-03-27 15:11:34', '2018-03-27 15:11:34', '2018-04-04 14:24:48', 1),
(43, '2018CP0000020', '709289696', 0, '2018-03-27 15:11:34', '2018-03-27 15:11:34', '2018-04-04 14:26:53', 1),
(44, '2018CP0000021', '', 1, '2018-03-27 15:11:34', '2018-03-27 15:11:34', '2018-03-27 15:11:34', 1),
(45, '2018CP0000022', '', 1, '2018-03-27 15:11:34', '2018-03-27 15:11:34', '2018-03-27 15:11:34', 1),
(46, '2018CP0000023', '', 1, '2018-03-27 15:11:34', '2018-03-27 15:11:34', '2018-03-27 15:11:34', 1),
(47, '2018CP0000024', '', 1, '2018-03-27 15:11:34', '2018-03-27 15:11:34', '2018-03-27 15:11:34', 1),
(48, '2018CP0000025', '', 1, '2018-03-27 15:11:34', '2018-03-27 15:11:34', '2018-03-27 15:11:34', 1),
(49, '2018CP0000026', '', 1, '2018-03-27 15:20:12', '2018-03-27 15:20:12', '2018-03-27 15:20:12', 1),
(50, '2018CP0000027', '', 1, '2018-03-27 15:20:12', '2018-03-27 15:20:12', '2018-03-27 15:20:12', 1),
(51, '2018CP0000028', '', 1, '2018-03-27 15:20:12', '2018-03-27 15:20:12', '2018-03-27 15:20:12', 1),
(52, '2018CP0000029', '', 1, '2018-03-27 15:20:12', '2018-03-27 15:20:12', '2018-03-27 15:20:12', 1),
(53, '2018CP0000030', '', 1, '2018-03-27 15:20:12', '2018-03-27 15:20:12', '2018-03-27 15:20:12', 1),
(54, '2018CP0000031', '', 1, '2018-03-27 15:28:01', '2018-03-27 15:28:01', '2018-03-27 15:28:01', 1),
(55, '2018CP0000032', '', 1, '2018-03-27 15:28:01', '2018-03-27 15:28:01', '2018-03-27 15:28:01', 1),
(56, '2018CP0000033', '', 1, '2018-03-27 15:28:01', '2018-03-27 15:28:01', '2018-03-27 15:28:01', 1),
(57, '2018CP0000034', '', 1, '2018-03-27 15:28:01', '2018-03-27 15:28:01', '2018-03-27 15:28:01', 1),
(58, '2018CP0000035', '', 1, '2018-03-27 15:28:01', '2018-03-27 15:28:01', '2018-03-27 15:28:01', 1),
(59, '2018CP0000040', '', 1, '2018-03-27 15:32:25', '2018-03-27 15:32:25', '2018-03-27 15:32:25', 1),
(60, '2018CP0000041', '', 1, '2018-03-27 15:32:25', '2018-03-27 15:32:25', '2018-03-27 15:32:25', 1),
(61, '2018CP0000042', '', 1, '2018-03-27 15:32:25', '2018-03-27 15:32:25', '2018-03-27 15:32:25', 1),
(62, '2018CP0000043', '', 1, '2018-03-27 15:32:25', '2018-03-27 15:32:25', '2018-03-27 15:32:25', 1),
(63, '2018CP0000044', '', 1, '2018-03-27 15:32:25', '2018-03-27 15:32:25', '2018-03-27 15:32:25', 1),
(64, '2018CP0000045', '', 1, '2018-03-27 15:32:25', '2018-03-27 15:32:25', '2018-03-27 15:32:25', 1),
(65, '2018CP0000046', '', 1, '2018-03-27 15:32:25', '2018-03-27 15:32:25', '2018-03-27 15:32:25', 1),
(66, '2018CP0000047', '', 1, '2018-03-27 15:32:25', '2018-03-27 15:32:25', '2018-03-27 15:32:25', 1),
(67, '2018CP0000048', '', 1, '2018-03-27 15:32:25', '2018-03-27 15:32:25', '2018-03-27 15:32:25', 1),
(68, '2018CP0000049', '', 1, '2018-03-27 15:32:25', '2018-03-27 15:32:25', '2018-03-27 15:32:25', 1),
(69, '2018CP0000050', '', 1, '2018-03-27 15:32:25', '2018-03-27 15:32:25', '2018-03-27 15:32:25', 1),
(70, '2018CP00000200', '311023752', 0, '2018-03-27 15:47:23', '2018-03-27 15:47:23', '2018-04-04 14:28:51', 1),
(71, '2018CP00000201', '411507889', 0, '2018-03-27 15:47:23', '2018-03-27 15:47:23', '2018-04-04 14:31:10', 1),
(72, '2018CP00000202', '965220334', 0, '2018-03-27 15:47:23', '2018-03-27 15:47:23', '2018-04-04 14:34:07', 1),
(73, '2018CP00000203', '475607078', 0, '2018-03-27 15:47:23', '2018-03-27 15:47:23', '2018-04-05 12:47:00', 1),
(74, '2018CP00000204', '953638324', 0, '2018-03-27 15:47:23', '2018-03-27 15:47:23', '2018-04-05 13:10:02', 1),
(75, '2018CP00000205', '685503128', 0, '2018-03-27 15:47:23', '2018-03-27 15:47:23', '2018-04-05 20:19:47', 1),
(76, '2018CP00000206', '455170462', 0, '2018-03-27 15:47:23', '2018-03-27 15:47:23', '2018-04-06 18:02:45', 1),
(77, '2018CP00000207', '180737734', 0, '2018-03-27 15:47:23', '2018-03-27 15:47:23', '2018-04-08 17:14:17', 1),
(78, '2018CP00000208', '', 1, '2018-03-27 15:47:23', '2018-03-27 15:47:23', '2018-03-27 15:47:23', 1),
(79, '2018CP00000209', '', 1, '2018-03-27 15:47:23', '2018-03-27 15:47:23', '2018-03-27 15:47:23', 1),
(80, '2018CP00000210', '', 1, '2018-03-27 15:47:23', '2018-03-27 15:47:23', '2018-03-27 15:47:23', 1),
(81, '2018CP00000211', '', 1, '2018-03-27 15:47:23', '2018-03-27 15:47:23', '2018-03-27 15:47:23', 1),
(82, '2018CP00000212', '', 1, '2018-03-27 15:47:23', '2018-03-27 15:47:23', '2018-03-27 15:47:23', 1),
(83, '2018CP00000213', '', 1, '2018-03-27 15:47:23', '2018-03-27 15:47:23', '2018-03-27 15:47:23', 1),
(84, '2018CP00000214', '', 1, '2018-03-27 15:47:23', '2018-03-27 15:47:23', '2018-03-27 15:47:23', 1),
(85, '2018CP00000215', '', 1, '2018-03-27 15:47:23', '2018-03-27 15:47:23', '2018-03-27 15:47:23', 1),
(86, '2018CP00000216', '', 1, '2018-03-27 15:47:23', '2018-03-27 15:47:23', '2018-03-27 15:47:23', 1),
(87, '2018CP00000217', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(88, '2018CP00000218', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(89, '2018CP00000219', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(90, '2018CP00000220', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(91, '2018CP00000221', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(92, '2018CP00000222', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(93, '2018CP00000223', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(94, '2018CP00000224', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(95, '2018CP00000225', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(96, '2018CP00000226', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(97, '2018CP00000227', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(98, '2018CP00000228', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(99, '2018CP00000229', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(100, '2018CP00000230', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(101, '2018CP00000231', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(102, '2018CP00000232', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(103, '2018CP00000233', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(104, '2018CP00000234', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(105, '2018CP00000235', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(106, '2018CP00000236', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(107, '2018CP00000237', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(108, '2018CP00000238', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(109, '2018CP00000239', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(110, '2018CP00000240', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(111, '2018CP00000241', '', 1, '2018-03-27 15:47:24', '2018-03-27 15:47:24', '2018-03-27 15:47:24', 1),
(112, '2018CP00000242', '', 1, '2018-03-27 15:47:25', '2018-03-27 15:47:25', '2018-03-27 15:47:25', 1),
(113, '2018CP00000243', '', 1, '2018-03-27 15:47:25', '2018-03-27 15:47:25', '2018-03-27 15:47:25', 1),
(114, '2018CP00000244', '', 1, '2018-03-27 15:47:25', '2018-03-27 15:47:25', '2018-03-27 15:47:25', 1),
(115, '2018CP00000245', '', 1, '2018-03-27 15:47:25', '2018-03-27 15:47:25', '2018-03-27 15:47:25', 1),
(116, '2018CP00000246', '', 1, '2018-03-27 15:47:25', '2018-03-27 15:47:25', '2018-03-27 15:47:25', 1),
(117, '2018CP00000247', '', 1, '2018-03-27 15:47:25', '2018-03-27 15:47:25', '2018-03-27 15:47:25', 1),
(118, '2018CP00000248', '', 1, '2018-03-27 15:47:25', '2018-03-27 15:47:25', '2018-03-27 15:47:25', 1),
(119, '2018CP00000249', '', 1, '2018-03-27 15:47:25', '2018-03-27 15:47:25', '2018-03-27 15:47:25', 1),
(120, '2018CP00000250', '', 1, '2018-03-27 15:47:25', '2018-03-27 15:47:25', '2018-03-27 15:47:25', 1),
(121, '2018CP00000251', '', 1, '2018-03-27 15:51:32', '2018-03-27 15:51:32', '2018-03-27 15:51:32', 1),
(122, '2018CP00000252', '', 1, '2018-03-27 15:51:32', '2018-03-27 15:51:32', '2018-03-27 15:51:32', 1),
(123, '2018CP00000253', '', 1, '2018-03-27 15:51:32', '2018-03-27 15:51:32', '2018-03-27 15:51:32', 1),
(124, '2018CP00000254', '', 1, '2018-03-27 15:51:32', '2018-03-27 15:51:32', '2018-03-27 15:51:32', 1),
(125, '2018CP00000255', '', 1, '2018-03-27 15:51:32', '2018-03-27 15:51:32', '2018-03-27 15:51:32', 1),
(126, '2018CP00000256', '', 1, '2018-03-27 15:51:32', '2018-03-27 15:51:32', '2018-03-27 15:51:32', 1),
(127, '2018CP00000257', '', 1, '2018-03-27 15:51:32', '2018-03-27 15:51:32', '2018-03-27 15:51:32', 1),
(128, '2018CP00000258', '', 1, '2018-03-27 15:51:32', '2018-03-27 15:51:32', '2018-03-27 15:51:32', 1),
(129, '2018CP00000259', '', 1, '2018-03-27 15:51:32', '2018-03-27 15:51:32', '2018-03-27 15:51:32', 1),
(130, '2018CP00000260', '', 1, '2018-03-27 15:51:32', '2018-03-27 15:51:32', '2018-03-27 15:51:32', 1),
(131, '2018CP00000261', '', 1, '2018-03-27 15:51:32', '2018-03-27 15:51:32', '2018-03-27 15:51:32', 1),
(132, '2018CP00000262', '', 1, '2018-03-27 15:51:32', '2018-03-27 15:51:32', '2018-03-27 15:51:32', 1),
(133, '2018CP00000263', '', 1, '2018-03-27 15:51:32', '2018-03-27 15:51:32', '2018-03-27 15:51:32', 1),
(134, '2018CP00000264', '', 1, '2018-03-27 15:51:32', '2018-03-27 15:51:32', '2018-03-27 15:51:32', 1),
(135, '2018CP00000265', '', 1, '2018-03-27 15:51:32', '2018-03-27 15:51:32', '2018-03-27 15:51:32', 1),
(136, '2018CP00000266', '', 1, '2018-03-27 15:51:33', '2018-03-27 15:51:33', '2018-03-27 15:51:33', 1),
(137, '2018CP00000267', '', 1, '2018-03-27 15:51:33', '2018-03-27 15:51:33', '2018-03-27 15:51:33', 1),
(138, '2018CP00000268', '', 1, '2018-03-27 15:51:33', '2018-03-27 15:51:33', '2018-03-27 15:51:33', 1),
(139, '2018CP00000269', '', 1, '2018-03-27 15:51:33', '2018-03-27 15:51:33', '2018-03-27 15:51:33', 1),
(140, '2018CP00000270', '', 1, '2018-03-27 15:51:33', '2018-03-27 15:51:33', '2018-03-27 15:51:33', 1),
(141, '2018CP00000271', '', 1, '2018-03-27 15:54:50', '2018-03-27 15:54:50', '2018-03-27 15:54:50', 1),
(142, '2018CP00000272', '', 1, '2018-03-27 15:54:50', '2018-03-27 15:54:50', '2018-03-27 15:54:50', 1),
(143, '2018CP00000273', '', 1, '2018-03-27 15:54:50', '2018-03-27 15:54:50', '2018-03-27 15:54:50', 1),
(144, '2018CP00000274', '', 1, '2018-03-27 15:54:50', '2018-03-27 15:54:50', '2018-03-27 15:54:50', 1),
(145, '2018CP00000275', '', 1, '2018-03-27 15:54:50', '2018-03-27 15:54:50', '2018-03-27 15:54:50', 1),
(146, '2018CP00000276', '', 1, '2018-03-27 15:54:51', '2018-03-27 15:54:51', '2018-03-27 15:54:51', 1),
(147, '2018CP00000277', '', 1, '2018-03-27 15:54:51', '2018-03-27 15:54:51', '2018-03-27 15:54:51', 1),
(148, '2018CP00000278', '', 1, '2018-03-27 15:54:51', '2018-03-27 15:54:51', '2018-03-27 15:54:51', 1),
(149, '2018CP00000279', '', 1, '2018-03-27 15:54:51', '2018-03-27 15:54:51', '2018-03-27 15:54:51', 1),
(150, '2018CP00000280', '', 1, '2018-03-27 15:54:51', '2018-03-27 15:54:51', '2018-03-27 15:54:51', 1),
(151, '2018CP00000281', '', 1, '2018-03-27 15:54:51', '2018-03-27 15:54:51', '2018-03-27 15:54:51', 1),
(152, '2018CP00000282', '', 1, '2018-03-27 15:54:51', '2018-03-27 15:54:51', '2018-03-27 15:54:51', 1),
(153, '2018CP00000283', '', 1, '2018-03-27 15:54:51', '2018-03-27 15:54:51', '2018-03-27 15:54:51', 1),
(154, '2018CP00000284', '', 1, '2018-03-27 15:54:51', '2018-03-27 15:54:51', '2018-03-27 15:54:51', 1),
(155, '2018CP00000285', '', 1, '2018-03-27 15:54:51', '2018-03-27 15:54:51', '2018-03-27 15:54:51', 1),
(156, '2018CP00000286', '', 1, '2018-03-27 15:54:51', '2018-03-27 15:54:51', '2018-03-27 15:54:51', 1),
(157, '2018CP00000287', '', 1, '2018-03-27 15:54:51', '2018-03-27 15:54:51', '2018-03-27 15:54:51', 1),
(158, '2018CP00000288', '', 1, '2018-03-27 15:54:51', '2018-03-27 15:54:51', '2018-03-27 15:54:51', 1),
(159, '2018CP00000289', '', 1, '2018-03-27 15:54:51', '2018-03-27 15:54:51', '2018-03-27 15:54:51', 1),
(160, '2018CP00000290', '', 1, '2018-03-27 15:54:51', '2018-03-27 15:54:51', '2018-03-27 15:54:51', 1),
(161, '2018CP00000291', '', 1, '2018-03-27 15:54:51', '2018-03-27 15:54:51', '2018-03-27 15:54:51', 1),
(162, '2018CP00000292', '', 1, '2018-03-27 15:54:51', '2018-03-27 15:54:51', '2018-03-27 15:54:51', 1),
(163, '2018CP00000293', '', 1, '2018-03-27 15:54:52', '2018-03-27 15:54:52', '2018-03-27 15:54:52', 1),
(164, '2018CP00000294', '', 1, '2018-03-27 15:54:52', '2018-03-27 15:54:52', '2018-03-27 15:54:52', 1),
(165, '2018CP00000295', '', 1, '2018-03-27 15:54:52', '2018-03-27 15:54:52', '2018-03-27 15:54:52', 1),
(166, '2018CP00000296', '', 1, '2018-03-27 15:54:52', '2018-03-27 15:54:52', '2018-03-27 15:54:52', 1),
(167, '2018CP00000297', '', 1, '2018-03-27 15:54:52', '2018-03-27 15:54:52', '2018-03-27 15:54:52', 1),
(168, '2018CP00000298', '', 1, '2018-03-27 15:54:52', '2018-03-27 15:54:52', '2018-03-27 15:54:52', 1),
(169, '2018CP00000299', '', 1, '2018-03-27 15:54:52', '2018-03-27 15:54:52', '2018-03-27 15:54:52', 1),
(170, '2018CP00000300', '', 1, '2018-03-27 15:54:52', '2018-03-27 15:54:52', '2018-03-27 15:54:52', 1),
(171, '2018CP00000301', '', 1, '2018-03-27 15:55:37', '2018-03-27 15:55:37', '2018-03-27 15:55:37', 1),
(172, '2018CP00000302', '', 1, '2018-03-27 15:55:37', '2018-03-27 15:55:37', '2018-03-27 15:55:37', 1),
(173, '2018CP00000303', '', 1, '2018-03-27 15:55:37', '2018-03-27 15:55:37', '2018-03-27 15:55:37', 1),
(174, '2018CP00000304', '', 1, '2018-03-27 15:55:37', '2018-03-27 15:55:37', '2018-03-27 15:55:37', 1),
(175, '2018CP00000305', '', 1, '2018-03-27 15:55:38', '2018-03-27 15:55:38', '2018-03-27 15:55:38', 1),
(176, '2018CP00000306', '', 1, '2018-03-27 15:55:38', '2018-03-27 15:55:38', '2018-03-27 15:55:38', 1),
(177, '2018CP00000307', '', 1, '2018-03-27 15:55:38', '2018-03-27 15:55:38', '2018-03-27 15:55:38', 1),
(178, '2018CP00000308', '', 1, '2018-03-27 15:55:38', '2018-03-27 15:55:38', '2018-03-27 15:55:38', 1),
(179, '2018CP00000309', '', 1, '2018-03-27 15:55:38', '2018-03-27 15:55:38', '2018-03-27 15:55:38', 1),
(180, '2018CP00000310', '', 1, '2018-03-27 15:55:38', '2018-03-27 15:55:38', '2018-03-27 15:55:38', 1),
(181, '2018CP00000311', '', 1, '2018-03-27 15:55:38', '2018-03-27 15:55:38', '2018-03-27 15:55:38', 1),
(182, '2018CP00000312', '', 1, '2018-03-27 15:55:38', '2018-03-27 15:55:38', '2018-03-27 15:55:38', 1),
(183, '2018CP00000313', '', 1, '2018-03-27 15:55:38', '2018-03-27 15:55:38', '2018-03-27 15:55:38', 1),
(184, '2018CP00000314', '', 1, '2018-03-27 15:55:38', '2018-03-27 15:55:38', '2018-03-27 15:55:38', 1),
(185, '2018CP00000315', '', 1, '2018-03-27 15:55:38', '2018-03-27 15:55:38', '2018-03-27 15:55:38', 1),
(186, '2018CP00000316', '', 1, '2018-03-27 15:55:38', '2018-03-27 15:55:38', '2018-03-27 15:55:38', 1),
(187, '2018CP00000317', '', 1, '2018-03-27 15:55:38', '2018-03-27 15:55:38', '2018-03-27 15:55:38', 1),
(188, '2018CP00000318', '', 1, '2018-03-27 15:55:38', '2018-03-27 15:55:38', '2018-03-27 15:55:38', 1),
(189, '2018CP00000319', '', 1, '2018-03-27 15:55:38', '2018-03-27 15:55:38', '2018-03-27 15:55:38', 1),
(190, '2018CP00000320', '', 1, '2018-03-27 15:55:38', '2018-03-27 15:55:38', '2018-03-27 15:55:38', 1),
(191, '2018CP00000321', '', 1, '2018-03-27 15:57:00', '2018-03-27 15:57:00', '2018-03-27 15:57:00', 1),
(192, '2018CP00000322', '', 1, '2018-03-27 15:57:00', '2018-03-27 15:57:00', '2018-03-27 15:57:00', 1),
(193, '2018CP00000323', '', 1, '2018-03-27 15:57:00', '2018-03-27 15:57:00', '2018-03-27 15:57:00', 1),
(194, '2018CP00000324', '', 1, '2018-03-27 15:57:00', '2018-03-27 15:57:00', '2018-03-27 15:57:00', 1),
(195, '2018CP00000325', '', 1, '2018-03-27 15:57:00', '2018-03-27 15:57:00', '2018-03-27 15:57:00', 1),
(196, '2018CP00000326', '', 1, '2018-03-27 15:57:00', '2018-03-27 15:57:00', '2018-03-27 15:57:00', 1),
(197, '2018CP00000327', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(198, '2018CP00000328', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(199, '2018CP00000329', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(200, '2018CP00000330', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(201, '2018CP00000331', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(202, '2018CP00000332', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(203, '2018CP00000333', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(204, '2018CP00000334', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(205, '2018CP00000335', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(206, '2018CP00000336', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(207, '2018CP00000337', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(208, '2018CP00000338', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(209, '2018CP00000339', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(210, '2018CP00000340', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(211, '2018CP00000341', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(212, '2018CP00000342', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(213, '2018CP00000343', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(214, '2018CP00000344', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(215, '2018CP00000345', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(216, '2018CP00000346', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(217, '2018CP00000347', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(218, '2018CP00000348', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(219, '2018CP00000349', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(220, '2018CP00000350', '', 1, '2018-03-27 15:57:01', '2018-03-27 15:57:01', '2018-03-27 15:57:01', 1),
(221, '2018CP00000351', '', 1, '2018-03-27 15:58:10', '2018-03-27 15:58:10', '2018-03-27 15:58:10', 1),
(222, '2018CP00000352', '', 1, '2018-03-27 15:58:10', '2018-03-27 15:58:10', '2018-03-27 15:58:10', 1),
(223, '2018CP00000353', '', 1, '2018-03-27 15:58:10', '2018-03-27 15:58:10', '2018-03-27 15:58:10', 1),
(224, '2018CP00000354', '', 1, '2018-03-27 15:58:10', '2018-03-27 15:58:10', '2018-03-27 15:58:10', 1),
(225, '2018CP00000355', '', 1, '2018-03-27 15:58:10', '2018-03-27 15:58:10', '2018-03-27 15:58:10', 1),
(226, '2018CP00000356', '', 1, '2018-03-27 15:58:10', '2018-03-27 15:58:10', '2018-03-27 15:58:10', 1),
(227, '2018CP00000357', '', 1, '2018-03-27 15:58:10', '2018-03-27 15:58:10', '2018-03-27 15:58:10', 1),
(228, '2018CP00000358', '', 1, '2018-03-27 15:58:10', '2018-03-27 15:58:10', '2018-03-27 15:58:10', 1),
(229, '2018CP00000359', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(230, '2018CP00000360', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(231, '2018CP00000361', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(232, '2018CP00000362', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(233, '2018CP00000363', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(234, '2018CP00000364', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(235, '2018CP00000365', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(236, '2018CP00000366', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(237, '2018CP00000367', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(238, '2018CP00000368', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(239, '2018CP00000369', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(240, '2018CP00000370', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(241, '2018CP00000371', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(242, '2018CP00000372', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(243, '2018CP00000373', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(244, '2018CP00000374', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(245, '2018CP00000375', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(246, '2018CP00000376', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(247, '2018CP00000377', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(248, '2018CP00000378', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(249, '2018CP00000379', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(250, '2018CP00000380', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(251, '2018CP00000381', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(252, '2018CP00000382', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(253, '2018CP00000383', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(254, '2018CP00000384', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(255, '2018CP00000385', '', 1, '2018-03-27 15:58:11', '2018-03-27 15:58:11', '2018-03-27 15:58:11', 1),
(256, '2018CP00000386', '', 1, '2018-03-27 15:58:12', '2018-03-27 15:58:12', '2018-03-27 15:58:12', 1),
(257, '2018CP00000387', '', 1, '2018-03-27 15:58:12', '2018-03-27 15:58:12', '2018-03-27 15:58:12', 1),
(258, '2018CP00000388', '', 1, '2018-03-27 15:58:12', '2018-03-27 15:58:12', '2018-03-27 15:58:12', 1),
(259, '2018CP00000389', '', 1, '2018-03-27 15:58:12', '2018-03-27 15:58:12', '2018-03-27 15:58:12', 1),
(260, '2018CP00000390', '', 1, '2018-03-27 15:58:12', '2018-03-27 15:58:12', '2018-03-27 15:58:12', 1),
(261, '2018CP00000391', '', 1, '2018-03-27 15:58:12', '2018-03-27 15:58:12', '2018-03-27 15:58:12', 1),
(262, '2018CP00000392', '', 1, '2018-03-27 15:58:12', '2018-03-27 15:58:12', '2018-03-27 15:58:12', 1),
(263, '2018CP00000393', '', 1, '2018-03-27 15:58:12', '2018-03-27 15:58:12', '2018-03-27 15:58:12', 1),
(264, '2018CP00000394', '', 1, '2018-03-27 15:58:12', '2018-03-27 15:58:12', '2018-03-27 15:58:12', 1),
(265, '2018CP00000395', '', 1, '2018-03-27 15:58:12', '2018-03-27 15:58:12', '2018-03-27 15:58:12', 1),
(266, '2018CP00000396', '', 1, '2018-03-27 15:58:12', '2018-03-27 15:58:12', '2018-03-27 15:58:12', 1),
(267, '2018CP00000397', '', 1, '2018-03-27 15:58:12', '2018-03-27 15:58:12', '2018-03-27 15:58:12', 1),
(268, '2018CP00000398', '', 1, '2018-03-27 15:58:12', '2018-03-27 15:58:12', '2018-03-27 15:58:12', 1),
(269, '2018CP00000399', '', 1, '2018-03-27 15:58:12', '2018-03-27 15:58:12', '2018-03-27 15:58:12', 1),
(270, '2018CP00000400', '', 1, '2018-03-27 15:58:12', '2018-03-27 15:58:12', '2018-03-27 15:58:12', 1),
(271, '2018CP00000401', '', 1, '2018-03-27 15:59:21', '2018-03-27 15:59:21', '2018-03-27 15:59:21', 1),
(272, '2018CP00000402', '', 1, '2018-03-27 15:59:21', '2018-03-27 15:59:21', '2018-03-27 15:59:21', 1),
(273, '2018CP00000403', '', 1, '2018-03-27 15:59:21', '2018-03-27 15:59:21', '2018-03-27 15:59:21', 1),
(274, '2018CP00000404', '', 1, '2018-03-27 15:59:21', '2018-03-27 15:59:21', '2018-03-27 15:59:21', 1),
(275, '2018CP00000405', '', 1, '2018-03-27 15:59:21', '2018-03-27 15:59:21', '2018-03-27 15:59:21', 1),
(276, '2018CP00000406', '', 1, '2018-03-27 15:59:21', '2018-03-27 15:59:21', '2018-03-27 15:59:21', 1),
(277, '2018CP00000407', '', 1, '2018-03-27 15:59:21', '2018-03-27 15:59:21', '2018-03-27 15:59:21', 1),
(278, '2018CP00000408', '', 1, '2018-03-27 15:59:21', '2018-03-27 15:59:21', '2018-03-27 15:59:21', 1),
(279, '2018CP00000409', '', 1, '2018-03-27 15:59:21', '2018-03-27 15:59:21', '2018-03-27 15:59:21', 1),
(280, '2018CP00000410', '', 1, '2018-03-27 15:59:21', '2018-03-27 15:59:21', '2018-03-27 15:59:21', 1),
(281, '2018CP00000411', '', 1, '2018-03-27 15:59:21', '2018-03-27 15:59:21', '2018-03-27 15:59:21', 1),
(282, '2018CP00000412', '', 1, '2018-03-27 15:59:22', '2018-03-27 15:59:22', '2018-03-27 15:59:22', 1),
(283, '2018CP00000413', '', 1, '2018-03-27 15:59:22', '2018-03-27 15:59:22', '2018-03-27 15:59:22', 1),
(284, '2018CP00000414', '', 1, '2018-03-27 15:59:22', '2018-03-27 15:59:22', '2018-03-27 15:59:22', 1),
(285, '2018CP00000415', '', 1, '2018-03-27 15:59:22', '2018-03-27 15:59:22', '2018-03-27 15:59:22', 1),
(286, '2018CP00000416', '', 1, '2018-03-27 15:59:22', '2018-03-27 15:59:22', '2018-03-27 15:59:22', 1),
(287, '2018CP00000417', '', 1, '2018-03-27 15:59:22', '2018-03-27 15:59:22', '2018-03-27 15:59:22', 1),
(288, '2018CP00000418', '', 1, '2018-03-27 15:59:22', '2018-03-27 15:59:22', '2018-03-27 15:59:22', 1),
(289, '2018CP00000419', '', 1, '2018-03-27 15:59:22', '2018-03-27 15:59:22', '2018-03-27 15:59:22', 1),
(290, '2018CP00000420', '', 1, '2018-03-27 15:59:22', '2018-03-27 15:59:22', '2018-03-27 15:59:22', 1),
(291, '2018CP00000421', '', 1, '2018-03-27 15:59:22', '2018-03-27 15:59:22', '2018-03-27 15:59:22', 1),
(292, '2018CP00000422', '', 1, '2018-03-27 15:59:22', '2018-03-27 15:59:22', '2018-03-27 15:59:22', 1),
(293, '2018CP00000423', '', 1, '2018-03-27 15:59:22', '2018-03-27 15:59:22', '2018-03-27 15:59:22', 1),
(294, '2018CP00000424', '', 1, '2018-03-27 15:59:22', '2018-03-27 15:59:22', '2018-03-27 15:59:22', 1),
(295, '2018CP00000425', '', 1, '2018-03-27 15:59:22', '2018-03-27 15:59:22', '2018-03-27 15:59:22', 1),
(296, '2018CP00000426', '', 1, '2018-03-27 15:59:22', '2018-03-27 15:59:22', '2018-03-27 15:59:22', 1),
(297, '2018CP00000427', '', 1, '2018-03-27 15:59:22', '2018-03-27 15:59:22', '2018-03-27 15:59:22', 1),
(298, '2018CP00000428', '', 1, '2018-03-27 15:59:22', '2018-03-27 15:59:22', '2018-03-27 15:59:22', 1),
(299, '2018CP00000429', '', 1, '2018-03-27 15:59:22', '2018-03-27 15:59:22', '2018-03-27 15:59:22', 1),
(300, '2018CP00000430', '', 1, '2018-03-27 15:59:22', '2018-03-27 15:59:22', '2018-03-27 15:59:22', 1),
(301, '2018CP00000431', '', 1, '2018-03-27 15:59:23', '2018-03-27 15:59:23', '2018-03-27 15:59:23', 1),
(302, '2018CP00000432', '', 1, '2018-03-27 15:59:23', '2018-03-27 15:59:23', '2018-03-27 15:59:23', 1),
(303, '2018CP00000433', '', 1, '2018-03-27 15:59:23', '2018-03-27 15:59:23', '2018-03-27 15:59:23', 1),
(304, '2018CP00000434', '', 1, '2018-03-27 15:59:23', '2018-03-27 15:59:23', '2018-03-27 15:59:23', 1),
(305, '2018CP00000435', '', 1, '2018-03-27 15:59:23', '2018-03-27 15:59:23', '2018-03-27 15:59:23', 1),
(306, '2018CP00000436', '', 1, '2018-03-27 15:59:23', '2018-03-27 15:59:23', '2018-03-27 15:59:23', 1),
(307, '2018CP00000437', '', 1, '2018-03-27 15:59:23', '2018-03-27 15:59:23', '2018-03-27 15:59:23', 1),
(308, '2018CP00000438', '', 1, '2018-03-27 15:59:23', '2018-03-27 15:59:23', '2018-03-27 15:59:23', 1),
(309, '2018CP00000439', '', 1, '2018-03-27 15:59:23', '2018-03-27 15:59:23', '2018-03-27 15:59:23', 1),
(310, '2018CP00000440', '', 1, '2018-03-27 15:59:23', '2018-03-27 15:59:23', '2018-03-27 15:59:23', 1),
(311, '2018CP00000441', '', 1, '2018-03-27 15:59:23', '2018-03-27 15:59:23', '2018-03-27 15:59:23', 1),
(312, '2018CP00000442', '', 1, '2018-03-27 15:59:23', '2018-03-27 15:59:23', '2018-03-27 15:59:23', 1),
(313, '2018CP00000443', '', 1, '2018-03-27 15:59:23', '2018-03-27 15:59:23', '2018-03-27 15:59:23', 1),
(314, '2018CP00000444', '', 1, '2018-03-27 15:59:23', '2018-03-27 15:59:23', '2018-03-27 15:59:23', 1),
(315, '2018CP00000445', '', 1, '2018-03-27 15:59:23', '2018-03-27 15:59:23', '2018-03-27 15:59:23', 1),
(316, '2018CP00000446', '', 1, '2018-03-27 15:59:23', '2018-03-27 15:59:23', '2018-03-27 15:59:23', 1),
(317, '2018CP00000447', '', 1, '2018-03-27 15:59:23', '2018-03-27 15:59:23', '2018-03-27 15:59:23', 1),
(318, '2018CP00000448', '', 1, '2018-03-27 15:59:23', '2018-03-27 15:59:23', '2018-03-27 15:59:23', 1),
(319, '2018CP00000449', '', 1, '2018-03-27 15:59:23', '2018-03-27 15:59:23', '2018-03-27 15:59:23', 1),
(320, '2018CP00000450', '', 1, '2018-03-27 15:59:24', '2018-03-27 15:59:24', '2018-03-27 15:59:24', 1),
(321, '900', '', 1, '2018-04-17 20:16:35', '2018-04-17 20:16:35', '2018-04-17 20:16:35', 1),
(322, '901', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(323, '902', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(324, '903', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(325, '904', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(326, '905', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(327, '906', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(328, '907', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(329, '908', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(330, '909', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(331, '910', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(332, '911', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(333, '912', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(334, '913', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(335, '914', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(336, '915', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(337, '916', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(338, '917', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(339, '918', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(340, '919', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(341, '920', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(342, '921', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(343, '922', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(344, '923', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(345, '924', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(346, '925', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(347, '926', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(348, '927', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(349, '928', '', 1, '2018-04-17 20:16:36', '2018-04-17 20:16:36', '2018-04-17 20:16:36', 1),
(350, '929', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(351, '930', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(352, '931', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(353, '932', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(354, '933', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(355, '934', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(356, '935', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(357, '936', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(358, '937', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(359, '938', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(360, '939', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(361, '940', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(362, '941', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(363, '942', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(364, '943', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(365, '944', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(366, '945', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(367, '946', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(368, '947', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(369, '948', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(370, '949', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(371, '950', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(372, '951', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(373, '952', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(374, '953', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(375, '954', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(376, '955', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(377, '956', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(378, '957', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(379, '958', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(380, '959', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(381, '960', '', 1, '2018-04-17 20:16:37', '2018-04-17 20:16:37', '2018-04-17 20:16:37', 1),
(382, '961', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(383, '962', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(384, '963', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(385, '964', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(386, '965', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(387, '966', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(388, '967', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(389, '968', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(390, '969', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(391, '970', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(392, '971', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(393, '972', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(394, '973', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(395, '974', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(396, '975', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(397, '976', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(398, '977', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(399, '978', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(400, '979', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(401, '980', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(402, '981', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(403, '982', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(404, '983', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(405, '984', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(406, '985', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(407, '986', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(408, '987', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(409, '988', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(410, '989', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(411, '990', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(412, '991', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(413, '992', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(414, '993', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(415, '994', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(416, '995', '', 1, '2018-04-17 20:16:38', '2018-04-17 20:16:38', '2018-04-17 20:16:38', 1),
(417, '996', '', 1, '2018-04-17 20:16:39', '2018-04-17 20:16:39', '2018-04-17 20:16:39', 1),
(418, '997', '', 1, '2018-04-17 20:16:39', '2018-04-17 20:16:39', '2018-04-17 20:16:39', 1),
(419, '998', '', 1, '2018-04-17 20:16:39', '2018-04-17 20:16:39', '2018-04-17 20:16:39', 1),
(420, '999', '', 1, '2018-04-17 20:16:39', '2018-04-17 20:16:39', '2018-04-17 20:16:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `imm_position`
--

CREATE TABLE `imm_position` (
  `position_id` int(11) NOT NULL,
  `position` varchar(255) NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_position`
--

INSERT INTO `imm_position` (`position_id`, `position`, `enabled`) VALUES
(1, 'Admin', 1),
(2, 'Applicant', 1),
(3, 'Branch Admin', 1),
(4, 'Staff', 1),
(5, 'Branch Staff', 1);

-- --------------------------------------------------------

--
-- Table structure for table `imm_reschedule_fee`
--

CREATE TABLE `imm_reschedule_fee` (
  `resched_id` int(11) NOT NULL,
  `resched_fee` double NOT NULL,
  `resched_limit` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_reschedule_fee`
--

INSERT INTO `imm_reschedule_fee` (`resched_id`, `resched_fee`, `resched_limit`, `date_created`, `date_updated`, `enabled`) VALUES
(1, 500, 5, '2018-01-23 13:36:53', '2018-01-23 14:11:53', 0),
(2, 500, 4, '2018-01-23 14:23:41', '2018-01-23 14:23:41', 0),
(3, 1000, 5, '2018-01-23 14:24:26', '2018-02-08 00:49:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `imm_schedule_limit`
--

CREATE TABLE `imm_schedule_limit` (
  `sched_limit_id` int(11) NOT NULL,
  `sched_limit_branch_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `day_limit` int(11) NOT NULL,
  `hour_limit` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_schedule_limit`
--

INSERT INTO `imm_schedule_limit` (`sched_limit_id`, `sched_limit_branch_id`, `start_date`, `end_date`, `day_limit`, `hour_limit`, `created_by`, `date_created`, `date_updated`, `enabled`) VALUES
(20, 1, '2018-02-26', '2018-05-31', 2, 1, 1, '2018-04-06 12:01:08', '2018-04-06 18:03:38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `imm_staff`
--

CREATE TABLE `imm_staff` (
  `staff_id` int(10) NOT NULL,
  `staff_first_name` varchar(100) NOT NULL,
  `staff_middle_name` varchar(100) NOT NULL,
  `staff_last_name` varchar(100) NOT NULL,
  `staff_birthdate` date NOT NULL,
  `staff_gender_id` int(1) NOT NULL,
  `staff_contact_num` varchar(255) NOT NULL,
  `staff_country_id` int(11) NOT NULL,
  `staff_email` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_staff`
--

INSERT INTO `imm_staff` (`staff_id`, `staff_first_name`, `staff_middle_name`, `staff_last_name`, `staff_birthdate`, `staff_gender_id`, `staff_contact_num`, `staff_country_id`, `staff_email`, `date_created`, `date_updated`, `enabled`) VALUES
(5, 'Marie', 'P', 'Curry', '1900-02-01', 2, '091945662465', 1, 'VGVBRVZVU2pURG1wQ0c2NzVma1ZwSzlQNHVOeFlkaXNtaHh3QXhYOGVzZEZMOUlLcnJRcWRadGV4WWdpT0V0TzJTQTA5T3BzWUtuOEpXblU1cS9wMmc9PQ==', '2018-01-09 12:01:04', '2018-01-09 13:15:42', 1),
(6, 'January', 'M', 'Walter', '0000-00-00', 0, '0915546587', 0, 'staff@cloudpanda.ph', '2018-01-23 19:33:27', '2018-02-08 11:07:15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `imm_uploaded_docs`
--

CREATE TABLE `imm_uploaded_docs` (
  `uploaded_doc_id` int(11) NOT NULL,
  `applicant_email` varchar(255) NOT NULL,
  `uploaded_doc` varchar(255) NOT NULL,
  `uploaded_doc_ext` varchar(255) NOT NULL,
  `document_type_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `imm_users`
--

CREATE TABLE `imm_users` (
  `user_id` int(10) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `position_id` int(11) NOT NULL COMMENT 'Admin = 1 | Applicant = 2 | Branch Admin = 3 | Staff = 4 | Branch Staff = 5',
  `date_activated` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `enabled` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imm_users`
--

INSERT INTO `imm_users` (`user_id`, `user_email`, `password`, `position_id`, `date_activated`, `date_created`, `date_updated`, `enabled`) VALUES
(87, 'admin@cloudpanda.ph', '$2y$12$irrIK2y4pWhiD0chndJ2AuRXX.PQxJhFSdtXrca/vtrq/fX0qZ51u', 1, '0000-00-00 00:00:00', '2018-01-23 18:48:02', '2018-01-23 18:48:02', 1),
(88, 'staff@cloudpanda.ph', '$2y$12$K5VCvPRoRFNKc94aHL5HaeoHdubRPH6Rh9SBXaiNURRKFxTpT7izS', 4, '0000-00-00 00:00:00', '2018-01-23 19:33:27', '2018-01-23 19:33:27', 1),
(91, 'branch_admin@cloudpanda.ph', '$2y$12$K5VCvPRoRFNKc94aHL5HaeoHdubRPH6Rh9SBXaiNURRKFxTpT7izS', 3, '2018-01-23 19:40:24', '2018-01-23 19:40:24', '2018-01-23 19:40:24', 1),
(92, 'branch_staff@cloudpanda.ph', '$2y$12$ORilSew/5/6D2nhBA6AnfefPXrre6AS95RiJsRe5QX4mg3ka0u7Oq', 5, '0000-00-00 00:00:00', '2018-01-23 20:37:44', '2018-01-29 03:09:51', 1),
(98, 'sssa@dd.com', '$2y$12$mNw1qQf4KAPEekVpNyJWqeGRaPiHIlnAprvg8TAvE3j6RSAl4py8u', 2, '0000-00-00 00:00:00', '2018-02-07 19:31:09', '2018-02-07 19:31:09', 1),
(100, 'edwndolor@yahoo.com', '$2y$12$VQb8eS6K20CvPKkPaYJEr.9sj703cPqfj116uQtPQnPyniix7GULi', 2, '0000-00-00 00:00:00', '2018-02-07 20:15:49', '2018-02-07 20:15:49', 1),
(101, 'applicant2@cloudpanda.ph', '$2y$12$/WHwtrArU5IsNqg5z3xlfus86xkaMR/7Eun3HmA93ylSFLAVOIyuS', 2, '0000-00-00 00:00:00', '2018-02-08 11:36:52', '2018-02-08 11:36:52', 1),
(102, 'applicant4@cloudpanda.ph', '$2y$12$anuJf9eFluvp95lT2BDze.kyFg3bfts6Fntbp0cSl4pivKu6TmS5a', 2, '0000-00-00 00:00:00', '2018-02-09 11:16:35', '2018-02-09 11:16:35', 1),
(104, 'applicant@cloudpanda.ph', '$2y$12$GnEPgXkLYfz2HABf8hWAVO/I6ULwKH5E8Vfdye6MpXTuNKUZnubvK', 2, '0000-00-00 00:00:00', '2018-03-02 19:27:22', '2018-03-26 19:04:01', 1),
(106, 'lbg@lbj.lbj', '$2y$12$Fo1cpP0cORXG6aTOO0qS0OfBXTqFC9pCi2XdfJ8Su2tkPCNXlNivK', 2, '0000-00-00 00:00:00', '2018-03-02 19:52:51', '2018-03-02 19:52:51', 1),
(113, 'kembaby@yehey.com', '$2y$12$.GUJj8FKP4zP.CGyohYvp.BRNDLfEIP0CN4taFf3m4P6RQwcBjMH6', 2, '0000-00-00 00:00:00', '2018-03-27 19:12:33', '2018-03-27 19:12:33', 1),
(119, 'a@a.com', '$2y$12$ZYs9GlOA.8uxCVvPJfMqXu8ouJEZ4ayG0I9rVN5.7xZOd1JuKvmUa', 2, '0000-00-00 00:00:00', '2018-04-06 17:42:40', '2018-04-06 17:42:40', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `imm_admin`
--
ALTER TABLE `imm_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `imm_announcements`
--
ALTER TABLE `imm_announcements`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `imm_applicant`
--
ALTER TABLE `imm_applicant`
  ADD PRIMARY KEY (`applicant_id`);

--
-- Indexes for table `imm_application_log`
--
ALTER TABLE `imm_application_log`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `imm_application_process`
--
ALTER TABLE `imm_application_process`
  ADD PRIMARY KEY (`process_id`);

--
-- Indexes for table `imm_application_requirements_log`
--
ALTER TABLE `imm_application_requirements_log`
  ADD PRIMARY KEY (`uploaded_requirement_id`);

--
-- Indexes for table `imm_application_requirements_type`
--
ALTER TABLE `imm_application_requirements_type`
  ADD PRIMARY KEY (`requirement_id`);

--
-- Indexes for table `imm_application_type`
--
ALTER TABLE `imm_application_type`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `imm_appointment_log`
--
ALTER TABLE `imm_appointment_log`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `imm_appointment_status`
--
ALTER TABLE `imm_appointment_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `imm_appointment_timesched`
--
ALTER TABLE `imm_appointment_timesched`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imm_bg`
--
ALTER TABLE `imm_bg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imm_branch`
--
ALTER TABLE `imm_branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `imm_branch_admin`
--
ALTER TABLE `imm_branch_admin`
  ADD PRIMARY KEY (`branch_admin_id`);

--
-- Indexes for table `imm_branch_staff`
--
ALTER TABLE `imm_branch_staff`
  ADD PRIMARY KEY (`branch_staff_id`);

--
-- Indexes for table `imm_civil_status`
--
ALTER TABLE `imm_civil_status`
  ADD PRIMARY KEY (`civil_status_id`);

--
-- Indexes for table `imm_country`
--
ALTER TABLE `imm_country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `imm_cp_receipt`
--
ALTER TABLE `imm_cp_receipt`
  ADD PRIMARY KEY (`cp_or_id`);

--
-- Indexes for table `imm_gender`
--
ALTER TABLE `imm_gender`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `imm_holiday`
--
ALTER TABLE `imm_holiday`
  ADD PRIMARY KEY (`holiday_id`);

--
-- Indexes for table `imm_official_receipt`
--
ALTER TABLE `imm_official_receipt`
  ADD PRIMARY KEY (`or_id`);

--
-- Indexes for table `imm_position`
--
ALTER TABLE `imm_position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `imm_reschedule_fee`
--
ALTER TABLE `imm_reschedule_fee`
  ADD PRIMARY KEY (`resched_id`);

--
-- Indexes for table `imm_schedule_limit`
--
ALTER TABLE `imm_schedule_limit`
  ADD PRIMARY KEY (`sched_limit_id`);

--
-- Indexes for table `imm_staff`
--
ALTER TABLE `imm_staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `imm_uploaded_docs`
--
ALTER TABLE `imm_uploaded_docs`
  ADD PRIMARY KEY (`uploaded_doc_id`);

--
-- Indexes for table `imm_users`
--
ALTER TABLE `imm_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `imm_admin`
--
ALTER TABLE `imm_admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `imm_announcements`
--
ALTER TABLE `imm_announcements`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `imm_applicant`
--
ALTER TABLE `imm_applicant`
  MODIFY `applicant_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `imm_application_log`
--
ALTER TABLE `imm_application_log`
  MODIFY `app_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `imm_application_requirements_log`
--
ALTER TABLE `imm_application_requirements_log`
  MODIFY `uploaded_requirement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `imm_application_requirements_type`
--
ALTER TABLE `imm_application_requirements_type`
  MODIFY `requirement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `imm_application_type`
--
ALTER TABLE `imm_application_type`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `imm_appointment_log`
--
ALTER TABLE `imm_appointment_log`
  MODIFY `appointment_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `imm_appointment_status`
--
ALTER TABLE `imm_appointment_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `imm_appointment_timesched`
--
ALTER TABLE `imm_appointment_timesched`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `imm_bg`
--
ALTER TABLE `imm_bg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `imm_branch`
--
ALTER TABLE `imm_branch`
  MODIFY `branch_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `imm_branch_admin`
--
ALTER TABLE `imm_branch_admin`
  MODIFY `branch_admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `imm_branch_staff`
--
ALTER TABLE `imm_branch_staff`
  MODIFY `branch_staff_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `imm_civil_status`
--
ALTER TABLE `imm_civil_status`
  MODIFY `civil_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `imm_country`
--
ALTER TABLE `imm_country`
  MODIFY `country_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `imm_cp_receipt`
--
ALTER TABLE `imm_cp_receipt`
  MODIFY `cp_or_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `imm_holiday`
--
ALTER TABLE `imm_holiday`
  MODIFY `holiday_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `imm_official_receipt`
--
ALTER TABLE `imm_official_receipt`
  MODIFY `or_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=421;

--
-- AUTO_INCREMENT for table `imm_position`
--
ALTER TABLE `imm_position`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `imm_reschedule_fee`
--
ALTER TABLE `imm_reschedule_fee`
  MODIFY `resched_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `imm_schedule_limit`
--
ALTER TABLE `imm_schedule_limit`
  MODIFY `sched_limit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `imm_staff`
--
ALTER TABLE `imm_staff`
  MODIFY `staff_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `imm_uploaded_docs`
--
ALTER TABLE `imm_uploaded_docs`
  MODIFY `uploaded_doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `imm_users`
--
ALTER TABLE `imm_users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
