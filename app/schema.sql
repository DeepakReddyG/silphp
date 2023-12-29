-- create database phpsil
CREATE DATABASE IF NOT EXISTS phpsil;
USE phpsil;

-- create table users
CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'staff', 'club_head', 'club_member') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

-- create table clubs
CREATE TABLE IF NOT EXISTS clubs (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    category ENUM('TEC', 'LCH', 'ESO', 'IIE', 'HWB'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

-- create table club_members
CREATE TABLE IF NOT EXISTS club_members (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    club_id INT NOT NULL,
    role ENUM('admin', 'staff', 'club_head', 'club_member') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (club_id) REFERENCES clubs(id)
);

-- create table activities
CREATE TABLE IF NOT EXISTS activities (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    club_id INT NOT NULL,
    category ENUM('TEC', 'LCH', 'ESO', 'IIE', 'HWB'),
    student_organizer VARCHAR(255) NOT NULL,
    faculty_incharge VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    venue VARCHAR(255) NOT NULL,
    points INT NOT NULL,
    report TEXT DEFAULT NULL, -- or DEFAULT 'No report available'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (club_id) REFERENCES clubs(id),
    FOREIGN KEY (student_organizer) REFERENCES users(username),
    FOREIGN KEY (faculty_incharge) REFERENCES users(username)
);

-- create table activity_registrations
CREATE TABLE IF NOT EXISTS activity_registrations (
    id INT NOT NULL AUTO_INCREMENT,
    activity_id INT NOT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (activity_id) REFERENCES activities(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
