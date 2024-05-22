<?php
namespace Src\Services;

use Src\Models\Attendance;
use Src\Repositories\AttendanceDatabaseRepository;

class AttendanceService {
    /** 
     * @var AttendanceDatabaseRepository
     */
    private $datasource;

    public function __construct($datasource) {
        $this->datasource = $datasource;
    }

    public function findByAttendanceSheetId($attenanceSheetId) {
        return $this->datasource->findByAttendanceSheetId($attenanceSheetId);
    }

    public function createOrUpdateAttendance($attendanceSheetId, $studentId, $date, $status) {
        return $this->datasource->createOrUpdate($attendanceSheetId, $studentId, $date, $status);
    }

    public function deleteAttendance($attendanceSheetId, $studentId, $date) {
        return $this->datasource->deleteBySheetIdAndStudentIdAndDate($attendanceSheetId, $studentId, $date);
    }
}