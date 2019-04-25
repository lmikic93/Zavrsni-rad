

create table bend (
	sifra 			int not null primary key auto_increment,
	naziv 			varchar(50) not null,
	korisnickoime 	varchar(50) not null,
	lozinka 		varchar(50) not null,
	email 			varchar(100) not null
);

create table svirac (
	sifra 			int not null primary key auto_increment,
	ime 			varchar(50) not null,
	prezime 		varchar(50) not null,
	email			varchar(100) not null,
	bend			int not null
);

create table nastup (
	sifra 			int not null primary key auto_increment,
	datumpocetka 	datetime,
	cijena			decimal(18,2) not null,
	adresa			varchar(100) not null,
	vrstasvirke		varchar(100) not null,
	bend			int not null
);




alter table svirac add foreign key (bend) references bend(sifra);

alter table nastup add foreign key (bend) references bend(sifra);


insert into bend (sifra,naziv,korisnickoime,lozinka,email) values
(null,'Bend 01','bend01','12345','bend01@gmail.com'),
(null,'Bend 02','bend02','12345','bend02@gmail.com'),
(null,'Bend 03','bend03','12345','bend03@gmail.com'),
(null,'Bend 04','bend04','12345','bend04@gmail.com'),
(null,'Bend 05','bend05','12345','bend05@gmail.com');

insert into svirac (sifra,ime,prezime,email,bend) values
(null,'Ivan','Ivic','ivan@gmail.com', 1),
(null,'Marko','Maric','marko@gmail.com', 2),
(null,'Josip','Josipovic','josip@gmail', 3),
(null,'Luka','Lukic','luka@gmail.com', 4),
(null,'Gabriel','Lustig','gabriel@gmail.com', 5);

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
