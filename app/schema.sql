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



-- implementation for social internship

create table social_internship_users (
    id int not null auto_increment,
    username varchar(50) not null,
    name varchar(255) not null,
    gender enum('Male', 'Female') not null,
    year int not null,
    branch varchar(255) not null,
    email varchar(255) not null,
    internship_domain varchar(255) not null,
    primary key (id)
);


DELIMITER //
CREATE TRIGGER after_insert_social_internship_users
AFTER INSERT ON social_internship_users
FOR EACH ROW
BEGIN

    INSERT INTO social_internship_attendance (username, day_1, day_2, day_3, day_4, day_5, day_6, day_7, day_8, day_9, domain)
    VALUES (NEW.username, 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', NEW.internship_domain);
END;
//
DELIMITER ;



create table social_internship_attendance (
    id int not null auto_increment,
    username varchar(50) not null,
    day_1 enum('Present', 'Absent', 'NA') not null,
    day_2 enum('Present', 'Absent', 'NA') not null,
    day_3 enum('Present', 'Absent', 'NA') not null,
    day_4 enum('Present', 'Absent', 'NA') not null,
    day_5 enum('Present', 'Absent', 'NA') not null,
    day_6 enum('Present', 'Absent', 'NA') not null,
    day_7 enum('Present', 'Absent', 'NA') not null,
    day_8 enum('Present', 'Absent', 'NA') not null,
    day_9 enum('Present', 'Absent', 'NA') not null,
    domain varchar(255) not null,
    primary key (id)
);



-- Sample INSERT statement for social_internship_users
INSERT INTO social_internship_users (username, name, gender, year, branch, email, internship_domain)
VALUES ('2300012345', 'John Doe', 'Male', 2, 'Engineering', 'john.doe@example.com', 'Software Development');

-- Trigger will automatically insert default attendance for the new user
