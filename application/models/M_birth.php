<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_birth extends CI_Model
{
	public function dataAll(){
		$sql=$this->db->query("select *, date_format(datetime_maternity,'%d-%m-%Y %H:%i:%s') as date_maternity from tb_birth left join tb_child on  child_hd_id=birth_id");
		if($sql->num_rows()>0){
			$response['type']=0;
			$response['data']=$sql->result_array();
		}else{
			$response['type']=1;
			$response['data']=array();
		}
		return $response;
	}
	public function search($data){

		$sql=$this->db->query("select *, date_format(datetime_maternity,'%d-%m-%Y %H:%i:%s') as date_maternity from tb_birth left join tb_child on  child_hd_id=birth_id ".$data."");
		if($sql->num_rows()>0){
			$response['type']=0;
			$response['data']=$sql->result_array();
		}else{
			$response['type']=0;
			$response['data']=array();
		}
		return $response;
	}
	public function save($data,$id=''){
		unset($data['id']);
		if($id == ''){
			$this->db->insert('tb_birth',$data);
			$message='Tambah Data Berhasil';
			$birthId=$this->db->insert_id();
		}else{
			$this->db->where('birth_id',$id)->update('tb_birth',$data);
			$message='Update Data Berhasil';
			$birthId=$id;
		}
		$response=array(
			"type" =>0,
			"data" =>array("id"=>$birthId),
			"message" =>$message,
		);
		return $response;
	}
	public function show($id){
		$sql=$this->db->query("select * ,Date_format(datetime_maternity,'%d-%m-%Y %H:%i:%s') as date_maternity from tb_birth where birth_id ='".$id."'");
		if($sql->num_rows()>0){
			$response['data']['birth']=$sql->row_array();
			$sqlDetails=$this->db->where('child_hd_id',$id)->get('tb_child');
			$response['data']['childDetail']=$sqlDetails->row_array();
			$response['type']=0;
		}else{
			$response['type']=1;
			$response['data']='';
		}
		return $response;
	}
	public function delete($id){
		$this->db->where('birth_id',$id)->delete('tb_birth');
		$this->db->where('child_hd_id',$id)->delete('tb_child');
		$response['type']=0;
		$response['data']='';
		$response['message']='Detele Berhasil';
		return $response;
	}
	public function saveChild($data,$id=''){
		unset($data['id']);
		if($id == ''){
			$this->db->insert('tb_child',$data);
			$message='Tambah Data Berhasil';
		}else{
			$this->db->where('child_id',$id)->update('tb_child',$data);
			$message='Update Data Berhasil';
		}
		$response=array(
			"type" =>0,
			"message" =>$message,
		);
		return $response;
	
	}
	public function editChild($id){
		$sql=$this->db->where('child_id',$id)->get('tb_child');
		if($sql->num_rows()>0){
			$response['data']['child']=$sql->row_array();
			$response['type']=0;
		}else{
			$response['type']=1;
			$response['data']='';
		}
		return $response;
	}
	public function showChild($id){
		$sqlDetails=$this->db->where('child_hd_id',$id)->get('tb_child');
		
		if($sqlDetails->num_rows()>0){
			$response['data']['child']=$sqlDetails->result_array();
			$response['type']=0;
		}else{
			$response['type']=1;
			$response['data']='';
		}
		return $response;
	}
	public function deleteChild($id){
		$this->db->where('child_id',$id)->delete('tb_child');
		$response['type']=0;
		$response['data']='';
		$response['message']='Detele Berhasil';
		return $response;
	}
}
