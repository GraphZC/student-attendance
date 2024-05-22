<?php

namespace Src\Models;

class Student {
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    
    public function __construct($id = null, $name = null) {
        $this->id = $id;
        $this->name = $name;
    }
}