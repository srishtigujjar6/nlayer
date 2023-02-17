<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Services\Interfaces\ICategoryService;

trait CategoryTrait
{
	public function __construct(ICategoryService  $categoryService)
	{
		$this->categoryService = $categoryService;
	}
    
    public function getcategories()
	{
        return $this->categoryService->getcategories();
	}

    public function category_store(Request $request)
	{
        return $this->categoryService->category_store($request);
	}

    public function category_update(Request $request,$category)
	{
        return $this->categoryService->category_update($request,$category);
	}

    public function category_destroy($category)
	{
        return $this->categoryService->category_destroy($category);
	}
	
	public function category_view($category)
	{
        return $this->categoryService->category_view($category);
	}

}
