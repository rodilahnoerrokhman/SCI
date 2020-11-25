<?php
/**
 * RolesModel Class
 * @author  Rodilah Noer Rokhman <rodilahnoerrokhman @yahoo.co.id/@gmail.com>
 */
class RolesModel extends CI_Model {
  
  /** Constructor */
  function RolesModel()
  { parent::__construct(); }
  
  var $Table = 'Roles';
  var $ID = 'Roles.id';
  var $Name = 'Roles.name';
  
  function setColumn() {
    $column['Table'] = $this->Table;
    $column['ID'] = $this->ID;
    $column['Name'] = $this->Name;
    
    $column['NID'] = $this->splitColumn($this->ID);
    $column['NName'] = $this->splitColumn($this->Name);
    
    return $column;
  }
  
  /**
    * Get info
    * @param for ID : String
    */
  function getInfo($ID) {
    $this->db->select('*');
    $this->db->where($this->ID, $ID);
    return $this->db->get($this->Table);
  }
  
  /**
    * Get all data based on pagination
    * @param for limit : int
    * @param for offset : int
    */
  function getList() {
    $this->db->select('*');
    $this->db->from($this->Table);
    return $this->db->get();
  }
  
  /** Check available data on db
    * @param for Code : String
    */
  function checkData($Code) {
    $query = $this->db->get_where($this->Table, array($this->Code => $Code));
    if ($query->num_rows() > 0)
    { return TRUE; }
    else
    { return FALSE; }
  }
  
  /**
    * The process for add data
    * @param for data : Array
    */
  function add($data)
  { $this->db->insert($this->Table, $data); }
  
  /**
    * The process for update data
    * @param for id_user : String
    * @param for data : array
    */
  function update($ID, $data) {
    $this->db->where($this->ID, $ID);
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