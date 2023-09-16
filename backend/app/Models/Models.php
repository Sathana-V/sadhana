<?php
namespace App\Models;
use CodeIgniter\Model;
class Models extends Model{
    protected $table='model';
    protected $primaryKey='model_id';


   
    protected $allowedFields=['model_name','model_status'];
//     public function getData()
// {
//     $subjects=[
//         ['subject'=>'HMTaL','abbr'=>'Hyper Text']
//     ];

// return $subjects;
// }
}
?>