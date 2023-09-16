<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Product extends ResourceController
{
    use ResponseTrait;
    protected $modelName = 'App\Models\Product';
    protected $format = 'json';

    // all users
    // public function index()
    // {
    //     $db = \Config\Database::connect();
    //     $userData = array();
    //     $sql = "SELECT * FROM product";
    //     $query = $db->query($sql);
    //     foreach ($query->getResult('array') as $row) {
          
    //         $row['available_size'] = unserialize($row['available_size']);
    //          $row['colors_available'] = unserialize($row['colors_available']);
    //         $row['price'] = unserialize($row['price']);
            
    //         $row['attached_images'] = unserialize($row['attachments']);
    //         array_push($userData, $row);
    //     }
    //     $res['Product_Data'] = $userData;
    //     return $this->respond($res);
    // }
   public function index()
    {
        $db = \Config\Database::connect();
        $userData = array();
        $sql = "SELECT * FROM product where status!='Deleted'";
        $query = $db->query($sql);
        $color="";
        $sql2=" ";
        $j=0;
        foreach ($query->getResult('array') as $row) {
            $i=0;
            $newcolor=array();
            $row['available_size'] = unserialize($row['available_size']) ? unserialize($row['available_size']) : [];
             $row['colors_available'] = unserialize($row['colors_available']);
             if ($row['colors_available']) {
             $sql2 = "SELECT color_id as id,color_name as name,color_hexvalue as hexvalue FROM colors where color_id in (";
            
             for (; $i < count( $row['colors_available'])-1; $i++) {
               
                $color=$row['colors_available'][$i];
                 $sql2.="".$color.","; 
            }
            $color=$row['colors_available'][$i];
            $sql2.="".$color."";
             $sql2.=") and 1=1";
             
             $query2 = $db->query($sql2);
             foreach ($query2->getResult('array') as $row2) {
               
                array_push($newcolor,$row2);
             }
            
             }
            $row['price'] = unserialize($row['price']) || unserialize($row['price']) ? unserialize($row['price']) : [];
            $row['colors_available']=$newcolor;
            
            $row['attached_images'] = unserialize($row['attachments']) ? unserialize($row['attachments']) : [];
            
            array_push($userData, $row);
            $j++;
        }
        
        $res['Product_Data'] = $userData;
        return $this->respond($res);
    }
    
    public function create()
    {
        date_default_timezone_set("Asia/Kolkata");
        $attachment = '';
        $time = date("Y-m-d-h-i-sa");
        $fileName = array();

        if ($this->request->getFileMultiple('files')) {

            foreach ($this->request->getFileMultiple('files') as $file) {

                $filename = $file->getClientName();
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                // Valid extensions
                $valid_ext = array("png", "jpeg", "jpg", "pdf", "txt", "doc", "docx");

                // Check extension
                if (in_array($ext, $valid_ext)) {
                    $newfilename = "Attachment_" . $time . "_" . $filename;
                    array_push($fileName, $newfilename);
                    $file->move('../public/uploads', $newfilename);
                }
            }
            $attachment = serialize($fileName);
        }

        if ($this->request->getVar('status') == 'new') {
            $status = 'Created';
        }
        $data = [
            'product_name' => $this->request->getVar('product_name'),
            'product_description' => $this->request->getVar('product_description'),
            'attachments' => $attachment,
            'model_id' => $this->request->getVar('model_id'),
            'model_name' => $this->request->getVar('model_name'),
            'colors_available' => serialize($this->request->getVar('available_colors')),
            'status' => $status,
            'available_size' =>serialize($this->request->getVar('available_size')),
            'price'=>serialize($this->request->getVar('pricelist')),
            'sizetype'=>$this->request->getVar('sizetype'),
            'timestamp' => date('Y-m-d H:i:s'),
        ];

        $this->model->insert($data);

        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'circular added successfully',

            ],
            'data' => $data,

        ];
        return $this->respondCreated($response);
    }

    // single user
    public function show($id = null)
    {

        $db = \Config\Database::connect();
        $userData = array();
        $sql = "SELECT * FROM product where status!='Deleted' and product_id='".$id."'";
        $query = $db->query($sql);
        $color="";
        
        $sql2=" ";
        foreach ($query->getResult('array') as $row) {
            $newcolor=array();
            $row['available_size'] = unserialize($row['available_size']);
             $row['colors_available'] = unserialize($row['colors_available']);
             $sql2 = "SELECT color_id as id,color_name as name,color_hexvalue as hexvalue FROM colors where color_id in (";
             for ($i = 0; $i < count( $row['colors_available'])-1; $i++) {
                $color=$row['colors_available'][$i];
               
                 $sql2.="".$color.","; 
            }
            $color=$row['colors_available'][$i];
            $sql2.="".$color."";
             $sql2.=") and 1=1";
             $query2 = $db->query($sql2);
             foreach ($query2->getResult('array') as $row2) {
               
                array_push($newcolor,$row2);
             }
             $row['newcolor']=$sql2;
             $row['newolor']=array_count_values($row['colors_available']);
            $row['price'] = unserialize($row['price']);
            $row['colors_available']=$newcolor;
            $row['attached_images'] = unserialize($row['attachments']);
            array_push($userData, $row);
        }
        $res['Product_Data'] = $userData;
        return $this->respond($res);
    }
    public function count()
    {
        $db = \Config\Database::connect();
        $userData = array();
        $sql = "SELECT count(*) as count FROM product where status!='Deleted'";
        $query = $db->query($sql);
        
        foreach ($query->getResult('array') as $row) {
            array_push($userData,$row['count']);
        }
        $response = [
           
            'ProductCount' => $userData,
        ];
        return $this->respond($response);
    }
    // update
    public function update($id = null)
    {
        $msg = '';
        $status = $this->request->getVar('operation');
        //  return $this->respond($id.$status);
        $data = '';
        if ($status == 'Publish') {
            $data = [
                'state' => 'Published',
                'status' => 'Despatched',
            ];
            $msg = 'Publshed Successfully';
        }else if ($status == 'unPublish') {
            $data = [
                'state' => 'Unpublished',
                'status' => 'Created',
            ];
            $msg = 'Publshed Successfully';
        } 
        else if ($status == 'Update') {
            date_default_timezone_set("Asia/Kolkata");
            $attachment = '';
            $msg = 'Updated Successfully';
            if ($this->request->getVar('oldfiles')) {

                // Count total files
                $oldarr = $this->request->getVar('oldfiles');
                $length = sizeof($oldarr);
                $location = "../public/uploads/";

                for ($i = 0; $i < $length; $i++) {

                    $imgloc = $location . $oldarr[$i];
                    if (!unlink($imgloc)) {
                        $msg .= 'There was a error deleting the file ' . $imgloc;
                    }
                }
            }
            $time = date("Y-m-d-h-i-sa");
            $fileName = array();
            $attachment = $this->request->getFileMultiple('files');
            if ($this->request->getFileMultiple('files')) {

                foreach ($this->request->getFileMultiple('files') as $file) {

                    $filename = $file->getClientName();
                    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                    // Valid extensions
                    $valid_ext = array("png", "jpeg", "jpg", "pdf", "txt", "doc", "docx");
                    if (in_array($ext, $valid_ext)) {
                        $pattern = '/Attachment_[0-9]{4}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}[a|p]m_/i';
                        $filename = preg_replace($pattern, '', $filename);
                        $newfilename = "Attachment_" . $time . "_" . $filename;
                        array_push($fileName, $newfilename);

                        $file->move('../public/uploads', $newfilename);
                    }
                    // Check extension

                }
                $attachment = serialize($fileName);
            }

            $data = [
                'product_name' => $this->request->getVar('product_name'),
                'product_description' => $this->request->getVar('product_description'),
                'model_id' => $this->request->getVar('model_id'),
                'model_name' => $this->request->getVar('model_name'),
                'colors_available' => serialize($this->request->getVar('available_colors')),
                'available_size' =>serialize($this->request->getVar('available_size')),
                'price'=>serialize($this->request->getVar('pricelist')),
                'sizetype'=>$this->request->getVar('sizetype'),
                'attachments' => $attachment,
                'status' => $this->request->getVar('status'),
                'timestamp' => date('Y-m-d H:i:s'),
                'oldfiles' => $this->request->getVar('oldfiles'),

            ];
            $id = $this->request->getVar('id');
        } else if ($status == 'Delete') {
            $data = [
                'status' => 'Deleted',
            ];
            $msg = 'Deleted Successfully';
        }

         $this->model->update($id, $data);
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

    // delete
    public function delete($id = null)
    {
    }
}
