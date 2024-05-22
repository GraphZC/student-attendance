CREATE TABLE `course` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `subject` varchar(255),
  `room_no` varchar(255)
);

CREATE TABLE `register` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `student_id` varchar(255),
  `course_id` int
);

CREATE TABLE `student` (
  `id` varchar(255) PRIMARY KEY,
  `name` varchar(255)
);

CREATE TABLE `attendance_sheet` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `month` int,
  `year` int,
  `course_id` int,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `attendance` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `attendance_sheet_id` int,
  `student_id` varchar(255),
  `date` int,
  `status` varchar(255)
);

ALTER TABLE `register` ADD FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);

ALTER TABLE `register` ADD FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);

ALTER TABLE `attendance_sheet` ADD FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);

ALTER TABLE `attendance` ADD FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);

ALTER TABLE `attendance` ADD FOREIGN KEY (`attendance_sheet_id`) REFERENCES `attendance_sheet` (`id`);

ALTER TABLE `attendance` ADD CONSTRAINT `unique_attendance_entry` UNIQUE (`student_id`, `date`, `attendance_sheet_id`);
