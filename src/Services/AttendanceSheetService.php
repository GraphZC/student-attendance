<?php
namespace Src\Services;

use Src\Models\AttendanceSheet;

class AttendanceSheetService {
    /**
     * @var \Src\Repositories\AttendanceSheetDatabaseRepository
     */
    private $datasource;

    public function __construct($datasource) {
        $this->datasource = $datasource;
    }

    /**
     * Get all attendance sheets
     * 
     * @return \Src\Models\AttendanceSheet[]
     */
    public function getAll() {
        return $this->datasource->getAll();
    }

    /**
     * Find attendance sheet by id
     */
    public function findAttendanceSheetById($id) {
        return $this->datasource->findById($id);
    }

    /**
     * Find attendance sheet by course id
     * 
     * @param int $courseId
     */

    public function findAttendanceSheetByCourseId($courseId) {
        return $this->datasource->findByCourseId($courseId);
    }

    /**
     * Find attendance sheet by id
     * 
     * @param int $id
     * @return \Src\Models\AttendanceSheet
     */
    public function findById($id) {
        return $this->datasource->findById($id);
    }

    /**
     * Create attendance sheet
     * 
     * @param array $data
     * @return int
     */
    public function create($data) {
        return $this->datasource->create($data);
    }
}