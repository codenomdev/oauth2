<?php

/**
 * @see       https://github.com/codenomdev/oauth2 for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/oauth2/blob/main/LICENSE MIT License
 */

namespace Codenom\OAuth2\Controllers\Rest;

use Heimdall\Interfaces\AuthorizationController;
use App\Controllers\BaseController;
use Codenom\OAuth2\Libraries\OAuthServer\Entities\UserEntity;
use Codenom\OAuth2\Libraries\OAuthServer\OAuthServer;
use Exception;

class Authorization extends BaseController implements AuthorizationController
{

    private $heimdall;

    function __construct()
    {
        // get a new instance of HeimdallAuthorizationServer
        $this->heimdall = OAuthServer::createAuthorizationServer();

        // bootsrap heimdall with the codeigniter's request & response
        $this->heimdall->bootstrap($this->request, $this->response);
    }

    // authorization code generation endpoint
    function authorize()
    {
        try {
            $authRequest = $this->heimdall->validateAuth();
            $authRequest->setUser(new UserEntity());
            $this->heimdall->completeAuth($authRequest);
        } catch (Exception $exception) {
            $this->heimdall->handleException($exception);
        }
    }

    // access token generation endpoint
    public function token()
    {
        // echo 'pk';
        try {
            $this->heimdall->createToken();
        } catch (Exception $exception) {
            $this->heimdall->handleException($exception);
        }
    }
}