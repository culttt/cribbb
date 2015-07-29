<?php namespace Cribbb\Oauth;

use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use League\OAuth2\Server\Entity\ScopeEntity;
use League\OAuth2\Server\Storage\AbstractStorage;
use League\OAuth2\Server\Entity\AccessTokenEntity;
use League\OAuth2\Server\Storage\AccessTokenInterface;

class AccessTokenStorage extends AbstractStorage implements AccessTokenInterface
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
     * Get an instance of AccessTokenEntity
     *
     * @param string $token
     * @return AccessTokenEntity
     */
    public function get($token)
    {
        $result = $this->db->table('oauth_access_tokens')
                           ->where('oauth_access_tokens.id', $token)
                           ->first();

        if (is_null($result)) {
            return null;
        }

        return (new AccessTokenEntity($this->getServer()))
               ->setId($result->id)
               ->setExpireTime((int)$result->expire_time);
    }

    /**
     * Get the scopes for an access token
     *
     * @param AccessTokenEntity $token
     * @return array ScopeEntity
     */
    public function getScopes(AccessTokenEntity $token)
    {
        $result = $this->db->table('oauth_access_token_scopes')
                           ->select('oauth_scopes.*')
                           ->join('oauth_scopes', 'oauth_access_token_scopes.scope_id', '=', 'oauth_scopes.id')
                           ->where('oauth_access_token_scopes.access_token_id', $token->getId())
                           ->get();

        $scopes = [];

        foreach ($result as $scope) {
            $scopes[] = (new ScopeEntity($this->getServer()))->hydrate([
               'id'           => $scope->id,
                'description' => $scope->description
            ]);
        }

        return $scopes;
    }

    /**
     * Create a new access token
     *
     * @param string $token
     * @param integer $expireTime
     * @param string $sessionId
     * @return void
     */
    public function create($token, $expireTime, $sessionId)
    {
        $this->db->table('oauth_access_tokens')->insert([
            'id'          => $token,
            'expire_time' => $expireTime,
            'session_id'  => $sessionId,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);

        return (new AccessTokenEntity($this->getServer()))
               ->setId($token)
               ->setExpireTime((int)$expireTime);
    }

    /**
     * Associate a scope with an acess token
     *
     * @param AccessTokenEntity
     * @param ScopeEntity
     * @return void
     */
    public function associateScope(AccessTokenEntity $token, ScopeEntity $scope)
    {
        $this->db->table('oauth_access_token_scopes')->insert([
            'access_token_id' => $token->getId(),
            'scope_id'        => $scope->getId(),
            'created_at'      => Carbon::now(),
            'updated_at'      => Carbon::now()
        ]);
    }

    /**
     * Delete an access token
     *
     * @param AccessTokenEntity $token
     * @return void
     */
    public function delete(AccessTokenEntity $token)
    {
        $this->db->table('oauth_access_tokens')
                 ->where('oauth_access_tokens.id', $token->getId())
                 ->delete();
    }
}
