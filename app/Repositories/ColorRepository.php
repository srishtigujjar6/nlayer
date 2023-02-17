<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IColorRepository;
use App\Models\Color;
use App\Models\Product;

class ColorRepository implements IColorRepository
{
    public function colorModel()
	{
		return Color::class;
	}

    public function productModel()
	{
		return Product::class;
	}

	public function getcolors()
	{
        $all_data = $this->colorModel()::get();        
        if(sizeof($all_data)){
            return ['data'=>$all_data, 'message' => 'All colors listed'];
        }
        return ['message' => 'No colors found'];
	}

    public function color_store($request)
	{
        $color = $this->colorModel()::create([
            'color'=>$request->color,
        ]);
        return $color;
	}

    public function color_destroy($color)
	{
        $data = $this->colorModel()::find($color);        
        if($data){
            $products = $this->productModel()::where("color_id",$color)->update(["color_id"=>null]);
            $data = $data->delete();
            return ['message' => "color has been eliminated"];
        }
        return ['message' => "color not found"];
	}

    public function color_update($request,$id){
        $color_data = $this->colorModel()::find($id);
        if($color_data){   
            $color = $this->colorModel()::where('id',$id)->update([
                'color'=>$request->color,
            ]);
            return ['message' => "color data updated!"];
        }
        return ['message' => "color not found"];
    }

    public function color_view($color){
        $data = $this->colorModel()::find($color);
        if($data){
            return ['color' => $data];
        }
        return ['message' => "color not found"];
    }

    public function colorExists($color){
        return $this->colorModel()::find($color);
    }
}
