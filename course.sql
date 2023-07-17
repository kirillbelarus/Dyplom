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
		
insert into Catalog_Museum values(1,'Национальный художественный','г.Минск,ул. Ленина, 20','+ 375 163 421524, + 375 163 421100','kgirel@yandex.by','16:45-18:12','./images/99.jpg',1);
insert into Catalog_Museum values(2,'Национальный исторический','г.Минск,ул. Интернациональная ул., 33А','+ 375 163 421524, + 375 163 421100','kgirel@yandex.by','16:45-18:12','./images/56.jpg',2);
insert into Catalog_Museum values(3,'Дом Ваньковичей','г.Минск,ул. Интернациональная ул., 33А','+ 375 163 421524, + 375 163 421100','kgirel@yandex.by','16:45-18:12','./images/vank.jpg',3);
insert into Catalog_Museum values(4,'Янка Купала','г.Минск,ул. Янки Купалы, 4','+ 375 163 421524, + 375 163 421100','yanka@yandex.by','16:45-18:12','./images/Yanka.jpg',1);

insert into Afisha values(1,1,1,'Лялькі-берагіні','выставка','2023-06-11','2023-06-12','./images/hist_7.jpg',5,'художественная');
insert into Afisha values(2,2,2,'От негатива до позитива','выставка','2023-06-11','2023-07-31','./images./hist_1.jpg',15,'историческая');
insert into Afisha values(3,3,3,'Сны о прошлом','выставка','2023-06-11','2023-08-31','./images./vank_1.jpg',35,'книжная');
insert into Afisha values(4,3,3,'Рождество у ваньковичей','выставка','2023-11-11','2024-01-10','./images./vank_2.jpg',23,'тематическая');
insert into Afisha values(5,1,3,'опен шаф','выставка','2023-11-11','2023-12-29','./images./5.jpg',5,'детям');
insert into Afisha values(6,2,2,'Гид по истории и культуры','выставка','2023-06-11','2023-07-31','./images./hist_2.jpg',0,'историческая');
insert into Afisha values(7,1,1,'вандровка','лекция','2023-11-11','2023-11-29','./images./hist_9.jpg',0,'художественная');
insert into Afisha values(8,1,1,'братство среди друзей','лекция','2023-11-11','2023-12-31','./images./8.jpg',123,'художественная');
insert into Afisha values(9,1,1,'никто не разлучит','лекция','2023-09-11','2024-01-31','./images./9.jpg',9,'художественная');
insert into Afisha values(10,2,2,'Стань донором','выставка','2023-04-11','2024-07-31','./images./hist_3.jpg',0,'персональная');
insert into Afisha values(11,2,2,'Нельзя забыть','выставка','2023-06-18','2024-09-12','./images./hist_4.jpg',10,'историческая');
insert into Afisha values(12,2,2,'Тайны белорусской письменности','лекция','2023-05-18','2024-08-12','./images./hist_5.jpg',15,'историческая');
insert into Afisha values(13,2,2,'Беларусь от истоков по XVIII ст.','лекция','2023-07-18','2024-08-12','./images./hist_6.jpg',15,'этнографическая');
insert into Afisha values(14,1,1,'Авторские куклы мишки Тедди','выставка','2023-05-11','2023-06-12','./images/art_1.jpg',5,'тематическая');
insert into Afisha values(15,1,1,'Художники Минщины: персоны','выставка','2023-05-11','2023-06-12','./images/art_2.jpg',5,'тематическая');
insert into Afisha values(16,1,1,'Время выбрало за них','лекция','2023-05-11','2023-06-12','./images/art_3.jpg',5,'детям');
insert into Afisha values(17,1,1,'Диалог с космосом','лекция','2023-05-11','2023-06-31','./images/art_4.jpg',7,'тематическая');
insert into Afisha values(18,3,3,'Масленица у ваньковичей','выставка','2023-11-11','2024-01-10','./images./vank_3.jpg',23,'детям');
insert into Afisha values(19,2,2,'Цэрни крэсау','выставка','2023-06-18','2023-07-11','./images./hist_8.jpg',10,'историческая');
insert into Afisha values(20,3,3,'Калядки у ваньковичей','выставка','2023-11-11','2024-01-10','./images./vank_4.jpg',0,'этнографическая');
insert into Afisha values(21,3,3,'Агинский-250','выставка','2023-04-11','2023-07-10','./images./vank_5.jpg',0,'тематическая');
insert into Afisha values(22,3,3,'Камерный партрет','лекция','2023-04-11','2023-07-10','./images./vank_6.jpg',8,'фотография');
insert into Afisha values(23,4,3,'Я несу вам дар','выставка','2023-04-11','2023-07-10','./images./yank_1.jpg',8,'художественная');
insert into Afisha values(24,4,3,'Жизнь и смерть Янки Купалы','лекция','2023-04-11','2023-07-10','./images./yank_2.jpg',9,'историческая');



insert into Users values(1,'kgirel@yandex.by','kirill1991','xede');
insert into Users values(2,'girelkirill@yandex.by','kirill1992','xede');
insert into Users values(3,'kotjmot@yandex.by','kirill1993','xede');

insert into Bron values(1,1,1,1,'2022-11-11','16:45',5,"да");
insert into Bron values(2,3,2,6,'2023-11-11','16:45',1,"нет");
insert into Bron values(3,3,3,4,'2022-12-11','16:45',2,"да");

insert into Request values(1,1,'1194788@mtp.by','kirill1992','балетный','golodeda,10','+375333333333','dasdad','13:00-18:00','2023-01-31');

insert into Comments values(1,2,2,'Мы ставим на каждый Новый год только естественную ёлку. Почему? Выгоднее же приобрести один раз искусственную и больше не мучиться с поиском натуральной перед праздником. Также сравню ель-2023 с предыдущими нашими ёлками.',4);
insert into Comments values(2,2,2,'Мы ставим на каждый Новый год только естественную ёлку. Почему? Выгоднее же приобрести один раз искусственную и больше не мучиться с поиском натуральной перед праздником. Также сравню ель-2023 с предыдущими нашими ёлками.',4);
insert into Comments values(3,2,1,'Мы ставим на каждый Новый год только естественную ёлку. Почему? Выгоднее же приобрести один раз искусственную и больше не мучиться с поиском натуральной перед праздником. Также сравню ель-2023 с предыдущими нашими ёлками.',4);
insert into Comments values(4,3,3,'Мы ставим на каждый Новый год только естественную ёлку. Почему? Выгоднее же приобрести один раз искусственную и больше не мучиться с поиском натуральной перед праздником. Также сравню ель-2023 с предыдущими нашими ёлками.',4);
insert into Comments values(5,2,2,'Мы ставим на каждый Новый год только естественную ёлку. Почему? Выгоднее же приобрести один раз искусственную и больше не мучиться с поиском натуральной перед праздником. Также сравню ель-2023 с предыдущими нашими ёлками.',4);
                 