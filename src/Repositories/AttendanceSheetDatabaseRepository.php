<?php
namespace Src\Repositories;

use Src\Models\AttendanceSheet;

class AttendanceSheetDatabaseRepository extends Repository {
    public function __construct($conn) {
        parent::__construct($conn);
    }

    /**
     * Get all attendance sheets
     *
     * @return AttendanceSheet[]
     */
    public function getAll() {
        $query = "SELECT * FROM attendance_sheet";
        $result = $this->conn->query($query);
        $result->fetch_all(MYSQLI_ASSOC);

        // Serailze
        $attendanceSheets = [];
        foreach ($result as $row) {
            $attendanceSheets[] = new AttendanceSheet($row['id'], $row['course_id'], $row['month'], $row['year'], $row['created_at']);
        }

        return $attendanceSheets;
    }

    /**
     * Get attendance sheet by id
     *
     * @param int $id
     * @return AttendanceSheet
     */
    public function findById($id) {
        $query = "SELECT * FROM attendance_sheet WHERE id = ? limit 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return new AttendanceSheet($row['id'], $row['course_id'], $row['month'], $row['year'], $row['created_at']);
    }

    /**
     * Create attendance sheet
     * 
     * @param AttendanceSheet $data
     * @return int
     */
    public function create($data) {
        $query = "INSERT INTO attendance_sheet (course_id, month, year) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data->courseId, $data->month, $data->year]);
        return $stmt->insert_id;
    }

    /**
     * Update attendance sheet
     * 
     * @param int $id
     * @param array $data
     * @return int
     */
    public function update($id, $data) {

    }

    /**
     * Delete attendance sheet
     * 
     * @param int $id
     * @return int
     */
    public function delete($id) {

    }

    /**
     * Get attendance sheet by course id
     *
     * @param int $courseId
     * @return \Src\Models\AttendanceSheet[]
     */
    public function findByCourseId($courseId) {
        $query = "SELECT * FROM attendance_sheet WHERE course_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$courseId]);
        $result = $stmt->get_result();

        $attendanceSheets = [];
        while ($row = $result->fetch_assoc()) {
            $attendanceSheets[] = new AttendanceSheet($row['id'], $row['course_id'], $row['month'], $row['year'], $row['created_at']);
        }

        return $attendanceSheets;
    }
}
