CREATE TABLE user {
	name TEXT NOT NULL,
	admin BOOLEAN DEFAULT 0,
	passwrd TEXT NOT NULL.
	email TEXT NOT NULL,
	PRIMARY KEY (email)
}

CREATE TABLE show {
	showid INT NOT NULL.
	genre TEXT,
	semester TEXT,
	PRIMARY KEY showid
}

CREATE TABLE dj {
	email TEXT,
	showid INT,
	PRIMARY KEY (email, showid),
	FOREIGN KEY (email) REFERENCES user(email)
		ON DELETE CASCADE,
	FOREIGN KEY (showid) REFERENCES show(showid)
		ON DELETE CASCADE
}

CREATE TABLE showInstance {
	showid INT,
	day TEXT,
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
	name TEXT NOT NULL,
	PRIMARY KEY (name)
}

CREATE TABLE post {
	postid INT NOT NULL,
	email TEXT NOT NULL,
	time TIMESTAMP,
	content TEXT NOT NULL,
	category TEXT NOT NULL,
	PRIMARY KEY (postid),
	FOREIGN KEY (category) REFERENCES category(name)
		ON UPDATE CASCADE
		ON DELETE CASCADE
	FOREIGN KEY(email) REFERENCES user(email)
		ON UPDATE CASCADE
		ON DELETE CASCADE	

}