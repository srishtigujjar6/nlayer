<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Services\Interfaces\IProductService;
// use App\Http\Requests\ProductRequest;
use Response;
use stdClass;
use Illuminate\Http\Response as IlluminateResponse;

trait ProductTrait
{
	public function __construct(IProductService  $productService)
	{
		$this->productService = $productService;
	}
    
    public function getproducts()
	{
        return $this->productService->getproducts();
	}

    public function product_store(Request $request)
	{
        return $this->productService->product_store($request);
	}

    public function product_update(Request $request,$product)
	{
        return $this->productService->product_update($request,$product);
	}

    public function product_destroy($product)
	{
        return $this->productService->product_destroy($product);
	}
	
	public function product_view($product)
	{
        return $this->productService->product_view($product);
	}

	public function getException()
	{
        return $this->productService->getException();
	}

	public function getHandlerException()
	{
        return $this->productService->getHandlerException();
	}
	
}
