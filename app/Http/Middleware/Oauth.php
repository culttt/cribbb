<?php namespace Cribbb\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use League\OAuth2\Server\ResourceServer;
use League\OAuth2\Server\Exception\OAuthException;

class Oauth
{
    /**
     * @var ResourceServer
     */
    private $server;

    /**
     * @param ResourceServer $server
     * @return void
     */
    public function __construct(ResourceServer $server)
    {
        $this->server = $server;
    }

    /**
     * Handle an incoming request
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, Closure $next)
    {
        try {
            $this->server->isValidRequest();

            return $next($request);
        }

        catch (OAuthException $e) {
            return new JsonResponse([
                'error'   => $e->errorType,
                'message' => $e->getMessage()
            ], $e->httpStatusCode, $e->getHttpHeaders());
        }
    }
}
