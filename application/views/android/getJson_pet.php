<?php
$array['pet'] = array();
foreach($result as $res){
    array_push($array['pet'], 
            array(
            'pet_id' =>$res->pet_id, 
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
            ));
}
echo json_encode($array);
