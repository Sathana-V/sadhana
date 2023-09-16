<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
class Admin extends ResourceController
{
    use ResponseTrait;
    protected $modelName = 'App\Models\AdminModel';
    protected $format='json';
    public function index($id="haiiopo",$value="NULL")
    { 
        
         helper("cookie");
        $number=rand(10,1000);
        $strv=strval($number);
        setcookie("username",$strv ,time() + 6000);
        
        // set_cookie($id,$value,3600);
        $cook="get_cookie('haiiopo')";
        return $this->respond($number);
    }
    public function indexi($id="haiiopo",$value="NULL")
    { 
         helper("cookie");
        $name = $this->request->getVar('name');
        $email = $this->request->getVar('email');
        $number=rand(10,1000);
        $strv=strval($number);
        setcookie($name,$email ,time() + 6000);
        
        // set_cookie($id,$value,3600);
        // $cook="get_cookie('haiiopo')";
        return $this->respond($number);
    }
      public function logout()
    { 
        
        $email='mypitch.xyz';
        $path='/public/admin';
        helper('cookie');
        setcookie("username",$email ,time() - 6000);
        // set_cookie($id,$value,3600);
        // $cook="get_cookie('haiiopo')";
        $number="logged out successfully";
        return $this->respond($number);
    }
     public function login()
    {  
    
    
        helper("cookie");
        
        $number="hai";
        // set_cookie($id,$value,3600);
        $cook="false";
         $cook=get_cookie("username");
        if(get_cookie("username"))
        {
           $cook="true";
        }
        else
        {
         $cook="false";
        }
        return $this->respond($cook);
    }
    public function validateform()
    {
        // $db=\Config\Database::connect();
        // $userData = array();
        // $password='';
        // $email='';
        // $email='';
        // $data = [
        //     'email' => $this->request->getVar('email'),
        //     'password' => $this->request->getVar('password'),
        // ];
        // $email = $this->request->getVar('email');
        // $password = $this->request->getVar('password');
       
        // $sql = "SELECT count(*) as countl from admin_details where email='".$email."' and password ='".$password."'";
        // $query=$db->query($sql);
        // foreach($query->getResult('array') as $row)
        // {
        //     array_push($userData,$row);
        // }
        // $res['login_Data']=$userData;
        // $response = [
        //     'status' => 201,
        //     'error' => null,
        //     'messages' => [
        //         'success' => 'checked',
        //         'message'=>$sql,
        //         'given'=>$data,

        //     ],
        //     'login_data' => $userData,

        // ];
        // return $this->respond($response);
         $db=\Config\Database::connect();
        $userData = array();
        $password='';
        $email='';
        $email='';
        $data = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
        ];
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $sql = "SELECT *,count(*) as countl from admin_details where email='".$email."' and password ='".$password."'";
       // return $this->respond($sql);
        $query=$db->query($sql);
      
        foreach($query->getResult('array') as $row)
        {
            array_push($userData,$row);
        }
        
        $result="false";
       
        $query = $db->query($sql);
        $img=$query->getResultArray();
        $cook='';
        $name= $img[0]['name'];
        $email= $img[0]['email'];
        if($img[0]['countl']==1)
        {
            $result="trueee";
            

        }
         helper("cookie");
        $name = $this->request->getVar('name');
        $email = $this->request->getVar('email');
        setcookie("username",$email ,time() + 6000);
        $res['login_Data']=$userData;
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'checked',
                'message'=>$sql,
                'given'=>$img[0]['name'],
                'cook'=>$cook

            ],
            'login_data' => $userData,
            'result'=>$result

        ];
        return $this->respond($response);
    } 
  
}
?>