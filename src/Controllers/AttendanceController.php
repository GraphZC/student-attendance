<?php
namespace Src\Controllers;

use Src\Responses\JsonResponse;
use Src\Http\HttpRequest;

class AttendanceController {
    /**
     * @var \Src\Services\AttendanceService
     */
    private $attendanceService;

    public function __construct($attendanceService) {
        $this->attendanceService = $attendanceService;
    }

    public function updateAttendance(HttpRequest $request) {
        $body = $request->getBody();

        // Loop through each student and update attendance
        $count = 0;
        foreach ($body as $attendance) {
            if ($attendance['status'] === 'NONE') {
                $this->attendanceService->deleteAttendance(
                    $attendance['attendanceSheetId'],
                    $attendance['studentId'],
                    $attendance['date']
                );
            } else {
                $this->attendanceService->createOrUpdateAttendance(
                    $attendance['attendanceSheetId'],
                    $attendance['studentId'],
                    $attendance['date'],
                    $attendance['status']
                );
            }
            $count++;
        }

        return JsonResponse::send([
            'message' => "$count attendance records updated"
        ]);
    }
}
