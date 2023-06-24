<?php

declare(strict_types=1);

namespace Bitnob\Client\Endpoint;

use Bitnob\Client\HttpClient\Message\ResponseMediator;
use Bitnob\Client\BitnobSdk;

final class Transfer
{
    private BitnobSdk $sdk;
    private string $baseUri;

    public function __construct(BitnobSdk $sdk)
    {
        $this->sdk = $sdk;
        $this->baseUri = '/mobile-payments';
    }

    public function accountResolution(string $bankCode, string $type, string $accountNumber): array
    {
        return ResponseMediator::getContent($this->sdk->getHttpClient()->post("$this->baseUri/account-detail-lookup", [], json_encode(compact('bankCode', 'type', 'accountNumber'))));
    }

    public function transfer(string $bankCode, string $type, string $accountNumber): array
    {
        return ResponseMediator::getContent($this->sdk->getHttpClient()->post("$this->baseUri/initiate", [], json_encode(compact('bankCode', 'type', 'accountNumber'))));
    }

    public function transferPay(string $id, string $reference, string $customerEmail, string $wallet): array
    {
        return ResponseMediator::getContent($this->sdk->getHttpClient()->post("$this->baseUri/pay/$id", [], json_encode(compact('reference', 'customerEmail', 'wallet'))));
    }
}