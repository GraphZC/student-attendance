<?php
namespace Src\Repositories;

use Src\Models\Course;
use Src\Repositories\Repository;

class CourseDatabaseRepository extends Repository {
    public function __construct($conn) {
        parent::__construct($conn);
    }

    /**
     * Get all courses
     *
     * @return \Src\Models\Course[]
     */
    public function getAll() {
        $query = "SELECT * FROM course";
        $result = $this->conn->query($query);
        $result->fetch_assoc();

        // Serailze
        $courses = [];
        foreach ($result as $row) {
            $courses[] = new Course($row['id'], $row['subject'], $row['room_no']);
        }

        return $courses;
    }

    /**
     * Get course by id
     *
     * @param int $id
     * @return \Src\Models\Course
     */
    public function findById($id) {
        $query = "SELECT * FROM course WHERE id = ? limit 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return new Course($row['id'], $row['subject'], $row['room_no']);
    }

    /**
     * Create course
     * 
     * @param Course $data
     * @return int
     */
    public function create($data) {
        $query = "INSERT INTO course (`subject`, `room_no`) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $data->subject, 
            $data->roomNo
        ]);
        return $stmt->insert_id;
    }   

    /**
     * Update course
     * 
     * @param int $id
     * @param array $data
     * @return int
     */
    public function update($id, $data) {
    }

    /**
     * Delete course
     * 
     * @param int $id
     * @return int
     */
    public function delete($id) {

    }
}