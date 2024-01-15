/* 2024-01-03 */
ALTER TABLE appform 
ADD COLUMN head_of_facility_name TEXT,
ADD COLUMN license_number TEXT,
ADD COLUMN license_validity DATE;



/* 2024-01-09 */
ALTER TABLE reg_facility_archive
ADD COLUMN regfac_id_temp int NULL;




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
