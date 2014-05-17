<?php

class HomeController extends BaseController {

  /**
   * Index
   *
   * @return View
   */
  public function index()
  {
    $this->storeReferralCode();

    $this->layout->nest('content', 'website.index');
  }

  /**
   * Store Referral code
   *
   * @return void
   */
  protected function storeReferralCode()
  {
    if(Input::get('referral'))
    {
      Session::put('referral_code', Input::get('referral'));
    }
  }

}
