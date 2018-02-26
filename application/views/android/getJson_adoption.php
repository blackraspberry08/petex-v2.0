<?php
$array['adoption'] = array();
if(empty($result)){
	array_push($array['adoption'],array(
		'success' => false,
		'result' => "You have not adopted yet.",
		'user_id' => "0"
	));
	echo json_encode($array);
}else{
	foreach($result as $res){
		array_push($array['adoption'], 
			array(
				'adoption_id' => $res->adoption_id,
				'adoption.pet_id' => $res->pet_id,
				'adoption.user_id' =>$res->user_id,
				'adoption_proof_img' => $res->adoption_proof_img,
				'adoption_isRead' => $res->adoption_isRead,
				'adoption_isMissing' =>$res->adoption_isMissing,
				'adoption_adopted_at' =>$res->adoption_adopted_at,
				'user_firstname' =>$res->user_firstname,
				'user_lastname' =>$res->user_lastname,
				'user_username' =>$res->user_username,
				'user_password' =>$res->user_password,
				'user_bday' =>$res->user_bday,
				'user_status' =>$res->user_status,
				'user_sex' =>$res->user_sex,
				'user_email' =>$res->user_email,
				'user_verification_code' =>$res->user_verification_code,
				'user_isverified' =>$res->user_isverified,
				'user_contact_no' => $res->user_contact_no,
				'user_picture' =>$res->user_picture,
				'user_address' =>$res->user_address,
				'user_added_at' =>$res->user_added_at,
				'user_updated_at' =>$res->user_updated_at,
				'pet_nfc_tag' => $res->pet_nfc_tag,
				'pet_name' =>$res->pet_name,
				'pet_bday' =>$res->pet_bday,
				'pet_specie' =>$res->pet_specie,
				'pet_sex' =>$res->pet_sex,
				'pet_breed' =>$res->pet_breed,
				'pet_size' =>$res->pet_size,
				'pet_status' =>$res->pet_status,
				'pet_access' =>$res->pet_access,
				'pet_neutered_spayed' =>$res->pet_neutered_spayed,
				'pet_admission' =>$res->pet_admission,
				'pet_description' =>$res->pet_description,
				'pet_history' =>$res->pet_history,
				'pet_picture' =>$res->pet_picture,
				'pet_video' =>$res->pet_video,
				'pet_added_at' =>$res->pet_added_at,
				'pet_updated_at' =>$res->pet_updated_at
			)
		);	
	}
	echo json_encode($array);
}


