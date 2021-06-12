<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF { 
	function __construct() { 
		parent::__construct(); 
	}
	
	//Page header
    public function Header() {
        $logo = dirname('C:\xampp\htdocs\sparesCRM\application\libraries\tcpdf\images').'\elevation2.JPG';
        
        
        // Title
        $this->Image($logo,10,6,30);
        // Set font
        $this->SetFont('times', 'B', 20);
        $this->Cell(0, 15, 'Spares Information ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(10);
        // Set font
        $this->SetFont('times','',15);
        $this->Cell(0, 10, 'Shelter-Afrique House, Mamlaka Rd, Nairobi ', 0, false, 'C', 0, '', 0, false, 'M', 'M');

    }
    public function _destroy($destroyall = false, $preserve_objcopy = false)
        {
            if ($destroyall) {
                unset($this->imagekeys);
            }
            parent::_destroy($destroyall, $preserve_objcopy);
        }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */