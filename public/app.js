Garuda('display_button').setContent('<button class="btn btn-primary btn-xs" id="btn_add" onclick="addData();">Add</button>'); 

var $btn_add;
var id_user_update;

function display_edit()
{
    $btn_add = Garuda('display_button').getContent;
    Garuda('display_button').setContent('<button class="btn btn-warning btn-xs" onclick="updateData();">Update</button>'
                                            +'&nbsp <button class="btn btn-success btn-xs" onclick="cancelUpdate()">Cancel</button>'); 

}


function cancelUpdate()
{
    Garuda('display_button').setContent($btn_add);
    $all_input.set('clear');
    Garuda('t_name').focus();
}


function updateData()
{
     let name = Garuda('t_name').getValue;
     let email = Garuda('t_email').getValue;
     let age = Garuda('t_age').getValue;

     if (name==='' || name==null)
     {
         Garuda('t_name').focus();
         return;
     }

     if (email==='' || email==null)
     {
         Garuda('t_email').focus();
         return;
     }

     if (_isEmail(email)==false)
     {
         Garuda('disp_content').setContent('<div class="alert alert-danger" role="alert">Email is not valid !</div>');
         Garuda('t_email').focus();
        return;
     }

     if (age==='' || age==null)
     {
         Garuda('t_age').focus();
         return;
     }
    
     $update_data = __({
        url:_url_update,
        method:'post',
        data:{
          id:id_user_update,
          name:name,
          email:email,
          age:age,
          _token:_token
        }
     });

     $update_data.request($=>{
          if ($==='T')
          {
             Garuda('t_name').focus();
             Garuda('disp_content').setContent('<div class="alert alert-success" role="alert">Data has been updated !</div>');
             $all_input.set('clear');
             loadData();
          }
     });
}



function loading()
{
    Garuda('disp_table').setContent(
        '<center><img width="50" height="50" src="'+_url_loading_+'"></img></center>'
    );
}

function addData()
{
     let name = Garuda('t_name').getValue;
     let email = Garuda('t_email').getValue;
     let age = Garuda('t_age').getValue;

     if (name==='' || name==null)
     {
         Garuda('t_name').focus();
         return;
     }

     if (email==='' || email==null)
     {
         Garuda('t_email').focus();
         return;
     }

     if (_isEmail(email)==false)
     {
         Garuda('disp_content').setContent('<div class="alert alert-danger" role="alert">Email is not valid !</div>');
         Garuda('t_email').focus();
        return;
     }

     if (age==='' || age==null)
     {
         Garuda('t_age').focus();
         return;
     }
    
     $insert_data = __({
        url:_url_add,
        method:'post',
        data:{
          name:name,
          email:email,
          age:age,
          _token:_token
        }
     });

     $insert_data.request($=>{
          if ($==='T')
          {
             Garuda('t_name').focus();
             Garuda('disp_content').setContent('<div class="alert alert-success" role="alert">Data has been added !</div>');
             $all_input.set('clear');
             loadData();
          }
     });
}




function loadData()
{
    loading();
    $load_data = __({
        url:_url_load,
        method:'get',
        data:{
          _token:_token
        }
    });

    $load_data.request($res=>{
        var obj = JSON.parse($res);
        if (obj)
        {
              var tmplate = '';
              for (var i = 0; i < obj.length; i++) 
              {
                  var name = obj[i]['name'];
                  var email = obj[i]['email'];
                  var age = obj[i]['age'];
                  var id = obj[i]['id'];
                  var foto = _storage_+obj[i]['foto'];

                  tmplate += '<tr>'+
                              '<th scope="row">'+(i+1)+'</th>'+
                              '<td>'+name+'</td>'+
                              '<td>'+email+'</td>'+
                              '<td>'+age+'</td>'+
                              '<td><img src="'+foto+'" class="img-thumbnail" width="50" height="50"></img></td>'+
                              '<td><button id="'+id+'" onclick="showUpdate(this.id);" id="b_update" class="btn btn-warning btn-xs">Edit</button>&nbsp'
                              +'<button id="'+id+'" onclick="deleteData(this.id);" class="btn btn-danger btn-xs">Delete</button>&nbsp'+
                              '<button id="'+id+'" onclick="upload(this.id);" class="btn btn-successs btn-xs">Upload</button></td>'+
                            '</tr>';
              }
              Garuda("disp_table").setContent(tmplate);
        }
    });       
}
loadData();

function upload(id)
{
    _refresh(_url_+'/upload/'+id);
}

function deleteData(id)
{
     var r  = confirm("Are you sure want to delete this one ?");

    if (r == true) 
    {
         $delete_data = __({
            url:_url_delete,
            method:'post',
            data:{
              id_user:id,
              _token:_token
            }
        });

        $delete_data.request($res=>{
            if ($res==='T')
            {

                Garuda('disp_content').setContent('<div class="alert alert-success" role="alert">Data has been deleted !</div>');
                loadData();
            }else{
                alert("Failed deleted data !");
            }
        }); 
    } 
}


function showUpdate(id)
{
   display_edit();
   Garuda('t_name').focus();
   $all_input.set('clear');
   Garuda('b_update').disabled();
   id_user_update = id;
   $get_data = __({
      url:_url_get_data,
      method:'post',
      data:{
        id:id_user_update,
        _token:_token
      }
   });
   _writeLog(id_user_update);
   $get_data.request($res=>{
        var obj = JSON.parse($res);
        if (obj)
        {
            $name = obj[0]['name'];
            $email = obj[0]['email'];
            $age = obj[0]['age'];

            Garuda('t_name').setValue($name);
            Garuda('t_email').setValue($email);
            Garuda('t_age').setValue($age);

            Garuda('b_update').enabled();
        }
   });
}

Garuda('b_add').when('click',$=>{
    addData();
});

Garuda('t_name').focus();

$all_input = new GarudaInput([
    't_name',
    't_email',
    't_age'
]);

function enterAdd(e)
{
    if (e.keyCode==13)
    {
        addData();
    }
}
