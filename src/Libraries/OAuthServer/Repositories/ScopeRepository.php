<?php

/**
 * @see       https://github.com/codenomdev/oauth2 for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/oauth2/blob/main/LICENSE MIT License
 */

namespace Codenom\OAuth2\Libraries\OAuthServer\Repositories;

use Codenom\OAuth2\Libraries\OAuthServer\Entities\ScopeEntity;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;

class ScopeRepository implements ScopeRepositoryInterface
{

    public function getScopeEntityByIdentifier($scopeIdentifier)
    {
        $scopes = [
            'basic' => [
                'description' => 'Basic information'
            ],
            'email' => [
                'description' => 'Your email address',
            ],
        ];
        if (array_key_exists($scopeIdentifier, $scopes) === false) return null;
        $scope = new ScopeEntity();
        $scope->setIdentifier($scopeIdentifier);
        return $scope;
    }

    public function finalizeScopes(
        array $scopes,
        $grantType,
        ClientEntityInterface $clientEntity,
        $userIdentifier = null
    ) {
        if ((int) $userIdentifier === 1) {
            $scope = new ScopeEntity();
            $scope->setIdentifier('email');
            $scopes[] = $scope;
        }
        return $scopes;
    }
}