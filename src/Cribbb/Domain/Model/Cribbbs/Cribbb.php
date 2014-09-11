<?php namespace Cribbb\Domain\Model\Cribbbs;

use Cribbb\HasEvents;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="cribbbs")
 * @ORM\entity(repositoryClass="Cribbb\Domain\Model\Cribbbs\CribbbRepository")
 */
class Cribbb
{
    use HasEvents;

    /**
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @ORM\Column(type="string")
     */
    private $owner;

    /**
     * Create a new Cribbb
     *
     * @return void
     */
    private function __construct(CribbbId $id, $name, $slug, $owner)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setSlug($slug);
        $this->setOwner($owner);
    }

    /**
     * Create a new Cribbb
     *
     */
    public static function create(CribbbId $id, $name, $slug, $owner)
    {
        return new Cribbb($id, $name, $slug, $owner);
    }

    public function id()
    {
        return $this->id;
    }

    /**
     * Set the Id
     *
     * @param CribbbId $id
     * @return void
     */
    private function setId(CribbbId $cribbbId)
    {
        $this->id = $id;
    }

    public function name()
    {
        return $this->name;
    }

    private function setName($name)
    {
        $this->name = $name;
    }

    public function slug()
    {
        return $this->slug;
    }

    private function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function owner()
    {
        return $this->owner;
    }

    private function setOwner($owner)
    {
        $this->owner = $owner;
    }

}
