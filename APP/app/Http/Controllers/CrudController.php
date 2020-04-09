<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrudController extends Controller
{

    public function register(Request $req){

        $validate = Validator::make($req->all(),[
        'name' => 'required|unique:MAUSR,MAUSR_FULL_NAME|max:255',
        'email' => 'required|unique:MAUSR,MAUSR_EMAIL_ADDRESS|max:255',
        'password' => 'required|max:255'

        ]);

        $msg = 'fail';

        if($validate->fails()){
            
            return $msg;
        }else if($req->password != $req->cpassword){
            $msg = 'misspass';

            return $msg;
        }else{
            $pass = Crypt::encryptString($req->password);
            $user_code = $this->generateUsrCode();
            $data = [
                'MAUSR_CODE' => $user_code,
                'MAUSR_EMAIL_ADDRESS' => $req->email,
                'MAUSR_FULL_NAME' => $req->name,
                'MAUSR_PASSWORD' => $pass,
                'MAUSR_CRTD_BY' => $user_code,
                'MAUSR_CRTD_BY_TEXT' => $req->name,
                'MAUSR_CRTD_TIMESTAMP' => date('Y-m-d H:i:s')
            ];

            $save_user = std_insert([
                'table_name' => 'MAUSR',
                'insert_data' => $data
            ]);

            if($save_user === false){

                return $msg;
            }else{

                $msg = 'done';

                return $msg;
            }
        }

    }

    public function generateUsrCode(){

        $cek_user = std_get([
            'table_name' => 'MAUSR'
        ]);

        $no = count($cek_user) + 1;
        $code = null;
        if($no > 0 && $no < 10){

            $code = 'USR000'.$no;
        }elseif($no > 9 && $no < 100){

            $code = 'USR00'.$no;
        }elseif($no > 99 && $no < 1000){

            $code = 'USR0'.$no;
        }elseif($no > 999){

            $code = 'USR'.$no;
        }

        return $code;
    }
}
