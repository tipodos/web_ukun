<?php

namespace App\Services;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

class PayPalService
{
    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('paypal.paypal.client_id'),
                config('paypal.paypal.secret')
            )
        );

        $this->apiContext->setConfig(config('paypal.paypal.settings'));
    }

    public function getApiContext()
    {
        return $this->apiContext;
    }
}
