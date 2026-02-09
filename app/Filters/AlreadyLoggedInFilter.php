<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AlreadyLoggedInFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        $msg = '';        
        if(session()->has('userlogin')){
            // if(url_is('admin/*')){
            //     $msg = '<div class="alert alert-danger">You must be logged in!</div>';
            // }
            //return redirect()->to('/404')->with('message', $msg);
            // return redirect()->to('/admin?access=out')->with('message', $msg);
            return redirect()->to('/admin/dashboard');
        }else{
            // $menuId = $this->check_privilege();
            // if(! $menuId){
            //     return redirect()->to('/authentication-failed');
            // }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}