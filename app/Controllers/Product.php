<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;

class Product extends ResourceController
{
    use ResponseTrait;
    //getallproduct
    public function index()
    {
        $model = new ProductModel();
        $data['product'] = $model -> orderBy('id', 'DESC') ->findAll();
        return $this -> respond($data);
    }
    
    //get product by id
    public function getProduct($id = null){
        $model = new ProductModel();
        $data = $model->where('id',$id)->first();
        if($data){
            return $this->respond($data);
        }
        else{
            return $this->failNotFound('No Product found');
        }
   
    }

    //insert new product
    public function create()
    {
        $model = new ProductModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'category' => $this->request->getVar('category'),
            'price' => $this->request->getVar('price'),
            'tags' => $this->request->getVar('tags')
        ];
        $model->insert($data);
        $response = [
            'status' => 201,
            'error' => null,
            'message' => 'Product created success'
        ];
        return $this->respond($response);
    }

    //update Product
    public function update($id=null){
        $model = new ProductModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'category' => $this->request->getVar('category'),
            'price' => $this->request->getVar('price'),
            'tags' => $this->request->getVar('tags')
        ];
        $model->update($id, $data);
        $response = [
            'status' => 201,
            'error' => null,
            'message' => 'Product Updated success'
        ];
        return $this->respond($response);
    }

    //delete Producr
    public function delete($id=null){
    $model = new ProductModel();
    $data = $model->find($id);
        if($data){
            $model->delete($id);
            $response = [
                'status' => 200,
                'error' => null,
                'message' => [
                    'success' => 'Product Delete'
                ]
            ];
            return $this->respond($response);
        }
        else{
            return $this->failNotFound("No Product Found");
        }
    }
}


