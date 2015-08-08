<?php namespace Cribbb\Groups;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('Cribbb\Users\User');
    }
}
