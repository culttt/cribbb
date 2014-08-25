<?php namespace Cribbb;

trait HasEvents {

  /**
   * @var array
   */
  private $pendingEvents;

  /**
   * Add an event to the pending events
   *
   * @param $event
   * @return void
   */
  public function raiseEvent($event)
  {
    $this->pendingEvents[] = $event;
  }

  /**
   * Release the events
   *
   * @return array
   */
  public function releaseEvents()
  {
    $events = $this->pendingEvents;

    $this->pendingEvents = [];

    return $events;
  }

}
