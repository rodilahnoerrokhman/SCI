<?php

/**
 * Home Class
 * @author Rodilah Noer Rokhman <rodilahnoerrokhman @yahoo.co.id/@gmail.com>
 */
class Home extends UserAccess {

  var $title = 'Dashboard';
  var $limit = 10;

  function Home() {
    parent::__construct();
    $this->load->model('MasterModel', '', TRUE);
    
    //Write to session---------------------------------------
    $data = array('menu1' => $this->router->class);
    $this->session->set_userdata($data);
    //---------------------------------- End Write to session
  }

  /** Show page */
  function index() {
    $data['main_view'] = 'Admin/Home/Info';
    $this->load->view('Admin/Template', $data);
  }
}
