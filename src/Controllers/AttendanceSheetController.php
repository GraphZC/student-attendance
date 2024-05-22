<?php
namespace Src\Controllers;

use Src\Http\HttpRequest;
use Src\Models\AttendanceSheet;
use Src\Responses\JsonResponse;
use Src\Responses\RenderResponse;
use Src\Services\AttendanceService;
use Src\Services\AttendanceSheetService;
use Src\Services\CourseService;
use Src\Services\StudentService;
use Src\Responses\Redirect;

class AttendanceSheetController {
    /**
     * @var AttendanceSheetService
     */
    private $attendanceSheetService;

    /**
     * @var StudentService
     */
    private $studentService;

    /**
     * @var AttendanceService
     */
    private $attendanceService;

    /**
     * @var CourseService
     */
    private $courseService;

    /**
     * AttendanceSheetController constructor.
     * 
     * @param $attendanceSheetService
     * @param $studentService
     * @param $attendanceService
     * @param $courseService
     */
    public function __construct(
        $attendanceSheetService, 
        $studentService,
        $attendanceService,
        $courseService
    ) {
        $this->attendanceSheetService = $attendanceSheetService;
        $this->studentService = $studentService;
        $this->attendanceService = $attendanceService;
        $this->courseService = $courseService;
    }

    public function viewAttendanceSheetById(HttpRequest $request) {
        return RenderResponse::render('attendance-sheet-detail', [
            'title' => 'Attendance Sheet',
            'id' => $request->getParams()['id'],
        ]);
    }

    public function findAttendanceSheetById(HttpRequest $request) {
        $id = $request->getParams()['id'];

        $attendanceSheet = $this->attendanceSheetService->findById($id);
        $attendance = $this->attendanceService->findByAttendanceSheetId($attendanceSheet->id);
        $attendanceFormat = [];

        $students = $this->studentService->findByCourseId($attendanceSheet->courseId);
            
        foreach ($students as $student) {
            $attendanceFormat[] = [
                "id" => $student->id,
                "name" => $student->name,
                "attendances" => []
            ];
        }

        foreach ($attendance as $record) {
            $student_id = $record['studentId'];
            $date = $record['date'];
            $status = $record['status'];

            foreach ($attendanceFormat as $key => $student) {
                if ($student['id'] == $student_id) {
                    $attendanceFormat[$key]['attendances'][$date] = $status;
                }
            }
        }
        return JsonResponse::send([
            ...$attendanceSheet->toArray(),
            'students' => $attendanceFormat,
        ]);
    }

    public function createAttendanceSheetView(HttpRequest $request) {
        $param = $request->getParams();
        $id = $param['id'];
        $course = $this->courseService->findCourseById($id);
        return RenderResponse::render('create-attendance-sheet', [
            'title' => 'Create attendance Sheet',
            'course' => $course,
        ]);
    }
    
    public function saveCreateAttendanceSheet(HttpRequest $request) {
        $attendanceSheet = new AttendanceSheet();

        if (!isset($_POST['courseId']) || !isset($_POST['month']) || !isset($_POST['year'])) {
            return JsonResponse::send(['message' => 'Invalid data']);
        }

        $attendanceSheet->courseId = $_POST['courseId'];
        $attendanceSheet->month = $_POST['month'];
        $attendanceSheet->year = $_POST['year'];

        $this->attendanceSheetService->create($attendanceSheet);

        return Redirect::to("/courses/$attendanceSheet->courseId");
    }

}