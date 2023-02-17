<?php

namespace App\Repositories\Interfaces;

interface IProductRepository 
{
    public function getproducts($products);
    public function product_store($request);
    public function product_update($request,$product);
    public function product_destroy($product);
    public function product_view($product);

}
