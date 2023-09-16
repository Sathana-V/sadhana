<?php 
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Designation;
class Size extends ResourceController
{
    use ResponseTrait;

    // all users
    public function index(){
      $db = \Config\Database::connect();
       $sql="SELECT * FROM sizechart";
     
      $query= $db->query($sql);
      $data['Size_Data']= $query->getResult();
     
    return $this->respond($data);
    }

    // create
    public function create() {
        
    }

    // single user
    public function show($id = null){
      $db = \Config\Database::connect();
      $sql="SELECT * FROM sizechart where size_label ='".$id."'";
    
     $query= $db->query($sql);
     $data['Size_Data']= $query->getResult();
     
     return $this->respond($data);
       
    }

    // update
    public function update($id = null){
       
    }

    // delete
    public function delete($id = null){
       
    }

}