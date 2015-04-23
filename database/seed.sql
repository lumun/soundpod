USE soundpod;

INSERT INTO user VALUES (1,'John Snow',1,'password','admin');
INSERT INTO user VALUES (2,'Megan Wensel',0,'password','dj');

INSERT INTO radioShow VALUES (1,'Alternative','S2015','John lays it Down');
INSERT INTO radioShow VALUES (2,'Hard Rock','S2015','Megan and John Are Sharks');

INSERT INTO dj VALUES (1,1);
INSERT INTO dj VALUES (1,2);
INSERT INTO dj VALUES (2,2);

INSERT INTO showInstance VALUES (1,'Tuesday',1500);
INSERT INTO showInstance VALUES (2,'Monday',2200);
