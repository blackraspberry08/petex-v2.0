<?php
class ManageOfficer_model extends CI_Model {
    public function get_admins(){
        $table = "user";
        $where = array("user_access" => "Subadmin");
        $this->db->where($where);
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
    public function get_officer_modules($where = NULL){
        $table = "module_access";
        $join = "user";
        $on = "module_access.user_id = user.user_id";
        $join2 = "module";
        $on2 = "module_access.module_id = module.module_id";
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
        if(!empty($where)){
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
    public function get_modules(){
        $table = "module";
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
    public function remove_all_modules($where = NULL){
        if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->delete("module_access");
        return $this->db->affected_rows();
    }
    public function add_module($data){
        $this->db->insert("module_access", $data);
        return $this->db->affected_rows();
    }
}
