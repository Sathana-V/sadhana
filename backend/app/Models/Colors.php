<?php
namespace App\Models;
use CodeIgniter\Model;
class Colors extends Model{
    protected $table='colors';
    protected $primaryKey='color_id';


   
    protected $allowedFields=['color_name','color_hexvalue'];
//     public function getData()
// {
//     $subjects=[
//         ['subject'=>'HMTaL','abbr'=>'Hyper Text']
//     ];

// return $subjects;
// }
}
?>