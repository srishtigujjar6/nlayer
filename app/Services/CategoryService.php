<?php

namespace App\Services;

use App\Repositories\Interfaces\IcategoryRepository;
use App\Services\Interfaces\ICategoryService;
use Validator;

class CategoryService implements ICategoryService
{
    private $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    public function validate_request($request)
	{
        return Validator::make($request->all(),[
            'category' => 'required|unique:categories',
        ]);
	}

    public function getcategories()
    {
        $service = $this->categoryRepository->getcategories();
        return $service;
    }

    public function category_store($request)
	{
        $validator = $this->validate_request($request);
        if($validator->fails()){
            return ['error'=>$validator->messages(), 'message'=> 'Input error'];
        }
        return $this->categoryRepository->category_store($request);
	}

    public function category_update($request,$category)
	{
        $validator = $this->validate_request($request);
        if($validator->fails()){
            return ['data'=>$validator->messages(), 'message'=> 'Input error'];
        }
        return $this->categoryRepository->category_update($request,$category);
	}

    public function category_destroy($category)
	{
        return $this->categoryRepository->category_destroy($category);
	}

    public function category_view($category)
	{
        return $this->categoryRepository->category_view($category);
	}
    
}
