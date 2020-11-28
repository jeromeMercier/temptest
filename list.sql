SELECT email, titre
FROM myjob.main_annonce
WHERE echance > CURDATE()
INTO OUTFILE '/var/lib/mysql-files/list.csv'
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n';