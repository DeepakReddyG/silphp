-- create database phpsil

create database phpsil;
use phpsil;

create table activities (
    id int not null auto_increment,
    name varchar(255) not null,
    clubname varchar(255) not null,
    poster varchar(255) not null,
    category varchar(255) not null,
    organized_on date not null,
    venue varchar(255) not null,
    time_slot varchar(255) not null,
    points int not null,
    primary key (id)
);

create table participants (
    id int not null auto_increment,
    username varchar(50) not null,
    name varchar(255) not null,
    event_name varchar(255) not null,
    club_name varchar(255) not null,
    category varchar(255) not null,
    date_of_participation date not null,
    venue varchar(255) not null,
    time_slot varchar(255) not null,
    points int not null,
    primary key (id)
);

create table grievances (
    id int not null auto_increment,
    username BIGINT not null,
    issue_type enum ('attendance', 'points', 'disciplie', 'others') not null,
    description TEXT not null,
    primary key (id)
);
