<?php

namespace AutomatedEmails\App\Data\Savers;

use AutomatedEmails\App\Data\Savers\Abilities\RequestData;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\System\Functions\GlobalFunctionWrapper;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\PassingValidator;

class WordPressPostSaverComposite extends WordPressPostSaver
{
    public function __construct(
        protected Collection /*<WordPressPostSaver>*/ $wordpressPostSavers,
    ) {}
    
    public function save(RequestData $data)
    {
        $this->wordpressPostSavers->perform(setPost: $this->post)
                                  ->filter(fn(WordPressPostSaver $wordPressPostSaver) => $wordPressPostSaver->canBeSaved($data)->isValid())
                                  ->perform(save: $data);
    } 

    public function canBeSaved(RequestData $data): Validator
    {
        return new PassingValidator;
    } 
}