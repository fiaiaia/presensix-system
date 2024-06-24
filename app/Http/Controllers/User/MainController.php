<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class MainController extends Controller
{
    public function home()
    {
        return view('user.main.home');
    }

    public function inputEmail(Request $request)
    {
        try {
            $cekbbi = stripos($request->email, '@gmail.com');
            if($cekbbi){
                $update = User::whereId(auth()->user()->id)->update([
                    "email" => $request->email,
                ]);
                $data_response = [
                    'status' => 200,
                    'output' => 'Add email Success!'
                ];
            }else{
                $data_response = [
                    'status' => 404,
                    'output' => 'Format email salah, mohon perbaiki!'
                ];
            }
        }catch (\Throwable $th) {
          DB::rollBack();
          $message = $th->getMessage();
          $data_response = [
              'status' => 500,
              'output' => $message
          ];
        }
     return response()->json(['data'=>$data_response]);
    }
}
