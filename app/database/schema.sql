-- Create the database if not exists
CREATE DATABASE IF NOT EXISTS `silphp` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Use the created database
USE `silphp`;

-- Create the users table
CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    user_type ENUM('Student', 'Admin') NOT NULL DEFAULT 'Student',
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    session_status ENUM('Active', 'Inactive') NOT NULL,
    PRIMARY KEY (id)
);

-- Create the user_profile table
CREATE TABLE user_profile (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    profile_picture VARCHAR(255) NOT NULL DEFAULT 'NA',
    gender ENUM('Male', 'Female', 'NA') NOT NULL DEFAULT 'NA',
    residence_type ENUM('University Hostel', 'Day Scholar', 'NA') NOT NULL DEFAULT 'NA',
    personal_email VARCHAR(255) NOT NULL DEFAULT 'NA',
    phone_number VARCHAR(255) NOT NULL DEFAULT 'NA',
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Set a different delimiter
DELIMITER //

-- Trigger to insert default data into user_profile when a new user is added
CREATE TRIGGER after_insert_user
AFTER INSERT ON users
FOR EACH ROW
BEGIN
    INSERT INTO user_profile (user_id, profile_picture, gender, residence_type, personal_email, phone_number)
    VALUES (NEW.id, 'NA', 'NA', 'NA', 'NA', 'NA');
END //

-- Reset the delimiter to semicolon
DELIMITER ;




-- Create the user_academic_profile table
CREATE TABLE user_academic_profile (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    year_of_study ENUM('1', 'NA') NOT NULL DEFAULT 'NA',
    department VARCHAR(255) NOT NULL,
    cluster INT NOT NULL,
    sil_section INT NOT NULL,
    CGPA FLOAT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Set a different delimiter
DELIMITER //

-- Trigger to insert default data into user_academic_profile when a new user is added
CREATE TRIGGER after_insert_user_academic
AFTER INSERT ON users
FOR EACH ROW
BEGIN
    INSERT INTO user_academic_profile (user_id, year_of_study, department, cluster, sil_section, CGPA)
    VALUES (NEW.id, 'NA', 'Not Specified', 0, 0, 0.0);
END //

-- Reset the delimiter to semicolon
DELIMITER ;



-- create table social internship
create table social_internship_registration (
    id int not null auto_increment,
    user_id int not null,
    internship_domain varchar(255) not null,
    internship_registration_approval_status enum('Approved', 'Pending', 'Rejected') not null default 'Pending',
    created_at timestamp not null default current_timestamp,
    primary key (id),
    foreign key (user_id) references users(id)
);

create table social_internship_attendance (
    id int not null auto_increment,
    user_id int not null,
    day_one_attendance_status enum('Present', 'Absent', 'Pending') not null default 'Pending',
    day_two_attendance_status enum('Present', 'Absent', 'Pending') not null default 'Pending',
    day_three_attendance_status enum('Present', 'Absent', 'Pending') not null default 'Pending',
    day_four_attendance_status enum('Present', 'Absent', 'Pending') not null default 'Pending',
    day_five_attendance_status enum('Present', 'Absent', 'Pending') not null default 'Pending',
    day_six_attendance_status enum('Present', 'Absent', 'Pending') not null default 'Pending',
    day_seven_attendance_status enum('Present', 'Absent', 'Pending') not null default 'Pending',
    day_eight_attendance_status enum('Present', 'Absent', 'Pending') not null default 'Pending',
    day_nine_attendance_status enum('Present', 'Absent', 'Pending') not null default 'Pending',
    day_ten_attendance_status enum('Present', 'Absent', 'Pending') not null default 'Pending',
    primary key (id),
    foreign key (user_id) references users(id)
);



