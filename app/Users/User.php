<?php namespace Cribbb\Users;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * @return BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany('Cribbb\Groups\Group');
    }
}
