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

