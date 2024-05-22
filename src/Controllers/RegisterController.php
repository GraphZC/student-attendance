<?php
namespace Src\Controllers;

use Src\Http\HttpRequest;
use Src\Models\Register;
use Src\Responses\JsonResponse;
use Src\Responses\RenderResponse;
use Src\Responses\Redirect;

class RegisterController {
    /**
     * @var \Src\Services\RegisterService
     */
    private $registerService;

    public function __construct($registerService) {
        $this->registerService = $registerService;
    }

    public function createRegister(HttpRequest $request) {
        $body = $request->getBody();

        $register = new Register();
        $register->studentId = $body['studentId'];
        $register->courseId = $body['courseId'];

        $this->registerService->create($register);

        return JsonResponse::send([
            'message' => 'Register created'
        ]);
    }
}