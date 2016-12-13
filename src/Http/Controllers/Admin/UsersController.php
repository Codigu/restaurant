<?php

namespace Copya\Http\Controllers\Admin;

class UsersController extends BaseController
{
    public function index()
    {
        //dd($this->getSideNav());
        return view('copya.admin.users.index', array('sidenav' => $this->getSideNav()));
    }
}
