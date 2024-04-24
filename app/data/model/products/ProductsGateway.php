<?php

namespace AutomatedEmails\App\Data\Model\Products;

use AutomatedEmails\App\Data\Model\Products\ProductModel;
use AutomatedEmails\Original\Data\Schema\DatabaseTable;
use AutomatedEmails\App\Data\Model\ProductsTable;
use AutomatedEmails\App\Data\Model\Products\Product;
use AutomatedEmails\Original\Data\Model\Gateway;

Class ProductsGateway extends WordPressPostGateway
{
    protected function createCreatorMapper() : CreatorMapper
    {
        return new ProductDatabasePostTypeCreatorMapper(new EventsCreatorMapper);
    }

    protected function createDestructurerMapper() : DestructurerMapper
    {
        return new ProductDatabasePostTypeDestructurerMapper;
    }
    
    public function findWithId($id) : Collection
    {
        return $this->productsGateway->findTheLatest10();
        ///
        ///
        ///
        ///
        ///
        (object) $wordPressPostAPIDriver = new WordPressPostAPIDriver;
        (object) $productsGateway = new ProductsFinder($wordPressPostAPIDriver);

        (object) $products = $productsGateway->findTheLatest10();

        // drivers:
        // default worrdpress api driver (uses wp_query, update_post(), insert_post())
        // woocomerce api driver (uses wc_product_query)
        // wordpres post to wordpress database driver (converts the wp arguments to raw sql statements)
        // cache driver that falls back to another driver
        return $this->executeInstruction(new WordPressPostWPQueryGETInstruction([
            'id' => $id,
            'post_type' => $this->schema->getName()
        ]));
    }   

}