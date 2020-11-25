<?php

/**
 * Roles Class
 * @author Rodilah Noer Rokhman <rodilahnoerrokhman @yahoo.co.id/@gmail.com>
 */
class Roles extends UserAccess {

  /**
   * Constructor
   */
  function Roles() {
    parent::__construct();
    $this->load->model('RolesModel', '', TRUE);
    $this->load->model('MasterModel', '', TRUE);
    
    //Write to session---------------------------------------
    $data = array('menu1' => $this->router->class);
    $this->session->set_userdata($data);
    //---------------------------------- End Write to session
  }

  /** Inisialisasi variabel for $title(for id element <body>) */
  var $title = 'Roles';

  /**
   * Show the Roles page if already logged or
   * back to the Login page when not logged.
   */
  function index() {
    $this->getList();
  }

  /**
   * @param for offset : int
   */
  function getList() {
    //Check Access Permission
    $statusAccess = parent::getAccess();
    if ($statusAccess) {
      //Initialization
      $data['title'] = $this->title;
      $data['h2_title'] = $this->title;
      $data['main_view'] = 'Admin/Roles/List';
      $data['link'] = site_url('Admin/Roles');
        
      //Halaman
      if (count($this->uri->segment_array()) > 4) {
        $dataSession = array('RolesOffsetP' => $this->uri->segment(5));
        $this->session->set_userdata($dataSession);
      }

      //Mendapatkan data
      $data['result'] = $this->getDataToList();

      //Cek data pencarian
      $this->form_validation->set_rules('Name', 'Name', 'required');
      if ($this->form_validation->run() == TRUE) {
        //Set session
        $dataSession = array('RolesName' => $this->input->post('Name'));
        $this->session->set_userdata($dataSession);

        redirect('Admin/Roles/getList');
      } else {
        $this->load->view('Admin/Template', $data);
      }
    }
  }
  
  function getDataToList() {
    $columnRoles = $this->RolesModel->setColumn();

    //Condition
    $num_rows = 0;
    $WHERE = '';
    $ArrayCondition_ = array();

    $SQL = 'SELECT * FROM ' . $columnRoles['Table'] . ' ' .
           ($WHERE<>''?'WHERE ' . $WHERE:'') . ' ' .
           'ORDER BY ' . $columnRoles['Name'] . ' ';
    $getData = $this->MasterModel->getQueryWithoutParameters($SQL)->result();

    if ($getData > 0) {

      $array_ = array();
      foreach ($getData as $list) {
        //data preparation
        $array1 = array($list->$columnRoles['NID'],
                        $list->$columnRoles['NName']);
        array_push($array_, $array1);
      }

      $data['array_'] = $array_;
    } else {
      $data['message'] = 'Not found any User Data!';
    }

    // Load default view
    return $data;
  }

  /** Untuk cek data kembar */
  function checkData($str) {
    //if certificate exist then delete all data on database
    if ($this->RolesModel->checkData($str) == TRUE) {
      $this->form_validation->set_message('checkData', 'Kode sudah digunakan.');
      return false;
    } else {
      return true;
    }
  }
  
  function getDataInfoByCode($ID) {
    $columnRoles = $this->RolesModel->setColumn();

    $result = '';
    $SQL = 'SELECT * FROM ' . $columnRoles['Table'] . ' ' .
           'WHERE ' . $columnRoles['ID'] . ' = ? ' .
           'ORDER BY ' . $columnRoles['ID'] . ' Desc LIMIT 1';
    $getInfo = $this->MasterModel->getQuery($SQL, array($ID))->row();
    if (count($getInfo) > 0) {
      $result = $getInfo->$columnRoles['NID'];
    }

    return $result;
  }

  /**
   * Process for update data
   * @param for AnggaranID : String
   */
  function info($ID) {
    //Check Access Permission
    $statusAccess = parent::getAccess($this->router->class, 'Info_', FALSE);
    if ($statusAccess) {
      //initialization
      $data['title'] = $this->title;
      $data['h2_title'] = $this->title;
      $data['main_view'] = 'Admin/Roles/Info';
      $data['form_action'] = site_url('Admin/Roles/update/' . $ID);
      $data['link'] = site_url('Admin/Roles');

      $data['default'] = $this->getDataInfo($ID);
      $this->load->view('Admin/Template', $data);
    }
  }

  function getDataInfo($ID) {
    $columnRoles = $this->RolesModel->setColumn();

    //Search data from Database
    $SQL = 'SELECT ' . $columnRoles['Table'] . '.* ' .
           'FROM ' . $columnRoles['Table'] . ' ' .
           'WHERE ' . $columnRoles['ID'] . ' = ?';
    $getInfo = $this->MasterModel->getQuery($SQL, array($ID))->row();

    //initialization
    $data['ID'] = $getInfo->$columnRoles['NID'];
    $data['Name'] = $getInfo->$columnRoles['NName'];

    return $data;
  }

  /** Process for enter the new user master data */
  function add() {
    $columnRoles = $this->RolesModel->setColumn();

    //Check Access Permission
    $statusAccess = parent::getAccess();
    if ($statusAccess) {
      // Inisialisasi data umum
      $data['title'] = $this->title;
      $data['h2_title'] = $this->title;
      $data['main_view'] = 'Admin/Roles/Form';
      $data['form_action'] = site_url('Admin/Roles/add');
      $data['link'] = site_url('Admin/Roles');

      // Set validation rules
      $this->form_validation->set_rules('Name', 'Name', 'required');
      $newDate = date('Y-m-d H:i:s');

      if ($this->form_validation->run() == TRUE) {
        //Prepare data for database
        $Roles = array($columnRoles['Name'] => $this->input->post('Name'));

        //Process for storing data
        $this->RolesModel->add($Roles);

        $this->session->set_flashdata('message', 'Sukses menambah data');
        redirect('Admin/Roles');
      } else {
        $this->load->view('Admin/Template', $data);
      }
    }
  }

  /** Untuk edit data */
  function update($ID) {
    $columnRoles = $this->RolesModel->setColumn();

    //Check Access Permission
    $statusAccess = parent::getAccess();
    if ($statusAccess) {
      //initialization
      $data['title'] = $this->title;
      $data['h2_title'] = $this->title;
      $data['main_view'] = 'Admin/Roles/Form';
      $data['form_action'] = site_url('Admin/Roles/update/' . $ID);
      $data['link'] = site_url('Admin/Roles');

      //Search data from Database
      $data['default'] = $this->getDataInfo($ID);

      // Set validation rules
      $this->form_validation->set_rules('Name', 'Name', 'required');
      $newDate = date('Y-m-d H:i:s');

      if ($this->form_validation->run() == TRUE) {
        //Prepare data for database
        //Cek if password not be change
        $Roles = array($columnRoles['Name'] => $this->input->post('Name'));

        //Process for storing data
        $this->RolesModel->update($ID, $Roles);
        //Set message
        $this->session->set_flashdata('message', 'Sukses edit data');
        redirect('Admin/Roles');
      }

      $this->load->view('Admin/Template', $data);
    }
  }

  /** Hapus data, (menjadikan tidak aktif) */
  function delete($ID) {
    $columnRoles = $this->RolesModel->setColumn();
    
    //Check Access Permission
    $statusAccess = parent::getAccess();
    if ($statusAccess) {

      //Process for storing data
      $this->RolesModel->delete($ID);

      //Set message
      $this->session->set_flashdata('message', '1 data berhasil diganti.');
      redirect('Admin/Roles');
    }
  }
}
