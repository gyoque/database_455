.mode columns
.headers on
.nullvalue NULL
PRAGMA foreign_keys = ON;

create table User(
	dLicense TEXT PRIMARY KEY,
	fname TEXT NOT NULL,
	lname TEXT NOT NULL,
	phone TEXT NOT NULL CHECK(length(phone) <= 15),
	email TEXT NOT NULL UNIQUE,
	street TEXT NOT NULL,
	city TEXT NOT NULL,
	state TEXT NOT NULL CHECK(length(state) <= 2),
	zip INTEGER NOT NULL CHECK(zip < 100000),
	username TEXT NOT NULL UNIQUE,
	FOREIGN KEY(username) REFERENCES Login(username)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

create table Vehicle(
	vin INTEGER PRIMARY KEY,
	pricePerHour REAL NOT NULL,
	make TEXT NOT NULL,
	model TEXT NOT NULL,
	year INTEGER NOT NULL CHECK(year > 1900),
	transmission TEXT NOT NULL CHECK(transmission LIKE 'Manual' or transmission LIKE 'Automatic'),
	seats INTEGER NOT NULL
);

create table Reservation(
	confirmNum INTEGER,
	dLicense TEXT,
	startTime TEXT NOT NULL,
	endTime TEXT NOT NULL,
	location TEXT NOT NULL,
	priceTotal REAL NOT NULL,
	vin TEXT NOT NULL,
	PRIMARY KEY(confirmNum, dLicense)
	FOREIGN KEY(vin) REFERENCES Vehicle(vin)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

create table Login(
	username TEXT PRIMARY KEY,
	password TEXT NOT NULL
);

create table Admin(
	adminID INTEGER PRIMARY KEY,
	fname TEXT NOT NULL,
	lname TEXT NOT NULL,
	username TEXT NOT NULL UNIQUE,
	FOREIGN KEY(username) REFERENCES Login(username)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

create table EditsUser(
	adminID INTEGER,
	driversLicense TEXT,
	timeEdited TEXT,
	PRIMARY KEY(adminID, driversLicense, timeEdited)
	FOREIGN KEY(adminID) REFERENCES Admin(adminID)
		ON UPDATE CASCADE
		ON DELETE CASCADE
	FOREIGN KEY(driversLicense) REFERENCES User(dLicense)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

create table EditsReservation(
	adminID INTEGER,
	vin TEXT,
	confirmNum INTEGER,
	timeEdited TEXT,
	PRIMARY KEY(adminID, vin, confirmNum, timeEdited)
	FOREIGN KEY(adminID) REFERENCES Admin(adminID)
		ON UPDATE CASCADE
		ON DELETE CASCADE
	FOREIGN KEY(vin) REFERENCES Vehicle(vin)
		ON UPDATE CASCADE
		ON DELETE CASCADE
	FOREIGN KEY(confirmNum) REFERENCES Reservation(confirmNum)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

create table EditsVehicle(
	adminID INTEGER,
	vin TEXT,
	timeEdited TEXT,
	PRIMARY KEY(adminID, vin, timeEdited)
	FOREIGN KEY(adminID) REFERENCES Admin(adminID)
		ON UPDATE CASCADE
		ON DELETE CASCADE
	FOREIGN KEY(vin) REFERENCES Vehicle(vin)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

create table UserCreditCard(
	number INTEGER PRIMARY KEY,
	expDate TEXT NOT NULL,
	CVC INTEGER NOT NULL
);

create table UserBalance(
	dLicense TEXT PRIMARY KEY,
	number INTEGER NOT NULL,
	balance REAL NOT NULL,
	FOREIGN KEY(number) REFERENCES UserCreditCard(number)
		ON UPDATE CASCADE
		ON DELETE CASCADE
	FOREIGN KEY(dLicense) REFERENCES User(dLicense)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);
