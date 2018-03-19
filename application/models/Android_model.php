<?php

class Android_model extends CI_Model {
    public function fetch($table, $where = NULL, $column = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        if (!empty($column)) {
            $this->db->select($column);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
    public function fetchTwo($table, $column = NULL, $join = NULL, $on = NULL, $join2 = NULL, $on2 = NULL, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        if (!empty($column)) {
            $this->db->select($column);
        }
        if (!(empty($join) || empty($on))) {
            $this->db->join($join, $on, "INNER");
        }
        if (!(empty($join2) || empty($on2))) {
            $this->db->join($join2, $on2, "INNER");
        }

        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
	
	public function report_missing($data, $adoption_id){
		$this->db->where(array("adoption_id" => $adoption_id));
        $this->db->update("adoption", $data);
        return $this->db->affected_rows();
    }
	
	public function pet_found($data, $pet_id){
		$this->db->where(array("pet_id" => $pet_id));
        $this->db->update("adoption", $data);
        return $this->db->affected_rows();
    }
	
	public function pet_discovery($data){
		$table = "discovery";
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
	}
	
	public function get_discoveries($where = NULL){
		$table = "discovery";
		$join = "user";
		$on = "discovery.user_id = user.user_id";
		$join2 = "pet";
		$on2 = "discovery.pet_id = pet.pet_id";
		
		$column = "
				discovery_id,
				discovery.pet_id,
				discovery.user_id,
				discovery_latitude,
				discovery_longitude,
				discovery_added_at,
				user_firstname,
				user_lastname,
				user_username,
				user_password,
				user_bday,
				user_sex,
				user_status,
				user_email,
				user_verification_code,
				user_isverified,
				user_contact_no,
				user_picture,
				user_address,
				user_added_at,
				user_updated_at,
				pet_nfc_tag,
				pet_name,
				pet_bday,
				pet_specie,
				pet_sex,
				pet_breed,
				pet_size,
				pet_status,
				pet_access,
				pet_neutered_spayed,
				pet_admission,
				pet_description,
				pet_history,
				pet_picture,
				pet_video,
				pet_added_at,
				pet_updated_at";
		
		if (!empty($where)) {
            $this->db->where($where);
        }
        if (!empty($column)) {
            $this->db->select($column);
        }
        if (!(empty($join) || empty($on))) {
            $this->db->join($join, $on, "INNER");
        }
        if (!(empty($join2) || empty($on2))) {
            $this->db->join($join2, $on2, "INNER");
        }

        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
	}
		
}