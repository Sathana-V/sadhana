<?php 
namespace App\Models;
use CodeIgniter\Model;
class AdminModel extends Model{
    protected $table = 'admin_details';
    protected $primaryKey='email';
    protected $allowedFields=[
    'email',
    'password',
    'name',
    
];
}