<?php

/**
 * User Class
 * @author Rodilah Noer Rokhman <rodilahnoerrokhman @yahoo.co.id/@gmail.com>
 */
class User extends UserAccess {

  /**
   * Constructor
   */
  function User() {
    parent::__construct();
    $this->load->library("Excel/PHPExcel");
    $this->load->model('UserModel', '', TRUE);
    $this->load->model('RolesModel', '', TRUE);
    $this->load->model('MasterModel', '', TRUE);
    
    //Write to session---------------------------------------
    $data = array('menu1' => $this->router->class);
    $this->session->set_userdata($data);
    //---------------------------------- End Write to session
  }

  /** Inisialisasi variabel for $title(for id element <body>) */
  var $title = 'User';

  /**
   * Show the User page if already logged or
   * back to the Login page when not logged.
   */
  function index() {
    $this->getList();
  }
  
  /** For initialization form search for data */
  function initializationSession() {
    //initialization
    $data['Name'] = $this->session->userdata('SUserName');
    $data['Role'] = $this->session->userdata('SUserRole');

    return $data;
  }
  
  /** For initialization form search for data */
  function resetSession() {
    $dataSession = array('SUserName' => '',
                         'SUserRole' => '');
    $this->session->set_userdata($dataSession);
  }

  /**
   * Show the User based on limit --> 10/page
   * @param for offset : int
   */
  function getList() {
    //Check Access Permission
    $statusAccess = parent::getAccess();
    if ($statusAccess) {
      //Initialization
      $data['title'] = $this->title;
      $data['h2_title'] = $this->title;
      $data['main_view'] = 'Admin/User/List';
      $data['link'] = site_url('Admin/User');
      
      if (count($this->uri->segment_array()) == 2) {
        $this->resetSession();
      }
      $data['default'] = $this->initializationSession();

      //Mendapatkan data
      $data['result'] = $this->getDataToList();
      
      //Cek data pencarian
      $this->form_validation->set_rules('XX', 'XX', 'required');
      $this->form_validation->set_rules('Name', 'Name', '');
      $this->form_validation->set_rules('Role', 'Role', '');
      if ($this->form_validation->run() == TRUE) {
        //Set session
        $dataSession = array('SUserName' => $this->input->post('Name'),
                             'SUserRole' => $this->input->post('Role'));
        $this->session->set_userdata($dataSession);

        redirect('Admin/User/getList');
      } else {
        $this->load->view('Admin/Template', $data);
      }
    }
  }
  
  function getDataToList() {
    $columnUser = $this->UserModel->setColumn();
    $columnRoles = $this->RolesModel->setColumn();

    //Condition
    $num_rows = 0;
    $WHERE = '';

    if ($this->session->userdata('SUserName') <> '') {
      $WHERE = ($WHERE<>'')?($WHERE . ' AND '):$WHERE;
      $WHERE = $WHERE . ' ' . $columnUser['FirstName'] . ' like "%' . $this->session->userdata('SUserName') . '%"';
    }

    if ($this->session->userdata('SUserRole') <> '') {
      $WHERE = ($WHERE<>'')?($WHERE . ' AND '):$WHERE;
      $WHERE = $WHERE . ' ' . $columnRoles['Name'] . ' like "%' . $this->session->userdata('SUserRole') . '%"';
    }

    $SQL = 'SELECT ' .
             $columnUser['Table'] . '.*, ' .
             $columnRoles['Name'] . ' AS ' . $columnUser['NRoleName'] . ' ' .
           'FROM ' . $columnUser['Table'] . ' ' .
             'LEFT JOIN ' . $columnRoles['Table'] . ' ' .
               'ON ' . $columnRoles['ID'] . ' = ' . $columnUser['Role'];
    $SQL = ($WHERE<>'')?($SQL . ' WHERE ' . $WHERE):$SQL;
    $SQL = $SQL . ' ORDER BY ' . $columnUser['ID'] . ' ';
    $getData = $this->MasterModel->getQueryWithoutParameters($SQL)->result();
    
    if ($getData > 0) {
      $array_ = array();
      foreach ($getData as $list) {
        //data preparation
        $array1 = array($list->$columnUser['NID'],
                        $list->$columnUser['NEmail'],
                        $list->$columnUser['NFirstName'],
                        $list->$columnUser['NRoleName'],
                        $list->$columnUser['NRole']);
                        
        array_push($array_, $array1);
      }
      
      $data['array_'] = $array_;
    } else {
      $data['message'] = 'Data tidak ditemukan.';
    }

    // Load default view
    return $data;
  }
  
