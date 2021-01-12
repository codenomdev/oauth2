<?php

/**
 * @see       https://github.com/codenomdev/oauth2 for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/oauth2/blob/main/LICENSE MIT License
 */

namespace Codenom\OAuth2\Libraries\OAuthServer\Entities;

use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\UserEntityInterface;

class UserEntity implements UserEntityInterface
{
    use EntityTrait;

    public function __construct($identifier = 1)
    {
        $this->setIdentifier($identifier);
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }
}