CREATE DATABASE IF NOT EXISTS soundpod;

USE soundpod;

CREATE TABLE IF NOT EXISTS user (
	email VARCHAR(30) NOT NULL,
	name VARCHAR(20) NOT NULL,
	admin TINYINT(2) DEFAULT 0,
	password VARCHAR(20) NOT NULL,
	PRIMARY KEY (email)
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
	origdj VARCHAR(30),
	subdj VARCHAR(30),
	showid INT,
	showdate DATE,
	PRIMARY KEY (showid, showdate),
	FOREIGN KEY (origdj) REFERENCES user(email),
	FOREIGN KEY (subdj) REFERENCES user(email)
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

INSERT INTO user VALUES ('admin','John Snow',1,'password');
INSERT INTO user VALUES ('dj','Megan Wensel',0,'password');

INSERT INTO radioShow VALUES (1,'Alternative','S2015','John lays it Down');
INSERT INTO radioShow VALUES (2,'Hard Rock','S2015','Megan and John Are Sharks');

INSERT INTO dj VALUES ('admin',1);
INSERT INTO dj VALUES ('admin',2);
INSERT INTO dj VALUES ('dj',2);

INSERT INTO showInstance VALUES (1,'Tuesday',1500);
INSERT INTO showInstance VALUES (2,'Monday',2200);