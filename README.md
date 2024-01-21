use the xampp server to run code.
step 1 : download the code or copy paste.
step 2 : download the xampp server and start apache and mysql.
step 3 : copy online-voting-system-using-php folder and paste into htdocs folder in xampp.
step 4 : goto default browser and type "http://localhost/online-voting-system-using-php/home.html"

Note:- in phpmyadmin you create following database or tables

Database name:- userdb 
Query:- create database userdb;

voter table:- users  
     columns:- id, username, password, p_no, addr, voted.
Query:- CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    p_no VARCHAR(15) NOT NULL,
    addr TEXT,
    voted INT DEFAULT 0
);

admin table:- admin
     columns:- id, adminname, password, p_no, addr, votes.
Query:- CREATE TABLE admin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    adminname VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    p_no VARCHAR(15) NOT NULL,
    addr TEXT,
    votes INT DEFAULT 0
);
