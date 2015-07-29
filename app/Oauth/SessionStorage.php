<?php namespace Cribbb\Oauth;

use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use League\OAuth2\Server\Entity\ScopeEntity;
use League\OAuth2\Server\Entity\SessionEntity;
use League\OAuth2\Server\Entity\AuthCodeEntity;
use League\OAuth2\Server\Storage\AbstractStorage;
use League\OAuth2\Server\Entity\AccessTokenEntity;
use League\OAuth2\Server\Storage\SessionInterface;

class SessionStorage extends AbstractStorage implements SessionInterface
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
     * Get a session from an access token
     *
     * @param AccessTokenEntity $accessToken
     * @return SessionEntity
     */
    public function getByAccessToken(AccessTokenEntity $accessToken)
    {
        $result = $this->db->table('oauth_sessions')
                ->select('oauth_sessions.*')
                ->join('oauth_access_tokens', 'oauth_sessions.id', '=', 'oauth_access_tokens.session_id')
                ->where('oauth_access_tokens.id', $accessToken->getId())
                ->first();

        if (is_null($result)) {
            return;
        }

        return (new SessionEntity($this->getServer()))
               ->setId($result->id)
               ->setOwner($result->owner_type, $result->owner_id);
    }

    /**
     * Get a session from an auth code
     *
     * @param AuthCodeEntity $authCode
     * @return SessionEntity
     */
    public function getByAuthCode(AuthCodeEntity $authCode)
    {
        $result = $this->db->table('oauth_sessions')
            ->select('oauth_sessions.*')
            ->join('oauth_auth_codes', 'oauth_sessions.id', '=', 'oauth_auth_codes.session_id')
            ->where('oauth_auth_codes.id', $authCode->getId())
            ->first();

        if (is_null($result)) {
            return;
        }

        return (new SessionEntity($this->getServer()))
               ->setId($result->id)
               ->setOwner($result->owner_type, $result->owner_id);
    }

    /**
     * Get a session's scopes
     *
     * @param SessionEntity
     * @return array
     */
    public function getScopes(SessionEntity $session)
    {
        $result = $this->db->table('oauth_session_scopes')
                  ->select('oauth_scopes.*')
                  ->join('oauth_scopes', 'oauth_session_scopes.scope_id', '=', 'oauth_scopes.id')
                  ->where('oauth_session_scopes.session_id', $session->getId())
                  ->get();

        $scopes = [];

        foreach ($result as $scope) {
            $scopes[] = (new ScopeEntity($this->getServer()))->hydrate([
                'id' => $scope->id,
                'description' => $scope->description,
            ]);
        }

        return $scopes;
    }

    /**
     * Create a new session
     *
     * @param string $ownerType
     * @param string $ownerId
     * @param string $clientId
     * @param string $clientRedirectUri
     * @return integer
     */
    public function create($ownerType, $ownerId, $clientId, $clientRedirectUri = null)
    {
        return $this->db->table('oauth_sessions')->insertGetId([
            'client_id'  => $clientId,
            'owner_type' => $ownerType,
            'owner_id'   => $ownerId,
            'client_redirect_uri' => $clientRedirectUri,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }

    /**
     * Associate a scope with a session
     *
     * @param SessionEntity $session
     * @param ScopeEntity $scope
     * @return void
     */
    public function associateScope(SessionEntity $session, ScopeEntity $scope)
    {
        $this->db->table('oauth_session_scopes')->insert([
            'session_id' => $session->getId(),
            'scope_id'   => $scope->getId(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
