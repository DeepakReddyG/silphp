-- create database phpsil
CREATE DATABASE IF NOT EXISTS phpsil;
USE phpsil;

CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'staff', 'club_head', 'club_member') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active', -- Added 'status' column
    PRIMARY KEY (id),
    UNIQUE (username)
);


-- create table clubs
CREATE TABLE IF NOT EXISTS clubs (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
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

-- create a table for users log
CREATE TABLE IF NOT EXISTS users_log (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    year enum('1', '2', '3', '4', '5') NOT NULL,
    branch enum('CSE', 'AIDS', 'CSI','ECE', 'EEE', 'ME', 'Civil', 'Others') NOT NULL,
    club_name int NOT NULL,
    purpose TEXT NOT NULL,
    date DATE NOT NULL,
    in_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    out_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (club_name) REFERENCES clubs(id)
);