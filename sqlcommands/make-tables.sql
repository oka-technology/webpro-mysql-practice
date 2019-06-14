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
  isbn int(13) not null,
  name varchar(255) not null,
  price int not null,
  category_id int not null,
  author_id int not null,
  foreign key (category_id)
    references categories(id),
  foreign key (author_id)
    references authors(id)
);
