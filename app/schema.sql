-- create database phpsil
CREATE DATABASE IF NOT EXISTS phpsil;
USE phpsil;

CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'staff', 'club_head', 'club_member', 'recruiter') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active',
    club_id INT NULL, 
    PRIMARY KEY (id),
    UNIQUE (username)
);

CREATE TABLE IF NOT EXISTS clubs (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    club_head INT NOT NULL, -- Assuming club_head is referencing the id of users
    category ENUM('TEC', 'LCH', 'ESO', 'IIE', 'HWB'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (club_head) REFERENCES users(username)
);

CREATE TABLE IF NOT EXISTS member_recruitments (
    id INT NOT NULL AUTO_INCREMENT,
    club_id INT NOT NULL,
    candidate_id BIGINT NOT NULL,
    candidate_name VARCHAR(255) NOT NULL,
    candidate_year ENUM('1', '2', '3', '4', '5') NOT NULL,
    candidate_branch ENUM('CSE-H', 'CSE-R', 'AIDS', 'CSIT','ECE', 'EEE', 'ME', 'Civil', 'Others') NOT NULL,
    q1 INT NOT NULL,
    q2 INT NOT NULL,
    q3 INT NOT NULL,
    q4 INT NOT NULL,
    q5 INT NOT NULL,
    remarks TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (club_id) REFERENCES clubs(id)
);

CREATE TABLE IF NOT EXISTS activities (
    id INT NOT NULL AUTO_INCREMENT,
    club_id INT NOT NULL,
    activity_name VARCHAR(255) NOT NULL,
    activity_date DATE NOT NULL,
    activity_time TIME NOT NULL,
    activity_venue VARCHAR(255) NOT NULL,
    category ENUM('TEC', 'LCH', 'ESO', 'IIE', 'HWB'),
    student_coordinator VARCHAR(255) NOT NULL,
    faculty_coordinator VARCHAR(255) NOT NULL,
    report_link VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);
