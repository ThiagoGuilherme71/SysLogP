<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VersaoSistema extends Model
{
    use HasFactory;
    const URI_ALL_VERSION = 'https://sigv-dev.salvador.ba.gov.br/api/versao-sistema/6';
    const URI_LAST_VERSION = 'https://sigv-dev.salvador.ba.gov.br/api/ultima-versao-sistema/6';

    public static function getLastSystemVersion()
    {
        $httpGuzzle = new Client();

        try {
            $response = $httpGuzzle->request('GET', self::URI_LAST_VERSION);

            if ($response->getStatusCode() == 200) {
                $result = json_decode((string)$response->getBody(), true);

                if (isset($result['data']) && is_array($result['data']) && count($result['data']) > 0) {
                    return $result['data'][0];
                }
            }
        } catch (\Exception $e) {
            \Log::error($e);
        }

        return "-";
    }

    public static function getAllSystemVersions ()
    {
        $httpGuzzle = new Client();

        try {
            $response = $httpGuzzle->request('GET', self::URI_ALL_VERSION);

            if ($response->getStatusCode() == 200) {
                $result = json_decode((string)$response->getBody(), true);

                if (isset($result['data']) && is_array($result['data']) && count($result['data']) > 0) {
                    return $result['data'];
                }
            }
        } catch (\Exception $e) {
            \Log::error($e);
        }

        return "-";
    }
}
