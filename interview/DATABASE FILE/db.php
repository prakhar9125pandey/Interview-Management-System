<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interview";

// Create connection
$conn = new mysqli($servername, $username, $password, '', 3306, '/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock');


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->select_db($dbname);

// SQL structure and data
$sqlScript = <<<SQL
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS candidates (
  cand_id int(10) NOT NULL AUTO_INCREMENT,
  cand_name varchar(150) NOT NULL,
  cand_gender varchar(255) NOT NULL,
  cand_email varchar(150) NOT NULL,
  cand_phone varchar(150) NOT NULL,
  cand_age int(10) DEFAULT NULL,
  cand_address text,
  cand_qualification text,
  PRIMARY KEY (cand_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO candidates (cand_id, cand_name, cand_gender, cand_email, cand_phone, cand_age, cand_address, cand_qualification) VALUES
(1, 'Jesse Lopez', 'F', 'jessel@gmail.com', '7025556601', 25, '3549 Cimmaron Road', 'BIT'),
(3, 'John Doe', 'M', 'johndoe@gmail.com', '7412225450', 26, '2154 Avenue Street', 'MScIT'),
(4, 'John Walker', 'M', 'johnw@gmail.com', '7412225800', 27, '254 Deckk Street', 'MIT'),
(5, 'Joshua K Smith', 'M', 'joshuasm@gmail.com', '7025000020', 23, '4438 Atha Drive', 'BIT'),
(7, 'Willard Henderson', 'M', 'willardh@gmail.com', '7024586969', 29, '2325 Cedarstone Drive', 'MSIT');

CREATE TABLE IF NOT EXISTS comments (
  comment_id int(10) NOT NULL AUTO_INCREMENT,
  comment text,
  cand_id int(10) DEFAULT NULL,
  PRIMARY KEY (comment_id),
  FOREIGN KEY (cand_id) REFERENCES candidates (cand_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO comments (comment_id, comment, cand_id) VALUES
(4, 'seems good, requires a bit more attention regarding communication skill', 3),
(5, 'lacks experience on SEO, seems good for graphics', 4),
(6, 'considered', 1),
(8, 'all good, listed on the hired list!!', 7);

CREATE TABLE IF NOT EXISTS questions (
  question_id int(10) NOT NULL AUTO_INCREMENT,
  question text,
  PRIMARY KEY (question_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO questions (question_id, question) VALUES
(6, 'What languages have you programmed in?'),
(7, 'How do you handle multiple deadlines?'),
(8, 'What development tools have you used?'),
(9, 'What interests you about this position?'),
(10, 'How do you troubleshoot IT issues?'),
(11, 'Describe a time when you were able to improve upon the design that was originally suggested.'),
(12, 'What is the biggest IT challenge you have faced, and how did you handle it?'),
(13, 'Out of all the candidates, why should we hire you?'),
(14, 'What are your favorite and least favorite technology products, and why?'),
(17, 'What are the benefits and the drawbacks of working in an Agile environment?'),
(18, 'How do you think further technology advances will impact your job?');

CREATE TABLE IF NOT EXISTS reports (
  report_id int(10) NOT NULL AUTO_INCREMENT,
  question_id int(10) NOT NULL,
  cand_id int(10) NOT NULL,
  result text,
  PRIMARY KEY (report_id),
  FOREIGN KEY (question_id) REFERENCES questions (question_id),
  FOREIGN KEY (cand_id) REFERENCES candidates (cand_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO reports (report_id, question_id, cand_id, result) VALUES
(28, 6, 3, '7'),
(29, 7, 3, '9'),
(30, 8, 3, '7'),
(31, 9, 3, '8'),
(32, 6, 4, '10'),
(33, 7, 4, '5'),
(34, 8, 4, '7'),
(35, 9, 4, '7'),
(36, 6, 1, '7'),
(37, 7, 1, '8'),
(38, 8, 1, '8'),
(39, 9, 1, '8'),
(40, 10, 1, '7'),
(41, 11, 1, '9'),
(42, 12, 1, '7'),
(43, 13, 1, '7'),
(44, 14, 1, '8'),
(56, 6, 7, '8'),
(57, 7, 7, '9'),
(58, 8, 7, '9'),
(59, 9, 7, '8'),
(60, 10, 7, '7'),
(61, 11, 7, '8'),
(62, 12, 7, '7'),
(63, 13, 7, '9'),
(64, 14, 7, '9'),
(65, 17, 7, '8'),
(66, 18, 7, '8');

CREATE TABLE IF NOT EXISTS user (
  user_id int(10) NOT NULL AUTO_INCREMENT,
  user_name varchar(150) NOT NULL,
  email varchar(100) NOT NULL,
  password varchar(150) NOT NULL,
  PRIMARY KEY (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO user (user_id, user_name, email, password) VALUES
(1, 'Will Williams', 'williams@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'Liam Moore', 'liam@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(3, 'Jeff Madison', 'jeff@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(4, 'Anthony Johnson', 'anthony@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99');
SQL;

if ($conn->multi_query($sqlScript) === TRUE) {
    echo "Tables created and data inserted successfully<br>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();

?>
