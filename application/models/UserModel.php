<?php

/**
 * UserModel Class
 * @author  Rodilah Noer Rokhman <rodilahnoerrokhman @yahoo.co.id/@gmail.com>
 */
class UserModel extends CI_Model {
  
  var $Table = 'Users';
  var $ID = 'Users.id';
  var $FirstName = 'Users.name';
  var $Email = 'Users.email';
  var $Password = 'Users.Password';
  var $Role = 'Users.role_id';
  
  function setColumn() {
    $column['Table'] = $this->Table;
    $column['ID'] = $this->ID;
    $column['FirstName'] = $this->FirstName;
    $column['Email'] = $this->Email;
    $column['Password'] = $this->Password;
    $column['Role'] = $this->Role;
    
    $column['NID'] = $this->splitColumn($this->ID);
    $column['NFirstName'] = $this->splitColumn($this->FirstName);
    $column['NEmail'] = $this->splitColumn($this->Email);
    $column['NPassword'] = $this->splitColumn($this->Password);
    $column['NRole'] = $this->splitColumn($this->Role);
    
    $column['NRoleName'] = 'RoleName';
    
    return $column;
  }

  /** Constructor */
  function UserModel() {
  parent::__construct();
  }

  /**
   * Get info
   * @param for UserName : String
   */
  function getInfo($ID) {
    $this->db->select('*');
    $this->db->where($this->ID, $ID);
    return $this->db->get($this->Table);
  }

  /**
   * Get info
   * @param for NFirstName : String
   */
  function getInfoByEmail($Email) {
    $this->db->select('*');
    $this->db->where($this->Email, $Email);
    return $this->db->get($this->Table);
  }

  /**
   * Check available data and password on db for login
   * @param for Email : String
   * @param for Password : String
   */
  function login($Email, $Password) {
    $query = $this->db->get_where($this->Table, array($this->Email => $Email, $this->Password => $Password), 1, 0);

    if ($query->num_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /**
   * Get all data based on pagination
   * @param for limit : int
   * @param for offset : int
   */
  function getList($limit, $offset) {
    $this->db->select('*');
    $this->db->from($this->Table);
    $this->db->order_by($this->NFirstName, 'asc');
    $this->db->limit($limit, $offset);
    return $this->db->get();
  }

  /** Count the number of lines generated */
  function count_all_num_rows() {
    return $this->db->count_all($this->Table);
  }

  /** Check available data on db
   * @param for UserName : String
   */
  function checkData($Email) {
    $query = $this->db->get_where($this->Table, array($this->Email => $Email));
    if ($query->num_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /**
   * The process for add data
   * @param for data : Array
   */
  function add($data) {
    $this->db->insert($this->Table, $data);
  }

  /**
   * The process for update data
   * @param for ID : String
   * @param for data : array
   */
  function update($ID, $data) {
    $this->db->where($this->ID, $ID);
    $this->db->update($this->Table, $data);
  }
  function updateByEmail($Email, $data) {
    $this->db->where($this->Email, $Email);
    $this->db->update($this->Table, $data);
  }

  /**
   * The process for deleting data
   * @param for ID : String
   */
  function delete($ID) {
    $this->db->where($this->ID, $ID);
    $this->db->delete($this->Table);
  }

}