  /** Menampilkan data Role */
  function getListRole() {
    $columnRole = $this->RolesModel->setColumn();

    $data = array();
    $getData = $this->RolesModel->getList()->result();
    if (count($getData) > 0) {
      foreach ($getData as $list) {
        //data preparation
        array_push($data, array($list->$columnRole['NID'],
                                $list->$columnRole['NName']));
      }
    }

    return $data;
  }

  /** Process for enter the new user master data */
  function add() {
    $columnUser = $this->UserModel->setColumn();
    
    //Check Access Permission
    $statusAccess = parent::getAccess();
    if ($statusAccess) {
      // Inisialisasi data umum
      $data['title'] = $this->title;
      $data['h2_title'] = $this->title;
      $data['main_view'] = 'Admin/User/Form';
      $data['form_action'] = site_url('Admin/User/add');
      $data['link'] = site_url('Admin/User');
      $data['DataRole'] = $this->getListRole();
      
      $this->form_validation->set_rules('Email', 'Email', 'required');
      $this->form_validation->set_rules('Password', 'Password', 'required');
      $this->form_validation->set_rules('Name', 'Name', 'required');
      $this->form_validation->set_rules('Role', 'Role', 'required');
      $DateNow = date('Y-m-d H:i:s');

      if ($this->form_validation->run() == TRUE) {
        //Prepare data for database
        $User = array($columnUser['Email'] => $this->input->post('Email'),
                      $columnUser['Password'] => do_hash($this->input->post('Password'), 'md5'),
                      $columnUser['FirstName'] => $this->input->post('Name'),
                      $columnUser['Role'] => $this->input->post('Role'));

        //Process for storing data
        $this->UserModel->add($User);
        $this->session->set_flashdata('message', '1 data berhasil dibuat.');

        redirect('Admin/User');
      } else {
        $this->load->view('Admin/Template', $data);
      }
    }
  }

  /** Mendapatkan data berdasarkan ID */
  function info($ID) {
    //Check Access Permission
    $statusAccess = parent::getAccess($this->router->class, 'Info_', FALSE);
    if ($statusAccess) {
      //initialization
      $data['title'] = $this->title;
      $data['h2_title'] = $this->title;
      $data['main_view'] = 'Admin/User/Info';
      $data['form_action'] = site_url('Admin/User/update/' . $ID);
      $data['link'] = site_url('Admin/User');

      $data['default'] = $this->getDataInfo($ID);

      $this->load->view('Admin/Template', $data);
    }
  }
  
  function getDataInfo($ID) {
    $columnUser = $this->UserModel->setColumn();
    $columnNext = $this->MasterModel->setColumnNext();
    $data = '';
    
    //Search data from Database
    $SQL = 'SELECT ' . $columnUser['Table'] . '.* ' .
           'FROM ' . $columnUser['Table'] . ' ' .
           'WHERE ' . $columnUser['ID'] . ' = ?';
    $getInfo = $this->MasterModel->getQuery($SQL, array($ID))->row();
    
    if(count($getInfo)>0) {
      //initialization
      $data['ID'] = $getInfo->$columnUser['NID'];
      $data['Name'] = $getInfo->$columnUser['NFirstName'];
      $data['Email'] = $getInfo->$columnUser['NEmail'];
      $data['Role'] = $getInfo->$columnUser['NRole'];
    }

    return $data;
  }
  
