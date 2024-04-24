<?php
(string) $optionallyUseProductsLoader = ($testCaseType === 'DatabaseTestCase' ? "use ProductsDatabaseLoader;\n"  :'');

return <<<TEMPLATE
<?php declare(strict_types=1);

namespace {$fullyQualifiedNamespace};

use AutomatedEmails\Original\Tests\DataProviderLoader;
use AutomatedEmails\App\Tests\FilterAssertions;
use AutomatedEmails\App\Tests\OfferAssertions;
use AutomatedEmails\App\Tests\CouponComponents;
use AutomatedEmails\App\Tests\ProductsDatabaseLoader;
use AutomatedEmails\Original\Tests\DatabaseTestCase;
use WP_UnitTestCase;

Class {$typeName} extends {$testCaseType}
{
    use DataProviderLoader;
    use FilterAssertions;
    use OfferAssertions;    

    public function test_()
    {

    }
}
TEMPLATE;
