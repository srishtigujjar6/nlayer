<?php

namespace App\Services;

use App\Repositories\Interfaces\IProductRepository;
use App\Services\Interfaces\IProductService;
// use App\Traits\ProductTrait;
use App\Exceptions\CustomNotFoundException;
use App\Exceptions\CustomSkipException;
use App\Exceptions\CustomHandlerException;
use Validator;

class ProductService implements IProductService
{
    // use ProductTrait;
    private $productRepository;

    public function __construct(IProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function validate_request($request)
	{
        return Validator::make($request->all(),[
            'name' => 'required',
            'price' => 'required|numeric',
        ]);
	}

    public function getproducts()
    {
        $products = $this->productRepository->productsExists();
        if(empty($products)){  
            throw new NotFoundException('Products not found!');
        }
        return $this->productRepository->getproducts($products);
    }

    public function product_store($request)
	{
        $validator = $this->validate_request($request);
        if($validator->fails()){
            return ['data'=>$validator->messages(), 'message'=> 'Input error'];
        }
        return $this->productRepository->product_store($request);
        // $result = $this->productRepository->product_store($request);
        // dd($result);
	}

    public function product_update($request,$product)
	{
        $validator = $this->validate_request($request);
        if($validator->fails()){
            return ['data'=>$validator->messages(), 'message'=> 'Input error'];
        }
        return $this->productRepository->product_update($request,$product);
	}

    public function product_destroy($product)
	{
        $data = $this->productRepository->productExists($product);
        if(empty($data)){
            throw new CustomNotFoundException('Product not found please enter valid product id!');
        }
        $data->delete();
        return ['data'=>$data,'message'=>'Product has been deleted!'];
	}

    public function product_view($product)
	{
        $data = $this->productRepository->productExists($product);
        if(empty($data)){
            throw new CustomNotFoundException('Product not found please enter valid product id!');
        }
        return $this->productRepository->product_view($data);
	}

    public function getException()
	{
        throw new CustomSkipException('CustomSkipException example');
	}

    public function getHandlerException()
	{
        throw new CustomHandlerException('getHandlerException example');
	}

}
