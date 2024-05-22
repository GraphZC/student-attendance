<?php
namespace Src\Controllers;

use Src\Http\HttpRequest;
use Src\Responses\RenderResponse;

class HomeController {
    public function index(HttpRequest $request) {
        return RenderResponse::render('home', [
            'title' => 'Attendance System'
        ]);
    }
}