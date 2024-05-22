<?php

use Src\Controllers\AttendanceSheetController;
use Src\Controllers\CourseController;
use Src\Controllers\AttendanceController;
use Src\Repositories\AttendanceDatabaseRepository;
use Src\Repositories\CourseDatabaseRepository;
use Src\Services\CourseService;
use Src\Repositories\AttendanceSheetDatabaseRepository;
use Src\Repositories\StudentDatabaseRepository;
use Src\Services\AttendanceService;
use Src\Services\AttendanceSheetService;
use Src\Services\StudentService;
use Src\Controllers\StudentController;
use Src\Controllers\HomeController;
use Src\Controllers\RegisterController;
use Src\Repositories\RegisterDatabaseRepository;
use Src\Services\RegisterService;

// Course
$courseRepository = new CourseDatabaseRepository($conn);
$courseService = new CourseService($courseRepository);

// Attendance Sheet
$attendanceSheetRepository = new AttendanceSheetDatabaseRepository($conn);
$attendanceSheetService = new AttendanceSheetService($attendanceSheetRepository);

// Student
$studentRepository = new StudentDatabaseRepository($conn);
$studentService = new StudentService($studentRepository);

// Attendance
$attendanceRepository = new AttendanceDatabaseRepository($conn);
$attendanceService = new AttendanceService($attendanceRepository);

// Register
$registerRepository = new RegisterDatabaseRepository($conn);
$registerService = new RegisterService($registerRepository);


// Controllers
$homeController = new HomeController();

$courseController = new CourseController($courseService, $attendanceSheetService);

$attendanceSheetController = new AttendanceSheetController(
    $attendanceSheetService,
    $studentService,
    $attendanceService,
    $courseService
);

$attendanceController = new AttendanceController($attendanceService);

$studentController = new StudentController($studentService, $courseService);

$registerController = new RegisterController($registerService);
