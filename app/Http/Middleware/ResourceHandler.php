<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Exceptions\CustomNotFoundException;
use App\Exceptions\CustomSkipException;
use App\Traits\APIResponseTrait;
use Exception;
use App\Http\Resources\Interfaces\IHandler;

class ResourceHandler
{
    use APIResponseTrait;
    private $handler;
    public function __construct(IHandler $handler)
    {
        $this->handler = $handler;
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */


    public function handle($request, \Closure $next, $guard = null)
    {
        try {
            $response = $next($request);
            return $response;
        } catch (CustomNotFoundException $ex) {
            return $this->reponseErrorReturn($ex->getMessage());    
        } catch (CustomSkipException $ex) {
            return $this->respondSkipError($ex->getMessage());    
        } catch (Exception $ex) {
            return $this->respondInternalError($ex->getMessage());
        }
    }

    public function terminate($request, $response)
    {
    }
}