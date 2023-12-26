UPDATE cdrrattachment SET appid='8237' WHERE appid='8059';
UPDATE cdrrhrotherattachment SET appid='8237' WHERE appid='8059';
UPDATE cdrrhrpersonnel SET appid='8237' WHERE appid='8059';
UPDATE cdrrhrreceipt SET appid='8237' WHERE appid='8059';
UPDATE cdrrhrxraylist SET appid='8237' WHERE appid='8059';
UPDATE cdrrhrxrayservcat SET appid='8237' WHERE appid='8059';
UPDATE cdrrpersonnel SET appid='8237' WHERE appid='8059';
UPDATE cdrrreceipt SET appid='8237' WHERE appid='8059';
UPDATE hfsrbannexa SET appid='8237' WHERE appid='8059';
UPDATE hfsrbannexb SET appid='8237' WHERE appid='8059';
UPDATE hfsrbannexc SET appid='8237' WHERE appid='8059';
UPDATE hfsrbannexd SET appid='8237' WHERE appid='8059';
UPDATE hfsrbannexf SET appid='8237' WHERE appid='8059';
UPDATE hfsrbannexh SET appid='8237' WHERE appid='8059';
UPDATE hfsrbannexi SET appid='8237' WHERE appid='8059';


---------------------------

SELECT assignedRgn, appid, licenseNo, rgnid, facilityname, hfser_id, hgpid, approvedDate FROM `appform` WHERE appform.status='A' AND hfser_id='PTC' ORDER BY assignedRgn, licenseNo;