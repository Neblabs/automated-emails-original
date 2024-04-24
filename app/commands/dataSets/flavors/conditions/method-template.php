<?php
(string) $TrueOrFalse = $this->dataSetKey === 'p' ? 'True' : 'False';

return <<<TEMPLATE
/**
    * @dataProvider {$providerName}
    */
    public function {$methodName}(array \$inTheDatabase, array \$conditionOptions)
    {
        \$this->createProductsAndTheirData(\$inTheDatabase);

        \$this->assert{$TrueOrFalse}();
    }
TEMPLATE;
