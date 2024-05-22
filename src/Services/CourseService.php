<?php
namespace Src\Services;

use Src\Models\Course;

class CourseService {
    /**
     * @var \Src\Repositories\CourseDatabaseRepository
     */
    private $datasource;

    public function __construct($datasource) {
        $this->datasource = $datasource;
    }

    /**
     * Get all courses
     * 
     * @return \Src\Models\Course[]
     */
    public function getAll() {
        return $this->datasource->getAll();
    }

    /**
     * Find course by id
     */
    public function findCourseById($id) {
        return $this->datasource->findById($id);
    }

    /**
     * Create course
     * 
     * @param Course $data
     * @return int
     */
    public function create($data) {
        return $this->datasource->create($data);
    }

}