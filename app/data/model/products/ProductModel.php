<?php

namespace AutomatedEmails\App\Data\Model\Products;

use AutomatedEmails\App\Data\Model\ProductsTable;
use AutomatedEmails\Original\Data\Schema\DatabaseTable;
use AutomatedEmails\App\Data\Model\Products\Product;
use AutomatedEmails\App\Data\Model\Products\Products;
use AutomatedEmails\Original\Data\Model\Model;

Class ProductModel extends Model
{
    public function getDomainClass() : string
    {
        return Product::class;
    }

    public function getDomainsClass() : string
    {
        return Products::class;
    }

    public function getTable() : DatabaseTable
    {
        return new ProductsTable;
    }
}