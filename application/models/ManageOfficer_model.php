<?php
class ManageOfficer_model extends CI_Model {
    public function get_admins(){
        $table = "user";
        $where = array("user_access" => "Subadmin");
        $this->db->where($where);
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
}
