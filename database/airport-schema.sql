

-- The Airport Schema (DDL) for SQLite 3
-- CS 455
-- @author David Chiu
-- @version 2/11/2015

--SQLite3 configuration
.mode columns
.headers on
.nullvalue NULL
PRAGMA foreign_keys = ON;	-- enable foreign key constraint


-- drop these tables from schema if they already exist
drop table if exists onboard;
drop table if exists flight;
drop table if exists passengers;
drop table if exists plane;


--create the following tables:

create table passengers (
    f_name TEXT NOT NULL,
    m_name TEXT,
    l_name TEXT NOT NULL,
    ssn    TEXT CHECK(GLOB('???-??-????', ssn)) PRIMARY KEY
);



create table plane (
	tail_no INTEGER PRIMARY KEY,
	make TEXT NOT NULL,
	model TEXT NOT NULL,
	capacity INTEGER,
	mph INTEGER
);



create table flight (
	flight_no INTEGER PRIMARY KEY,
	dep_loc TEXT NOT NULL,
	dep_time TEXT NOT NULL,
	arr_loc TEXT NOT NULL,
	arr_time TEXT NOT NULL,
	tail_no INTEGER,

	--table constraints
	foreign key(tail_no) references plane(tail_no)
		on update cascade	-- If planeID is updated, update here too
		on delete cascade	-- Also delete flights plane was assigned
							-- if the plane is removed!
);



create table onboard (
	ssn TEXT,
	flight_no INTEGER,
	seat TEXT,

	--table constraints
	primary key(ssn,flight_no),
	foreign key(ssn) references passengers(ssn),
		-- No [on update|delete] clause means that changes to passenger(ssn) are not allowed, period.

	foreign key(flight_no) references flight(flight_no)
		on update cascade
		on delete cascade
		-- Changes to flight_num should be expected, and it should be propagated
		-- to this relation
);