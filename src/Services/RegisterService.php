<?php
namespace Src\Services;

use Src\Models\Register;

class RegisterService {
    /**
     * @var \Src\Repositories\RegisterDatabaseRepository
     */
    private $datasource;

    public function __construct($datasource) {
        $this->datasource = $datasource;
    }

    /**
     * Get all registers
     * 
     * @return Register[]
     */
    public function getAll() {
        return $this->datasource->getAll();
    }

    /**
     * Find register by id
     */
    public function findRegisterById($id) {
        return $this->datasource->findById($id);
    }


    /**
     * Find register by id
     * 
     * @param int $id
     * @return Register
     */
    public function findById($id) {
        return $this->datasource->findById($id);
    }

    /**
     * Create register
     * 
     * @param Register $data
     * @return int
     */
    public function create($data) {
        return $this->datasource->create($data);
    }
}