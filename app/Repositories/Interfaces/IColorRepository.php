<?php

namespace App\Repositories\Interfaces;

interface IColorRepository 
{
    public function getcolors();
    public function color_store($request);
    public function color_update($request,$color);
    public function color_destroy($color);
    public function color_view($color);
}
