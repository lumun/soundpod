CREATE DATABASE IF NOT EXISTS soundpod;

USE soundpod;

CREATE TABLE IF NOT EXISTS user (
	name VARCHAR(20) NOT NULL,
	admin TINYINT(2) DEFAULT 0,
	password VARCHAR(20) NOT NULL,
	email VARCHAR(30) NOT NULL,
	PRIMARY KEY (email)
);

CREATE TABLE IF NOT EXISTS radioShow (
	showid INT NOT NULL,
	genre VARCHAR(20),
	title VARCHAR(40),
	PRIMARY KEY (showid)
);

CREATE TABLE IF NOT EXISTS dj (
	email VARCHAR(30),
	showid INT,
	PRIMARY KEY (email, showid),
	FOREIGN KEY (email) REFERENCES user(email)
		ON DELETE CASCADE,
	FOREIGN KEY (showid) REFERENCES radioShow(showid)
		ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS showInstance (
	showid INT,
	weekday VARCHAR(10),
	time VARCHAR(10),
	PRIMARY KEY (showid, weekday, time),
	FOREIGN KEY (showid) REFERENCES radioShow(showid)
		ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS subRequest (
	origdj VARCHAR(30),
	subdj VARCHAR(30),
	comment VARCHAR(2000),
	showid INT,
	weekday VARCHAR(10),
	time VARCHAR(10),
	month VARCHAR(10),
	day VARCHAR (5),
	active TINYINT(2) DEFAULT 1,
	PRIMARY KEY (showid, month, day),
	FOREIGN KEY (origdj) REFERENCES user(email),
	FOREIGN KEY (subdj) REFERENCES user(email)
		ON DELETE CASCADE,
	FOREIGN KEY (showid) REFERENCES radioShow(showid)
		ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS category (
	name VARCHAR(60) NOT NULL,
	PRIMARY KEY (name)
);

CREATE TABLE IF NOT EXISTS post (
	postid INT NOT NULL AUTO_INCREMENT,
	email VARCHAR(30) NOT NULL,
	time TIMESTAMP,
	content VARCHAR(2000) NOT NULL,
	category VARCHAR(60) NOT NULL,
	PRIMARY KEY (postid),
	FOREIGN KEY (category) REFERENCES category(name)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY(email) REFERENCES user(email)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);