<?php namespace Cribbb\Oauth;

use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use League\OAuth2\Server\Entity\ClientEntity;
use League\OAuth2\Server\Entity\SessionEntity;
use League\OAuth2\Server\Storage\AbstractStorage;
use League\OAuth2\Server\Storage\ClientInterface;

class ClientStorage extends AbstractStorage implements ClientInterface
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
     * Validate a client
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param string $redirectUri
     * @param string $grantType
     * @return ClientEntity
     */
    public function get($clientId, $clientSecret = null, $redirectUri = null, $grantType = null)
    {
        $query = null;

        if (! is_null($redirectUri) && is_null($clientSecret)) {
            $query = $this->db->table('oauth_clients')
                   ->select(
                       'oauth_clients.id as id',
                       'oauth_clients.secret as secret',
                       'oauth_client_endpoints.redirect_uri as redirect_uri',
                       'oauth_clients.name as name')
                   ->join('oauth_client_endpoints', 'oauth_clients.id', '=', 'oauth_client_endpoints.client_id')
                   ->where('oauth_clients.id', $clientId)
                   ->where('oauth_client_endpoints.redirect_uri', $redirectUri);
        } elseif (! is_null($clientSecret) && is_null($redirectUri)) {
            $query = $this->db->table('oauth_clients')
                   ->select(
                       'oauth_clients.id as id',
                       'oauth_clients.secret as secret',
                       'oauth_clients.name as name')
                   ->where('oauth_clients.id', $clientId)
                   ->where('oauth_clients.secret', $clientSecret);
        } elseif (! is_null($clientSecret) && ! is_null($redirectUri)) {
            $query = $this->db->table('oauth_clients')
                   ->select(
                       'oauth_clients.id as id',
                       'oauth_clients.secret as secret',
                       'oauth_client_endpoints.redirect_uri as redirect_uri',
                       'oauth_clients.name as name')
                   ->join('oauth_client_endpoints', 'oauth_clients.id', '=', 'oauth_client_endpoints.client_id')
                   ->where('oauth_clients.id', $clientId)
                   ->where('oauth_clients.secret', $clientSecret)
                   ->where('oauth_client_endpoints.redirect_uri', $redirectUri);
        }


        $result = $query->first();

        if (is_null($result)) {
            return;
        }

        return $this->hydrateEntity($result);
    }

    /**
     * Get the client associated with a session
     *
     * @param SessionEntity $session
     * @return ClientEntity
     */
    public function getBySession(SessionEntity $session)
    {
        $result = $this->db->table('oauth_clients')
                ->select(
                    'oauth_clients.id as id',
                    'oauth_clients.secret as secret',
                    'oauth_clients.name as name')
                ->join('oauth_sessions', 'oauth_sessions.client_id', '=', 'oauth_clients.id')
                ->where('oauth_sessions.id', '=', $session->getId())
                ->first();

        if (is_null($result)) {
            return;
        }

        return $this->hydrateEntity($result);
    }

    /**
     * Create a client
     *
     * @param string $name
     * @param string $id
     * @param string $secret
     * @return int
     */
    public function create($name, $id, $secret)
    {
        return $this->db->table('oauth_clients')->insertGetId([
            'id'         => $id,
            'name'       => $name,
            'secret'     => $secret,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }

    /**
     * Hydrate a ClientEntity
     *
     * @param $result
     * @return ClientEntity
     */
    protected function hydrateEntity($result)
    {
        $client = new ClientEntity($this->getServer());

        $client->hydrate([
            'id'          => $result->id,
            'name'        => $result->name,
            'secret'      => $result->secret,
            'redirectUri' => (isset($result->redirect_uri) ? $result->redirect_uri : null)
        ]);

        return $client;
    }
}
