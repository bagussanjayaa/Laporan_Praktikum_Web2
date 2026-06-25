<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class Auth extends ResourceController
{

    protected $format = 'json';


    public function login()
    {



        // handle preflight Vue
        if($this->request->getMethod() == 'options')
        {
            return $this->respond([]);
        }



        // ambil JSON
        $data = $this->request->getJSON(true);



        $email = $data['useremail'] ?? null;

        $password = $data['userpassword'] ?? null;



        if(!$email || !$password)
        {

            return $this->failUnauthorized(
                'Email dan password wajib diisi'
            );

        }



        $model = new UserModel();



        $user = $model
            ->where('useremail',$email)
            ->first();



        if(!$user)
        {

            return $this->failUnauthorized(
                'Email tidak ditemukan'
            );

        }



        if(!password_verify(
            $password,
            $user['userpassword']
        ))
        {

            return $this->failUnauthorized(
                'Password salah'
            );

        }



        return $this->respond([

            'status'=>200,

            'message'=>'Login Berhasil',

            'data'=>[

                'id'=>$user['id'],

                'username'=>$user['username'],

                'useremail'=>$user['useremail'],

                'token'=>base64_encode(
                    'TOKEN-'.$user['useremail']
                )

            ]

        ]);


    }

    public function options()
    {

        return $this->respond([
            'status'=>200
        ]);

    }


}