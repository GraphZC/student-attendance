<?php
namespace Src\Models;

class Attendance {
    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $attendanceSheetId;
    
    /**
     * @var string
     */
    public $studentId;

    /**
     * @var int
     */
    public $date;

    /**
     * @var string
     */
    public $status;

    public function __construct($id = null, $attendanceSheetId = null, $studentId = null, $date = null, $status = null) {
        $this->id = $id;
        $this->attendanceSheetId = $attendanceSheetId;
        $this->studentId = $studentId;
        $this->date = $date;
        $this->status = $status;
    }
}
