USE soundpod;

INSERT INTO category VALUES ('New Users');
INSERT INTO category VALUES ('Dummy');

INSERT INTO post(postid,email,content,category) VALUES (0,'admin','Welcome to the Category!','New Users');
INSERT INTO post(postid,email,content,category) VALUES (1,'dj','Im stoked to be here','New Users');
INSERT INTO post(postid,email,content,category) VALUES (2,'dj','dummy dummy dummy dummy','Dummy');