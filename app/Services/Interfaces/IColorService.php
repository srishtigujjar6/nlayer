<?php

namespace App\Services\Interfaces;

use App\Http\Requests\V1\Service\GetAllServiceRequest;

interface IColorService
{
    public function getcolors();
    public function color_store($request);
    public function color_update($request,$color);
    public function color_destroy($color);
    public function color_view($color);
}
