<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Patient extends REST_Controller {

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
	public function index_get($id=0){
		if($id==0){
			$response=$this->birth->dataAll();
			$this->response($response);
		}else{
			$response=$this->birth->show($id);
			$this->response($response);
		}
	}
	public function index_post($flag=''){
		if($flag ==''){
			$error = [];
			if( !$this->post('nameMother')) $error[] = 'Nama Ibu harus diisi';
			if( !$this->post('ageMother')) $error[] = 'Umur Ibu harus diisi';
			if( !$this->post('agePregnancy')) $error[] = 'Umur Kandungan harus diisi';
			if( !$this->post('datetimeMaternity')) $error[] = 'Tanggal dan Jam Bersalin harus diisi';
			if( !$this->post('parturitionProcess')) $error[] = 'Proses Partus harus diisi';
	
			if( count($error) > 0 )
			{
				$this->response(['success' => false,'type'=>1,'message' => $error[0] ], 422);
			}
			$data=[
				"id" =>'',
				"name_mother" =>$this->post('nameMother'),
				"age_mother" =>$this->post('ageMother'),
				"age_pregnancy" =>$this->post('agePregnancy'),
				"datetime_maternity" =>$this->post('datetimeMaternity'),
				"parturition_process" =>$this->post('parturitionProcess')
			];
			$response=$this->birth->save($data,'');
			$this->response($response);
		}else{
			$dateStart=date('Y-m-d',strtotime($this->post('dateSearchStart')));
			$dateEnd=date('Y-m-d',strtotime($this->post('dateSearchEnd')));
			$search="WHERE date_format(datetime_maternity,'%Y-%m-%d') between ".$dateStart." AND ".$dateEnd."";
			$response =$this->birth->search($search);
			$this->response($response);
		}

	}
	public function index_put(){
		$error = [];
        if( !$this->put('nameMother')) $error[] = 'Nama Ibu harus diisi';
        if( !$this->put('ageMother')) $error[] = 'Umur Ibu harus diisi';
        if( !$this->put('agePregnancy')) $error[] = 'Umur Kandungan harus diisi';
        if( !$this->put('datetimeMaternity')) $error[] = 'Tanggal dan Jam Bersalin harus diisi';
        if( !$this->put('parturitionProcess')) $error[] = 'Proses Partus harus diisi';

        if( count($error) > 0 )
        {
            $this->response(['success' => false, 'message' => $error[0] ], 422);
        }
		$data=[
			"id" =>$this->put('id'),
			"name_mother" =>$this->put('nameMother'),
			"age_mother" =>$this->put('ageMother'),
			"age_pregnancy" =>$this->put('agePregnancy'),
			"datetime_maternity" =>$this->put('datetimeMaternity'),
			"parturition_process" =>$this->put('parturitionProcess')
		];
		$response=$this->birth->save($data,$this->put('id'));
		$this->response($response);
	}
	public function index_delete($id){
		$response=$this->birth->delete($id);
		$this->response($response);
	}
}
