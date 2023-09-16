<?php
namespace App\Models;
use CodeIgniter\Model;
class Product extends Model{
    protected $table='product';
    protected $primaryKey='product_id';


   
    protected $allowedFields=['timestamp','product_id','product_name','product_description','status','model_id','model_name','colors_available','available_size','sizetype','price','attachments'];

}
?>

