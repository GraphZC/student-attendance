<?php
namespace Src\Models;

class AttendanceSheet {
    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $courseId;

    /**
     * @var int
     */
    public $month;

    /**
     * @var int
     */
    public $year;

    /**
     * @var datetime
     */
    public $createdAt;

    public function __construct($id = null, $courseId = null, $month = null, $year = null, $createdAt = null) {
        $this->id = $id;
        $this->courseId = $courseId;
        $this->month = $month;
        $this->year = $year;
        $this->createdAt = $createdAt;
    }

    public function getMonthTh() {
        $months = [
            1 => 'มกราคม',
            2 => 'กุมภาพันธ์',
            3 => 'มีนาคม',
            4 => 'เมษายน',
            5 => 'พฤษภาคม',
            6 => 'มิถุนายน',
            7 => 'กรกฎาคม',
            8 => 'สิงหาคม',
            9 => 'กันยายน',
            10 => 'ตุลาคม',
            11 => 'พฤศจิกายน',
            12 => 'ธันวาคม',
        ];

        return $months[$this->month];
    }
    
    /**
     * Convert object to array
     * 
     * @return array
     */
    public function toArray() {
        return [
            'id' => $this->id,
            'courseId' => $this->courseId,
            'month' => $this->month,
            'year' => $this->year,
            'createdAt' => $this->createdAt,
        ];
    }
}