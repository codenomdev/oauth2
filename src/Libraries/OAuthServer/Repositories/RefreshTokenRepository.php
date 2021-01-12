<?php

/**
 * @see       https://github.com/codenomdev/oauth2 for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/oauth2/blob/main/LICENSE MIT License
 */

namespace Codenom\OAuth2\Libraries\OAuthServer\Repositories;

use Codenom\OAuth2\Libraries\OAuthServer\Entities\RefreshTokenEntity;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;

class RefreshTokenRepository implements RefreshTokenRepositoryInterface
{

    public function persistNewRefreshToken(RefreshTokenEntityInterface $refreshTokenEntity)
    {
        // Some logic to persist the refresh token in a database
    }

    public function revokeRefreshToken($tokenId)
    {
        // Some logic to revoke the refresh token in a database
    }

    public function isRefreshTokenRevoked($tokenId)
    {
        return false; // The refresh token has not been revoked
    }

    public function getNewRefreshToken()
    {
        return new RefreshTokenEntity();
    }
}