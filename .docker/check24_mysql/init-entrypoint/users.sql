create table users
(
    id   int auto_increment
        primary key,
    name varchar(255) null,
    constraint id
        unique (id)
);

