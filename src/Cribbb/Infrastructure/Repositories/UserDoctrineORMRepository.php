<?php namespace Cribbb\Infrastructure\Repositories;

use Doctrine\ORM\EntityRepository;
use Cribbb\Domain\Model\Identity\UserRepository;

class UserDoctrineORMRepository extends EntityRepository implements UserRepository {}
