<?php

use Mockery as m;
use Cribbb\Entity\StubEntity;

class EntityTest extends TestCase {

  public function tearDown()
  {
    m::close();
  }

  /**
   *  @expectedException Exception
   */
  public function testCreateMethodThrowsExceptionIfNotArray()
  {
    $entity = new StubEntity;
    $entity->create('hello world');
  }

  /**
   *  @expectedException Exception
   */
  public function testUpdateMethodThrowsExceptionIfNotArray()
  {
    $entity = new StubEntity;
    $entity->update('hello world');
  }

}
