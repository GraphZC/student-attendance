<?php
namespace Src\Controllers;

use Src\Http\HttpRequest;
use Src\Models\Course;
use Src\Responses\JsonResponse;
use Src\Responses\RenderResponse;
use Src\Responses\Redirect;

class CourseController {
    /**
     * @var \Src\Services\CourseService
     */
    private $courseService;

    /**
     * @var \Src\Services\AttendanceSheetService
     */
    private $attendanceSheetService;

    public function __construct($courseService, $attendanceSheetService) {
        $this->courseService = $courseService;
        $this->attendanceSheetService = $attendanceSheetService;
    }

    public function getAllCourses(HttpRequest $request) {
        $courses = $this->courseService->getAll();
        return JsonResponse::send($courses);
    }

    public function findCourseById(HttpRequest $request) {
        $course = $this->courseService->findCourseById($request->getParams()['id']);
        return JsonResponse::send($course);
    }

    public function createCourse(HttpRequest $request) {
        return JsonResponse::send($request->getBody(), 201);
    }

    public function viewAllCourses(HttpRequest $request) {
        return RenderResponse::render('courses-list', [
            'title' => 'Courses',
            'courses' => $this->courseService->getAll()
        ]);
    }

    public function viewCourseById(HttpRequest $request) {
        $course = $this->courseService->findCourseById($request->getParams()['id']);
        $attendanceSheets = $this->attendanceSheetService->findAttendanceSheetByCourseId($course->id);
        return RenderResponse::render('course-detail', [
            'title' => "$course->subject | ห้อง $course->roomNo" ,
            'course' => $course,
            'attendanceSheets' => $attendanceSheets,
        ]);
    }

    public function createCourseView(HttpRequest $request) {
        return RenderResponse::render('course-create', [
            'title' => 'Create Course'
        ]);
    }

    public function saveCreateCourse(HttpRequest $request) {
        if (!isset($_POST['subject']) || !isset($_POST['roomNo'])) {
            return JsonResponse::send([
                'message' => 'Subject and Room No are required'
            ], 400);
        }

        $course = new Course();
        $course->subject = $_POST['subject'];
        $course->roomNo = $_POST['roomNo'];

        $this->courseService->create($course);


        return Redirect::to('/courses');
    }
}