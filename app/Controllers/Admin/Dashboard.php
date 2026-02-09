<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\AuthModel;
use App\Libraries\Hash;
use CodeIgniter\HTTP\RedirectResponse;

class Dashboard extends BaseController
{
    public $authmodel;
    public function __construct()
    {
        $this->authmodel = model('App\Models\AuthModel', false);
    }
    public function index()
    {
        $data = [];
        return view('Admin/index', $data);
        
    }
}
