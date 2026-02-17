<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\AuthModel;
use App\Libraries\Hash;
use CodeIgniter\HTTP\RedirectResponse;

class Users extends BaseController
{
    public $authmodel;
    public $commonmodel;
    public function __construct()
    {
        $this->authmodel = model('App\Models\AuthModel', false);
        $this->commonmodel = model('App\Models\CommonModel', false);
    }
    public function index()
    {
        $data = [];
        $data['users'] = $this->commonmodel->getAllRecord('tbl_admin','',['user_id','DESC']);
        return view('Admin/users/userindex', $data);
    }
    public function add_user(){
        $data = [];
        if($this->request->getMethod() == 'POST'){
            $validation = $this->validate([
              'name'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'Your Full name is required'
                  ]
                  ],
              'email' =>[
                  'rules'=>'required|valid_email|is_unique[tbl_admin.email]',
                  'errors'=>[
                      'required'=>'Email is required',
                      'valid_email'=>'You must enter a valid email',
                      'is_unique'=>'Email already taken'
                  ]
                  ],
                'phone'=>[
                  'rules'=>'required|numeric|min_length[10]|max_length[10]',
                  'errors'=>[
                      'required'=>'Phone is required',
                      'numeric'=>'You must enter numeric value',
                      'min_length'=>'Phone Number must be 10 digit in length',
                      'max_length'=>'Phone Number must not have more than 10 digit in length'
                  ]
                  ],
              'password'=>[
                  //'rules'=>'required|min_length[5]|max_length[12]|regex_match[^[A-Z]+(?=.*?[a-z])(?=.*?[0-9])(?=.*?\W).*$]',
                  'rules'=>'required|min_length[5]|max_length[12]',
                  'errors'=>[
                      'required'=>'Password is required',
                      'min_length'=>'Password must have atleast 5 character in length',
                      'max_length'=>'Password must not have characters more than 12 in length',
                      'regex_match'=>'Password must start with capital letter, and containing at least 1 lowercase, 1 special character and 1 digit.',
                  ]
                  ],
              'cpassword'=>[
                  'rules'=>'required|matches[password]',
                  'errors'=>[
                      'required'=>'Confirm password is required',
                      'matches'=>'Confirm Password not matches to password'
                  ]
                  ],
              
            //   'address'=>[
            //       'rules'=>'required',
            //       'errors'=>[
            //           'required'=>'Address is required'
            //       ]
            //       ],
            //   'image' =>[
            //       //'rules'=>'uploaded[image]|max_size[image,50]|ext_in[image,png,jpg,jpeg,bmp,gif]',
            //       'rules'=>'max_size[image,100]|ext_in[image,png,jpg,jpeg,bmp,gif]',
            //       'errors'=>[
            //           //'uploaded'=>lang('User.validation.image.uploaded'),
            //           'max_size'=>'Image should not greater than 100 KB of size.',
            //           'ext_in'=>'Image must be extension with png,jpg,jpeg,bmp,gif.',
            //       ]
            //   ],
            //   'privilege_id'=>[
            //       'rules'=>'required',
            //       'errors'=>[
            //           'required'=>'Privilege is required'
            //       ]
            //     ], 
            //   'status'=>[
            //       'rules'=>'required',
            //       'errors'=>[
            //           'required'=>'Status must be select'
            //       ]
            //   ]
            ]);
            if(!$validation){
              $data['validation'] = $this->validator;
              //return view('admin/users/add_user',$this->data);
            }else{
                // print_r($_POST); exit;
                $post['name'] = $this->request->getPost('name');
                $post['email'] = $this->request->getPost('email');
                $post['phone'] = $this->request->getPost('phone');
                $password = $this->request->getPost('cpassword');
                $post['password'] = Hash::make($password);
                $post['status'] = $this->request->getPost('status');
                $post['ip_address'] = $this->request->getIPAddress();
                $post['added_by'] = session('user_id');

                $inserted = $this->commonmodel->insertRecord('tbl_admin', $post);
                if($inserted){
                    session()->setFlashdata(['message'=>'User Added Successfully','type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong. Please Try After Sometimes...','type'=>'danger']);
                }
                return redirect()->to('admin/users');

            }
        }
        return view('Admin/users/add_user', $data);
        
    }
    public function view_user($id){
        echo $id;
    }
    public function edit_user($id){
        if($this->request->getMethod() == 'POST'){
            // echo "<pre>"; print_r($_FILES); exit;
            $validation = $this->validate([
              'name'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'Your Full name is required'
                  ]
                  ],
              'email' =>[
                  'rules'=>'required|valid_email',
                  'errors'=>[
                      'required'=>'Email is required',
                      'valid_email'=>'You must enter a valid email',
                    //   'is_unique'=>'Email already taken'
                  ]
                  ],
                'phone'=>[
                  'rules'=>'required|numeric|min_length[10]|max_length[10]',
                  'errors'=>[
                      'required'=>'Phone is required',
                      'numeric'=>'You must enter numeric value',
                      'min_length'=>'Phone Number must be 10 digit in length',
                      'max_length'=>'Phone Number must not have more than 10 digit in length'
                  ]
                  ],
              
              
            
            ]);
            if(!$validation){
              $data['validation'] = $this->validator;
              //return view('admin/users/add_user',$this->data);
            }else{
                // print_r($_POST); exit;
                if($_FILES['image']['name'] != ''){
                  if($img = $this->request->getFile('image')){ 
                      $imgname = $img->getName();
                      if($img->isValid() && !$img->hasMoved()){
                          $ext = explode('.',$imgname);
                          $ext = end($ext);
                          $newName = 'u_'.time().'.'.$ext;
                          $img->move('./public/assets/upload/users/',$newName);
                      }
                  }
                  $post['image'] = $newName;
                }
                $post['name'] = $this->request->getPost('name');
                $post['email'] = $this->request->getPost('email');
                $post['phone'] = $this->request->getPost('phone');
                $post['status'] = $this->request->getPost('status');
                $post['ip_address'] = $this->request->getIPAddress();
                $post['update_by'] = session('user_id');
                $post['updated'] = date('Y-m-d H:i:s');

                $updated = $this->commonmodel->updateRecord('tbl_admin', $post,['user_id'=>$id]);
                if($updated){
                    session()->setFlashdata(['message'=>'User Updated Successfully','type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong. Please Try After Sometimes...','type'=>'danger']);
                }
                return redirect()->to('admin/users');

            }
        }
        $data['user'] = $this->commonmodel->getOneRecord('tbl_admin',['user_id'=>$id]);
        return view('Admin/users/edit_user', $data);
    }
    public function delete_user($id){
        if($id){
            $updated = $this->commonmodel->updateRecord('tbl_admin', ['status'=>2],['user_id'=>$id]);
            if($updated){
                session()->setFlashdata(['message'=>'User deleted Successfully','type'=>'success']);
            }else{
                session()->setFlashdata(['message'=>'Something went wrong. Please Try After Sometimes...','type'=>'danger']);
            }
        }
        return redirect()->to(base_url('admin/users'));
    }
}
