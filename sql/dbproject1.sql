create database project1;
use project1;
create table admins(
id int primary key auto_increment,
name varchar(30) not null,
email varchar(255) not null unique,
password varchar(50) not null
);
create table customers(
id int primary key auto_increment,
name varchar(30) not null,
email varchar(255) not null unique,
password varchar(50) not null,
phone varchar(10) ,
address varchar(200)
);
create table products (
id int primary key auto_increment, 
product_code varchar(20),
name varchar(100), 
price int,
themes varchar(50),
description varchar(500),
image varchar(1000)
);
-- 0: chua duyet, 1: da duyet, -1: da huy, 2: thanh cong 
create table orders (
id int primary key auto_increment,
customer_id int,
admin_id int,
total_price int,
order_date date,
status tinyint,
foreign key (customer_id) references customers(id), 
foreign key (admin_id) references admins(id)
);
create table order_details(
id int primary key auto_increment, 
order_id int, 
product_id int,
 price int,
quantity int,
foreign key (order_id) references orders (id),
 foreign key (product_id) references products(id)
);
select * from products where themes='dreamzzz';
SELECT COUNT(*) AS total_count
FROM products
WHERE themes = 'ninjago';


-- tạo đăng nhập với bên admin

CREATE TABLE user_admin(
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	email VARCHAR(50) NOT NULL,
	user_name VARCHAR(50) NOT NULL,
	pass_word VARCHAR(100) NOT NULL,
	status TINYINT(4),
	created_time INT(11)
);
-- data of product 
INSERT INTO `products` (`id`, `product_code`, `name`, `price`, `themes`, `description`, `image`) VALUES 
(1,"43249","Stitch",60,"disney","","https://www.lego.com/cdn/cs/set/assets/bltde91ef1db83222dd/43249.png?format=webply&fit=bounds&quality=70&width=800&height=800&dpr=1.5"
),
(12,"10330","McLaren MP4/4 & Ayrton Senna",70,"technic","","https://www.lego.com/cdn/cs/set/assets/bltf8476f68fa47b137/10330.png?format=webply&fit=bounds&quality=70&width=800&height=800&dpr=1.5"
),
(13,"71812","Kai's Ninja Climber Mech",60,"ninjago","","https://www.lego.com/cdn/cs/set/assets/bltde3762f748d25c73/71812.png?format=webply&fit=bounds&quality=70&width=800&height=800&dpr=1.5"
),
(21,"71484","Cooper's Robot Dinosaur C-Rex",70,"dreamzzz","A cool LEGO® DREAMZzz™ dinosaur robot toy","https://www.lego.com/cdn/cs/set/assets/blt27b357d47e7b13c0/71484.png?format=webply&fit=bounds&quality=70&width=800&height=800&dpr=1.5"
),
(31,"71813","Wolf Mask Shadow Dojo",105,"ninjago","qqwww","../../public/upload/71813.png"
),
(33,"42639","Andrea's Modern Mansion",170,"friends","hello","../../public/upload/42639_alt1.webp"
),
(34,"71818","Tournament Battle Arena",50,"ninjago","fhefqoif","../../public/upload/71818.webp"
),
(35,"71485","Mateo and Z-Blob the Knight Battle Mech",115,"dreamzzz","A LEGO® DREAMZzz™ mech toy to fuel creativity
","");

