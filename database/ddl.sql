CREATE TABLE user {
	uid INT NOT NULL,
	name VARCHAR(20) NOT NULL,
	admin BOOLEAN DEFAULT 0,
	password VARCHAR(20) NOT NULL.
	email VARCHAR(30) NOT NULL,
	PRIMARY KEY (uid)
}

CREATE TABLE show {
	showid INT NOT NULL.
	genre VARCHAR(20),
	semester VARCHAR(8),
	PRIMARY KEY showid
}

CREATE TABLE dj {
	uid INT,
	showid INT,
	PRIMARY KEY (uid, showid),
	FOREIGN KEY (uid) REFERENCES user(uid)
		ON DELETE CASCADE,
	FOREIGN KEY (showid) REFERENCES show(showid)
		ON DELETE CASCADE
}

CREATE TABLE showInstance {
	showid INT,
	day VARCHAR(10),
	time INT,
	PRIMARY KEY (showid, day, time),
	FOREIGN KEY (showid) REFERENCES show(showid)
		ON DELETE CASCADE
}

CREATE TABLE subRequest {
	origdj INT,
	subdj INT,
	showid INT,
	showdate DATE,
	PRIMARY KEY (showid, showdate),
	FOREIGN KEY (origdj) REFERENCES user(uid),
	FOREIGN KEY (subdj) REFERENCES user(uid)
		ON DELETE CASCADE,
	FOREIGN KEY (showid) REFERENCES show(showid)
		ON DELETE CASCADE
}

CREATE TABLE category {
	name VARCHAR(20) NOT NULL,
	PRIMARY KEY (name)
}

CREATE TABLE post {
	postid INT NOT NULL,
	uid INT NOT NULL,
	time TIMESTAMP,
	content VARCHAR(1000) NOT NULL,
	category VARCHAR(30) NOT NULL,
	PRIMARY KEY (postid),
	FOREIGN KEY (category) REFERENCES category(name)
		ON UPDATE CASCADE
		ON DELETE CASCADE
}