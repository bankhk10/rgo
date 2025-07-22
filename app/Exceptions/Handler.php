<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException; // เพิ่มบรรทัดนี้ที่ด้านบนของไฟล์


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            // ถ้าเป็น request ที่ต้องการ JSON (API request) ให้คืนค่า 404 JSON response
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Not Found.'], 404);
            }

            // ถ้าเป็น request จากเว็บปกติ ให้ redirect
            return redirect('/admin/login');
        }

        return parent::render($request, $exception);
    }
}
