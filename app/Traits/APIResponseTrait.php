<?php

namespace App\Traits;
use Response;
use stdClass;
use Illuminate\Http\Response as IlluminateResponse;

trait APIResponseTrait
{
    // HTTP_OK
    // HTTP_CREATED
    // HTTP_BAD_REQUEST
    // HTTP_INTERNAL_SERVER_ERROR
    // HTTP_NOT_FOUND
    // HTTP_FORBIDDEN
    // HTTP_UNAUTHORIZED
    // API RESPONSE =====================================
    public function reponseSuccessReturn($msgdata = 'Response Successfully!', $statusCode = IlluminateResponse::HTTP_OK)
    {
        if (!$statusCode){
            $statusCode = IlluminateResponse::HTTP_OK;
        }         
        $data = $msgdata['data'];
        $msg = $msgdata['message'];
        $returndata = ['data' => $data, 'message' => $msg, 'status_code' => $statusCode];
        return $this->setStatusCode($statusCode)->respond($returndata);
    }

    public function reponseErrorReturn($message = 'Something went wrong!')
    {
        if (!$message){
            $message = 'Not found Exception!';
        }  
        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
    }

    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }

    public function respondSkipError($message = 'Skip exception Error!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_FORBIDDEN)->respondWithError($message);
    }

	public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }
	
	private function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }
	
	public function getStatusCode()
    {
        return  $this->statusCode;
    }

    protected function respondWithError($message)
    {
        return $this->respond([
            'data' => new stdClass,
            'message' => $message,
            'status_code' => $this->getStatusCode()
        ]);
    }
}
