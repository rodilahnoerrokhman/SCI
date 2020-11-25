<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * CI_Loader
	 *
	 * @var	CI_Loader
	 */
	public $load;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}

}

class UserAccess extends CI_Controller {

  /** Constructor */
  function UserAccess() {
    parent::__construct();
    $this->load->model('UserModel', '', TRUE);
    $this->load->model('MasterModel', '', TRUE);
  }

  /** Get list all document and certificate for upload process */
  function getUploadPage($URLtmp) {
    redirect(base_url() . str_replace("~", "/", $URLtmp));
  }

  /** Get list all document and certificate for upload process */
  function replaceHTMLChar($val) {
    $val = str_replace("&#39;", "'", $val);
    $val = str_replace("&nbsp;", " ", $val);
    $val = str_replace("&amp;", "&", $val);
    $val = str_replace("&quot;", "\"", $val);
    $val = str_replace("&lt;", "<", $val);
    $val = str_replace("&gt;", ">", $val);
    
    return $val;
  }

  /** Create directory path */
  function createPath($path) {
    if (!is_dir($path)) {
      //mkdir($path, 0777, TRUE);
      mkdir($path, 777, true);
      chmod($path, 0777);
    }
  }
  
  public function splitDateMYD($StringDate) {
    $splitString = explode('/', $StringDate);
    return $splitString[0] . '/' . $splitString[1] . '/' . $splitString[2];
  }

  /** Remove directory path */
  function removePath($path) {
    if ($path <> 'uploads/Empty.jpg') {
      if (is_dir($path) === true) {
        $files = array_diff(scandir($path), array('.', '..'));
        foreach ($files as $file) {
          $this->removePath(realpath($path) . '/' . $file);
        }
        return rmdir($path);
      } else if (is_file($path) === true) {
        return unlink($path);
      }
    }

    return false;
  }

  /**
   * Show the Notification page if already logged or
   * back to the Login page when not logged.
   */
  public function sendNotif($title, $message, $fcms) {
    $api_key = "AAAAUIiMGQk:APA91bH1XZqH6Y_q0JIgxIHtR_Wr6C3_cvDElHgLOp_wLPvH4Jz0VtPSuJjKfTNOYI8yiUVnpZq-LaQM0L28vq-LT9JhptcGj9XX1cLwmJ9CwpDfzgw9xZPW6gPNnQYBkG_0bi0rtHGywaHX5tjT_2rrbCxamzDvYw";
    $url = "https://fcm.googleapis.com/fcm/send";

    $fields = array(
      'registration_ids' => $fcms,
      'data' => array(
        "title" => $title,
        "message" => $message,
        'type' => 'booking',
        'type_id' => 1
      ),
    );

    $request_headers = array('Authorization: key=' . $api_key, 'Content-Type: application/json');
    $ch = curl_init();

    $this->curl->create($url);
    $this->curl->option(CURLOPT_HTTPHEADER, $request_headers);
    $this->curl->post(json_encode($fields));
    $result = $this->curl->execute();
  }
  
  function arrayExcel() {
    $char = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q',
                  'R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG',
                  'AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU',
                  'AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI',
                  'BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW',
                  'BX','BY','BZ');
    return $char;
  }

  /**
  * Used for validate the certificate number - min character (callback_check_length_min)
  * @param for word : String
  * @param for min : int
  */
  function check_length_min($input, $min) {
    $length = strlen($input);

    if ($length >= $min) {
      return TRUE;
    } elseif ($length < $min) {
      $this->form_validation->set_message('check_length_min', 'Minimum number of characters is ' . $min);
      return FALSE;
    }
  }

  /**
   * Used for validate the certificate number - min character (callback_check_length_min)
   * @param for word : String
   * @param for min : int
   */
  function check_length($input, $min) {
    $length = strlen($input);

    if ($length == $min) {
      return TRUE;
    } else {
      $this->form_validation->set_message('check_length', 'Harus berjumlah ' . $min . ' karakter.');
      return FALSE;
    }
  }

  /**
   * Used for validate the certificate number - max character (callback_check_length_min)
   * @param for word : String
   * @param for max : int
   */
  function check_length_max($input, $max) {
    $length = strlen($input);

    if ($length <= $max) {
      return TRUE;
    } elseif ($length > $max) {
      $this->form_validation->set_message('check_length_max', 'Maximum number of characters is ' . $max);
      return FALSE;
    }
  }
  
  public function getAccess() {
    $ColumnUser = $this->UserModel->setColumn();
    
    //Cek hak akses user login
    if ($this->session->userdata('Login') == TRUE) {
      return true;
    } else {
      redirect('login');
      return false;
    }
  }

   /**Cek file is exist */
  function file_exists_($URL) {
    $result = 'uploads/Empty.jpg';
    if ($URL <> '' AND file_exists($URL))
      $result = $URL;

    return $result;
  }

  function valid_date($str) {
    if ($str <> '') {
      if (!preg_match("^(0[1-9]|1[012])/(0[1-9]|1[0-9]|2[0-9]|3[01])/([0-9]{4})$^", $str)) {
        $this->form_validation->set_message('valid_date', 'Format tanggal tidak valid. mm/dd/yyyy');
        return false;
      } else {
        return true;
      }
    }
  }
}
