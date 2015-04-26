CREATE DATABASE IF NOT EXISTS soundpod;

USE soundpod;

CREATE TABLE IF NOT EXISTS user (
	uid INT NOT NULL,
	name VARCHAR(20) NOT NULL,
	admin TINYINT(2) DEFAULT 0,
	password VARCHAR(20) NOT NULL,
	email VARCHAR(30) NOT NULL,
	PRIMARY KEY (uid)
);

CREATE TABLE IF NOT EXISTS radioShow (
	showid INT NOT NULL,
	genre VARCHAR(20),
	semester VARCHAR(8),
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
	day VARCHAR(10),
	time INT,
	PRIMARY KEY (showid, day, time),
	FOREIGN KEY (showid) REFERENCES radioShow(showid)
		ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS subRequest (
	origdj INT,
	subdj INT,
	showid INT,
	showdate DATE,
	PRIMARY KEY (showid, showdate),
	FOREIGN KEY (origdj) REFERENCES user(uid),
	FOREIGN KEY (subdj) REFERENCES user(uid)
		ON DELETE CASCADE,
	FOREIGN KEY (showid) REFERENCES radioShow(showid)
		ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS category (
	name VARCHAR(20) NOT NULL,
	PRIMARY KEY (name)
);

CREATE TABLE IF NOT EXISTS post (
	postid INT NOT NULL,
	email VARCHAR(30) NOT NULL,
	time TIMESTAMP,
	content VARCHAR(2000) NOT NULL,
	category VARCHAR(20) NOT NULL,
	PRIMARY KEY (postid),
	FOREIGN KEY (category) REFERENCES category(name)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY(email) REFERENCES user(email)
		ON UPDATE CASCADE
		ON DELETE CASCADE	
);