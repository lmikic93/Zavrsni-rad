drop database if exists evidencijasvirki;
create database evidencijasvirki character set utf8 collate utf8_general_ci;
# c:\xampp\mysql\bin\mysql -uedunova -pedunova --default_character_set=utf8 < d:\php\zavrsni\evidencijasvirki.sql
use evidencijasvirki;

create table bend (
	sifra 			int not null primary key auto_increment,
	naziv 			varchar(50) not null,
	korisnickoime 	varchar(50) not null,
	lozinka 		varchar(50) not null
);

create table clan (
	sifra 			int not null primary key auto_increment,
	ime 			varchar(50) not null,
	prezime 		varchar(50) not null,
	email			varchar(100) not null,
	bend			int not null
);

create table nastup (
	sifra 			int not null primary key auto_increment,
	vrstasvirke 	int not null,
	datumpocetka 	datetime,
	cijena			decimal(18,2) not null,
	adresa			varchar(100) not null,
	bend			int not null
);

create table vrstasvirke (
	sifra			int not null primary key auto_increment,
	svatovi			varchar(100) not null,
	pratnja			varchar(100) not null,
	rodendan		varchar(100) not null,
	javno			varchar(100) not null,
	caffebar		varchar(100) not null,
	ostalo			varchar(100) not null
);

create table clan_nastup (
	clan 			int not null,
	nastup 			int not null,
	zarada			decimal(18,2) not null
);


alter table clan add foreign key (bend) references bend(sifra);

alter table nastup add foreign key (bend) references bend(sifra);
alter table nastup add foreign key (vrstasvirke) references vrstasvirke(sifra);

alter table clan_nastup add foreign key (clan) references clan(sifra);
alter table clan_nastup add foreign key (nastup) references nastup(sifra);