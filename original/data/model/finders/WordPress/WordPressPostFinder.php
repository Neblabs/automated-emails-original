<?php

namespace AutomatedEmails\Original\Data\Model\Finders\Wordpress;

use AutomatedEmails\Original\Data\Drivers\Abilities\ReadableDriver;
use AutomatedEmails\Original\Data\Drivers\Wordpress\WordPressPostReadableDriver;
use AutomatedEmails\Original\Data\Model\Finder;
use AutomatedEmails\Original\Data\Query\Parameters;

class WordPressPostFinder extends Finder
{
    // $this->postsFinder->with()->id(78)->find();
    // $this->postsFinder->withId(78)->findIt();
    // $this->postsFinder->withType('product')->findThem();
    // 
    // $this->postMetaFinder->forPost($post)->findThem();
    // $this->postMetaFinder->forPostWithKey($post, 'key')->findIt();
    public function withId(int $id) : static
    {
        $this->parameters->addQueryArguments(
            //ID: $id
        );

        return $this;
    }
}
