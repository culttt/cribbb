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

    return View::make('home.index');
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
