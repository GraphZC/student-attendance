<?php
namespace Src\Controllers;

use Src\Http\HttpRequest;
use Src\Models\Student;
use Src\Responses\JsonResponse;
use Src\Responses\RenderResponse;
use Src\Responses\Redirect;

class StudentController {
    /**
     * @var \Src\Services\StudentService
     */
    private $studentService;

    /**
     * @var \Src\Services\CourseService
     */
    private $courseService;

    public function __construct($studentService, $courseService) {
        $this->studentService = $studentService;
        $this->courseService = $courseService;
    }

    public function viewStudentsByCourseId(HttpRequest $request) {
        $params = $request->getParams();
        $courseId = $params['id'];
        $students = $this->studentService->findByCourseId($courseId);
        $course = $this->courseService->findCourseById($courseId);

        return RenderResponse::render('registered-students-list', [
            'title' => 'Students',
            'students' => $students,
            'course' => $course,
        ]);
    }

    public function viewAllStudents(HttpRequest $request) {
        $students = $this->studentService->getAll();

        return RenderResponse::render('students-list', [
            'title' => 'Students',
            'students' => $students,
        ]);
    }

    public function saveCreateStudent(HttpRequest $request) {
        if (!isset($_POST['id']) || !isset($_POST['name'])) {
            return JsonResponse::send(['message' => 'Invalid request'], 400);
        }

        $student = new Student();
        $student->id = $_POST['id'];
        $student->name = $_POST['name'];

        $this->studentService->createStudent($student);

        return Redirect::to("/students");
    }

    public function searchStudentsById(HttpRequest $request) {
        $query = $request->getQuery();
        $studentId = $query['id'];
        $student = $this->studentService->searchById($studentId);

        return JsonResponse::send($student);
    }


}