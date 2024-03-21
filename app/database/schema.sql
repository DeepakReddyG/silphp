CREATE DATABASE IF NOT EXISTS `silphp` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

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

DELIMITER //
CREATE TRIGGER after_insert_user_academic
AFTER INSERT ON users
FOR EACH ROW
BEGIN
    INSERT INTO user_academic_profile (user_id, year_of_study, department, cluster, sil_section, CGPA)
    VALUES (NEW.id, 'NA', 'Not Specified', 0, 0, 0.0);
END //
DELIMITER ;

create table social_internship_registration (
    id int not null auto_increment,
    user_id int not null unique,
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

DELIMITER //
CREATE TRIGGER after_insert_social_internship_registration
AFTER INSERT ON social_internship_registration
FOR EACH ROW
BEGIN
    INSERT INTO social_internship_attendance (user_id, day_one_attendance_status, day_two_attendance_status, day_three_attendance_status, day_four_attendance_status, day_five_attendance_status, day_six_attendance_status, day_seven_attendance_status, day_eight_attendance_status, day_nine_attendance_status, day_ten_attendance_status)
    VALUES (NEW.user_id, 'Pending', 'Pending', 'Pending', 'Pending', 'Pending', 'Pending', 'Pending', 'Pending', 'Pending', 'Pending');
END;
//
DELIMITER ;


create table internship_report_submission (
    id int not null auto_increment,
    user_id int not null,
    day_id int not null unique,
    check (day_id between 1 and 10),
    report_link varchar(255) not null default 'NA',
    report_accepted_status enum('Accepted', 'Pending', 'Rejected') not null default 'Pending',
    remarks varchar(255) not null default 'NA',
    created_at timestamp not null default current_timestamp,
    primary key (id),
    foreign key (user_id) references users(id)
);

-- Create the club_categories table
CREATE TABLE club_categories (
    id INT NOT NULL AUTO_INCREMENT,
    category_name VARCHAR(255) NOT NULL UNIQUE,
    category_description TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

-- Create the clubs table
CREATE TABLE clubs (
    id INT NOT NULL AUTO_INCREMENT,
    club_name VARCHAR(255) NOT NULL UNIQUE,
    club_logo TEXT NOT NULL DEFAULT 'NA',
    club_category INT NOT NULL,
    club_domain VARCHAR(255) NOT NULL,
    club_description TEXT NOT NULL,
    club_head VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (club_category) REFERENCES club_categories(id)
);


CREATE TABLE club_registration (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    club_category INT NOT NULL,
    club_id INT NOT NULL,
    registration_approval_status ENUM('Approved', 'Pending', 'Rejected') NOT NULL DEFAULT 'Pending',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY unique_user_category (user_id, club_category), -- Unique constraint for one club in each category
    UNIQUE KEY unique_user_club (user_id, club_id), -- Unique constraint for not registering the same club twice
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (club_category) REFERENCES club_categories(id),
    FOREIGN KEY (club_id) REFERENCES clubs(id)
);

create table grievances (
    id int not null auto_increment,
    user_id int not null,
    grievance_title varchar(255) not null,
    grievance_description text not null,
    grievance_status enum('Pending', 'Resolved') not null default 'Pending',
    created_at timestamp not null default current_timestamp,
    primary key (id),
    foreign key (user_id) references users(id)
);

CREATE TABLE courses (
    id INT NOT NULL AUTO_INCREMENT,
    course_name VARCHAR(255) NOT NULL,
    course_code VARCHAR(255) NOT NULL,
    course_description TEXT NOT NULL,
    course_image_url VARCHAR(255) NOT NULL,
    course_points INT NOT NULL,
    course_offering_club VARCHAR(255) NOT NULL,
    course_duration_hrs INT NOT NULL,
    course_student_administrator VARCHAR(255) NOT NULL,
    course_faculty_administrator VARCHAR(255) NOT NULL,
    course_approval_status ENUM('Approved', 'Pending', 'Rejected') NOT NULL DEFAULT 'Pending',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE TABLE course_registration (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    registration_approval_status ENUM('Approved', 'Pending', 'Rejected') NOT NULL DEFAULT 'Pending',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY unique_user_course (user_id, course_id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

CREATE TABLE attendance (
    id INT NOT NULL AUTO_INCREMENT,
    course_registration_id INT NOT NULL,
    user_id INT NOT NULL,
    attendance_date DATE NOT NULL,
    attended BOOLEAN NOT NULL DEFAULT false,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (course_registration_id) REFERENCES course_registration(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

