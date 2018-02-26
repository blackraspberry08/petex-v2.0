<?php
class ManageOfficer_model extends CI_Model {
    public function get_admin($where = NULL){
        $table = "admin";
        $this->db->where(array("admin_access" => "Subadmin"));
        $this->db->where(array("admin_status" => 1));
        if(!empty($where)){
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
    
    public function activate_admin($table, $where = NULL){
        $this->db->set("admin_status", 1);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->update($table);
        return $this->db->affected_rows();
    }
    public function deactivate_admin($table, $where = NULL){
        $this->db->set("admin_status", 0);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->update($table);
        return $this->db->affected_rows();
    }
    
    public function get_admins($admin_id = NULL){
        $table = "admin";
        $where = array("admin_isverified" => 1);
        if (!empty($admin_id)) {
            $this->db->where_not_in("admin_id", $admin_id);
        }
        $this->db->where($where);
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
    public function get_officer_modules($where = NULL){
        $table = "module_access";
        $join = "admin";
        $on = "module_access.admin_id = admin.admin_id";
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
        //"WHERE" must be user_id
        if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->delete("module_access");
        return $this->db->affected_rows();
    }
    public function remove_module($where = NULL){
        //"WHERE" must be module_access_id
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
