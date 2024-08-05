Create database YouTube
default character set utf8
default collate utf8_general_ci;

use youtube;

create table usuarios(

id serial primary key,
nome varchar(255) not null,
email varchar(255) not null unique,
senha varchar(255) not null,
data_criacao timestamp default current_timestamp,
imagem_perfil varchar(255),
canal_id int references canal(id)

)default charset = utf8;

create table canal(

id serial primary key,
nome varchar(255) not null,
descricao text,
data_criacao timestamp default current_timestamp,
usuario_id int references usuarios(id),
imagem_banner varchar(255),
total_inscritos int default 0

)default charset = utf8;

create table video(

id serial primary key,
titulo varchar(255) not null,
descricao text,
data_upload timestamp default current_timestamp,
url varchar(255) not null,
miniatura_url varchar(255),
canal_id int references canal(id),
visualizacoes int default 0,
likes int default 0,
dislike int default 0,
duracao time,
categoria_id int references categoria(id)

)default charset = utf8;

create table categoria(

id serial primary key,
nome varchar(255) not null

)default charset = utf8;

create table comentarios(

id serial primary key,
conteudo text not null,
data_criacao timestamp default current_timestamp,
usuarios_id int references usuarios(id),
video_id int references video(id)

)default charset = utf8;


create table subscritos(

id serial primary key,
usuarios_id int references usuarios(id),
canal_id int references canal(id),
data_inscricao timestamp default current_timestamp

)default charset = utf8;

create table playlist(

id serial primary key,
nome varchar(255) not null,
descricao text,
data_criacao timestamp default current_timestamp,
usuarios_id int references usuarios(id)

)default charset = utf8;