create schema GetURI;
use GetURI;

create table Institution(
	id int not null auto_increment primary key,
	name varchar(45) not null);

create table SClass(
	id int not null auto_increment primary key,
	name varchar(45) not null,
    idInst int not null references Institution(id));

create table Student(
	id int not null primary key,
	name varchar(45) not null,
	place int not null,
	since date not null,
	points float not null,
	tried int not null,
	submission int not null,
	idInstitution int not null references Institution(id));

create table Student_has_SClass(
	idStudent int not null references Student(id),
	idSClass int not null references SClass(id));

create table atualizacoes(
	idStudent int not null references Student(id),
    place int not null,
    data_att date not null);
    