<?php
namespace Src\Models;

class Register {
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $studentId;

    /**
     * @var int
     */
    public $courseId;

    public function __construct($id = null, $studentId = null, $courseId = null) {
        $this->id = $id;
        $this->studentId = $studentId;
        $this->courseId = $courseId;
    }
}