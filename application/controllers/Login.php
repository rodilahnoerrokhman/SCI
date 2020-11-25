<?php

/**
 * Login Class
 * @author Rodilah Noer Rokhman <rodilahnoerrokhman @yahoo.co.id/@gmail.com>
 */
class Login extends UserAccess {

  /** Constructor */
  public function Login() {
    parent::__construct();
    $this->load->model('UserModel', '', true);
    
    //Write to session---------------------------------------
    $data = array('menu1' => $this->router->class);
    $this->session->set_userdata($data);
    //---------------------------------- End Write to session
  }

  var $title = 'Happy Puppy';

  //var $h2_title = 'Data Karyawan';
  //var $limit = 20;

  /** Show Employee page */
  public function index($URL = '') {
    if ($this->session->userdata('Login') == true) {
      redirect('Admin/Home');
    } else {
      $this->processLogin($URL);
    }
  }

  /** Process for Login */
  function processLogin($URL = '') {
    //Inisialisasi variable
    $columnUser = $this->UserModel->setColumn();
    $data['form_action'] = site_url('Login/processLogin/' . $URL);
    
    //Cek inputan
    $this->form_validation->set_rules('Email', 'Email', 'required');
    $this->form_validation->set_rules('Password', 'Password', 'required');

    if ($this->form_validation->run() == true) {
      $Email = $this->input->post('Email');
      $Password = do_hash($this->input->post('Password'), 'md5');

      if ($this->UserModel->Login($Email, $Password) == true) {
        //Mencari data di database
        $dataInfo = $this->UserModel->getInfoByEmail($Email)->row();
        
        //2 Write to session---------------------------------------
        $data = array('LoginName' => $dataInfo->$columnUser['NFirstName'],
                      'LoginID' => $dataInfo->$columnUser['NID'],
                      'Login' => true);
        $this->session->set_userdata($data);
        
        if($URL=='') redirect('Admin/Home');
        else redirect(str_replace('~', '/', $URL));
      } else {
        $this->session->set_flashdata('message', 'Maaf, UserName dan atau Password Anda salah');
        redirect('Login/processLogin/' . $URL);
      }
    } else {
      $this->load->view('Admin/Login/Login', $data);
    }
    //1 -----------------------------------------End Start Validate
  }

  /** Process for logout */
  function processLogout() {
    $this->session->sess_destroy();
    redirect('Login', 'refresh');
  }

}