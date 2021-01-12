<?php

/**
 * @see       https://github.com/codenomdev/oauth2 for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/oauth2/blob/main/LICENSE MIT License
 */

namespace Codenom\OAuth2\Libraries\OAuthServer\Repositories;

use Codenom\OAuth2\Libraries\OAuthServer\Entities\ClientEntity;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{

    // change this to your authorization url
    const REDIRECT_URI = 'https://oauth.pstmn.io/v1/callback';

    public function getClientEntity($clientIdentifier)
    {
        $client = new ClientEntity();
        $client->setIdentifier($clientIdentifier);
        $client->setName(getenv('app.name'));
        $client->setRedirectUri(ClientRepository::REDIRECT_URI);
        $client->setConfidential();
        return $client;
    }

    public function validateClient($clientIdentifier, $clientSecret, $grantType)
    {
        $clients = [
            'test' => [
                'secret'          => password_hash('test123', PASSWORD_BCRYPT),
                'name'            => getenv('app.name'),
                'redirect_uri'    => ClientRepository::REDIRECT_URI,
                'is_confidential' => true,
            ],
        ];

        if(array_key_exists($clientIdentifier, $clients) === false) {
            return false;
        }

        if (
            $clients[$clientIdentifier]['is_confidential'] === true
            && password_verify($clientSecret, $clients[$clientIdentifier]['secret']) === false
        ) {
            return false;
        }

        return true;
    }
}