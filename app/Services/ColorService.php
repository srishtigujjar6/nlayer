<?php

namespace App\Services;

use App\Repositories\Interfaces\IColorRepository;
use App\Services\Interfaces\IColorService;
use Validator;

class ColorService implements IColorService
{
    private $colorRepository;

    public function __construct(IColorRepository $colorRepository) {
        $this->colorRepository = $colorRepository;
    }

    public function validate_request($request)
	{
        return Validator::make($request->all(),[
            'color' => 'required|unique:colors',
        ]);
	}

    public function getcolors()
    {
        $service = $this->colorRepository->getcolors();
        return $service;
    }

    public function color_store($request)
	{
        $validator = $this->validate_request($request);
        if($validator->fails()){
            return ['error'=>$validator->messages(), 'message'=> 'Input error'];
        }
        return $this->colorRepository->color_store($request);
	}

    public function color_update($request,$color)
	{
        $validator = $this->validate_request($request);
        if($validator->fails()){
            return ['data'=>$validator->messages(), 'message'=> 'Input error'];
        }
        return $this->colorRepository->color_update($request,$color);
	}

    public function color_destroy($color)
	{
        return $this->colorRepository->color_destroy($color);
	}

    public function color_view($color)
	{
        return $this->colorRepository->color_view($color);
	}
    
}
