<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ValidationLogin;
use App\Models\usersModel;


class Auth extends Controller
{
    protected $usersModel;
    public function __construct(usersModel $usersModel) {
        $this->usersModel = $usersModel;
    }

    public function login_page()  {
         $data = [
             'title' => 'Login'
        ];
        return view('auth/login', $data);
    }



    public function register_page()  {
         $data = [
             'title' => 'Registration'
        ];
        return view('auth/register', $data);
    }


    public function login_checks_auth(ValidationLogin $request)  {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = $this->usersModel->where('email', $email)->first();

          if ($user) {
             $check = $user && Hash::check($password, $user->password);
                if ($check) {
                      $checkAktif =  $user->is_active;
                      if ($checkAktif === true) {

                          $checkrole =  $user->role_id;

                            if ($checkrole === 1) {
                                $sess = [
                                    'id_user' => $user['id_user'],
                                    'email' => $user['email'],
                                    'role_id' => $user['role_id'],
                                ];
                                session()->put($sess);
                                return redirect()->to('Administrator/Dashboard');

                            }elseif ($checkrole === 2) {
                               $sess = [
                                    'id_user' => $user['id_user'],
                                    'email' => $user['email'],
                                    'role_id' => $user['role_id'],
                                ];
                                session()->put($sess);
                                return redirect()->to('Admins/Homes');

                            }elseif ($checkrole === 3) {
                                $sess = [
                                    'id_user' => $user['id_user'],
                                    'email' => $user['email'],
                                    'role_id' => $user['role_id'],
                                ];
                                session()->put($sess);
                                return redirect()->to('Admins/Homes');

                            }elseif ($checkrole === 4) {
                              $sess = [
                                    'id_user' => $user['id_user'],
                                    'email' => $user['email'],
                                    'role_id' => $user['role_id'],
                                ];
                                session()->put($sess);
                                return redirect()->to('Costumers/Home');

                            }else {
                               return redirect()->back()->withErrors([
                                    'CheksRole' => 'Sorry Your Account Ilegal',
                                    ]);
                            }
                      }else {
                       return redirect()->back()->withErrors([
                        'Chekstatus' => 'Your account nonaktif',
                        ]);
                      }
                }else {
                     return redirect()->back()->withErrors([
                    'ChekaMatch' => 'Password / Email wrong.',
                    ]);
                }
          }else {
             return redirect()->back()->withErrors([
                'checkEmail' => 'Email Or Password Not found.',
                ]);
          }
    }

}
