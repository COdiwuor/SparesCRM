<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model{
	
	function get_category(){
		$query = $this->db->get('category');
		return $query;	
	}

	function get_sub_category($category_id){
		$query = $this->db->get_where('sub_category', array('subcategory_category_id' => $category_id));
		return $query;
	}
	
	function save_product($spare_date,$spare_name_of_technician,$spare_number,$category_id,$subcategory_id,$spare_house,$spare_damage_description){
		$data = array(
			'spare_date' => $spare_date,
			'spare_name_of_technician' => $spare_name_of_technician,
			'spare_number' => $spare_number,
			'spare_category_id' => $category_id,
			'spare_subcategory_id' => $subcategory_id,
			'spare_house' => $spare_house,
			'spare_damage_description' => $spare_damage_description
		);
		$this->db->insert('spare',$data);
	}

	function get_products(){
		$this->db->select('spare_id,spare_date,spare_name_of_technician,spare_number,category_name,subcategory_name,spare_house,spare_damage_description');
		$this->db->from('spare');
		$this->db->join('category','spare_category_id = category_id','left');
		$this->db->join('sub_category','spare_subcategory_id = subcategory_id','left');	
		$query = $this->db->get();
		return $query;
	}
	function get_mapped_products_by_id($spare_id)
	{
		$this->db->select('spare_id,spare_date,spare_name_of_technician,spare_number,category_name,subcategory_name,spare_house,spare_damage_description');
		$this->db->join('category','spare_category_id = category_id','left');
		$this->db->join('sub_category','spare_subcategory_id = subcategory_id','left');	
		$query = $this->db->get_where('spare', array('spare_id' =>  $spare_id));
		return $query;
	}

	function get_product_by_id($spare_id){
		$query = $this->db->get_where('spare', array('spare_id' =>  $spare_id));
		return $query;
	}

	function update_product($spare_id,$spare_date,$spare_name_of_technician,$spare_number,$category_id,$subcategory_id,$spare_house,$spare_damage_description){
		$this->db->set('spare_date', $spare_date);
		$this->db->set('spare_name_of_technician', $spare_name_of_technician);
		$this->db->set('spare_number', $spare_number);
		$this->db->set('spare_category_id', $category_id);
		$this->db->set('spare_subcategory_id', $subcategory_id);
		$this->db->set('spare_house', $spare_house);
		$this->db->set('spare_damage_description', $spare_damage_description);
		$this->db->where('spare_id', $spare_id);
		$this->db->update('spare');
	}

	//Delete Product
	function delete_product($spare_id){
		$this->db->delete('spare', array('spare_id' => $spare_id));
	}

	function get_salesinfo() {
		$this->db->select('spare_id,spare_date,spare_name_of_technician,spare_number,category_name,subcategory_name,spare_house,spare_damage_description');
		$this->db->from('spare');
		$this->db->join('category','spare_category_id = category_id','left');
		$this->db->join('sub_category','spare_subcategory_id = subcategory_id','left');	
		$query = $this->db->get();
		return $query;
		
		
	}

	
}