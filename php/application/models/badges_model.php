<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Badges_model extends CI_Model {

  private $tableName = 'locations';
  private $tableId = 'id';

  public function create($data = []){
    $success = $this->db->insert($this->tableName, $data);
    return ($success) ? $this->retrieveLastSaved($this->db->insert_id()) : $success;
  }

  public function read(){
    return $this->db->get($this->tableName)->result_array();
  }

  public function update($data = []){
    $success = $this->db->where($this->tableId, $data[$this->tableId])->update($this->tableName, $data);
    return ($success) ? $this->retrieveLastSaved($data[$this->tableId]) : $success;
  }

  public function delete($data = []){
    return $this->db->where($this->tableId, $data[$this->tableId])->delete($this->tableName);
  }

  private function retrieveLastSaved($id){
    $this->db->flush_cache();
    return $this->db->where($this->tableId, $id)->get($this->tableName)->row_array();
  }

}