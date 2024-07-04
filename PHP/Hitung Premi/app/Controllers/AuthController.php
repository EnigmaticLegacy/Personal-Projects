<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        if(!is_null(session()->get('isLoggedIn'))){
            return redirect()->to('/');
        }
        $data['title'] = 'Login';
        return view('login',$data);
    }

    public function authenticate()
    {
        $session = session();
        $user = new UserModel();
        $request = $this->request->getPost();
        $email = $request['email'];
        $password = $request['password'];
        $data = $user->where('email',$email)->first();
        if(is_null($data))
        {
            return redirect()->back()->withInput()->with('error','Invalid Username or Password');
        }
        if(password_verify($password,$data['password'])){
            $session_data = [
                'name' => $data['name'],
                'email' => $data['email'],
                'isLoggedIn' => TRUE
            ];
            $session->set($session_data);
        }
        else{
            return redirect()->back()->withInput()->with('error','Invalid Username or Password');
        }
        return redirect()->to('/');


    }

    public function register()
    {
        if(!is_null(session()->get('isLoggedIn'))){
            return redirect()->to('/');
        }
        $data['title'] = 'Register';
        return view('register',$data);
    }
    
    public function register_user()
    {
        $rules = [
            'name' => ['rules' => 'required|max_length[255]'],
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[users.email]'],
            'phone' => ['rules' => 'required|max_length[20]'],
            'password' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'password2'  => [ 'label' => 'confirm password', 'rules' => 'matches[password]']
        ];

        if($this->validate($rules)){
            $user = new UserModel();
            $request = $this->request->getPost();
            $request['password'] = password_hash($request['password'] ,PASSWORD_DEFAULT);
            unset($request['password2']);
            unset($request['newsletter']);
            $user->save($request);
            return redirect()->to('/login');
        }else{
            $data['validation'] = $this->validator;
            $data['title'] = 'Register';
            return view('register',$data);
        }
    }

    public function logout() {
        session()->destroy();
        ob_clean();
        return redirect()->to('/login');
        
    }
}
