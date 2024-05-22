<?php

namespace Src\Repositories;

abstract class Repository {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    abstract public function getAll();
    abstract public function findById($id);
    abstract public function create($data);
    abstract public function update($id, $data);
    abstract public function delete($id);
}