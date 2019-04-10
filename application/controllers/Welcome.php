<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('home');
	}

	public function contactForm()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data = $this->input->post();
            //print_r($data['projectType']);
            $this->sendemail($data);
            $this->load->view('success');
		}
	}

	public function sendemail($data)
    {
        //Load email library
        $this->load->library('email');
        //$this->load->library('encrypt');
        //SMTP & mail configuration
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.mailgun.org',
            'smtp_port' => 587,
            'smtp_user' => 'postmaster@sandboxed97f759b76b40f390ea99febdc3f7b7.mailgun.org',
            'smtp_pass' => 'ea5892287d2b893943a8487469b6a5dd-6140bac2-1d4fe115',
            'mailtype' => 'html',
            'charset' => 'utf-8'
		);
		$verificationkey = "adsfasdfasdfasdf";
		$emailaddr = "kaiser@designbuildltdbd.com";
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        //Email content
        $htmlContent = '<h1>Response from Design Build Website Contact Form</h1>';
        $htmlContent .= '<h2>From designbuildltdbd.com</h2>';
        $htmlContent .= '<p>Project Type: '.$data['projectType'].'</p>';
        $htmlContent .= '<p>Land Area: '.$data['landArea'].'</p>';
        $htmlContent .= '<p>Project Location: '.$data['location'].'</p>';
        $htmlContent .= '<p>Front Road: '.$data['frontRoad'].'</p>';
        $htmlContent .= '<p>Project Budget: '.$data['budget'].'</p>';
        $htmlContent .= '<p>How many stories: '.$data['stories'].'</p>';

        $htmlContent .= '<hr><h2>Client Details: </h2>';
        $htmlContent .= '<p>Client Name: '.$data['clientName'].'</p>';
        $htmlContent .= '<p>Client Phone: '.$data['clientMobile'].'</p>';
        $htmlContent .= '<p>Company Name: '.$data['clientCompany'].'</p>';
        $htmlContent .= '<p>E-mail: '.$data['clientMail'].'</p>';
        $htmlContent .= '<p>Website: '.$data['clientWebsite'].'</p>';
        $htmlContent .= '<p>City: '.$data['clientCity'].'</p>';
        $htmlContent .= '<p>Message: '.$data['clientMessage'].'</p>';
        $this->email->to($emailaddr);
        $this->email->from('info@designbuildltdbd.com', 'DESIGN BUILD LTD.');
        $this->email->subject('Response: Design Build Contact Form');
        $this->email->message($htmlContent);
        //Send email
        if ($this->email->send()) echo "email sent";
        else echo "sending failed";
    }
}
