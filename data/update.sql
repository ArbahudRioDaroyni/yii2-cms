ALTER TABLE `doctor` ADD `consultation` VARCHAR(200) NULL DEFAULT NULL AFTER `specialization_id`;
ALTER TABLE `doctor` ADD `description` TEXT NOT NULL AFTER `workshop`;
ALTER TABLE `schedule` CHANGE `end_time` `end_time` TIME NULL DEFAULT NULL;


INSERT INTO `lookup` (`id`, `name`, `value`, `group`, `order`, `type`, `params`, `publish`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES (NULL, 'career-destination', 'Untuk Melamar Anda bisa: Kirim ke Email admin@carolus.com atau kirimkan surat lamaran beserta CV ke alamat kami secara langsung.', '', '0', 'richtext', '', '10', '0000-00-00 00:00:00', '0', NULL, NULL);

ALTER TABLE `specialization` ADD `order` INT NOT NULL AFTER `publish`;

INSERT INTO `carolus`.`lookup` (`id`, `name`, `value`, `group`, `order`, `type`, `params`, `publish`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES (NULL, 'testimonial', '1', '', '15', 'dropdown', '', '10', '0000-00-00 00:00:00', '0', NULL, NULL);

ALTER TABLE `proposal`
CHANGE `diploma_file` `diploma_file` varchar(100) COLLATE 'utf8_general_ci' NULL DEFAULT '0' AFTER `salary_expect`,
CHANGE `transcript_file` `transcript_file` varchar(100) COLLATE 'utf8_general_ci' NULL DEFAULT '0' AFTER `diploma_file`,
CHANGE `ktp_file` `ktp_file` varchar(100) COLLATE 'utf8_general_ci' NULL DEFAULT '0' AFTER `transcript_file`,
CHANGE `photo` `photo` varchar(100) COLLATE 'utf8_general_ci' NULL DEFAULT '0' AFTER `ktp_file`;

# 14/12/2017
ALTER TABLE `proposal` CHANGE `experience` `experience` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL;

# 15/12/2017
ALTER TABLE `proposal` CHANGE `birth_date` `birth_date` DATE NULL;\


# 15/01/2018
ALTER TABLE `proposal` ADD `height` VARCHAR(50) NULL AFTER `birth_date`, 
ADD `weight` VARCHAR(50) NULL AFTER `height`;


# 15/01/2018
ALTER TABLE `proposal` ADD `height` VARCHAR(50) NULL AFTER `birth_date`, 
ADD `weight` VARCHAR(50) NULL AFTER `height`;


# 11/02/2018
ALTER TABLE `doctor` ADD `real_name` VARCHAR(250) NOT NULL AFTER `name`;



# 19/02/2018
INSERT INTO `lookup` (`id`, `name`, `value`, `group`, `order`, `type`, `params`, `publish`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES (NULL, 'logo-image', '/~projectc/carolus/web/images/lookup/5a7d343089d871518154800.png', '', '16', 'file', '{\"isImage\":true}', '10', '2017-11-21 00:00:00', '1', '2017-11-21 00:00:00', '1');

# 21/03/2018
ALTER TABLE `schedule` ADD `type` INT NULL DEFAULT '10' AFTER `notes`;

# 28/09/2018
ALTER TABLE `article` ADD `meta_description` VARCHAR(250) NULL AFTER `excerpt`;

# 02/11/2018

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(300) NOT NULL,
  `created_at` datetime NULL,
  `created_by` int(11) NULL,
  `updated_at` datetime NULL,
  `updated_by` int(11) NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `newsletter` ADD PRIMARY KEY (`id`);COMMIT;