<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\validatedChangePassword;
use App\Models\usersModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\validationChangeProfile;

class Setting_General extends Controller
{
  protected $usersModel;
  public function __construct(usersModel $usersModel) {
    $this->usersModel = $usersModel;
  }


    public function Logout(Request $request) {
        // Auth::logout();
       // return redirect('/'); // Ganti dengan rute yang sesuai setelah logout
       // Auth::logout();
       // Session::flush(); // Menghapus semua data session
         // Hapus session
       $request->session()->flush();
       $request->session()->invalidate();
       $request->session()->regenerateToken();
       return redirect('/');
   }

    public  function ChangePassword ()  {
      $data = [
        'title' =>  'Change Password'
         ];
      return view('setting-general.change-pw.form', $data);
   }


   public function ChangePasswordUser(validatedChangePassword $request)  {
    try {
    $user = getUserData();
    $idUser = $user->id_user;
    $ChangPw = $this->usersModel->findOrFail($idUser);
    if (!empty($request->input('password'))) {
      $hashedPassword = Hash::make($request->input('password'));
  }
    $ChangPw->update([
      'password' => $hashedPassword
  ]);
  return redirect()->route('Setting_General.change.password')->with('success','Change Password success');
  } catch (\Throwable $th) {
      return redirect()->route('Setting_General.change.password')->with('error','Failed to Change Password. Please try again.');
  }
   }


  public function ChangeProfile()  {
    $user = getUserData();

    $data = [
      'title' =>  'Change Profile',
      'user' => $user,
       ];
    return view('setting-general.change-pr.file', $data);
   }

   public function ChangeProfileUser(validationChangeProfile $request)
   {
    try {
      $user = getUserData();
      $idUser = $user->id_user;
      // Ambil data user berdasarkan ID
      $profile = $this->usersModel->findOrFail($idUser);



      // ambil data gambar baru dan lama
      $newImage = $request->file('image');
      $oldImage = $request->input('imageold');
      // Jika ada gambar baru
      if ($newImage) {
      
          $imagePath =  $newImage->store('profile', 'public');
          $imageName = basename($imagePath);

          // Hapus gambar lama jika ada dan bukan gambar default
          if ($oldImage && $oldImage !== 'default.jpg') {
             //  $oldImagePath = storage_path('app/avatar/' . $oldImage);
              $oldImagePath = storage_path('app/public/profile/' . $oldImage);
              if (file_exists($oldImagePath)) {
                  unlink($oldImagePath);
              }
          }
      } else {
          // Jika tidak ada gambar baru, gunakan gambar lama
          $imageName = $oldImage;
      }
    
      // Update data user
      $profile->update([
          'fullname' => $request->input('fullname'),
          'image' => $imageName,
      ]);
  
      return redirect()->route('Setting_General.change.profile')
          ->with('success', 'Profile updated successfully');
    } catch (\Throwable $th) {
      return redirect()->route('Setting_General.change.profile')
      ->with('error', 'Username already exists!');
    }
       
   }

}
