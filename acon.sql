-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2024 at 01:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acon`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(5) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `pass`) VALUES
(4, 'admin@gmail.com', '$2y$10$ICMAnEtFipO3n');

-- --------------------------------------------------------

--
-- Table structure for table `barcode_submissions`
--

CREATE TABLE `barcode_submissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_type` enum('proprietorship','partnership','pvtLtd','other') NOT NULL,
  `pan_card` varchar(255) NOT NULL,
  `balance_sheet` varchar(255) NOT NULL,
  `barcode_request_letter` varchar(255) NOT NULL,
  `proprietorship_proof` varchar(255) DEFAULT NULL,
  `partnership_proof` varchar(255) DEFAULT NULL,
  `gst_certificate` varchar(255) DEFAULT NULL,
  `roc_certificate` varchar(255) DEFAULT NULL,
  `other_proof` varchar(255) DEFAULT NULL,
  `cancelled_cheque` varchar(255) NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `form_name` varchar(500) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barcode_submissions`
--

INSERT INTO `barcode_submissions` (`id`, `user_id`, `company_type`, `pan_card`, `balance_sheet`, `barcode_request_letter`, `proprietorship_proof`, `partnership_proof`, `gst_certificate`, `roc_certificate`, `other_proof`, `cancelled_cheque`, `submission_date`, `form_name`, `created_at`) VALUES
(3, 42, 'proprietorship', 'uploads/1735044616_Screenshot 2024-07-11 195847.png', 'uploads/1735044616_Screenshot 2024-09-03 191738.png', 'uploads/1735044616_Screenshot 2024-09-03 191759.png', 'uploads/1735044616_Screenshot 2024-09-10 133803.png', NULL, NULL, NULL, NULL, 'uploads/1735044616_Screenshot 2024-07-11 195847.png', '2024-12-24 12:50:16', 'Barcode Document Submission', '2024-12-24 18:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `company_incorporation`
--

CREATE TABLE `company_incorporation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_type` varchar(50) DEFAULT NULL,
  `paid_up_capital` bigint(20) DEFAULT NULL,
  `equity_shares` bigint(20) DEFAULT NULL,
  `authorized_share_capital` bigint(20) DEFAULT NULL,
  `promoters_pan` varchar(255) DEFAULT NULL,
  `address_proof` varchar(255) DEFAULT NULL,
  `email_ids` varchar(500) DEFAULT NULL,
  `mobile_nos` varchar(500) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `office_owner_name` varchar(255) DEFAULT NULL,
  `office_proof` varchar(255) DEFAULT NULL,
  `digital_signature` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `police_station` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

CREATE TABLE `directors` (
  `id` int(11) NOT NULL,
  `submission_id` int(11) DEFAULT NULL,
  `director_name` varchar(255) NOT NULL,
  `director_address` varchar(255) NOT NULL,
  `director_contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document_submissions`
--

CREATE TABLE `document_submissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `owner_aadhar` varchar(255) DEFAULT NULL,
  `owner_pan` varchar(255) DEFAULT NULL,
  `owner_photo` varchar(255) DEFAULT NULL,
  `partnership_deed` varchar(255) DEFAULT NULL,
  `cert_of_incorporation` varchar(255) DEFAULT NULL,
  `moa` varchar(255) DEFAULT NULL,
  `board_resolution` varchar(255) DEFAULT NULL,
  `property_712` varchar(255) DEFAULT NULL,
  `namunna_8` varchar(255) DEFAULT NULL,
  `tax_receipt` varchar(255) DEFAULT NULL,
  `noc` varchar(255) DEFAULT NULL,
  `light_bill` varchar(255) DEFAULT NULL,
  `location_plan` varchar(255) DEFAULT NULL,
  `pharmacist_aadhar` varchar(255) DEFAULT NULL,
  `pharmacist_photo` varchar(255) DEFAULT NULL,
  `last_year_marksheet` varchar(255) DEFAULT NULL,
  `reg_certificate` varchar(255) DEFAULT NULL,
  `ppp_card` varchar(255) DEFAULT NULL,
  `fridge_bill` varchar(255) DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `form_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `drug_license_submissions`
--

CREATE TABLE `drug_license_submissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entity_type` enum('proprietor','partnership','pvtLtd') NOT NULL,
  `aadhar_card_path` varchar(255) DEFAULT NULL,
  `pan_card_path` varchar(255) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `partnership_deed_path` varchar(255) DEFAULT NULL,
  `certificate_of_incorporation_path` varchar(255) DEFAULT NULL,
  `moa_path` varchar(255) DEFAULT NULL,
  `board_resolution_path` varchar(255) DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `form_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gst_submissions`
--

CREATE TABLE `gst_submissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `form_name` varchar(255) NOT NULL,
  `entity_type` varchar(50) NOT NULL,
  `aadhar_card_path` varchar(255) DEFAULT NULL,
  `pan_card_path` varchar(255) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `partnership_deed_path` varchar(255) DEFAULT NULL,
  `certificate_of_incorporation_path` varchar(255) DEFAULT NULL,
  `moa_path` varchar(255) DEFAULT NULL,
  `aoa_path` varchar(255) DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_license_submissions`
--

CREATE TABLE `leave_license_submissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `form_name` varchar(255) NOT NULL,
  `entity_type` enum('individual','partnership','pvtLtd') NOT NULL,
  `aadhar_card_individual` varchar(255) DEFAULT NULL,
  `pan_card_individual` varchar(255) DEFAULT NULL,
  `partnership_deed` varchar(255) DEFAULT NULL,
  `aadhar_card_partners` varchar(255) DEFAULT NULL,
  `pan_card_partners` varchar(255) DEFAULT NULL,
  `board_resolution_partners` varchar(255) DEFAULT NULL,
  `certificate_of_incorporation` varchar(255) DEFAULT NULL,
  `moa` varchar(255) DEFAULT NULL,
  `aoa` varchar(255) DEFAULT NULL,
  `aadhar_card_directors` varchar(255) DEFAULT NULL,
  `pan_card_directors` varchar(255) DEFAULT NULL,
  `board_resolution_directors` varchar(255) DEFAULT NULL,
  `place_document` varchar(255) DEFAULT NULL,
  `witness_aadhar` varchar(255) DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mpcb_submissions`
--

CREATE TABLE `mpcb_submissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_type` varchar(50) NOT NULL,
  `owner_aadhar` varchar(255) NOT NULL,
  `owner_pan` varchar(255) NOT NULL,
  `owner_photo` varchar(255) NOT NULL,
  `partners_docs` varchar(255) DEFAULT NULL,
  `partnership_deed` varchar(255) DEFAULT NULL,
  `directors_docs` varchar(255) DEFAULT NULL,
  `certificate_incorporation` varchar(255) DEFAULT NULL,
  `moa` varchar(255) DEFAULT NULL,
  `board_resolution` varchar(255) DEFAULT NULL,
  `property_docs` varchar(255) NOT NULL,
  `ca_certificate` varchar(255) NOT NULL,
  `flow_chart` varchar(255) NOT NULL,
  `stp_declaration` varchar(255) NOT NULL,
  `machinery_list` varchar(255) NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nursing_submissions`
--

CREATE TABLE `nursing_submissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entity_type` enum('proprietor','partnership','pvtLtd') NOT NULL,
  `aadhar_card_path` varchar(255) DEFAULT NULL,
  `pan_card_path` varchar(255) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `place_document_path` varchar(255) DEFAULT NULL,
  `mpcb_consent_path` varchar(255) DEFAULT NULL,
  `tax_receipt_path` varchar(255) DEFAULT NULL,
  `water_bill_path` varchar(255) DEFAULT NULL,
  `fire_noc_path` varchar(255) DEFAULT NULL,
  `rent_agreement_path` varchar(255) DEFAULT NULL,
  `plan_path` varchar(255) DEFAULT NULL,
  `bio_medical_waste_path` varchar(255) DEFAULT NULL,
  `corporation_noc_path` varchar(255) DEFAULT NULL,
  `doctor_aadhar_path` varchar(255) DEFAULT NULL,
  `doctor_photo_path` varchar(255) DEFAULT NULL,
  `degree_certificate_path` varchar(255) DEFAULT NULL,
  `visiting_surgeon_affidavit_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partnership_submissions`
--

CREATE TABLE `partnership_submissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `director_name` varchar(255) NOT NULL,
  `director_address` varchar(255) NOT NULL,
  `director_contact` varchar(20) NOT NULL,
  `photo_id_proof` varchar(255) NOT NULL,
  `possession_proof` varchar(255) NOT NULL,
  `firm_constitution` varchar(255) NOT NULL,
  `nomination_clause` varchar(255) DEFAULT NULL,
  `water_report` varchar(255) DEFAULT NULL,
  `iec_document` varchar(255) DEFAULT NULL,
  `recall_plan` varchar(255) DEFAULT NULL,
  `vehicle_list` text DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_act_submissions`
--

CREATE TABLE `shop_act_submissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entity_type` varchar(50) NOT NULL,
  `aadhar_card_path` varchar(255) DEFAULT NULL,
  `pan_card_path` varchar(255) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `partnership_deed_path` varchar(255) DEFAULT NULL,
  `certificate_of_incorporation_path` varchar(255) DEFAULT NULL,
  `moa_path` varchar(255) DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `form_name` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trademark_submissions`
--

CREATE TABLE `trademark_submissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_type` enum('proprietorship','partnership','pvtLtd') NOT NULL,
  `owner_aadhar` varchar(255) NOT NULL,
  `owner_pan` varchar(255) NOT NULL,
  `owner_photo` varchar(255) NOT NULL,
  `partners_docs` varchar(255) DEFAULT NULL,
  `partnership_deed` varchar(255) DEFAULT NULL,
  `directors_docs` varchar(255) DEFAULT NULL,
  `certificate_incorporation` varchar(255) DEFAULT NULL,
  `moa` varchar(255) DEFAULT NULL,
  `board_resolution` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `old_document` varchar(255) DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `udhyam_submissions`
--

CREATE TABLE `udhyam_submissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_type` enum('proprietor','partnership','pvtLtd') NOT NULL,
  `owner_aadhar` longblob DEFAULT NULL,
  `owner_pan` longblob DEFAULT NULL,
  `partners_docs` longblob DEFAULT NULL,
  `partnership_deed` longblob DEFAULT NULL,
  `directors_docs` longblob DEFAULT NULL,
  `certificates` longblob DEFAULT NULL,
  `moa` longblob DEFAULT NULL,
  `board_resolution` longblob DEFAULT NULL,
  `bank_details` bigint(20) DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `udhyam_submissions`
--

INSERT INTO `udhyam_submissions` (`id`, `user_id`, `business_type`, `owner_aadhar`, `owner_pan`, `partners_docs`, `partnership_deed`, `directors_docs`, `certificates`, `moa`, `board_resolution`, `bank_details`, `submission_date`) VALUES
(2, 42, 'proprietor', 0x75706c6f6164732f313733343937313530345f53637265656e73686f7420323032342d30392d3033203139313830382e706e67, 0x75706c6f6164732f313733343937313530345f53637265656e73686f7420323032342d30392d3130203133333830332e706e67, '', '', '', '', '', '', NULL, '2024-12-23 16:31:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `aadhaar` varchar(50) DEFAULT NULL,
  `birth_date` date NOT NULL,
  `gender` enum('male','female','prefer not to say') NOT NULL,
  `address_line1` varchar(255) NOT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `time_created` date NOT NULL DEFAULT current_timestamp(),
  `photo` varchar(100) DEFAULT NULL,
  `sign` varchar(100) DEFAULT NULL,
  `pass` varchar(255) NOT NULL,
  `membership_start_date` date DEFAULT NULL,
  `membership_end_date` date DEFAULT NULL,
  `status` enum('active','suspended') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone`, `aadhaar`, `birth_date`, `gender`, `address_line1`, `address_line2`, `country`, `city`, `region`, `postal_code`, `time_created`, `photo`, `sign`, `pass`, `membership_start_date`, `membership_end_date`, `status`) VALUES
(42, 'Chetan Sonwane', 'chetansonwane2006@gmail.com', '9130731260', '93361234554', '2004-08-06', 'male', '12,dfhsdfksdjfsdjlfg', '12 xysssssdfsd', 'India', 'Dhule', 'Maharastra', '424311', '2024-12-23', 'passPort.jpg', 'Screenshot 2024-09-03 191738.png', '$2y$10$oUNWg.PcHGRbZUfTQdJHEeKbPZpk0PdswCadvs9yc9QeIaMdK2x/e', '2025-06-23', '2025-06-23', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`,`admin_email`,`pass`);

--
-- Indexes for table `barcode_submissions`
--
ALTER TABLE `barcode_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `company_incorporation`
--
ALTER TABLE `company_incorporation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submission_id` (`submission_id`);

--
-- Indexes for table `document_submissions`
--
ALTER TABLE `document_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `drug_license_submissions`
--
ALTER TABLE `drug_license_submissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`entity_type`);

--
-- Indexes for table `gst_submissions`
--
ALTER TABLE `gst_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `leave_license_submissions`
--
ALTER TABLE `leave_license_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `mpcb_submissions`
--
ALTER TABLE `mpcb_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `nursing_submissions`
--
ALTER TABLE `nursing_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `partnership_submissions`
--
ALTER TABLE `partnership_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `shop_act_submissions`
--
ALTER TABLE `shop_act_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `trademark_submissions`
--
ALTER TABLE `trademark_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `udhyam_submissions`
--
ALTER TABLE `udhyam_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `barcode_submissions`
--
ALTER TABLE `barcode_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company_incorporation`
--
ALTER TABLE `company_incorporation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `directors`
--
ALTER TABLE `directors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document_submissions`
--
ALTER TABLE `document_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `drug_license_submissions`
--
ALTER TABLE `drug_license_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gst_submissions`
--
ALTER TABLE `gst_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leave_license_submissions`
--
ALTER TABLE `leave_license_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mpcb_submissions`
--
ALTER TABLE `mpcb_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nursing_submissions`
--
ALTER TABLE `nursing_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `partnership_submissions`
--
ALTER TABLE `partnership_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shop_act_submissions`
--
ALTER TABLE `shop_act_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trademark_submissions`
--
ALTER TABLE `trademark_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `udhyam_submissions`
--
ALTER TABLE `udhyam_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barcode_submissions`
--
ALTER TABLE `barcode_submissions`
  ADD CONSTRAINT `barcode_submissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_incorporation`
--
ALTER TABLE `company_incorporation`
  ADD CONSTRAINT `company_incorporation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `directors`
--
ALTER TABLE `directors`
  ADD CONSTRAINT `directors_ibfk_1` FOREIGN KEY (`submission_id`) REFERENCES `partnership_submissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `document_submissions`
--
ALTER TABLE `document_submissions`
  ADD CONSTRAINT `document_submissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `drug_license_submissions`
--
ALTER TABLE `drug_license_submissions`
  ADD CONSTRAINT `drug_license_submissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gst_submissions`
--
ALTER TABLE `gst_submissions`
  ADD CONSTRAINT `gst_submissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leave_license_submissions`
--
ALTER TABLE `leave_license_submissions`
  ADD CONSTRAINT `leave_license_submissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `mpcb_submissions`
--
ALTER TABLE `mpcb_submissions`
  ADD CONSTRAINT `mpcb_submissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nursing_submissions`
--
ALTER TABLE `nursing_submissions`
  ADD CONSTRAINT `nursing_submissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `partnership_submissions`
--
ALTER TABLE `partnership_submissions`
  ADD CONSTRAINT `partnership_submissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `shop_act_submissions`
--
ALTER TABLE `shop_act_submissions`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trademark_submissions`
--
ALTER TABLE `trademark_submissions`
  ADD CONSTRAINT `trademark_submissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `udhyam_submissions`
--
ALTER TABLE `udhyam_submissions`
  ADD CONSTRAINT `udhyam_submissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
