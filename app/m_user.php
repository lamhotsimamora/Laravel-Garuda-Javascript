<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class m_user extends Model
{
	private $id_user,$name,$email,$age,$foto;

	public function set($data)
	{
        if (isset($data['id_user']))
        {
            $this->id_user  = (int) $data['id_user'] ?? false;
        }
        if (isset($data['name']))
        {
           $this->name  = $data['name'] ?? false;
        }
         if (isset($data['email']))
        {
            $this->email = $data['email'] ?? false;
        }
        if (isset($data['age']))
        {
           $this->age   = (int) $data['age'] ?? false;
        }
        if (isset($data['foto']))
        {
           $this->foto   = $data['foto'] ?? 'user.png';
        }else{
           $this->foto = 'user.png';
        }
		return $this;
	}
	
    public function addData()
    {
        if ($this->name==false || $this->email==false || $this->age == false)
        {
            return false;
        }
    	return DB::insert(
                            'insert into t_user (name, email, age, foto) values (?, ?, ?, ?)',
                             [$this->name, $this->email, $this->age, $this->foto]
                         );
    }

    public function updateData()
    {
		return DB::table('t_user')
                    ->where('id', $this->id_user)
                    ->update(['name' => $this->name,'email'=> $this->email,'age'=>$this->age]);
    }

    public function uploadFoto()
    {
        return DB::table('t_user')
                    ->where('id', $this->id_user)
                    ->update(['foto' => $this->foto]);
    }

    public function deleteData()
    {
    	return DB::table('t_user')->where('id', $this->id_user)->delete();

        $filename = $this->getFileNameFoto();

        file_exists(storage_path('app/public/user/'.$filename)) ? unlink(storage_path('app/public/user/'.$filename)) : '';
    }

    public function getAllData()
    {
    	return DB::select('select * from t_user');
    }

    public function getDataWhereId()
    {
    	return $users = DB::table('t_user')->where('id', $this->id_user)->get();
    }

    public function getFileNameFoto()
    {
        $users = DB::table('t_user')->where('id', $this->id_user)->get();
        $users = json_encode($users);
        return $users->{'foto'};
    }
}
