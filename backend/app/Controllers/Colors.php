<?php 
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Colors extends ResourceController
{
    use ResponseTrait;
    protected $modelName = 'App\Models\Colors';
    protected $format = 'json';

    // all users
    public function index(){
      $db = \Config\Database::connect();
       $sql="SELECT * FROM colors";
     
      $query= $db->query($sql);
      $data['Color_Data']= $query->getResult();
     
    return $this->respond($data);
    }
    // public function index()
    // {
    //     return view('welcome_message');
    // }

    // create
    public function create() {
        $data = [
            'color_name' => $this->request->getVar('name'),
            'color_hexvalue' => $this->request->getVar('value'),
        ];

         $this->model->insert($data);

        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'added successfully',

            ],
            'data' => $data,

        ];
        return $this->respondCreated($response);
    }

    // single user
    public function show($id = null){
       
    }

    // update
    public function update($id = null){
        $data = [
            'color_name' => $this->request->getVar('name'),

        ];
        $idi = $this->request->getVar('id');
    
      $this->model->update($idi, $data);
    $response = [
        'status' => 201,
        'error' => null,
        'messages' => [
            'success' => $idi,
        ],
        'data' => $data,
    ];
    return $this->respond($response);
       
    }

    // delete
    public function delete($id = null){
        $this->model->delete($id);
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'deleted successfully',

            ],
            'data' => $id,

        ];
        return $this->respond($response);
    }

}