<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Product_model','product_model');
		$this->load->library('session');
	}

	function index(){
		$data['spares'] = $this->product_model->get_products();
		$this->load->view('product_list_view',$data);
	}

	public function spare() {
		$data['spares'] = $this->product_model->get_salesinfo();
		$this->load->view('salesinfo', $data);
	}

	// add new product
	function add_new(){
		$data['category'] = $this->product_model->get_category()->result();
		$this->load->view('add_product_view', $data);
	}

	// get sub category by category_id
	function get_sub_category(){
		$category_id = $this->input->post('id',TRUE);
		$data = $this->product_model->get_sub_category($category_id)->result();
		echo json_encode($data);
	}

	//save product to database
	function save_product(){
		$spare_date = $this->input->post('spare_date',TRUE);
		$spare_name_of_technician = $this->input->post('spare_name_of_technician',TRUE);
		$spare_number = $this->input->post('spare_number',TRUE);
		$category_id = $this->input->post('category',TRUE);
		$subcategory_id = $this->input->post('sub_category',TRUE);
		$spare_house = $this->input->post('spare_house',TRUE);
		$spare_damage_description = $this->input->post('spare_damage_description',TRUE);
		$this->product_model->save_product($spare_date,$spare_name_of_technician,$spare_number,$category_id,$subcategory_id,$spare_house,$spare_damage_description);
		$this->session->set_flashdata('msg','<div class="alert alert-success">Spare Info Saved</div>');
		redirect('product');
	}

	function get_edit(){
		$spare_id = $this->uri->segment(3);
		$data['spare_id'] = $spare_id;
		$data['category'] = $this->product_model->get_category()->result();
		$get_data = $this->product_model->get_product_by_id($spare_id);
		if($get_data->num_rows() > 0){
			$row = $get_data->row_array();
			$data['sub_category_id'] = $row['spare_subcategory_id'];
		}
		$this->load->view('edit_product_view',$data);
	}

	function get_data_edit(){
		$spare_id = $this->input->post('spare_id',TRUE);
		$data = $this->product_model->get_product_by_id($spare_id)->result();
		echo json_encode($data);
	}

	//update product to database
	function update_product(){
		$spare_id 	= $this->input->post('spare_id',TRUE);
		$spare_date = $this->input->post('spare_date',TRUE);
		$spare_name_of_technician = $this->input->post('spare_name_of_technician',TRUE);
		$spare_number = $this->input->post('spare_number',TRUE);
		$category_id = $this->input->post('category',TRUE);
		$subcategory_id = $this->input->post('sub_category',TRUE);
		$spare_house = $this->input->post('spare_house',TRUE);
		$spare_damage_description = $this->input->post('spare_damage_description',TRUE);
		$this->product_model->update_product($spare_id,$spare_date,$spare_name_of_technician,$spare_number,$category_id,$subcategory_id,$spare_house,$spare_damage_description);
		$this->session->set_flashdata('msg','<div class="alert alert-success">Spare Info Updated</div>');
		redirect('product');
	}

	//Delete Product from Database
	function delete(){
		$spare_id = $this->uri->segment(3);
		$this->product_model->delete_product($spare_id);
		$this->session->set_flashdata('msg','<div class="alert alert-success">Spare Info Deleted</div>');
		redirect('product');
	}

	public function generate_pdf() {
		//load pdf library
		$this->load->library('Pdf');
		
		$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetTitle('Spares Info ');
		$pdf->SetSubject('Report generated using Codeigniter and TCPDF');
		$pdf->SetKeywords('TCPDF, PDF, MySQL, Codeigniter');
	
		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
	
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	
		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	
		// set font
		$pdf->SetFont('times', '', 12);
		
		// ---------------------------------------------------------
		
		
		//Generate HTML table data from MySQL - start
		$template = array(
			'table_open' => '<table border="1" cellpadding="2" cellspacing="1">'
		);

		$this->load->library('table');
		
		$this->table->set_template($template);
	
		$this->table->set_heading('No', 'Date of Replacement', 'Name of Technician', 'Number of Spare Parts', 'Category of Spare Parts','Sub Category of Spare','House Address','Damage Description');
		
		$spare_id = $this->uri->segment(3);

		if($spare_id ==null)
		{
			$spares=$this->product_model->get_products();
		}
		else
		{
			$spares = $this->product_model->get_mapped_products_by_id($spare_id);
		}

		foreach ($spares ->result() as $sf):
			$this->table->add_row($sf->spare_id, $sf->spare_date, $sf->spare_name_of_technician, $sf->spare_number, $sf->category_name,$sf->subcategory_name,$sf->spare_house,$sf->spare_damage_description);
		endforeach;
		
		$html = $this->table->generate();
		//Generate HTML table data from MySQL - end
		
		// add a page
		$pdf->AddPage();
		
		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');
		
		// reset pointer to the last page
		$pdf->lastPage();
	
		//Close and output PDF document
		//$pdf->Output(md5(time()).'.pdf', 'D');
		$pdf->Output('Elevation Spares.pdf', 'D');
	}
}