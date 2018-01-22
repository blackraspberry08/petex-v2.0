<?php

class SaveEventAdmin extends CI_Model {
    public function trail($admin_id, $desc){
        $table = "event";
        $data = array(
            "admin_id"              => $admin_id,
            "event_description"     => $desc,
            "event_classification"  => "trail",
            "event_added_at"        =>  time()
        );
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }
    
    public function login($admin_id){
        $table = "event";
        $data  = array(
            "admin_id"              => $admin_id,
            "event_description"     => "Logged in",
            "event_classification"  => "log",
            "event_added_at"        =>  time()
        );
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }
    public function logout($admin_id){
        $table = "event";
        $data  = array(
            "admin_id"              => $admin_id,
            "event_description"     => "Logged out",
            "event_classification"  => "log",
            "event_added_at"        =>  time()
        );
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }
}