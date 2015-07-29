<?php namespace Cribbb\Http\Controllers;

use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Exception\OAuthException;

class OauthController extends Controller
{
    /**
     * @var AuthorizationServer
     */
    private $server;

    /**
     * @var AuthorizationServer $server
     * @return void
     */
    public function __construct(AuthorizationServer $server)
    {
        $this->server = $server;
    }

    /**
     * Authenticate via the Access Token Grant
     *
     * @return JsonResponse
     */
    public function accessToken()
    {
        try {
            $response = $this->server->issueAccessToken();

            return response()->json($response);
        }

        catch (OAuthException $e) {
            $error   = $e->errorType;
            $message = $e->getMessage();
            $code    = $e->httpStatusCode;
            $headers = $e->getHttpHeaders();

            return response()->json(compact('error', 'message'), $code, $headers);
        }
    }
}
