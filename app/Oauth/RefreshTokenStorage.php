<?php namespace Cribbb\Oauth;

use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use League\OAuth2\Server\Storage\AbstractStorage;
use League\OAuth2\Server\Entity\RefreshTokenEntity;
use League\OAuth2\Server\Storage\RefreshTokenInterface;

class RefreshTokenStorage extends AbstractStorage implements RefreshTokenInterface
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
     * Return a new instance of RefreshTokenEntity
     *
     * @param string $token
     * @return RefreshTokenEntity
     */
    public function get($token)
    {
        $result = $this->db->table('oauth_refresh_tokens')
                ->where('oauth_refresh_tokens.id', $token)
                ->where('oauth_refresh_tokens.expire_time', '>=', time())
                ->first();

        if (is_null($result)) {
            return;
        }

        return (new RefreshTokenEntity($this->getServer()))
               ->setId($result->id)
               ->setAccessTokenId($result->access_token_id)
               ->setExpireTime((int)$result->expire_time);
    }

    /**
     * Create a new refresh token_name
     *
     * @param string $token
     * @param integer $expireTime
     * @param string $accessToken
     * @return RefreshTokenEntity
     */
    public function create($token, $expireTime, $accessToken)
    {
        $this->db->table('oauth_refresh_tokens')->insert([
            'id'              => $token,
            'expire_time'     => $expireTime,
            'access_token_id' => $accessToken,
            'created_at'      => Carbon::now(),
            'updated_at'      => Carbon::now()
        ]);

        return (new RefreshTokenEntity($this->getServer()))
               ->setId($token)
               ->setAccessTokenId($accessToken)
               ->setExpireTime((int)$expireTime);
    }

    /**
     * Delete the refresh token
     *
     * @param RefreshTokenEntity $token
     * @return void
     */
    public function delete(RefreshTokenEntity $token)
    {
        $this->db->table('oauth_refresh_tokens')
                 ->where('id', $token->getId())
                 ->delete();
    }
}
