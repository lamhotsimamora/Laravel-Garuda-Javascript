<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use File;
use App\m_user;

class c_upload extends Controller
{
	private $path='user/';

	public function setPath($path)
	{
		$this->path = $path;
	}

	public function index($id,$message=null,$type=null)
	{
		$msg = $message ?? false;
		return view('upload',array('id_user'=>$id,'message'=>$msg,'type'=>$type));
	}


    public function uploadFoto(Request $request,$id=null)
    {
    	if ($request->hasFile('t_image_user'))
    	{
    		$tmp      = $request->file('t_image_user');
    		$filename_ori = $request->file('t_image_user')->getClientOriginalName();
            $ext      =  strtolower(pathinfo($filename_ori, PATHINFO_EXTENSION));
            $size     = $request->file('t_image_user')->getClientSize();

            if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg')
            {
                if ($size >= 1000000)
                {
                    return $this->index($id,'File {'.$filename_ori.'} is too large ! Maximum is 1 MB',false);
                }

                $filename = _randomStr(10).'.'.$ext;
                $path     = $this->path.$filename;

                move_uploaded_file($tmp, storage_path('app/public/'.$path));
                
                $user = new m_user;
                $result =  $user->set(array(
                    'foto'    => $path,
                    'id_user' => $id
                  )
                )->uploadFoto();
                
                if ($result)
                {
                    return $this->index($id,'File {'.$filename_ori.'} has been uploaded !',true);
                }else{
                    return $this->index($id,'Failed upload file {'.$filename_ori.'}',false);
                }   
            }else{
                return $this->index($id,'File {'.$filename_ori.'} is not image !',false);
            }
    	}else{
    		return $this->index($id,'File is empty !',false);
    	}
    }

    public function show()
    {
    	return Storage::files('');
    }
}
