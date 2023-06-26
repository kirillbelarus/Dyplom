drop database course;
create database course;
use course;

create table Organiz(
	id_org int auto_increment primary key,
    fio_org varchar(15),
    tel int,
    e_mail varchar(20),
    password_org varchar(20)
);

create table Catalog_Museum(
	id_museum int auto_increment primary key,
    name_museum varchar(80),
    adress varchar(100),
    tel varchar(80),
    e_mail varchar(20),
    time_work varchar(20),
    photo varchar(80),
    id_org int,
    
    foreign key (id_org) references Organiz(id_org)
);

create table Afisha(
	num_afish int auto_increment primary key,
    id_museum int,
	id_org int,
	name_afish varchar(80),
    type_event varchar(20),
    data_start date,
    data_end date,
	photo varchar(100),
    cost_ticket int,
    genre_afisha varchar(40),
    foreign key (id_museum) references Catalog_Museum(id_museum) on delete cascade,
    foreign key (id_org) references Organiz(id_org) on delete cascade
);
	
create table Users(
	id_user int auto_increment primary key,
    e_mail varchar(20),
    login_user varchar(20),
    password_user varchar(20)
);

create table Bron(
	id_bron int auto_increment primary key,
	id_museum int,
    id_user int,
    num_afish int,
    data_visit date,
    time_visit varchar(20),
    kol_chel int,
    gid varchar(3),
    
    foreign key (id_museum) references Catalog_Museum(id_museum) on delete cascade,
    foreign key (id_user) references Users(id_user) on delete cascade,
    foreign key (num_afish) references Afisha(num_afish) on delete cascade
);
create table Request(
	id_request int auto_increment primary key,
    id_user int,
    e_mail varchar(20),
    login_user varchar(20),
    name_museum varchar(80),
    adress varchar(50),
    tel varchar(40),
    password_user varchar(20),
    time_work varchar(20),
    date_submission date,
    
    foreign key (id_user) references Users(id_user) on delete cascade
);
create table Comments(
	id_comment int primary key auto_increment,
	id_user int,
    num_afish int,
    comment_text varchar(1000),
    rating int,
    foreign key (id_user) references Users(id_user) on delete cascade,
    foreign key (num_afish) references Afisha(num_afish) on delete cascade
);
insert into Organiz values(1,'Girel',12131,'kotjmot@yandex.by','dfhsjfh');
insert into Organiz values(2,'Ivan',21131,'zkrokaz@yandex.ru','dfhsjfh');
insert into Organiz values(3,'Lesha',952131,'kartoshka@yandex.by','dfhsjfh');
		
insert into Catalog_Museum values(4,'Национальный художественный','ул. Ленина, 20','+ 375 163 421524, + 375 163 421100','kgirel@yandex.by','16:45-18:12','./images/99.jpg',1);
insert into Catalog_Museum values(2,'Национальный исторический','ул. Интернациональная ул., 33А','+ 375 163 421524, + 375 163 421100','kgirel@yandex.by','16:45-18:12','./images/56.jpg',2);
insert into Catalog_Museum values(3,'Дом Ваньковичей','ул. Интернациональная ул., 33А','+ 375 163 421524, + 375 163 421100','kgirel@yandex.by','16:45-18:12','./images/vank.jpg',3);
insert into Catalog_Museum values(1,'Янка Купала','ул. Янки Купалы, 4','+ 375 163 421524, + 375 163 421100','yanka@yandex.by','16:45-18:12','./images/Yanka.jpg',1);

insert into Afisha values(1,1,1,'ждите нас, звезды!','выставка','2023-11-11','2023-12-31','./images/1.jpg',5,'художественная');
insert into Afisha values(2,2,2,'секреты нового года','лекция','2023-11-11','2023-12-31','./images./2.jpg',15,'этнографическая');
insert into Afisha values(3,3,3,'kalilaska','выставка','2023-11-11','2023-12-31','./images./3.jpg',35,'книжная');
insert into Afisha values(4,3,3,'вечер чудес','выставка','2023-11-11','2023-12-31','./images./4.jpg',23,'книжная');
insert into Afisha values(5,1,3,'опен шаф','выставка','2023-11-11','2023-12-29','./images./5.jpg',5,'детям');
insert into Afisha values(6,2,3,'духовой квинтет','выставка','2023-11-11','2023-12-31','./images./6.jpg',0,'этнографическая');
insert into Afisha values(7,1,1,'вандровка','лекция','2023-11-11','2023-11-29','./images./7.jpg',0,'художественная');
insert into Afisha values(8,1,1,'братство среди друзей','лекция','2023-11-11','2023-12-31','./images./8.jpg',123,'художественная');
insert into Afisha values(9,1,1,'никто не разлучит','лекция','2023-09-11','2024-01-31','./images./9.jpg',9,'художественная');

insert into Users values(1,'kgirel@yandec.by','kirill1991','xede');
insert into Users values(2,'girelkirill@yandex.by','kirill1992','xede');
insert into Users values(3,'kotjmot@yandex.by','kirill1993','xede');

insert into Bron values(1,1,1,1,'2022-11-11','16:45',5,"да");
insert into Bron values(2,3,2,6,'2023-11-11','16:45',1,"нет");
insert into Bron values(3,3,3,4,'2022-12-11','16:45',2,"да");

insert into Request values(1,1,'kgirel@yandec.by@yandex.by','kirill1991','балетный','golodeda,10','+375333333333','dasdad','13:00-18:00','2023-01-31');

insert into Comments values(1,2,2,'Мы ставим на каждый Новый год только естественную ёлку. Почему? Выгоднее же приобрести один раз искусственную и больше не мучиться с поиском натуральной перед праздником. Также сравню ель-2023 с предыдущими нашими ёлками.',4);
insert into Comments values(2,2,2,'Мы ставим на каждый Новый год только естественную ёлку. Почему? Выгоднее же приобрести один раз искусственную и больше не мучиться с поиском натуральной перед праздником. Также сравню ель-2023 с предыдущими нашими ёлками.',4);
insert into Comments values(3,2,1,'Мы ставим на каждый Новый год только естественную ёлку. Почему? Выгоднее же приобрести один раз искусственную и больше не мучиться с поиском натуральной перед праздником. Также сравню ель-2023 с предыдущими нашими ёлками.',4);
insert into Comments values(4,3,3,'Мы ставим на каждый Новый год только естественную ёлку. Почему? Выгоднее же приобрести один раз искусственную и больше не мучиться с поиском натуральной перед праздником. Также сравню ель-2023 с предыдущими нашими ёлками.',4);
insert into Comments values(5,2,2,'Мы ставим на каждый Новый год только естественную ёлку. Почему? Выгоднее же приобрести один раз искусственную и больше не мучиться с поиском натуральной перед праздником. Также сравню ель-2023 с предыдущими нашими ёлками.',4);


SELECT Afisha.num_afish as num_afish,Afisha.name_afish as name_afish,Afisha.data_start as data_start,
                    Afisha.data_end as data_end,Afisha.photo as photo,Afisha.cost_ticket as cost_ticket, Catalog_Museum.id_museum as id_museum from Afisha  inner join Catalog_Museum on Afisha.id_museum = Catalog_Museum.id_museum where num_afish = 1;
                    
SELECT count(id_bron) FROM Bron;                   