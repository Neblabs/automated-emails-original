<?php

namespace AutomatedEmails\App\Domain\Events\Supporteddata;

/**
 * This interface must be extended.
 *
 * The name of the extending interface in lowercase will be used 
 * by a Event to retreive the DataSet.
 *
 * For example, for a Posts interface:
 *  
 *      interface Posts extends EventDataSet {...}
 *
 *      The Event instance will use a posts() method to retrieve
 *      the DataSet
 * 
 * 
 */
interface EventDataSet
{
    /* 
        Eg:
        
        public function postsData() : PostsData;
        public function postsDataType() : PostDataType;    
     */
}