<?php

class SaveEvent extends CI_Model {
    public function to_trail($user_id, $desc, $where = NULL){
        $table = "event";
        $log_classification = "trail";
        if(!empty($where)){
            $this->db->where($where);
        }
        $data = array(
            'user_id' => $user_id,
            'event_description' => $desc,
            'event_classification' => $log_classification,
            'event_added_at' => time()
        );
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }
    public function to_log($user_id, $desc, $where = NULL){
        $table = "event";
        $log_classification = "log";
        if(!empty($where)){
            $this->db->where($where);
        }
        $data = array(
            'user_id' => $user_id,
            'event_description' => $desc,
            'event_classification' => $log_classification,
            'event_added_at' => time()
        );
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }
}