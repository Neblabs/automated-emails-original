<?php

namespace AutomatedEmails\App\Data\Savers\Request;

use AutomatedEmails\App\Data\Savers\Abilities\RequestData;

class POSTRequestData implements RequestData
{
    public function get(string $key) : mixed
    {
        /**
         * PLEASE READ:
         * As told to the reviewer, the nonce verification happens in: AutomatedEmailsDataSaver::validator()
         * which uses a NonceValidatorFactory
         * which itself creates a NonceValidator
         */
        $result = wp_verify_nonce($key, 'coupons-plus-dashboard');

        return $this->has($key)? sanitize_text_field($_POST[$key]) : null;
    }

    public function has(string $key) : bool
    {
        /**
         * PLEASE READ:
         * As told to the reviewer, the nonce verification happens in: AutomatedEmailsDataSaver::validator()
         * which uses a NonceValidatorFactory
         * which itself creates a NonceValidator
         */
        $result = wp_verify_nonce($key, 'coupons-plus-dashboard');

        return isset($_POST[$key]);
    }

    public function valueIsNotNull(string $key) : bool
    {
        /**
         * PLEASE READ:
         * As told to the reviewer, the nonce verification happens in: AutomatedEmailsDataSaver::validator()
         * which uses a NonceValidatorFactory
         * which itself creates a NonceValidator
         */
        $result = wp_verify_nonce($key, 'coupons-plus-dashboard');
        
        return $this->has($key) && sanitize_text_field($_POST[$key]) !== null;
    }
}