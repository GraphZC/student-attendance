<?php
use Src\Routers\Router;

$router = new Router();
$router->get('/', $homeController, 'index');

// Course API
$router->get('/api/courses', $courseController, 'getAllCourses');
$router->get('/api/courses/{id}', $courseController, 'findCourseById');
$router->post('/api/courses', $courseController, 'createCourse');

// Course Views
$router->get('/courses', $courseController, 'viewAllCourses');
$router->get('/courses/create', $courseController, 'createCourseView');
$router->post('/courses', $courseController, 'saveCreateCourse');
$router->get('/courses/{id}', $courseController, 'viewCourseById');

// Attendance Sheet
$router->get('/attendance-sheets/{id}', $attendanceSheetController, 'viewAttendanceSheetById');
$router->get('/api/attendance-sheets/{id}', $attendanceSheetController, 'findAttendanceSheetById');
$router->get('/courses/{id}/attendance-sheets/create', $attendanceSheetController, 'createAttendanceSheetView');
$router->post('/attendance-sheets', $attendanceSheetController, 'saveCreateAttendanceSheet');

// Attendance
$router->post('/api/attendances', $attendanceController, 'updateAttendance');

// Student
$router->get('/courses/{id}/students', $studentController, 'viewStudentsByCourseId');
$router->get('/students', $studentController, 'viewAllStudents');
$router->post('/students', $studentController, 'saveCreateStudent');
$router->get('/api/students/search', $studentController, 'searchStudentsById');

// Register
$router->post('/api/register', $registerController, 'createRegister');

$router->dispatch();

