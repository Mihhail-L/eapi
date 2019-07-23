<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

trait ExceptionTrait 
{
    public function apiExceptions($request, $e) {
            if($this->isModel($e)) { 
                return $this->modelResponse($e);
            }

            if($this->isHttp($e)) {
                return $this->httpResponse($e);
            }

            return parent::render($request, $e);

    }

    protected function isModel($e) {
        return $e instanceof ModelNotFoundException;
    }

    protected function isHttp($e) {
        return $e instanceof NotFoundHttpException;
    }

    protected function modelResponse($e) {
        return response()->json([
            'errors' => 'Product not found'
        ], Response::HTTP_NOT_FOUND);
    }

    protected function httpResponse($e) {
        return response()->json([
            'errors' => 'Incorrect request route'
        ], Response::HTTP_NOT_FOUND);
    }
}