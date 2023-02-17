<?php

namespace App\Repositories\Interfaces;

interface ICategoryRepository 
{
    public function getcategories();
    public function category_store($request);
    public function category_update($request,$category);
    public function category_destroy($category);
    public function category_view($category);
}