  /**
   * Checek for data exist (callback_check_user)
   * @param for word : String
   */
  function check_user($str) {
    //if certificate exist then delete all data on database
    if ($this->UserModel->checkData($str) == TRUE) {
      $this->form_validation->set_message('check_user', 'Username sudah digunakan.');
      return false;
    } else {
      return true;
    }
  }
  
  /** Proses edit. */
  function update($ID) {
    $columnUser = $this->UserModel->setColumn();
    
    //Check Access Permission
    $statusAccess = parent::getAccess();
    if ($statusAccess) {
      // Inisialisasi data umum
      $data['title'] = $this->title;
      $data['h2_title'] = $this->title;
      $data['main_view'] = 'Admin/User/Form';
      $data['form_action'] = site_url('Admin/User/update/' . $ID);
      $data['link'] = site_url('Admin/User/info/' . $ID);
      $data['DataRole'] = $this->getListRole();
      
      //Search data from Database
      $data['default'] = $this->getDataInfo($ID);
      
      // Set validation rules
      $this->form_validation->set_rules('Email', 'Email', 'required');
      $this->form_validation->set_rules('Name', 'Name', 'required');
      $this->form_validation->set_rules('Role', 'Role', 'required');
      $DateNow = date('Y-m-d H:i:s');
      
      if ($this->form_validation->run() == TRUE) {
        //Prepare data for database
        $User = array($columnUser['Email'] => $this->input->post('Email'),
                      $columnUser['Password'] => do_hash($this->input->post('Password'), 'md5'),
                      $columnUser['FirstName'] => $this->input->post('Name'),
                      $columnUser['Role'] => $this->input->post('Role'));

        //Process for storing data
        $this->UserModel->update($ID, $User);
        
        //Set message
        $this->session->set_flashdata('message', '1 data berhasil diganti.');
        redirect('Admin/User/');
      }

      $this->load->view('Admin/Template', $data);
    }
  }

  /** Menuju halaman upload. */
  function UploadFile() {
    //Check Access Permission
    $statusAccess = parent::getAccess($this->router->class, 'Update_', FALSE);
    if ($statusAccess) {
      $data['title'] = $this->title;
      $data['h2_title'] = 'Import Data';
      $data['link'] = site_url('Admin/User');
      $this->load->view('Admin/User/UploadFile', $data);
    }
  }

