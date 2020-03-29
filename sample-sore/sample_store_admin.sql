--  as admin
-- $ msql -u admin -p
-- > source /home/pjmd/PhpWorkspace/Intro/sample-sore/sample_store_admin.sql;
CREATE DATABASE sample_store;
CREATE USER "sample_user"@"localhost" IDENTIFIED BY 'PASSWORD';
GRANT ALL PRIVILEGES ON sample_store.* TO 'sample_user'@'localhost';
FLUSH PRIVILEGES;
