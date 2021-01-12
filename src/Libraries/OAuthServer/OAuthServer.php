<?php

/**
 * @see       https://github.com/codenomdev/oauth2 for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/oauth2/blob/main/LICENSE MIT License
 */

namespace Codenom\OAuth2\Libraries\OAuthServer;

use Heimdall\Heimdall;
use Heimdall\Server\HeimdallAuthorizationServer;
use Heimdall\Server\HeimdallResourceServer;
use Codenom\OAuth2\Libraries\OAuthServer\Repositories\AccessTokenRepository;
use Codenom\OAuth2\Libraries\OAuthServer\Repositories\AuthCodeRepository;
use Codenom\OAuth2\Libraries\OAuthServer\Repositories\ClientRepository;
use Codenom\OAuth2\Libraries\OAuthServer\Repositories\RefreshTokenRepository;
use Codenom\OAuth2\Libraries\OAuthServer\Repositories\ScopeRepository;

abstract class OAuthServer
{

    // function to create a new instance of HeimdallAuthorizationServer
    static function createAuthorizationServer()
    {
        // creating HeimdallAuthorizationServer config
        $config = Heimdall::withAuthorizationConfig(
            new ClientRepository(),
            new AccessTokenRepository(),
            new ScopeRepository(),
            __DIR__ . '/private.key'
        );

        // creating HeimdallAuthorizationServer grant
        $grant = Heimdall::withAuthorizationCodeGrant(
            new AuthCodeRepository(),
            new RefreshTokenRepository()
        );

        // return a new instance of HeimdallAuthorizationServer
        return Heimdall::initializeAuthorizationServer($config, $grant);
    }

    // function to create a new instance of HeimdallResourceServer
    static function createResourceServer()
    {
        // creating HeimdallResourceServer config
        $config = Heimdall::withResourceConfig(
            new AccessTokenRepository(),
            __DIR__ . '/public.key'
        );

        // return a new instance of HeimdallResourceServer
        return Heimdall::initializeResourceServer($config);
    }
}