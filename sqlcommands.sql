-- make bookdb
create database bookdb default charset utf8;
use bookdb;

-- make tables
create table categories(
  id int auto_increment not null primary key,
  name varchar(255) not null
);

create table authors(
  id int auto_increment not null primary key,
  name varchar(255) not null
);
  
create table tags(
  id int auto_increment not null primary key,
  name varchar(255) not null
);

create table books_tags(
  id int auto_increment not null primary key,
  books_id int not null,
  tags_id int not null
);

create table books(
  id int auto_increment not null primary key,
  isbn bigint(13) unique not null,
  name varchar(255) not null,
  price int not null,
  category_id int not null,
  author_id int not null,
  foreign key (category_id)
    references categories(id),
  foreign key (author_id)
    references authors(id)
);

-- add values
insert into categories (name) values ("プログラミング"), ("デザイン"), ("健康");
insert into authors (name) values ("コーリー・アルソフ"), ("Mana"), ("安倍晋三"), ("ああああ");
insert into tags (name) values ("面白い"), ("python"), ("わかりやすい"), ("独学シリーズ"), ("必須");

-- create user and give authority
create user user identified by 'password';
grant all privileges on bookdb.* to 'user'@'%' identified by 'password';

