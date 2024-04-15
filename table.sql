create table if not exists user (
  first_name varchar(50) not null,
  last_name varchar(50) not null,
  email varchar(50) primary key,
  password varchar(255) not null,
  image varchar(255)
  );

create table if not exists posts (
  post_id int auto_increment primary key,
  email varchar(255) not null,
  image varchar(255),
  content text not null,
  time datetime not null,
  foreign key (email) references user(email) on delete cascade
);
