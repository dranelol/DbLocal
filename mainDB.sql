/*

Janksby Incorporated, LLC

we didn't copy anything

*/
drop table if exists Reservation;
drop table if exists MovieShowing;
drop table if exists Theater;
drop table if exists Cinema;
drop table if exists Movie;
drop table if exists Member;
drop table if exists Membership;


create table Cinema
(
	ID int(11) NOT NULL auto_increment,
	Name varchar(256) NOT NULL,
	Address varchar(256) NOT NULL,
	PhoneNumber varchar(256) NOT NULL,
	
	primary key(ID)
)

CHARACTER SET = utf8 engine = InnoDB;

create table Theater
(
	ID int(11) NOT NULL auto_increment,
	CinemaID int(11) NOT NULL,
	TheaterNumber int(11) NOT NULL,
	SeatingRows int(11) NOT NULL,
	SeatingColumns int(11) NOT NULL,
	Capacity int(11) NOT NULL,
	primary key(ID),
	foreign key(CinemaID) references Cinema(ID) ON DELETE CASCADE
)

CHARACTER SET = utf8 engine = InnoDB;

create table Movie
(
	ID int(11) NOT NULL auto_increment,
	Title varchar(256) NOT NULL,
	Stars varchar(1024), /*serialized 1d array */
	Description varchar(256) NOT NULL,
	RunningTimeMinutes int(11) NOT NULL, 
	Rating varchar(256) NOT NULL,
	primary key(ID)
	
)

CHARACTER SET = utf8 engine = InnoDB;

create table MovieShowing
(
	ID int(11) NOT NULL auto_increment,
	CinemaID int(11) NOT NULL,
	TheaterID int(11) NOT NULL,
	MovieID int(11) NOT NULL,
	SeatingChart varchar (65536), /*serialized 2d array */
	ShowDate date NOT NULL,
	ShowTime time NOT NULL,
	SeatsAvailable int(11) NOT NULL,
	primary key(ID),
	foreign key(CinemaID) references Cinema(ID) ON DELETE CASCADE,
	foreign key(TheaterID) references Theater(ID) ON DELETE CASCADE,
	foreign key(MovieID) references Movie(ID) ON DELETE CASCADE
)

CHARACTER SET = utf8 engine = InnoDB;

create table Membership
(
	AcctNum int(11) NOT NULL auto_increment,
	PrimaryMemberID int(11) NOT NULL,
	StartDate date NOT NULL,
	EndDate date NOT NULL,
	primary key(AcctNum)
)

CHARACTER SET = utf8 engine = InnoDB;

create table Member
(
	ID int(11) NOT NULL auto_increment,
	MemberAcctNum int(11),
	MemberAcctOrder int(11),
	Name varchar(256) NOT NULL,
	Address varchar(256) NOT NULL,
	Email varchar(255) NOT NULL,
	PhoneNumber varchar(256) NOT NULL,
	Age int(11) NOT NULL,
	primary key(ID),
	foreign key(MemberAcctNum) references Membership(AcctNum) ON DELETE CASCADE
)

CHARACTER SET = utf8 engine = InnoDB;



create table Reservation
(
	ID int(11) NOT NULL auto_increment,
	MemberID int(11) NOT NULL,
	MembershipID int(11) NOT NULL,
	MovieShowingID int(11) NOT NULL,
	SeatRow int(11) NOT NULL,
	SeatColumn int(11) NOT NULL,
	primary key(ID),
	foreign key(MemberID) references Member(ID) ON DELETE CASCADE,
	foreign key(MovieShowingID) references MovieShowing(ID) ON DELETE CASCADE
)

CHARACTER SET = utf8 engine = InnoDB;

LOAD DATA LOCAL INFILE 'Cinema.data'
REPLACE
INTO TABLE Cinema
FIELDS TERMINATED BY ',';

LOAD DATA LOCAL INFILE 'Theater.data'
REPLACE
INTO TABLE Theater
FIELDS TERMINATED BY ',';

LOAD DATA LOCAL INFILE 'Movie.data'
REPLACE
INTO TABLE Movie
FIELDS TERMINATED BY ',';

LOAD DATA LOCAL INFILE 'MovieShowing.data'
REPLACE
INTO TABLE MovieShowing
FIELDS TERMINATED BY ',';

LOAD DATA LOCAL INFILE 'Membership.data'
REPLACE
INTO TABLE Membership
FIELDS TERMINATED BY ',';

LOAD DATA LOCAL INFILE 'Member.data'
REPLACE
INTO TABLE Member
FIELDS TERMINATED BY ',';

LOAD DATA LOCAL INFILE 'Reservation.data'
REPLACE
INTO TABLE Reservation
FIELDS TERMINATED BY ',';

