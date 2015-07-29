<?php namespace Cribbb\Oauth;

class Credentials
{
    /**
     * Generate Oauth credentials
     *
     * @return StdClass
     */
    public static function generate()
    {
        $fp      = fopen('/dev/urandom','rb');
        $entropy = fread($fp, 32);
        fclose($fp);
        $entropy .= uniqid(mt_rand(), true);

        $hash = hash('sha512', $entropy);
        $hash = gmp_strval(gmp_init($hash, 16), 62);

        return (object) [
            'key'    => substr($hash, 0, 32),
            'secret' => substr($hash, 32, 48)
        ];
    }
}
