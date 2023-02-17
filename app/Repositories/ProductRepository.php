<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IProductRepository;
use App\Models\Product;
use App\Models\Color;
use App\Models\Category;
use App\Exceptions\NotFoundException;
use App\Exceptions\CustomNotFoundException;
use Exception;

class ProductRepository implements IProductRepository
{
	public function productModel(){
		return Product::class;
	}
    public function colorModel(){
		return Color::class;
	}
    public function categoryModel(){
		return Category::class;
	}

	public function getproducts($all_data){
        foreach($all_data as $prod){
            $product = [];
            $product['id']= $prod->id;
            $product['name']= $prod->name;
            $product['price']= $prod->price;
            $color= null;
            if($prod->color_id){
                $color = $prod->color->color;
            }
            $product['color']= $color;
            $cats = $prod->categories()->get();
            $prod['categories'] = null;
            if(sizeof($cats)){
                foreach($cats as $cat){
                    $test = [];
                    $test['id'] = $cat->id;
                    $test['category'] = $cat->category;
                    $product['categories'][] = $test;
                }
            }
            $products[]= $product;
        }
        return ['data'=>$products,'message'=>'All product listed'];
	}

    public function product_store($request){
        $color_id = null;            
        if($request->color_id != null){
            $color = $this->colorModel()::find($request->color_id);
            if(!$color){
                // return ['error'=>'Color not found!'];
                throw new NotFoundException('Color not found!');
            }
            $color_id = $request->color_id;
        } 
        if(!empty($request->categories)){
            foreach($request->categories as $cat){
                $cat = $this->categoryModel()::find($cat);
                if(!$cat){
                    // return ['error'=>'Category not found!'];
                    throw new NotFoundException('Category not found!');
                }            
            }           
        }       
        $product = $this->productModel()::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'color_id'=>$color_id,
        ]);
        
        $product->categories()->attach($request->categories);
        $cats = $product->categories()->get();      
        $prod['id'] = $product->id;
        $prod['name'] = $product->name;
        $prod['price'] = $product->price;
        $prod['color'] = null;
        if($request->color_id != null){
            $prod['color'] = $product->color->color;
        }
        $prod['categories'] = null;
        if(sizeof($cats)){
            foreach($cats as $cat){
                $test = [];
                $test['id'] = $cat->id;
                $test['category'] = $cat->category;
                $prod['categories'][] = $test;
            }
        }        
        return ['data'=>$prod,'message'=>'New product added!'];
	}

    public function product_destroy($product){
        $product->delete();
        return ['data'=>$products,'message'=>'Product has been deleted!'];
	}

    public function product_update($request,$id){
        $product_data = $this->productModel()::find($id);
        if(!$product_data){
            throw new NotFoundException('Product not found!');
        }
        $color_id = null;            
        if($request->color_id != null){
            $color_id = $this->colorModel()::find($request->color_id);
            if(!$color_id){
                throw new NotFoundException('Color not found!');
            }
        }  
        
        if(!empty($request->categories)){
            foreach($request->categories as $cat){
                $cat = $this->categoryModel()::find($cat);
                if(!$cat){
                    throw new NotFoundException('Category not found!');
                }            
            }           
        }   
        $product = $this->productModel()::where('id',$id)->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'color_id'=>$request->color_id,
        ]);
        $product_data->categories()->sync($request->categories);
        $data = $this->productModel()::find($id);
        return ['data'=>$data,'message'=>'Product has been updated!'];
        // return ['Message' => "Product data updated!"];        
    }

    public function product_view($data){
        $cats = $data->categories()->get();
        $color = null;
        if($data->color){
            $color = $data->color->color;
        }
        $prod['id'] = $data->id;
        $prod['name'] = $data->name;
        $prod['price'] = $data->price;
        $prod['color'] = $color;
        $prod['categories'] = null;
        if(sizeof($cats)){
            foreach($cats as $cat){
                $test = [];
                $test['id'] = $cat->id;
                $test['category'] = $cat->category;
                $prod['categories'][] = $test;
            }
        }
        return ['data'=>$prod,'message'=>'All product data!'];
    }

    public function productExists($product){
        return $this->productModel()::find($product);
    }

    public function productsExists(){
        return $this->productModel()::select('id','name','price','color_id')->get(); 
    }

}
