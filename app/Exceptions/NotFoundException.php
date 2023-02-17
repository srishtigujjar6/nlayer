<?php

namespace App\Exceptions;
use Exception;
use Throwable;

class NotFoundException extends Exception 
{
    protected $message;
    protected $statusCode;
    // public function __construct($message)
    // {
    //     dump('$message');
    //     dump($message);
    //     // $this->data = $data;
    //     // $this->statusCode = $statusCode;
    //     // parent::__construct($message);
    // }
    /**
     * Render the exception into an HTTP response.
     */
    public function report(){}
    public function render($request)
    {
        return response()->json(['error' => $this->getMessage()], 404);
        // return ['message' => $this->getMessage(),'error' => $this->getMessage(),'data'=>null];
    }
    
}

