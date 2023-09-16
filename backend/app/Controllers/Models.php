<?php 
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
 use App\Models\Designation;
class Models extends ResourceController
{
    use ResponseTrait;

    
    public function index(){
      $db = \Config\Database::connect();
     $sql="SELECT * FROM model where model_status ='active'";
     
     $query= $db->query($sql);
     $data['Model_Data']= $query->getResult();
     
    return $this->respond($data);
    }
//     public function index()
//     {
//       $servername = "localhost";
// $username = "root";
// $password = "";

// // Create connection
// $conn = mysqli_connect($servername, $username, $password);

// // Check connection
// if (!$conn) {
//   die("Connection failed: " . mysqli_connect_error());
// }
// echo "Connected successfully";
// $sql="SELECT * FROM model";
//      $data = [];
//       //  $query= $db->query($sql);
//       // $data['Model_Data']= $query->getResult();
     
//     //  return $this->respond($data);
//         // return view('welcome');
//     }
    // create
    public function create() {
      $db = \Config\Database::connect();
      $model_name= $this->request->getVar('name');
       
    $sql="INSERT INTO `model`( `model_name`, `model_status`) VALUES ('".$model_name."','active')";
    
    $query= $db->query($sql);
    
    $response = [
        'status' => 201,
        'error' => null,
        'messages' => [
            'success' => 'circular added successfully',

        ],
        'data' => 'success',

    ];
    return $this->respondCreated($response);
    }

    // single user
    public function show($id = null){
       
    }

    // update
    public function update($id = null){
     
      $msg =" ";
        $db = \Config\Database::connect();
      $sql="update `model` set `model_status`= 'Deleted' where model_id ='".$id."'";
      $query= $db->query($sql);
        $msg = 'Deleted Successfully';
   

    
    $response = [
        'status' => 201,
        'error' => null,
        'id'=>$sql,
        'messages' => [
            'success' => $msg,
        ],
        
    ];
    return $this->respond($response);
     
  }
    // delete
    public function delete($id = null){
      $data = [
        'status' => 'Deleted',
    ];
    $msg = 'Deleted Successfully';
    $response = [
      'status' => 201,
      'error' => null,
      'id'=>$id,
      'messages' => [
          'success' => $msg,
      ],
      'data' => $data,
  ];

  return $this->respond($response);
    }

}