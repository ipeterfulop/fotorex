-- the old way
DROP DATABASE fotorexdb;
CREATE DATABASE fotorexdb CHARACTER SET utf8 COLLATE utf8_general_ci;
GRANT ALL ON fotorexdb.* TO fotorex@localhost IDENTIFIED BY 'JkN7T9CacLfA';
USE fotorexdb;

-- the new way
DROP DATABASE `fotorexdb`;
DROP USER fotorex@localhost;
CREATE SCHEMA `fotorexdb` CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE USER fotorex@localhost IDENTIFIED BY 'JkN7T9CacLfA';
GRANT ALL ON `fotorexdb`.* TO fotorex@localhost;
USE fotorexdb;


DROP DATABASE `userinboxdb`;
DROP USER userinbox@'%';
CREATE SCHEMA `userinboxdb` CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE USER userinbox@'%' IDENTIFIED BY 'RkF9S9XxX0afA';
GRANT ALL ON `userinboxdb`.* TO userinbox@'%';
USE `userinboxdb`;

DROP DATABASE `szamlamonitoringdb`;
DROP USER szamlamonitoring@localhost;
CREATE SCHEMA `szamlamonitoringdb` CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE USER szamlamonitoring@localhost IDENTIFIED BY '2s8Aw2t2wpqC';
GRANT ALL ON `szamlamonitoringdb`.* TO szamlamonitoring@localhost;
USE `szamlamonitoringdb`;

