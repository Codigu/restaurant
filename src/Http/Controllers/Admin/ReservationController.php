<?php

namespace CopyaRestaurant\Http\Controllers\Admin;

use Copya\Http\Controllers\Admin\BaseController;

class ReservationController extends BaseController
{
    public function index()
    {
        //dd($this->getSideNav());
        return view('copya.admin.users.index', array('sidenav' => $this->getSideNav()));
    }
}
