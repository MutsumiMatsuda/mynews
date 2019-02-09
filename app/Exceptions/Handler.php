<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
      if ($e instanceof ModelNotFoundException) {
          $e = new NotFoundHttpException($e->getMessage(), $e);
      }

      return parent::render($request, $e);
    }

    /**
     * render HttpException page
     * エラーページの共通化
     *
     * @param  \Symfony\Component\HttpKernel\Exception\HttpException  $e
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderHttpException(HttpException $e)
    {
      $status = $e->getStatusCode();
      $message = $e->getMessage();
      if (! $message) {
          switch ($status) {
              case 400:
                  $message = 'リクエストが不正です';
                  break;
              case 401:
                  $message = '認証に失敗しました';
                  break;
              case 403:
                  $message = 'アクセス権がありません';
                  break;
              case 404:
                  $message = 'お探しのページが見つかりません';
                  break;
              case 408:
                  $message = 'タイムアウトです';
                  break;
              case 414:
                  $message = 'リクエストURIが長すぎます';
                  break;
              case 419:
                  $message = '不正なリクエストです';
                  break;
              case 500:
                  $message = '不明なエラーです';
                  break;
              case 503:
                  $message = 'Service Unavailable';
                  break;
              default:
                  $message = 'エラーです';
                  break;
          }
      }
      return response()->view("errors.common", ['exception' => $e, 'message' => $message, 'status' => $status], $status);
    }
}
