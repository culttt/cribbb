<?php namespace Cribbb\Domain\Model\Identity\Events;

use BigName\EventDispatcher\Event;

class UserHasRegistered implements Event {

  public function getName()
  {
    return 'UserHasRegistered';
  }

}
