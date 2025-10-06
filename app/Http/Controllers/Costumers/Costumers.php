<?php

namespace App\Http\Controllers\Costumers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Costumers extends Controller
{
    public function Homes_Costumers() {
        $data  = [
            'title' => 'Costumers Home Page '
      ];
       return view('costumers/homes/file', $data);
    }


    public function Costumers_Document() {
        $data  = [
            'title' => 'Costumers Document'
      ];
       return view('costumers/documents/file', $data);
    }
}
