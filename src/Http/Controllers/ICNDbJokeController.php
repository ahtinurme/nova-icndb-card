<?php

namespace Swapnilsarwe\NovaIcndbCard\Http\Controllers;

use Illuminate\Support\Str;
use Swapnilsarwe\NovaIcndbCard\IcndbClient;

class ICNDbJokeController
{
    private $icndbClient;

    public function __construct()
    {
        $this->icndbClient = new IcndbClient();
    }

    public function __invoke()
    {
        $url = url()->current();
        if (Str::endsWith($url, 'random')) {
            $response = $this->icndbClient->random()->get();

            return (count($response) > 0) ? $response->value : '';
        }
        abort(404);
    }
}
