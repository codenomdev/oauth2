<?php

/**
 * @see       https://github.com/codenomdev/oauth2 for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/oauth2/blob/main/LICENSE MIT License
 */

$routes->get('rest/authorize', 'Authorization::authorize', ['namespace' => 'Codenom\OAuth2\Controllers\Rest']);

$routes->post('rest/token', 'Authorization::token', ['namespace' => 'Codenom\OAuth2\Controllers\Rest']);