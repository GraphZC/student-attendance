<?php
namespace Src\Repositories;

use Src\Models\Student;

class StudentDatabaseRepository extends Repository  {
    public function __construct($conn) {
        parent::__construct($conn);
    }
   
    /**
     * Get all students
     * 
     * @return \Src\Models\Student[]
     */
    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM student");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $students = [];
        foreach ($result as $row) {
            $students[] = new Student($row['id'], $row['name']);
        }

        return $students;
    }

    /**
     * Find student by id
     * 
     * @param int $id
     * @return \Src\Models\Student
     */
    public function findById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM student WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return new Student($row['id'], $row['name']);
    }

    /** 
     * Create student
     * 
     * @param Student $data
     * @return int
     */
    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO student (`id`, `name`) VALUES (?, ?)");
        $stmt->execute([$data->id, $data->name]);
        return $data->id;
    }

    public function update($id, $data) {

    }

    /**
     * Delete student
     * 
     * @param int $id
     * @return int
     */
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM student WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    /**
     * Find student by course id
     * 
     * @param int $courseId
     * @return \Src\Models\Student[]
     */
    public function findByCourseId($courseId) {
        $sql = "SELECT s.id, s.name FROM register r
                LEFT JOIN student s
                ON r.student_id = s.id
                WHERE r.course_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$courseId]);
        $result = $stmt->get_result();

        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = new Student($row['id'], $row['name']);
        }

        return $students;
    }

    /**
     * Search student by id
     * 
     * @param int $id
     * @return \Src\Models\Student[]
     */
    public function searchById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM student WHERE id LIKE ? LIMIT 5");
        $searchTerm = "$id%";
        $stmt->execute([$searchTerm]);
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $students = [];
        foreach ($result as $row) {
            $students[] = new Student($row['id'], $row['name']);
        }

        return $students;
    }
}