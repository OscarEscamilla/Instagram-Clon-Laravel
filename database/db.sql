CREATE DATABASE IF NOT EXISTS instagram;
USE instagram;


CREATE TABLE IF NOT EXISTS users(
    id              int(255) not null auto_increment,
    rol             varchar(20),
    name            varchar(100),
    surname         varchar(200),
    nick            varchar(100),
    email           varchar(255),
    password        varchar(255),
    image           varchar(255),
    created_at      datetime,
    updated_at      datetime,
    remember_token  varchar(255),
    CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InoDb;



CREATE TABLE IF NOT EXISTS images(
    id int(255) auto_increment not null,
    user_id int(255),
    image_path varchar(255),
    description text,
    created_at datetime,
    updated_at datetime,
    CONSTRAINT pk_images PRIMARY KEY(id),
    CONSTRAINT fk_images_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InoDb;




CREATE TABLE IF NOT EXISTS comments(
    id int(255) auto_increment not null,
    user_id int(255),
    image_id int(255),
    content text,
    created_at datetime,
    updated_at datetime,
    CONSTRAINT pk_comments PRIMARY KEY(id),
    CONSTRAINT fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_comments_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InoDb; 



CREATE TABLE IF NOT EXISTS likes(
    id int(255) auto_increment not null,
    user_id int(255),
    image_id int(255),
    created_at datetime,
    updated_at datetime,
    CONSTRAINT pk_likes PRIMARY KEY(id),
    CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_likes_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InoDb;


INSERT INTO users VALUES(null,'user','oscar','escamilla','oscar3scamilla','oscar@oscar.com','password',null, curtime(), curtime(), null);
INSERT INTO users VALUES(null,'user','manuel','morales','manuelito','manuel@manuel.com','password',null, curtime(), curtime(), null);
INSERT INTO users VALUES(null,'user','esteban','islas','steph','esteban@esteban.com','password',null, curtime(), curtime(), null);


INSERT INTO images VALUES (null, 1, 'caballo1.jpg', 'caballo pura sangre',curtime(), curtime());
INSERT INTO images VALUES (null, 2, 'horse.jpg', 'caballo cuarto de milla cafe',curtime(), curtime());
INSERT INTO images VALUES (null, 3, ' node.png', 'entorno de ejecucion',curtime(), curtime());

SELECT images.image_path, users.name FROM images INNER JOIN users ON images.user_id = users.id;


INSERT comments VALUES (null,1,2,'un caballo muy bonito',curtime(), curtime());
INSERT comments VALUES (null,2,3,'programar en nodejs es lo mejor',curtime(), curtime());
INSERT comments VALUES (null,3,1,'un caballo muy bonito',curtime(), curtime());


INSERT INTO likes VALUES(null,1,3,curtime(),curtime());
INSERT INTO likes VALUES(null,1,2,curtime(),curtime());
INSERT INTO likes VALUES(null,2,1,curtime(),curtime());
INSERT INTO likes VALUES(null,2,3,curtime(),curtime());
INSERT INTO likes VALUES(null,3,2,curtime(),curtime());
INSERT INTO likes VALUES(null,3,1,curtime(),curtime());




SELECT images.image_path,  users.name 
FROM images RIGHT JOIN likes
ON images.id = likes.image_id
RIGHT JOIN users ON users.id = likes.user_id;
