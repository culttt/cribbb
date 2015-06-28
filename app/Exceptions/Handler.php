<?php namespace Cribbb\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        CribbbException::class
    ];

    /**
     * Report or log an exception
     *
     * @param Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response
     *
     * @param Request $request
     * @param Exception $e
     * @return Response
     */
    public function render($request, Exception $e)
    {
        if (config('app.debug')) {
            return parent::render($request, $e);
        }

        return $this->handle($request, $e);
    }

    /**
     * Convert the Exception into a JSON HTTP Response
     *
     * @param Request $request
     * @param Exception $e
     * @return JSONResponse
     */
    private function handle($request, Exception $e) {
        if ($e instanceOf CribbbException) {
            $data   = $e->toArray();
            $status = $e->getStatus();
        }

        if ($e instanceOf NotFoundHttpException) {
            $data = array_merge([
                'id'     => 'not_found',
                'status' => '404'
            ], config('errors.not_found'));

            $status = 404;
        }

        if ($e instanceOf MethodNotAllowedHttpException) {
            $data = array_merge([
                'id'     => 'method_not_allowed',
                'status' => '405'
            ], config('errors.method_not_allowed'));

            $status = 405;
        }

        return response()->json($data, $status);
    }
}
