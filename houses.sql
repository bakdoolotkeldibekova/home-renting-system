use myDB;
CREATE TABLE region (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        region_name VARCHAR(50) NOT NULL
       );
      
INSERT into region (region_name) values
('Чуй'),
('Ош'),
('Ысык-Кол'),
('Нарын'),
('Баткен'),
('Талас'),
('Жалал-Абад');

CREATE TABLE state (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        state_name VARCHAR(50) NOT NULL
       );
      
INSERT into state (state_name) values
('хорошее'),
('среднее'),
('евроремонт'),
('требует ремонта'),
('свободная планировка'),
('черновая отделка'),
('недостроено'),
('под самоотделку (псо)');

CREATE TABLE rental_period (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL
       );
      
INSERT into rental_period (name) values
('по часам'),
('посуточно'),
('помесячно'),
('поквартально'),
('на долгий срок');

CREATE TABLE house (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `title` varchar(255) DEFAULT NULL,
        `date` datetime DEFAULT NULL,
        rental_period_id INT UNSIGNED,
    	land_area VARCHAR(50),
    	number_of_floors INT,
   		number_of_rooms INT,
   		`image` varchar(255) DEFAULT NULL,
   		price DOUBLE,
   		state_id INT UNSIGNED,
        description VARCHAR(500),
        region_id INT UNSIGNED,
        FOREIGN KEY (region_id) REFERENCES region(id),
        FOREIGN KEY (rental_period_id) REFERENCES rental_period(id),
        FOREIGN KEY (state_id) REFERENCES state(id)
       );  
      
INSERT into house (`image`, `title`, `date`, rental_period_id, land_area, number_of_floors, number_of_rooms, price, state_id, region_id, description) values
('https://thumbor.forbes.com/thumbor/fit-in/1200x0/filters%3Aformat%28jpg%29/https%3A%2F%2Fspecials-images.forbesimg.com%2Fimageserve%2F1026205392%2F0x0.jpg', 'Дом, 6 и более комнат, 550 м2', '2020-12-03 00:00:00', 5, '7 соток', 2, 8, 10000, 1, 1, 'Дом с участком 7 сотка,участок озелененный со многолетними саженцами ,а также имеется открытая терраса.Большая гостиная ,отдельная кухня ,обеденная зона ,и 3 спальных комнат+3 сан узла.Благоустроенный обжитый дом.На цокольном этаже своя баня,а также просторная комната для отдыха,которую можно оборудовать по желанию.Парковка на 2 больших машин.Участок огорожен.Сдается для семьи.Дом теплый,чистый с прекрасным расположением.'),
('https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/suburban-house-royalty-free-image-1584972559.jpg', 'Дом, 8 и более комнат, 600 м2', '2020-12-04 00:00:00', 4, '10 соток', 2, 15, 17000, 2, 2, 'Сдается дом в самом прекрасном районе города. Дом на длительный срок. Участок 10сотка . Общая квадратура 350м +летний домик(отапливаемый)75м3. 3 сан узла ,7 комнат . Баня внутри дома, бассейн во дворе. Огород за домом, Парковка под навесом на 3 машины. Участок озелененный предусмотрено все для комфортного проживания в доме. 4 способа отопления. Генератор свой '),
('https://cdn.geekwire.com/wp-content/uploads/2018/05/ISm2ws8xojvwbs1000000000.jpg', 'Дом, 7 и более комнат, 580 м2', '2020-12-04 00:00:00', 3, '8 соток', 2, 10, 13000, 3, 3, 'Сдаю дом на длительный срок. Общая квадратура 500м. Участок 5сотка. 10 Комнат. 5 сан узлов. Дом с ремонтом,обжитый. На участке летняя кухня+тапчан. навес на 2машины. Двор огорожен. 0708-077-577');
      
CREATE TABLE `image` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `house` INT UNSIGNED,
  `image` varchar(255) DEFAULT NULL,
  FOREIGN KEY (house) REFERENCES house(id)
);
      
INSERT INTO `image` (`house`, `image`) VALUES
(1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNP7SZO802fJXBOJTsI5UfAqdu460m2Ts8FA&usqp=CAU'),
(1, 'https://www.thespruce.com/thmb/EvdqR5HNV6Ev9RBv8qGqHNE8DoM=/3636x2045/smart/filters:no_upscale()/how-to-arrange-living-room-furniture-1976578-hero-c99074dcad854b669b91652046a39203.jpg'),
(2, 'https://cf.bstatic.com/images/hotel/max1024x768/236/236639618.jpg'),
(2, 'https://thumbor.forbes.com/thumbor/2000x1009/filters%3Aformat%28jpg%29/https%3A%2F%2Fspecials-images.forbesimg.com%2Fimageserve%2F5cdb058a5218470008b0b00f%2F0x0.jpg%3Ffit%3Dscale'),
(3, 'https://photos.zillowstatic.com/fp/c25e3206645b89374a035996ea1e8a7d-p_h.jpg'),
(3, 'https://assets.blog.hgtv.ca/wp-content/uploads/2020/03/26143737/valuable-rooms-at-home-feature.jpg'),
(3, 'https://www.phocuswire.com/uploadedImages/Articles/News/2020/April/T0406SCPRedmondHotel_HR.jpg?origwidth=800&origheight=400&origmode=crop&Anchor=MiddleCenter&width=600&height=300&scale=both&mode=crop');

CREATE TABLE `user` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
);

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(1, 'user', 'user', 'admin');

CREATE TABLE `application` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `house_id` INT UNSIGNED,
  `phone_number` varchar(255) NOT NULL,
  `name_surname` varchar(255) NOT NULL,
  `descrioption` varchar(255) NOT NULL,
  `date` datetime DEFAULT NULL,
  `deleted` bool,
  FOREIGN KEY (house_id) REFERENCES house(id)
);

INSERT INTO `application` (`house_id`, `phone_number`, `name_surname`, `descrioption`, `date`, `deleted`) VALUES
(1, '+996555959464', 'test name', 'want to rent', '2020-12-04 12:20:00', false);

UPDATE `application`
    SET `deleted` = true
    WHERE `id` = 1;

ALTER TABLE `image`
  ADD KEY `house` (`house`);
