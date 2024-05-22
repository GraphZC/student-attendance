<?php
namespace Src\Services;

use Src\Models\Student;
use Src\Repositories\StudentDatabaseRepository;

class StudentService {
    /**
     * @var StudentDatabaseRepository
     */
    private $datasource;

    public function __construct($datasource) {
        $this->datasource = $datasource;
    }

    /**
     * Get all students
     * 
     * @return Student[]
     */
    public function getAll() {
        return $this->datasource->getAll();
    }

    /**
     * Find student by id
     */
    public function findStudentById($id) {
        return $this->datasource->findById($id);
    }

    /**
     * Find student by course id
     * 
     * @param int $courseId
     * 
     * @return Student[]
     */
    public function findByCourseId($attendanceSheetId) {
        return $this->datasource->findByCourseId($attendanceSheetId);
    }

    /**
     * Create student
     * 
     * @param Student $student
     * @param int $courseId
     * 
     * @return int
     */
    public function createStudent($student) {
        return $this->datasource->create($student);
    }

    /**
     * Search student by id
     * 
     * @param int $id
     * @param array $data
     */
    public function searchById($id) {
        return $this->datasource->searchById($id);
    }
}