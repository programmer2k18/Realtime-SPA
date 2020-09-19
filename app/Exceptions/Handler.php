<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

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
     *
     * @throws \Exception
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
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof NotFoundHttpException)
            return response()->json("Requested url:{$request->url()} is not valid",404);
        elseif ($e instanceof ModelNotFoundException)
            return response()->json("Invalid URL parameters or ".$e->getMessage(),404);
        elseif ($e instanceof QueryException)
            return response()->json($e->getMessage(),404);

        elseif ($e instanceof TokenBlacklistedException)
            return response()->json("This token is blacklisted and can't be used.",400);

        elseif ($e instanceof TokenInvalidException)
            return response()->json("This token is not valid",400);

        elseif ($e instanceof TokenExpiredException)
            return response()->json("This token is expired and not still available",400);

        elseif ($e instanceof JWTException)
            return response()->json("Invalid token or token not provided",400);

        return parent::render($request, $e);
    }
}
