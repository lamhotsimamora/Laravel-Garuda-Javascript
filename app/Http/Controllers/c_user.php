<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\m_user;

class c_user extends Controller
{
    public function add(Request $req)
    {
    	$name  = $req->input('name');
    	$email = $req->input('email');
    	$age   = $req->input('age');
    	$user  = new m_user();
    	$result =  $user->set(array(
    		'name'  => $name,
    		'email' => $email,
    		'age'   => $age
    	  )
		)->addData();
    	echo $result ? 'T' : 'F';
    }

    public function update(Request $req)
    {
        $id  = $req->input('id');
        $name  = $req->input('name');
        $email = $req->input('email');
        $age   = $req->input('age');
        $user  = new m_user();
        $result =  $user->set(array(
            'id_user'  => $id,
            'name'  => $name,
            'email' => $email,
            'age'   => $age
          )
        )->updateData();
        echo $result ? 'T' : 'F';
    }

    public function delete(Request $req)
    {
        $id  = $req->input('id_user');

    	$user = new m_user();
        $user->set(array(
            'id_user'=>$id,
            'name'=>'',
            'email'=>'',
            'age'=>''
        ));
        $result = $user->deleteData();
        
        if ($result)
        {
            echo "T";
        }else{
            return 'F';
        }
    }

    public function getAllDataUser()
    {
        $user = new m_user();
        return $user->getAllData();
    }

    public function getUser(Request $req)
    {
        $id  = $req->input('id');

        $user = new m_user();
        $user->set(array(
            'id_user'=>$id
        ));
        return $user->getDataWhereId();
    }

    public function getFoto()
    {
        $user = new m_user;
        return $user->getFileNameFoto();
    }

}
