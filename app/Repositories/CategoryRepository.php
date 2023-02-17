<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ICategoryRepository;
use App\Models\Category;

class CategoryRepository implements ICategoryRepository
{
    public function categoryModel()
	{
		return Category::class;
	}

	public function getcategories()
	{
        $all_data = $this->categoryModel()::get();        
        if(sizeof($all_data)){
            return ['data'=>$all_data, 'message' => 'All categorys listed'];
        }
        return ['message' => 'No categorys found'];
	}

    public function category_store($request)
	{
        $category = $this->categoryModel()::create([
            'category'=>$request->category,
        ]);
        return $category;
	}

    public function category_destroy($category)
	{
        $data = $this->categoryModel()::find($category);        
        if($data){
            $products = $this->productModel()::where("category_id",$category)->update(["category_id"=>null]);
            $data = $data->delete();
            return ['message' => "category has been eliminated"];
        }
        return ['message' => "category not found"];
	}

    public function category_update($request,$id){
        $category_data = $this->categoryModel()::find($id);
        if($category_data){   
            $category = $this->categoryModel()::where('id',$id)->update([
                'category'=>$request->category,
            ]);
            return ['message' => "category data updated!"];
        }
        return ['message' => "category not found"];
    }

    public function category_view($category){
        $data = $this->categoryModel()::find($category);
        if($data){
            return ['category' => $data];
        }
        return ['message' => "category not found"];
    }

    public function categoryExists($category){
        return $this->categoryModel()::find($category);
    }

}
