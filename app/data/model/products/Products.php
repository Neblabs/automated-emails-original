<?php

namespace AutomatedEmails\App\Data\Model\Products;

use AutomatedEmails\Original\Data\Model\Domains;
use AutomatedEmails\App\Data\Model\Products\Product;

Class Products extends Domains
{
    protected function getDomainClass() : string
    {
        return Product::class;
    }
}