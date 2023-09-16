<?php
namespace App\Models;
use CodeIgniter\Model;
class Size extends Model{
    protected $table='sizechart';
    protected $primaryKey='size_id';


   
    protected $allowedFields=['size_label','size_rank'];
//     public function getData()
// {
//     $subjects=[
//         ['subject'=>'HMTaL','abbr'=>'Hyper Text']
//     ];

// return $subjects;
// }
}
?>