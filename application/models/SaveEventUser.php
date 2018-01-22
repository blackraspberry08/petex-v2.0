<?php

class SaveEventUser extends CI_Model {
    
    public function trail($user_id, $desc){
        $table = "event";
        $data = array(
            "user_id"               => $user_id,
            "event_description"     => $desc,
            "event_classification"  => "trail",
            "event_added_at"        =>  time()
        );
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }
    public function login($user_id){
        $table = "event";
        $data  = array(
            "user_id"               => $user_id,
            "event_description"     => "Logged in",
            "event_classification"  => "log",
            "event_added_at"        =>  time()
        );
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }
    public function logout($user_id){
        $table = "event";
        $data  = array(
            "user_id"               => $user_id,
            "event_description"     => "Logged out",
            "event_classification"  => "log",
            "event_added_at"        =>  time()
        );
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }
}