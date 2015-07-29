<?php namespace Cribbb\Oauth;

use Illuminate\Database\DatabaseManager;
use League\OAuth2\Server\Entity\ScopeEntity;
use League\OAuth2\Server\Storage\ScopeInterface;
use League\OAuth2\Server\Storage\AbstractStorage;

class ScopeStorage extends AbstractStorage implements ScopeInterface
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
     * Return information about a scope
     *
     * @param string $scope
     * @param string $grantType
     * @param string $clientId
     * @return ScopeEntity
     */
    public function get($scope, $grantType = null, $clientId = null)
    {
        $result = $this->db->table('oauth_scopes')
                           ->where('id', $scope)
                           ->get();

        if (count($result) === 0) {
            return;
        }

        return (new ScopeEntity($this->server))->hydrate([
            'id'          => $result->id,
            'description' => $result->description,
        ]);
    }
}
