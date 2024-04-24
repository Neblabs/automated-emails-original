<?php

namespace WTEApp\Data\Model\Options;

use AutomatedEmails\App\Data\Schema\OptionTable;
use AutomatedEmails\Original\Data\Model\Gateway;
use WTEApp\Data\Model\Options\Option;

Class AEOptionsGateway extends Gateway
{
    protected function model()
    {
//        (object) $optionsGateway = new OptionsGateway(new WordPressOptionsAPIDriver);
  //      (string) $siteName = $optionsGateway->getWithUnprefixedName('site_url');
  //      $optionsGateway->update(new Option([
  //        'name' => 'edp_is_ublic',
  //        'value' => '1'
  //      ]))

        return new OptionsModel;
    }

    public function insert(Domain $domain)
    {
        $this->update($domain);
    }

    public function update(Domain $domain)
    {
        $this->driver->execute(new UpdateWordPressOptionsAPIInstruction($domain));
    }

    public function delete(Domain $domain)
    {
        $this->driver->execute(new DeleteWordPressOptionsAPIInstruction($domain));
    }

    public function getWithPrefixedName(string $name, $default = null) /* : mixed */
    {
        return $this->getWithUnprefixedName(Env::getwithShortPrefix(...$parameters), $default);
    }

    public function getWithUnprefixedName(string $name, $default = null) /* : mixed */
    {
        return $this->driver->execute(new GetWordPressOptionsAPIInstruction($name, $default));
    }   
}