<?php

namespace Swapnilsarwe\NovaIcndbCard;

use JsonException;
use Swapnilsarwe\NovaIcndbCard\Exceptions\APIUnavailableException;

class IcndbClient
{
    private static $url = 'https://api.chucknorris.io/jokes/random';

    /**
     * Does the execution of request
     * @return string the response value
     * @throws APIUnavailableException|JsonException
     */
    public function get(): string
    {
        $ch = curl_init(static::$url);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
        ]);

        $resp = curl_exec($ch);

        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($status !== 200 || $resp === '') {
            throw new APIUnavailableException('API Unreachable');
        }

        // escaped characters
        $resp = str_replace('\\', '', $resp);

        $body = json_decode($resp, false, 512, JSON_THROW_ON_ERROR);

        if ($body->type !== 'success') {
            throw new APIUnavailableException('API Failed');
        }

        return $body->value;
    }
}
