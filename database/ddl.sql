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

INSERT INTO user(email,name,admin,password) VALUES ('admin','Bob Belcher',1,'password');
INSERT INTO user(email,name,admin,password) VALUES ('dj','Megan Wensel',0,'password');
 
INSERT INTO radioShow(showid,genre,title) VALUES (67584563,'alt','Bob lays it Down');
INSERT INTO radioShow(showid,genre,title) VALUES (22349008,'loud','Megan and Bob Are Sharks');

INSERT INTO dj(email,showid) VALUES ('admin',67584563);
INSERT INTO dj(email,showid) VALUES ('admin',22349008);
INSERT INTO dj(email,showid) VALUES ('dj',22349008);

INSERT INTO showInstance(showid,weekday,time) VALUES (67584563,'Tuesday','1500');
INSERT INTO showInstance(showid,weekday,time) VALUES (22349008,'Monday','2200');

INSERT INTO category(name) VALUES ('New DJ\'s!');
INSERT INTO category(name) VALUES ('KUPS');
INSERT INTO category(name) VALUES ('Alternative');
INSERT INTO category(name) VALUES ('Loud Rock');
INSERT INTO category(name) VALUES ('Hip-Hop');
INSERT INTO category(name) VALUES ('Specialty');
INSERT INTO category(name) VALUES ('Street Team');
INSERT INTO category(name) VALUES ('Tabling');




INSERT INTO post(postid,email,content,category) VALUES (5,'admin','Welcome to KUPS! Ask questions and get advice here. And don\'t forget to have fun!','New DJ\'s');
INSERT INTO post(postid,email,content,category) VALUES (6,'dj','Im stoked to be here','New DJ\'s');
INSERT INTO post(postid,email,content,category) VALUES (7,'dj','Post any general station news that you have here!','KUPS');
INSERT INTO post(postid,email,content,category) VALUES (8,'dj','Who is tabling today?','tabling');

INSERT INTO user(email,name,admin,password) VALUES ('a@pugetsound.edu','Tom Riddle',1,'password');
INSERT INTO user(email,name,admin,password) VALUES ('b@pugetsound.edu','Avery Richert',0,'password');
INSERT INTO user(email,name,admin,password) VALUES ('c@pugetsound.edu','Glenna Beck',0,'password');
INSERT INTO user(email,name,admin,password) VALUES ('d@pugetsound.edu','Tim Wise',0,'password');
INSERT INTO user(email,name,admin,password) VALUES ('e@pugetsound.edu','Bob Corker',0,'password');
INSERT INTO user(email,name,admin,password) VALUES ('f@pugetsound.edu','Tatiana Williams',0,'password');
INSERT INTO user(email,name,admin,password) VALUES ('g@pugetsound.edu','Cory Gerber',0,'password');
INSERT INTO user(email,name,admin,password) VALUES ('h@pugetsound.edu','Sam Stone',0,'password');
INSERT INTO user(email,name,admin,password) VALUES ('i@pugetsound.edu','Wensley Went',0,'password');
INSERT INTO user(email,name,admin,password) VALUES ('j@pugetsound.edu','Storm Harder',0,'password');
INSERT INTO user(email,name,admin,password) VALUES ('k@pugetsound.edu','Maury Canter',0,'password');
INSERT INTO user(email,name,admin,password) VALUES ('l@pugetsound.edu','Joe Anne Tenpe',0,'password');
INSERT INTO user(email,name,admin,password) VALUES ('m@pugetsound.edu','Jon Snow',0,'password');
INSERT INTO user(email,name,admin,password) VALUES ('n@pugetsound.edu','Tyrion Lannister',1,'password');

INSERT INTO subRequest(origdj,comment,showid,weekday,time,month,day,active) VALUES ('dj','This is a sub request',67584563,'Tue','3PM','May','5th',1);
INSERT INTO subRequest(origdj,comment,showid,weekday,time,month,day,active) VALUES ('admin','Sub request',67584563,'Tue','3PM','May','12th',0);
INSERT INTO subRequest(origdj,comment,showid,weekday,time,month,day,active) VALUES ('a@pugetsound.edu','Ert',22349008,'Mon','10PM','May','11th',1);
