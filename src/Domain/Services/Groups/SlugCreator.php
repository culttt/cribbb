<?php namespace Cribbb\Domain\Services\Groups;

use Cribbb\Domain\Model\Groups\Name;
use Cribbb\Domain\Model\Groups\Slug;
use Illuminate\Support\Str;

class SlugCreator
{
    /**
     * Create a Slug from a Name
     *
     * @param Name $name
     * @return Slug
     */
    public function create(Name $name)
    {
        return new Slug(Str::slug($name->toString()));
    }
}
