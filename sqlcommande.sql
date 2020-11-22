CREATE TABLE myjobcopy.usersTemp 
AS
SELECT 
    myjob.auth_user.first_name as first_name,
    myjob.auth_user.last_name as last_name,
    myjob.auth_user.username as sciper,
    myjob.auth_user.email as email,
    myjob.main_profile.is_student as is_student,
    myjob.main_profile.filtreNewsmail_id as filtreNewsmail_id,
    myjob.main_profile.filtreAlerte_id as filtreAlerte_id

FROM 
    myjob.auth_user
LEFT JOIN 
    myjob.main_profile ON
    myjob.auth_user.id = myjob.main_profile.user_ptr_id;

CREATE TABLE myjobcopy.usersTemp2
AS
    
SELECT 
    myjobcopy.usersTemp.first_name as first_name,
    myjobcopy.usersTemp.last_name as last_name,
    myjobcopy.usersTemp.sciper as sciper,
    myjobcopy.usersTemp.email as email,
    myjobcopy.usersTemp.is_student as is_student,
    myjob.main_filtre.activated as notifications_day,
    myjobcopy.usersTemp.filtreAlerte_id as filtreAlerte_id

FROM 
    myjobcopy.usersTemp
LEFT JOIN
    myjob.main_filtre ON
    myjobcopy.usersTemp.filtreNewsmail_id = myjob.main_filtre.id;

CREATE TABLE myjobcopy.users
AS
    
SELECT 
    myjobcopy.usersTemp2.first_name as first_name,
    myjobcopy.usersTemp2.last_name as last_name,
    myjobcopy.usersTemp2.sciper as sciper,
    myjobcopy.usersTemp2.email as email,
    myjobcopy.usersTemp2.is_student as is_student,
    myjobcopy.usersTemp2.notifications_day as notifications_day,
    myjob.main_filtre.activated as notifications_instant

FROM 
    myjobcopy.usersTemp2
LEFT JOIN
    myjob.main_filtre ON
    myjobcopy.usersTemp2.filtreAlerte_id = myjob.main_filtre.id;

DELETE FROM myjobcopy.users WHERE notifications_day=0 AND notifications_instant=0;
ALTER TABLE myjobcopy.users ADD `user_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE myjobcopy.users ADD `notifications_week` TINYINT(1) NOT NULL Default 0;
ALTER TABLE myjobcopy.users ADD `admin` TINYINT(1) NOT NULL Default 0;
ALTER TABLE myjobcopy.users ADD `remember_token` VARCHAR(100)  NULL Default NULL;
ALTER TABLE myjobcopy.users ADD `created_at` timestamp  NULL Default NULL;
ALTER TABLE myjobcopy.users ADD `updated_at` timestamp  NULL Default NULL;
ALTER TABLE myjobcopy.users ADD `deleted_at` timestamp  NULL Default NULL;
UPDATE myjobcopy.users 
SET notifications_day = 0 where notifications_day IS NULL;
UPDATE myjobcopy.users 
SET notifications_instant = 0 where notifications_instant IS NULL;
UPDATE myjobcopy.users 
SET is_student = 0 where is_student IS NULL;
Drop table myjobcopy.usersTemp2;
Drop table myjobcopy.usersTemp;
DELETE FROM myjobcopy.users where email='nicolas.buchwalder@epfl.ch';
INSERT INTO mjv2copy2.users ( sciper, first_name, last_name, email, notifications_instant, notifications_day, notifications_week, admin, is_student)
SELECT sciper , first_name, last_name, email, notifications_instant, notifications_day, notifications_week, admin, is_student
FROM myjobcopy.users;