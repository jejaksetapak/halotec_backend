<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Child extends REST_Controller {

	function __construct(){
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$method = $_SERVER['REQUEST_METHOD'];
		if($method == "OPTIONS") {
			die();
		}
		parent::__construct();
		$this->load->model('M_birth', 'birth');
	}
    public function index_get($id,$flag=''){
		if($flag =='edit'){
			$response=$this->birth->editChild($id);
			$this->response($response);	
		}else{
			$response=$this->birth->showChild($id);
			$this->response($response);
		}
    }
    public function index_post(){
		$error = [];
        if( !$this->post('birthId')) $error[] = 'birth Id harus diisi';
        if( !$this->post('genderChild')) $error[] = 'Jenis Kelamin Bayi harus diisi';
        if( !$this->post('longChild')) $error[] = 'Panjang Bayi harus diisi';
        if( !$this->post('weightChild')) $error[] = 'Berat Bayi harus diisi';
        if( !$this->post('conditionChild')) $error[] = 'Kondisi Bayi harus diisi';

        if( count($error) > 0 )
        {
            $this->response(['success' => false, 'message' => $error[0] ], 422);
        }
		$data=[
			"child_hd_id"       =>$this->post('birthId'),
			"child_gender"      =>$this->post('genderChild'),
			"child_long"        =>$this->post('longChild'),
			"child_weight"      =>$this->post('weightChild'),
			"child_condition"   =>$this->post('conditionChild')
		];
		$response=$this->birth->saveChild($data,'');
		$this->response($response);

	}
	public function index_put(){
		$error = [];
        if( !$this->put('birthId')) $error[] = 'birth Id harus diisi';
        if( !$this->put('genderChild')) $error[] = 'Jenis Kelamin Bayi harus diisi';
        if( !$this->put('longChild')) $error[] = 'Panjang Bayi harus diisi';
        if( !$this->put('weightChild')) $error[] = 'Berat Bayi harus diisi';
        if( !$this->put('conditionChild')) $error[] = 'Kondisi Bayi harus diisi';

        if( count($error) > 0 )
        {
            $this->response(['success' => false, 'message' => $error[0] ], 422);
        }
		$data=[
			"child_hd_id"       =>$this->put('birthId'),
			"child_gender"      =>$this->put('genderChild'),
			"child_long"        =>$this->put('longChild'),
			"child_weight"      =>$this->put('weightChild'),
			"child_condition"   =>$this->put('conditionChild')
		];
		$response=$this->birth->saveChild($data,$this->put('id'));
		$this->response($response);
	}
	public function index_delete($id){
		$response=$this->birth->deleteChild($id);
		$this->response($response);
	}
}