  /** Proses upload */
  function ProcessUploadFile() {
    $columnUser = $this->UserModel->setColumn();
    $User = $this->session->userdata('LoginName');
    if($User=='') $User = '-';
    
    //Set main folder
    $output_dir = 'uploads/' . $this->router->class;
    $this->createPath($output_dir);

    //Folder
    $output_dir = $output_dir . '/';

    if (isset($_FILES["myfile"])) {
      $ret = array();
      $error = $_FILES["myfile"]["error"];
      if (!is_array($_FILES["myfile"]['name'])) { //single file
        $fileName = $User . '-' . str_replace(')', '', str_replace('(', '', str_replace(' ', '', $_FILES["myfile"]["name"])));
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileName = str_replace(')', '', str_replace('(', '', str_replace(' ', '', $_POST['varA'] . $fileName)));
        move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName);

        $ret[$fileName] = $output_dir . $fileName;
        $imgData = addslashes(file_get_contents($output_dir . $fileName));
        
        //mulai import data
        $this->importFromExcel($output_dir . $fileName);
      }
      echo json_encode($ret);
    }
  }
  
  /** Proses upload */
  function ProcessUploadFile11() {
     //mulai import data
     $this->importFromExcel('uploads/' . $this->router->class . '/--User26.xlsx');
  }
  
  function importFromExcel($url) {
    $columnUser = $this->UserModel->setColumn();
    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel = $excelreader->load($url);
    //$loadexcel = $excelreader->load('uploads/' . $this->router->class . '/--User26.xlsx');
    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
        
    $data = array();
    $numrow = 1;
    foreach($sheet as $row){
      // Cek $numrow apakah lebih dari 1
      // Artinya karena baris pertama adalah nama-nama kolom
      // Jadi dilewat saja, tidak usah diimport
      if($numrow > 1){
        // Kita push (add) array data ke variabel data
        /*array_push($data, array(
          'nis'=>$row['A'], // Insert data nis dari kolom A di excel
          'nama'=>$row['B'], // Insert data nama dari kolom B di excel
          'jenis_kelamin'=>$row['C'], // Insert data jenis kelamin dari kolom C di excel
          'alamat'=>$row['D'], // Insert data alamat dari kolom D di excel
        ));*/
        echo $row['A'] . ', ' . $row['B'] . ', ' . $row['C'] . ', ' . $row['D'] . '<br>';
        
        //Cek apakah ada email yang sama
        $datauser = $this->UserModel->getInfoByEmail($row['B'])->row();
        //jika tidak maka insert
        if($datauser == '') {
          $User = array($columnUser['Email'] => $row['B'],
                        $columnUser['Password'] => do_hash($this->input->post('0000'), 'md5'),
                        $columnUser['FirstName'] => $row['C'],
                        $columnUser['Role'] => $row['D']);

          //Process for storing data
          $this->UserModel->add($User);
        }
        //jika ada maka update
        else {
          //Prepare data for database
          $User = array($columnUser['FirstName'] => $row['C'],
                        $columnUser['Role'] => $row['D']);

          //Process for storing data
          $this->UserModel->updateByEmail($row['B'], $User);
        }
      }

      $numrow++; // Tambah 1 setiap kali looping
    }
  }

  /**
   * Process for delete data
   * @param for UserName : String
   */
  function delete($ID) {
    //Check Access Permission
    $statusAccess = parent::getAccess($this->router->class, 'Delete_', FALSE);
    if ($statusAccess) {
      $data = $this->getDataInfo($ID);
      
      $this->removePath($data['Photo']);
      $this->UserModel->delete($ID);
      
      $this->session->set_flashdata('message', '1 data berhasil dihapus.');

      redirect('Admin/User');
    }
  }
  
  /** Update Password */
  function updatePassword($ID) {
    $columnUser = $this->UserModel->setColumn();
    
    //Check Access Permission
    $statusAccess = parent::getAccess();
    if ($statusAccess) {
      //initialization
      
      $data['title'] = $this->title;
      $data['h2_title'] = $this->title;
      $data['main_view'] = 'Admin/User/FormPassword';
      $data['form_action'] = site_url('Admin/User/updatePassword/' . $ID);
      $data['link'] = site_url('Admin/User/info/' . $ID);

      //Search data from Database
      $data['default'] = $this->getDataInfo($ID);

      // Set validation rules
      $this->form_validation->set_rules('Email', 'Email', 'required');
      $this->form_validation->set_rules('Password', 'Password', 'required');
      if ($this->form_validation->run() == TRUE) {
        //Prepare data for database
        //Cek if password not be change
        if ($this->input->post('Password') <> '') {
          $User = array($columnUser['Password'] => do_hash($this->input->post('Password'), 'md5'));

          //Process for storing data
          $this->UserModel->update($ID, $User);
        }

        //Set message
        $this->session->set_flashdata('message', '1 data berhasil diganti.');
        redirect('Admin/User/');
      }

      $this->load->view('Admin/Template', $data);
    }
  }
  
  /** Update Email */
  function updateEmail($ID) {
    $columnUser = $this->UserModel->setColumn();
    
    //Check Access Permission
    $statusAccess = parent::getAccess($this->router->class, 'Update_', FALSE);
    if ($statusAccess) {
      //initialization
      
      $data['title'] = $this->title;
      $data['h2_title'] = $this->title;
      $data['main_view'] = 'Admin/User/FormEmail';
      $data['form_action'] = site_url('Admin/User/updateEmail/' . $ID);
      $data['link'] = site_url('Admin/User/info/' . $ID);

      //Search data from Database
      $data['default'] = $this->getDataInfo($ID);

      // Set validation rules
      $this->form_validation->set_rules('UserName', 'User Name', 'required');
      $this->form_validation->set_rules('Email', 'Email', 'required');
      $this->form_validation->set_rules('EmailPassword', 'Password Email', 'required');
      if ($this->form_validation->run() == TRUE) {
        if($this->SendEmail($this->input->post('Email'),
                            $this->input->post('EmailPassword'),
                            $this->input->post('Email'),
                            $this->input->post('Email'),
                            $this->input->post('Email'),
                            'Test Email',
                            'Test Email',
                            'Test Email from ' . site_url())) {
          //Prepare data for database
          $User = array($columnUser['Email'] => $this->input->post('Email'),
                        $columnUser['EmailPassword'] => $this->input->post('EmailPassword'));

          //Process for storing data
          $this->UserModel->update($ID, $User);

          //Set message
          $this->session->set_flashdata('message', '1 data berhasil diganti (email berhasil dikirim)');
          redirect('Admin/User/info/' . $ID);
        } else {
          $this->session->set_flashdata('message', 'Error! email tidak dapat dikirim.');
          $this->load->view('Admin/Template', $data);
        }
      }

      $this->load->view('Admin/Template', $data);
    }
  }
  
  
  
  
  
  
  
  
  
  public function downloadExcel() {
    $result = $this->getDataToList();
    $c1c1 = $this->arrayExcel();
    $c1c1_ = 0;
    $row = 1;
    
    $tmp;
    $tmpTotal;
    
    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = array(
      'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );
    $style_row_Number = array(
      'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      ),
      'code' => PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1
    );
    
    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    $style_col = array(
      'font' => array('bold' => true), // Set font nya jadi bold
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );
    
    //$Status = $this->AdminMasterProcessModel->getData($this->session->userdata('StatisticalDataReportStatusP'))->row();
    //$StatusD = '';
    //if(count($Status)>0) { $StatusD = $Status->Description; }
    
    //------------------------Laporan perTanggal
    //------------------------Laporan perTanggal
    //------------------------Laporan perTanggal
    $c1c1_ = 0;
    $row = 1;
    $c1c1Start = $c1c1_;
    $rowStart = $row;
    $l = 0;
    
    //membuat objek PHPExcel
    $objPHPExcel = new PHPExcel();
    
    //Field
    $objPHPExcel->getActiveSheet()->getStyle($c1c1[$c1c1_] . '' . $row)->applyFromArray($style_col);
    $objPHPExcel->setActiveSheetIndex($l)->setCellValue($c1c1[$c1c1_] . '' . $row, 'No'); $c1c1_++;
    $objPHPExcel->getActiveSheet()->getStyle($c1c1[$c1c1_] . '' . $row)->applyFromArray($style_col);
    $objPHPExcel->setActiveSheetIndex($l)->setCellValue($c1c1[$c1c1_] . '' . $row, 'Email'); $c1c1_++;
    $objPHPExcel->getActiveSheet()->getStyle($c1c1[$c1c1_] . '' . $row)->applyFromArray($style_col);
    $objPHPExcel->setActiveSheetIndex($l)->setCellValue($c1c1[$c1c1_] . '' . $row, 'Nama'); $c1c1_++;
    $objPHPExcel->getActiveSheet()->getStyle($c1c1[$c1c1_] . '' . $row)->applyFromArray($style_col);
    $objPHPExcel->setActiveSheetIndex($l)->setCellValue($c1c1[$c1c1_] . '' . $row, 'Role'); $c1c1_++;
    
    $objPHPExcel->setActiveSheetIndex($l)->setCellValue($c1c1[$c1c1_] . '' . $row, ''); $c1c1_++;
    $row++;
    
    //Details
    if(isset($result['array_'])) {
      if(count($result['array_'])>0) {
        for ($x = 0; $x < count($result['array_']); $x++) {
          $c1c1_ = 0;
          
          $objPHPExcel->getActiveSheet()->getStyle($c1c1[$c1c1_] . '' . $row)->applyFromArray($style_row_Number);
          $objPHPExcel->setActiveSheetIndex($l)->setCellValue($c1c1[$c1c1_] . '' . $row, ($x+1)); $c1c1_++;
          $objPHPExcel->getActiveSheet()->getStyle($c1c1[$c1c1_] . '' . $row)->applyFromArray($style_row);
          $objPHPExcel->setActiveSheetIndex($l)->setCellValue($c1c1[$c1c1_] . '' . $row, $result['array_'][$x][1]); $c1c1_++;
          $objPHPExcel->getActiveSheet()->getStyle($c1c1[$c1c1_] . '' . $row)->applyFromArray($style_row);
          $objPHPExcel->setActiveSheetIndex($l)->setCellValue($c1c1[$c1c1_] . '' . $row, $result['array_'][$x][2]); $c1c1_++;
          $objPHPExcel->getActiveSheet()->getStyle($c1c1[$c1c1_] . '' . $row)->applyFromArray($style_row);
          $objPHPExcel->setActiveSheetIndex($l)->setCellValue($c1c1[$c1c1_] . '' . $row, $result['array_'][$x][4]); $c1c1_++;
          
          $row++;
        }
      }
    }
    
    for ($i='A'; $i!=$objPHPExcel->getActiveSheet()->getHighestColumn(); $i++) {
      $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
    }
    
    //set title pada sheet (me rename nama sheet)
    $objPHPExcel->getActiveSheet()->setTitle('Laporan per Tanggal');
    
    //mulai menyimpan excel format xlsx, kalau ingin xls ganti Excel2007 menjadi Excel5
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

    //sesuaikan headernya 
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //ubah nama file saat diunduh
    header('Content-Disposition: attachment;filename="' . $this->router->class . '.xlsx"');
    //unduh file
    $objWriter->save("php://output");
  }
  
  /** Untuk upload foto *
  function UploadFile() {
    $data['title'] = $this->title;
    $data['h2_title'] = $this->title;
    $data['link'] = site_url('Admin/User');
    $this->load->view('Admin/User/UploadFile', $data);
  }

  /** For process upload file. *
  function ProcessUploadFile($ID) {
    $columnItem = $this->ItemModel->setColumn();

    //Get data info
    $data = $this->getDataInfo($ID);
    $this->removePath('uploads/' . $this->router->class . '/' . $data['Code']);

    //Set main folder
    $output_dir = 'uploads/' . $this->router->class;
    $this->createPath($output_dir);
    $output_dir = $output_dir . '/' . $data['Code'];
    $this->createPath($output_dir);

    //Folder
    $output_dir = $output_dir . '/';

    if (isset($_FILES["myfile"])) {
      $ret = array();
      $error = $_FILES["myfile"]["error"];
      if (!is_array($_FILES["myfile"]['name'])) { //single file
        $fileName = str_replace(')', '', str_replace('(', '', str_replace(' ', '', $_FILES["myfile"]["name"])));
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileName = str_replace(')', '', str_replace('(', '', str_replace(' ', '', $_POST['varA'] . $fileName)));
        move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName);

        $ret[$fileName] = $output_dir . $fileName;
        $imgData = addslashes(file_get_contents($output_dir . $fileName));

        $this->ItemModel->update($ID, array($columnItem['Photo'] => $output_dir . $fileName));
      }
      echo json_encode($ret);
    }
  }*/
}
