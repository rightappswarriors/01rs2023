CREATE TABLE `personnel_pre` (
  `prefix` varchar(20) NOT NULL,
  PRIMARY KEY (`prefix`)
);

INSERT INTO personnel_pre 
SELECT DISTINCT REPLACE(REPLACE(prefix, '.',''), '\'','') AS prefix FROM hfsrbannexa WHERE prefix IS NOT NULL;




/***************** UPDATE TABLE STRUCTURE CAN BE USED FOR CHANGE ******************/
ALTER TABLE x08_ft ADD COLUMN servowner TEXT;
ALTER TABLE x08_ft ADD COLUMN servtyp varchar(20);
ALTER TABLE x08_ft ADD COLUMN facid_old TEXT;



/***************** UPDATE TABLE STRUCTURE CAN BE USED FOR REGISTERED FACILITY ******************/
ALTER TABLE reg_x08_ft ADD COLUMN fee_type varchar(20);
ALTER TABLE reg_x08_ft ADD COLUMN servowner TEXT;
ALTER TABLE reg_x08_ft ADD COLUMN servtyp varchar(20);
ALTER TABLE reg_x08_ft ADD COLUMN facid_old TEXT;



/*************************************************************************************/
/*********** VIEW FOR REGISTERED FACILITY SERVICES PER APPFORM  ***************/
DROP VIEW IF EXISTS view_reg_facility_services;

CREATE VIEW view_reg_facility_services AS

SELECT rf.regfac_id, rf.old_pk AS lastest_appid, rf.nhfcode, rf.facid AS rf_hgpid, rf.facilitytype AS appform_hgpdesc, rf.assignedRgn AS assignrgn, 
reg_x08_ft.facid, facilitytyp.facname, facilitytyp.forSpecialty, facilitytyp.facmid,  facmode.facmdesc, 
facilitytyp.hgpid, hfaci_grp.hgpdesc AS facilitytyp_hgpdesc, hfaci_grp.status, hfaci_grp.year_validity, 
facilitytyp.servtype_id,  serv_type.anc_name, serv_type.seq, serv_type.facid AS serv_type_facid, serv_type.grp_name, 
 reg_x08_ft.servtyp, reg_x08_ft.servowner, reg_x08_ft.facid AS facid_old
FROM registered_facility rf
LEFT JOIN reg_x08_ft ON rf.regfac_id=reg_x08_ft.reg_facid 
LEFT JOIN facilitytyp ON facilitytyp.facid=reg_x08_ft.facid 
LEFT JOIN hfaci_grp ON hfaci_grp.hgpid=facilitytyp.hgpid
LEFT JOIN facmode ON facmode.facmid=facilitytyp.facmid
LEFT JOIN serv_type ON serv_type.servtype_id=facilitytyp.servtype_id
ORDER BY rf.regfac_id, rf.old_pk, serv_type.seq DESC;

/*********** VIEW FOR FACILITY SERVICES PER APPFORM  ***************/

DROP VIEW IF EXISTS view_facility_services_per_appform;

CREATE VIEW view_facility_services_per_appform AS

SELECT x08_ft.appid, hfaci_grp_a.hgpdesc AS appform_hgpdesc, facilitytyp.assignrgn,  x08_ft.fee_type, 
x08_ft.facid, facilitytyp.facname, facilitytyp.forSpecialty, facilitytyp.facmid,  facmode.facmdesc, 
 facilitytyp.hgpid, hfaci_grp.hgpdesc AS facilitytyp_hgpdesc, hfaci_grp.status, hfaci_grp.year_validity, facilitytyp.servtype_id,  serv_type.anc_name, serv_type.seq, serv_type.facid AS serv_type_facid, serv_type.grp_name, x08_ft.servowner, x08_ft.servtyp, x08_ft.facid_old, fac_old.facname AS facname_old, serv_type_old.anc_name AS anc_name_old
FROM appform 
LEFT JOIN x08_ft ON appform.appid=x08_ft.appid 
LEFT JOIN facilitytyp ON facilitytyp.facid=x08_ft.facid 
LEFT JOIN facilitytyp fac_old ON fac_old.facid=x08_ft.facid_old 
LEFT JOIN hfaci_grp ON hfaci_grp.hgpid=facilitytyp.hgpid
LEFT JOIN hfaci_grp AS hfaci_grp_a ON hfaci_grp_a.hgpid=appform.hgpid
LEFT JOIN facmode ON facmode.facmid=facilitytyp.facmid
LEFT JOIN serv_type ON serv_type.servtype_id=facilitytyp.servtype_id
LEFT JOIN serv_type serv_type_old ON serv_type.servtype_id=fac_old.servtype_id
WHERE x08_ft.appid IS NOT NULL
ORDER BY x08_ft.appid, serv_type.seq;



/************ VIEW FOR GET SERVICE CHARGES *****************/

DROP VIEW IF EXISTS view_ServiceCharge;

CREATE VIEW view_ServiceCharge AS

SELECT  serv_chg.facid, facilitytyp.facname, chg_app.amt, chg_app.chgapp_id, chg_app.chg_code, charges.chg_desc, 
serv_chg.hfser_id, serv_chg.facmid, extrahgpid, chg_app.aptid,  facilitytyp.servtype_id
FROM serv_chg 
LEFT JOIN facilitytyp ON facilitytyp.facid=serv_chg.facid
LEFT JOIN chg_app ON chg_app.chgapp_id=serv_chg.chgapp_id 
LEFT JOIN charges ON charges.chg_code=chg_app.chg_code;

/*************  VIEW FOR SERVICE LIST ****************/

DROP VIEW IF EXISTS view_ServiceList;

CREATE VIEW view_ServiceList AS

SELECT facilitytyp.facid, facilitytyp.facname,  facilitytyp.facmid,  facilitytyp.hgpid,  hfaci_grp.hgpdesc, facilitytyp.specified,  
facilitytyp.grphrz_name,  facilitytyp.servtype_id, serv_type.anc_name, serv_type.seq, serv_type.facid AS serv_type_facid, serv_type.grp_name, 
facilitytyp.old_factype_code,  facilitytyp.assignrgn,  facilitytyp.forSpecialty,  facilitytyp.status 
FROM facilitytyp  
LEFT JOIN serv_type ON facilitytyp.servtype_id=serv_type.servtype_id
LEFT JOIN hfaci_grp ON hfaci_grp.hgpid=facilitytyp.hgpid
ORDER BY facilitytyp.hgpid, facilitytyp.servtype_id;



/**************** VIEW FACILITY PER AUTHORIZATION GROUP ****************/

DROP VIEW IF EXISTS view_facility_per_authorization;

CREATE VIEW view_facility_per_authorization AS

SELECT  tf.tyf_id, tf.hfser_id, hg.* FROM type_facility tf LEFT JOIN hfaci_grp hg ON hg.hgpid=tf.facid
ORDER BY hfser_id, hgpid;


/*************** Ambulance ****************/

CREATE TABLE appform_ambulance
(	
	appid int,
    typeamb TEXT, ambtyp TEXT, plate_number TEXT, ambOwner TEXT
);

ALTER TABLE `appform_ambulance` 
CHANGE COLUMN `id` INT NOT NULL AUTO_INCREMENT ,
ADD PRIMARY KEY (`id`);

/*************** Registered Ambulance ****************/

CREATE TABLE reg_ambulance
(	
	id int PRIMARY KEY,
	regfac_id bigint,
    typeamb TEXT, ambtyp TEXT, plate_number TEXT, ambOwner TEXT
);
