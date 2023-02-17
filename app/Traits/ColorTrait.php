<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Services\Interfaces\IColorService;

trait ColorTrait
{
	public function __construct(IColorService  $colorService)
	{
		$this->colorService = $colorService;
	}
    
    public function getcolors()
	{
        return $this->colorService->getcolors();
	}

    public function color_store(Request $request)
	{
        return $this->colorService->color_store($request);
	}

    public function color_update(Request $request,$color)
	{
        return $this->colorService->color_update($request,$color);
	}

    public function color_destroy($color)
	{
        return $this->colorService->color_destroy($color);
	}
	
	public function color_view($color)
	{
        return $this->colorService->color_view($color);
	}

}
