<?php

namespace Src\Repositories;

use Src\Models\Register;

class RegisterDatabaseRepository extends Repository {
    public function __construct($conn) {
        parent::__construct($conn);
    }

    /**
     * Get all registers
     * 
     * @return \Src\Models\Register[]
     */
    public function getAll() {
        $sql = "SELECT * FROM register";
        $result = $this->conn->query($sql);
        $registers = [];
        foreach ($result as $row) {
            $registers[] = new Register($row['id'], $row['student_id'], $row['course_id']);
        }
        return $registers;
    }

    /**
     * Get register by id
     * 
     * @param int $id
     * @return \Src\Models\Register
     */
    public function findById($id) {
        $sql = "SELECT * FROM register WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        return new Register($row['id'], $row['student_id'], $row['course_id']);
    }

    /**
     * Create register
     * 
     * @param Register $data
     * @return int
     */
    public function create($data) {
        $sql = "INSERT INTO register (student_id, course_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$data->studentId, $data->courseId]);
        return $stmt->insert_id;
    }

    /**
     * Update register
     * 
     * @param int $id
     * @param array $data
     * 
     * @return int
     */
    public function update($id, $data) {

    }

    /**
     * Delete register
     * 
     * @param int $id
     * @return int
     */
    public function delete($id) {

    }
}