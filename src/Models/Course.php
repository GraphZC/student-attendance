<?php
namespace Src\Models;

class Course {
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $subject;

    /**
     * @var string
     */
    public $roomNo;

    public function __construct($id = null, $subject = null, $roomNo = null) {
        $this->id = $id;
        $this->subject = $subject;
        $this->roomNo = $roomNo;
    }


}