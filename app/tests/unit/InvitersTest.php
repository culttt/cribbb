<?php

use Mockery as m;

class InvitersTest extends TestCase {

  public function setUp()
  {
    parent::setUp();
    $this->resetEvents();
  }

  public function tearDown()
  {
    m::close();
  }

  public function testRequestNewInvitation()
  {
    $requester = App::make('Cribbb\Inviters\Requester');
    $invite = $requester->create(array('email' => 'phil@ipbrown.com'));
    $this->assertInstanceOf('Invite', $invite);
    $invite = $requester->create(array('email' => ''));
    $this->assertTrue(is_null($invite));
    $this->assertEquals(1, count($requester->errors()));
  }

  public function testUserInviteAnotherUser()
  {
    $inviter = App::make('Cribbb\Inviters\Inviter');
    $user = new User;
    $user->invitations = 1;
    $invite = $inviter->create($user, array('email' => 'phil@ipbrown.com'));
    $this->assertInstanceOf('Invite', $invite);
  }

  /**
   * @expectedException Cribbb\Inviters\Policies\InvitePolicyException
   */
  public function testUserHasNoInvitations()
  {
    $inviter = App::make('Cribbb\Inviters\Inviter');
    $user = new User;
    $invite = $inviter->create($user, array('email' => 'phil@ipbrown.com'));
  }

  public function testRequestSentByReferral()
  {
    $requester = App::make('Cribbb\Inviters\Requester');
    $invite1 = $requester->create(array('email' => 'phil@ipbrown.com'));

    $invite2 = $requester->create(array('email' => 'pb@yflag.com'), $invite1->referral_code);

    $invite1 = Invite::find($invite1->id);
    $this->assertEquals(1, count($invite1->referral_count));
  }

  private function resetEvents()
  {
    $models = array('Invite');

    foreach ($models as $model)
    {
      call_user_func(array($model, 'flushEventListeners'));
      call_user_func(array($model, 'boot'));
    }
  }

}
