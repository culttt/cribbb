<?php namespace Cribbb\Oauth;

use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use League\OAuth2\Server\Entity\ScopeEntity;
use League\OAuth2\Server\Entity\AuthCodeEntity;
use League\OAuth2\Server\Storage\AbstractStorage;
use League\OAuth2\Server\Storage\AuthCodeInterface;

class AuthCodeStorage extends AbstractStorage implements AuthCodeInterface
{
    /**
     * @var DatabaseManager
     */
    private $db;

    /**
     * @var DatabaseManager $db
     * @return void
     */
    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
    }

    /**
     * Get the auth code
     *
     * @param string $code
     * @return AuthCodeEntity
     */
    public function get($code)
    {
        $result = $this->db->table('oauth_auth_codes')
                           ->where('oauth_auth_codes.id', $code)
                           ->where('oauth_auth_codes.expire_time', '>=', time())
                           ->first();

        if (is_null($result)) {
            return;
        }

        return (new AuthCodeEntity($this->getServer()))
            ->setId($result->id)
            ->setRedirectUri($result->redirect_uri)
            ->setExpireTime((int)$result->expire_time);
    }

    /**
     * Create an auth code
     *
     * @param string $token
     * @param integer $expireTime
     * @param integer $sessionId
     * @param string  $redirectUri
     * @return void
     */
    public function create($token, $expireTime, $sessionId, $redirectUri)
    {
        $this->db->table('oauth_auth_codes')->insert([
            'id'           => $token,
            'session_id'   => $sessionId,
            'redirect_uri' => $redirectUri,
            'expire_time'  => $expireTime,
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now()
        ]);
    }

    /**
     * Get the scopes for an access token
     *
     * @param AuthCodeEntity $token
     * @return array ScopeEntity
     */
    public function getScopes(AuthCodeEntity $token)
    {
        $result = $this->db->table('oauth_auth_code_scopes')
                           ->select('oauth_scopes.*')
                           ->join('oauth_scopes', 'oauth_auth_code_scopes.scope_id', '=', 'oauth_scopes.id')
                           ->where('oauth_auth_code_scopes.auth_code_id', $token->getId())
                           ->get();

        $scopes = [];

        foreach ($result as $scope) {
            $scopes[] = (new ScopeEntity($this->getServer()))->hydrate([
                'id'          => $scope->id,
                'description' => $scope->description
            ]);
        }

        return $scopes;
    }

    /**
     * Associate a scope with an acess token
     *
     * @param AuthCodeEntity $token
     * @param ScopeEntity $scope
     * @return void
     */
    public function associateScope(AuthCodeEntity $token, ScopeEntity $scope)
    {
        $this->db->table('oauth_auth_code_scopes')->insert([
            'auth_code_id' => $token->getId(),
            'scope_id'     => $scope->getId(),
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now()
        ]);
    }

    /**
     * Delete an access token
     *
     * @param AuthCodeEntity $token
     * @return void
     */
    public function delete(AuthCodeEntity $token)
    {
        $this->db->table('oauth_auth_codes')
                 ->where('oauth_auth_codes.id', $token->getId())
                 ->delete();
    }
}
