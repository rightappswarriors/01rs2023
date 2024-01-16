/* 2024-01-03 */
ALTER TABLE appform 
ADD COLUMN head_of_facility_name TEXT,
ADD COLUMN license_number TEXT,
ADD COLUMN license_validity DATE;

DROP TABLE reg_facility_archive;

/*******************/

ALTER TABLE reg_facility_archive
ADD COLUMN hfser_id varchar(11) DEFAULT NULL,
ADD COLUMN nhfcode  varchar(70)  DEFAULT NULL,
ADD COLUMN nhfcode_temp varchar(70)  DEFAULT NULL,
ADD COLUMN year int DEFAULT NULL,
ADD COLUMN rgnid varchar(5) DEFAULT NULL,
ADD COLUMN facilityname TEXT DEFAULT NULL,
ADD COLUMN dtrackno varchar(80) DEFAULT NULL,
ADD COLUMN conid text DEFAULT NULL,
ADD COLUMN ptcid text DEFAULT NULL,
ADD COLUMN ltoid text DEFAULT NULL,
ADD COLUMN coaid text DEFAULT NULL,
ADD COLUMN atoid text DEFAULT NULL,
ADD COLUMN corid text DEFAULT NULL,
ADD COLUMN hgpid int DEFAULT NULL;


/*******************/
ALTER TABLE reg_facility_archive
MODIFY COLUMN description text DEFAULT NULL,
MODIFY COLUMN filename varchar(300)  DEFAULT NULL,
MODIFY COLUMN regfac_id int DEFAULT NULL;


/******************/
DROP TABLE reg_facility_archive;

CREATE TABLE `reg_facility_archive` (
  `rfa_id` int NOT NULL AUTO_INCREMENT,
  `regfac_id` int DEFAULT NULL,
  `hfser_id` varchar(11) DEFAULT NULL,
  `nhfcode` varchar(70) DEFAULT NULL,
  `nhfcode_temp` varchar(70) DEFAULT NULL,
  `year` int DEFAULT NULL,
  `rgnid` varchar(5) DEFAULT NULL,
  `facilityname` text,
  `hgpid` int DEFAULT NULL,
  `dtrackno` varchar(80) DEFAULT NULL,
  `conid` text,
  `ptcid` text,
  `ltoid` text,
  `coaid` text,
  `atoid` text,
  `corid` text,
  `rectype_id` int DEFAULT NULL,
  `description` text,
  `filename` varchar(300) DEFAULT NULL,
  `savelocation` text NOT NULL,
  `ipaddress` varchar(20) DEFAULT NULL,
  `localip` varchar(20) DEFAULT NULL,
  `computername` varchar(100) DEFAULT NULL,
  `browser` varchar(35) DEFAULT NULL,
  `created_at` date NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`rfa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
