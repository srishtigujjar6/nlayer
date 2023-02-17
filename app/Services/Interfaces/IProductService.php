<?php

namespace App\Services\Interfaces;

use App\Http\Requests\V1\Service\GetAllServiceRequest;
use Illuminate\Http\Request;

interface IProductService
{
    public function getproducts();
    public function product_store($request);
    public function product_update($request,$product);
    public function product_destroy($product);
    public function product_view($product);
}
