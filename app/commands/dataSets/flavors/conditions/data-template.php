<?php

return <<<TEMPLATE
/* 
    | ------------------------------------------------------------
    |
    |  Condition {$this->getFullDataSetKey()->upperCaseFirst()}
    |
    | ------------------------------------------------------------
    */
    '{$this->getFullDataSetKey()}' => [
        '' => [
            \$inTheDatabase = [
                'products' => [
                ],
                'coupons' => [
                ],
                'orders' => [
                ],
                'users' => [
                ]
            ],
            \$conditionOptions = [
            ]
        ],
    ], // always leave this comma
TEMPLATE;
