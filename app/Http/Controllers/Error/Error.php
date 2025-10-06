<?php

namespace App\Http\Controllers\Error;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Error extends Controller
{
    public function ErrorCheckAccessMenu() {
        $data  = [
            'title' => 'ERROR'
      ];
      return view('errors.checkmenu.file', $data);
    }

    public function ErrorCheckAccessSubMenu() {
        $data  = [
            'title' => 'ERROR'
      ];
      return view('errors.checksubmenu.file', $data);
    }
}