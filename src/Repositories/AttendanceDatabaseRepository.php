<?php
namespace Src\Repositories;

use Src\Models\Attendance;

class AttendanceDatabaseRepository extends Repository {
    public function __construct($conn) {
        parent::__construct($conn);
    }
    /**
     * Get all attendances
     * 
     * @return \Src\Models\Attendance[]
     */
    public function getAll() {
        $sql = "SELECT * FROM attendance";
        $result = $this->conn->query($sql);
        $attendances = [];
        foreach ($result as $row) {
            $attendances[] = new Attendance($row['id'], $row['attendance_sheet_id'], $row['student_id'], $row['date'], $row['status']);
        }
        return $attendances;
    }

    /**
     * Get attendance by id
     * 
     * @param int $id
     * @return \Src\Models\Attendance
     */
    public function findById($id) {
        $sql = "SELECT * FROM attendance WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        return new Attendance($row['id'], $row['attendance_sheet_id'], $row['student_id'], $row['date'], $row['status']);
    }

    /**
     * Create attendance
     * 
     * @param array $data
     * @return int
     */
    public function create($data) {

    }

    /**
     * Update attendance
     * 
     * @param int $id
     * @param array $data
     * 
     * @return int
     */
    public function update($id, $data) {

    }

    /**
     * Delete attendance
     * 
     * @param int $id
     * @return int
     */
    public function delete($id) {
        
    }

    /**
     * Get attendance by attendance sheet id
     * 
     * @param int $attenanceSheetId
     * @return array
     */
    public function findByAttendanceSheetId($attenanceSheetId) {
        $sql = "SELECT s.id AS studentId, s.name, at.date, at.status
                FROM student s
                JOIN register r 
                ON s.id = r.student_id
                JOIN attendance_sheet a 
                ON r.course_id = a.course_id
                JOIN attendance at 
                ON s.id = at.student_id AND at.attendance_sheet_id = a.id
                WHERE at.attendance_sheet_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$attenanceSheetId]);
        $result = $stmt->get_result();
        $attendances = [];
        foreach ($result as $row) {
            $attendances[] = $row;
        }

        return $attendances;
    }

    /**
     * Create or update attendance
     * 
     * @param int $attendanceSheetId
     * @param int $studentId
     * @param string $date
     * @param string $status
     * 
     * @return int
     */
    public function createOrUpdate($attendanceSheetId, $studentId, $date, $status) {
        $sql = "INSERT INTO attendance (`attendance_sheet_id`, `student_id`, `date`, `status`) 
                VALUES (?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE status = CASE
                    WHEN ? != status THEN ?
                    ELSE status
                END";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$attendanceSheetId, $studentId, $date, $status, $status, $status]);
        $result = $stmt->get_result();
        return $result;
    }

    public function deleteBySheetIdAndStudentIdAndDate($attendanceSheetId, $studentId, $date) {
        $sql = "DELETE FROM attendance WHERE attendance_sheet_id = ? AND student_id = ? AND date = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$attendanceSheetId, $studentId, $date]);
        $result = $stmt->get_result();
        return $result;
        
    }
}
