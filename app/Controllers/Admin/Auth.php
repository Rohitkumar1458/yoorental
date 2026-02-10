<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\AuthModel;
use App\Libraries\Hash;
use CodeIgniter\HTTP\RedirectResponse;

class Auth extends BaseController
{
    public $authmodel;
    public function __construct()
    {
        $this->authmodel = model('App\Models\AuthModel', false);
    }
    public function login()
    {
        $data = []; //this is test line
        if($this->request->getMethod() == 'POST'){
            // print_r($_POST); exit;
            $validation = $this->validate([
                'email'=>[
                    'rules'=>'required|valid_email|is_not_unique[tbl_admin.email]',
                    'errors'=>[
                        'required'=>'Email is required',
                        'valid_email'=>'Enter a valid email address',
                        'is_not_unique'=>'This email is not registered on your service'
                    ]
                    ],
                'password'=>[
                    'rules'=>'required|min_length[5]|max_length[12]',
                    'errors'=>[
                        'required'=>'Password is required',
                        'min_length'=>'Password must have atleast 5 characters in length',
                        'max_length'=>'Password must not have more than 12 characters in length'
                    ]
                ]
            ]);
            if(!$validation){
                $data['validation'] = $this->validator;
            }else{
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');
                $user_info = $this->authmodel->isvalidate($email);
                if(!isset($user_info->user_id)){
                    // print_r($user_info); exit;
                    session()->setFlashdata('message','<div class="alert alert-danger">Inactive user. Contact administrator...</div>');
                    return redirect()->to(base_url('admin'));

                }
                $check_password = Hash::check($password, $user_info->password);
                if($check_password){
                    $sessionData = array(
                        'user_id' => $user_info->user_id,
                        'name' => $user_info->name,
                        'email' => $user_info->email,
                        'phone' => $user_info->phone,
                        'address' => $user_info->address,
                        'image' => $user_info->image,
                        'privilege_id' => $user_info->privilege_id,
                        'status' => $user_info->status,
                        'userlogin' => true,
                    );
                    session()->set($sessionData);
                    return redirect()->to('/admin/dashboard');
                }else{
                    session()->setFlashdata('message','<div class="alert alert-danger">Incorrect Password</div>');
                    return redirect()->to('/admin')->withInput();
                }
                // print_r($user_info);exit;
            }
        }
        return view('Auth/login', $data);
    }
    public function logout(){
        if(session()->has('userlogin')){
            session()->destroy();
        }
        return redirect()->back();
    }
}
