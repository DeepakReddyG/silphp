-- create database phpsil

create database phpsil;
use phpsil;

create table activities (
    id int not null auto_increment,
    name varchar(255) not null,
    clubname varchar(255) not null,
    category varchar(255) not null,
    organized_on date not null,
    student_organizer_id BIGINT not null,
    student_organizer_name varchar(255) not null,
    venue varchar(255) not null,
    time_slot varchar(255) not null,
    points int not null,
    primary key (id)
);

CREATE TABLE participants (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    name VARCHAR(255) NOT NULL,
    event_name VARCHAR(255) NOT NULL,
    club_name VARCHAR(255) NOT NULL,
    category VARCHAR(255) NOT NULL,
    date_of_participation DATE NOT NULL,
    venue VARCHAR(255) NOT NULL,
    time_slot VARCHAR(255) NOT NULL,
    points INT NOT NULL,
    PRIMARY KEY (id)
);


create table grievances (
    id int not null auto_increment,
    username BIGINT not null,
    issue_type enum ('attendance', 'points', 'disciplie', 'others') not null,
    description TEXT not null,
    primary key (id)
);