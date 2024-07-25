CREATE DATABASE crud;

use crud;

CREATE TABLE accounts
(
	id int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    surname varchar(255) NOT NULL,
    email varchar(255) UNIQUE NOT NULL,
	company varchar(255) NULL,
    position varchar(255) NULL,
    PRIMARY KEY(id)
);

CREATE TABLE phones
(
	id int NOT NULL AUTO_INCREMENT,
	account_id int NOT NULL,
    phone_number bigint(11) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(account_id) REFERENCES accounts(id)
);