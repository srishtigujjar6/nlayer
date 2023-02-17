<?php

namespace App\Services\Interfaces;

use App\Http\Requests\V1\Service\GetAllServiceRequest;

interface ICategoryService
{
    public function getcategories();
    public function category_store($request);
    public function category_update($request,$category);
    public function category_destroy($category);
    public function category_view($category);
}
    