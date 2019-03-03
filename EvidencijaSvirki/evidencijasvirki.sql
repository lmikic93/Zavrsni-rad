

create table bend (
	sifra 			int not null primary key auto_increment,
	naziv 			varchar(50) not null,
	korisnickoime 	varchar(50) not null,
	lozinka 		varchar(50) not null,
	email 			varchar(100) not null
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

insert into bend (sifra,naziv,korisnickoime,lozinka,email) values
(null,'Bend 01','bend01','12345','bend01@gmail.com'),
(null,'Bend 02','bend02','12345','bend02@gmail.com'),
(null,'Bend 03','bend03','12345','bend03@gmail.com'),
(null,'Bend 04','bend04','12345','bend04@gmail.com'),
(null,'Bend 05','bend05','12345','bend05@gmail.com');

create table operater(
	sifra int not null primary key auto_increment,
	ime varchar(50) not null,
	prezime varchar(50) not null,
	email varchar(100) not null,
	lozinka char(60) not null
);

insert into operater (ime,prezime,email,lozinka) values
(
	'Leon',
	'Mikić',
	'leon.mikic93@gmail.com',
	'$2y$10$0oeK5JKlHslw1ksWLcimZOV2ggnEh5vltZq3ckemw4eIH79GYpTwi'

);
