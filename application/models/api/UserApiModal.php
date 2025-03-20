
<?php

class UserApiModal extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function tesing_Login($userid, $password) {
        // You should hash passwords and check against hashed values in real applications
        // For simplicity, we're assuming plaintext passwords here (not secure in production)
        // Simulate a database check for users
        $users = [
            ['id' => 1, 'userid' => 'shiv1', 'password' => '1234', 'name' => 'Shiv 1 Kumar'],
            ['id' => 2, 'userid' => 'shiv2', 'password' => '1235', 'name' => 'Shiv 2 Kumar']
        ];

        // Search for the user by email
        foreach ($users as $user) {
            if ($user['userid'] == $userid && $user['password'] == $password) {
                // Return user data if credentials match
                return [
                    'status' => TRUE,
                    'message' => 'Login successful!',
                    'user' => $user
                ];
            }
        }

        // Return an error if credentials don't match
        return [
            'status' => FALSE,
            'message' => 'Invalid credentials'
        ];
    }

    public function userAuthonticationModel($data) {
        $return_data = null;
        if ($data['userid'] != NULL and $data['password'] != NULL) {

            $query = "SELECT *  from  staff WHERE userid='" . $data['userid'] . "' and password='" . $data['password'] . "'";
            $q = $this->db->query($query);
            $res = -1;
            $userdata = null;
            if ($q->num_rows() > 0) {
                $res = $q->result()[0]->id;
                $userdata = $q->result()[0];
                $return_data['status'] = 1;
                $return_data['name'] = $q->result()[0]->username;
                $return_data['hw_id'] = $res;
                $return_data['is_active'] = $q->result()[0]->is_active;
                $return_data['doj'] = $q->result()[0]->date_of_joining;
            }

            if ($res > 0) {
                $this->db->select('child_id');
                $this->db->from('child_partial_registration');
                $this->db->where('child_partial_registration.healthworker_id ', $res);
                $result = $this->getData($this->db->get());
                if ($result == false)
                    $return_data['data_available_in_database'] = 0;
                else
                    $return_data['data_available_in_database'] = 1; //$this->getData($this->db->get());

                    
//                $return_data['user_data'] = array($userdata);
//                $return_data['status'] = 1;
                return $return_data;
            }
            else {
                $return_data['status'] = 0;
                $return_data['name'] = '';
                $return_data['hw_id'] = 0;
                $return_data['is_active'] = 0;
                $return_data['doj'] = '';
                $return_data['data_available_in_database'] = 0;
                return $return_data;
            }
        }
    }

    public function childPartialRegisteration($data) {

         $childData['child_uid'] = $data['child_uid'];
         $childData['child_name'] =$data['child_name'];
         $childDOB = $data['dateofbirth'];
         $childDOB = str_replace("/", "-", $childDOB);
         $childData['dateofbirth'] = date('Y-m-d', strtotime("$childDOB"));
         $childData['gender'] = $data['gender'];        
         $childData['father_name'] = $data['father_name'];
         $childData['mother_name'] = $data['mother_name'];
         $childData['healthworker_id '] = $data['healthworker_id'];
         $childData['contact_no'] = $data['contact_no'];
         $childData['supervisorResponse'] = $data['supervisor_response'];
         $childData['fullRegistration'] = $data['full_registration'];        
         $childData['deviceId'] = $data['device_id'];
         $dateFromLocalMobile =  $data["date"];
         $dateFromLocalMobile = str_replace('/', '-', $dateFromLocalMobile);
         $childData['date'] = date('Y-m-d', strtotime("$dateFromLocalMobile"));
        
        
             
              $screendata['ans1']=$data['ans1'];
              $screendata['ans2']=$data['ans2'];
              $screendata['ans3']=$data['ans3'];
              $screendata['ans4']=$data['ans4'];
              $screendata['ans5']=$data['ans5'];
              $screendata['ans6']=$data['ans6'];
              $screendata['ans7']=$data['ans7'];
              $screendata['ans8']=$data['ans8'];
              $screendata['ans9']=$data['ans9'];
              $screendata['ans10']=$data['ans10'];
              $screendata['ans11']=$data['ans11'];
              $screendata['cp']=$data['CP'];
              $screendata['visual_impairment']=$data['VI'];
              $screendata['hearing_impairment']=$data['HI'];
              $screendata['intellectual_disability']=$data['ID'];
              $screendata['epilepsy']=$data['EP'];
              $screendata['ASD']=$data['ASD'];
              $screendata['isProblem']=$data['isProblem'];
              $screendata['screening_date']=$data['screening_date'];
              
        
        
            if($childData != null){
            $this->db->insert('child_partial_registration', $childData);
            $childid=$this->db->insert_id();
            if($data != null && $childid>0 )
            {
            $screendata['child_id']=$childid;
            $this->db->insert('screening_result', $screendata);
            $screeningid=$this->db->insert_id();
            }
            else
            {
             $screeningid=-1;   
            }
            return  array('status' => TRUE, 'childuid'=>$childData['child_uid'], 'screeningid' => $screeningid,'childid'=>$childid);
             
        }
        else{
            return array('status' => FALSE,'childuid'=>-1, 'screeningid' => -1,'childid'=>-1);
        }
        
        
        
    }
    
    
    public function  completeChildPartial_or_fullRegisteration($data)
    {
         $childOnlineOfflineStatus=$data['onlineOffline'];
         $healthworkerStatusFromMobile = $data['healthWorkerStatus'];
         $patientType = $data['patientType'];
         $healthWorkerId=$data['healthworker_id'];
        	
	//child is viewed by clinical admin or not. 0 for not 1 for yes and 
	//2 for offline child means child is not submitted for clinical admin approval
	
        $TodayDate = date('Y-m-d', strtotime("now"));
	$nextCompletedStage='3';     // calculate last stage that a patient completed 
	$video=$data['video'];
	$cp = $data['CP'];
	$visualImpairment = $data['VI'];
	$hearingImpairment = $data['HI'];
	$intellectualDisability = $data['ID'];
	$epilepsy = $data['EP'];
	$ASD = $data['ASD'];
	$cp_approved = $cp;
	$hi_approved = $hearingImpairment;
	$vi_approved = $visualImpairment;
	$ep_approved = $epilepsy;
	$id_approved = $intellectualDisability;
	$asd_approved = $ASD;
	$isProblem =    $data['isProblem'];
	$localChildId = $data['child_uid'];
	$submittedToServer = "1";

	$deviceId = $data['device_id'];
	$level = $data['level'];
	$droc = $data['droc'];
	$dateFromMobile = $data['date'];
	$dateFromMobile = str_replace("/", "-", $dateFromMobile);
	$date = date('Y-m-d', strtotime("$dateFromMobile"));
	
        $childName = $data['child_name'];
        $childDOB = $data['dateofbirth'];
        $childDOB = str_replace("/", "-", $childDOB);
        $childData['dateofbirth'] = date('Y-m-d', strtotime("$childDOB"));
	$childGender = $data['gender'];
	$birthOrder = $data['birthOrder'];
	$armCercumference = $data['armCercumference'];
	$headCercumference = $data['headCercumference'];
	$currentSchoolStatus = $data['currentSchoolStatus'];
	$classCompleted = $data['classCompleted'];
	$categorySchool = $data['categorySchool'];
	$siblings = $data['siblings'];
	$preDignosis = $data['preDignosis'];
	$dignosisInfo = $data['dignosisInfo'];
	$informant = $data['informant'];
	$informantName = $data['informantName'];
	$informantRelation = $data['informantRelation'];
	$fatherName = $data['father_name'];
        $motherName = $data['mother_name'];
	$fatherAge =  $data['fatherAge'];
	$fatherOccupation = $data['fatherOccupation'];
	$fatherEducation = $data['fatherEducation'];
	$fatherRelationshipStatus = $data['fatherRelationshipStatus'];
	$motherAge = $data['motherAge'];
	$motherOccupation = $data['motherOccupation'];
	$motherEducation = $data['motherEducation'];
	$motherRelationshipStatus = $data['motherRelationshipStatus'];
	$carerName = $data['carerName'];
	$carerAge = $data['carerAge'];
	$carerOccupation = $data['carerOccupation'];
	$carerEducation = $data['carerEducation'];
	$carerRelationshipStatus = $data['carerRelationshipStatus'];
	$structureOfFamily = $data['structureOfFamily'];
	$ownershipInfrastructure = $data['ownershipInfrastructure'];
	$waterInfrastructure = $data['waterInfrastructure'];
	$toiletInfrastructure = $data['toiletInfrastructure'];
	$electricityInfrastructure = $data['electricityInfrastructure'];
	$roomsInfrastructure = $data['roomsInfrastructure'];
	$accesibilityInfrastructure = $data['accesibilityInfrastructure'];
	$sleepingInfrastructure = $data['sleepingInfrastructure'];
	//$mobileNumber = $data['mobileNumber'];
	$houseNumber = $data['houseNumber'];
        $mobileNumber = $data['contact_no'];
	$area = $data['area'];
	$city = $data['city'];
	$state = $data['state'];
	$country = $data['country'];
        $fullRegistration='1';
        
        //****************************************************
	// ******DROC Eating and Drinking Activity Questions and Observations
	//****************************************************
	$eatingAndDrinkingQuestion1=$data['eatingAndDrinkingQuestion1'];
	$eatingAndDrinkingQuestion2=$data['eatingAndDrinkingQuestion2'];
	$eatingAndDrinkingQuestion3=$data['eatingAndDrinkingQuestion3'];
	$eatingAndDrinkingQuestion4=$data['eatingAndDrinkingQuestion4'];
	$eatingAndDrinkingQuestion5=$data['eatingAndDrinkingQuestion5'];
	$eatingAndDrinkingQuestion6=$data['eatingAndDrinkingQuestion6'];
	$eatingAndDrinkingQuestion7=$data['eatingAndDrinkingQuestion7'];
	$eatingAndDrinkingQuestion8=$data['eatingAndDrinkingQuestion8'];
	$eatingAndDrinkingQuestion9=$data['eatingAndDrinkingQuestion9'];
	$eatingAndDrinkingQuestion10=$data['eatingAndDrinkingQuestion10'];
	$eatingAndDrinkingQuestion11=$data['eatingAndDrinkingQuestion11'];
	$eatingAndDrinkingQuestion12=$data['eatingAndDrinkingQuestion12'];
	$eatingAndDrinkingQuestion13=$data['eatingAndDrinkingQuestion13'];
	$eatingAndDrinkingQuestion14=$data['eatingAndDrinkingQuestion14'];
	$eatingAndDrinkingQuestion15=$data['eatingAndDrinkingQuestion15'];
	$eatingAndDrinkingQuestion16=$data['eatingAndDrinkingQuestion16'];
	$eatingAndDrinkingQuestion17=$data['eatingAndDrinkingQuestion17'];
	$eatingAndDrinkingQuestion18='10';
	$eatingAndDrinkingQuestion19='10';
	$eatingAndDrinkingQuestion20='10';
	$eatingAndDrinkingObservation1=$data['eatingAndDrinkingObservation1'];
	$eatingAndDrinkingObservation2=$data['eatingAndDrinkingObservation2'];
	$eatingAndDrinkingObservation3=$data['eatingAndDrinkingObservation3'];
	$eatingAndDrinkingObservation4=$data['eatingAndDrinkingObservation4'];
	$eatingAndDrinkingObservation5=$data['eatingAndDrinkingObservation5'];
	$eatingAndDrinkingObservation6=$data['eatingAndDrinkingObservation6'];
	$eatingAndDrinkingObservation7=$data['eatingAndDrinkingObservation7'];
	$eatingAndDrinkingObservation8=$data['eatingAndDrinkingObservation8'];
	$eatingAndDrinkingObservation9=$data['eatingAndDrinkingObservation9'];
	$eatingAndDrinkingObservation10=$data['eatingAndDrinkingObservation10'];
	$eatingAndDrinkingObservation11=$data['eatingAndDrinkingObservation11'];
	$eatingAndDrinkingObservation12=$data['eatingAndDrinkingObservation12'];
	$eatingAndDrinkingObservation13=$data['eatingAndDrinkingObservation13'];
	$eatingAndDrinkingObservation14=$data['eatingAndDrinkingObservation14'];
	$eatingAndDrinkingObservation15=$data['eatingAndDrinkingObservation15'];
	$eatingAndDrinkingObservation16=$data['eatingAndDrinkingObservation16'];
	$eatingAndDrinkingObservation17=$data['eatingAndDrinkingObservation17'];
	$eatingAndDrinkingObservation18=$data['eatingAndDrinkingObservation18'];
	$eatingAndDrinkingObservation19=$data['eatingAndDrinkingObservation19'];
	$eatingAndDrinkingObservation20='10';
	//****************************************************
	// ******DROC Brushing Activity Questions and Observations
	//****************************************************
	$brushingQuestion1=$data['brushingQuestion1'];
	$brushingQuestion2=$data['brushingQuestion2'];
	$brushingQuestion3=$data['brushingQuestion3'];
	$brushingQuestion4=$data['brushingQuestion4'];
	$brushingQuestion5=$data['brushingQuestion5'];
	$brushingQuestion6=$data['brushingQuestion6'];
	$brushingQuestion7=$data['brushingQuestion7'];
	$brushingQuestion8=$data['brushingQuestion8'];
	$brushingQuestion9=$data['brushingQuestion9'];
	$brushingQuestion10=$data['brushingQuestion10'];
	$brushingQuestion11=$data['brushingQuestion11'];
	$brushingQuestion12=$data['brushingQuestion12'];
	$brushingQuestion13=$data['brushingQuestion13'];
	$brushingQuestion14=$data['brushingQuestion14'];
	$brushingQuestion15=$data['brushingQuestion15'];
	$brushingQuestion16=$data['brushingQuestion16'];
	$brushingQuestion17=$data['brushingQuestion17'];
	$brushingQuestion18=$data['brushingQuestion18'];
	$brushingQuestion19='10';
	$brushingQuestion20='10';
	$brushingObservation1=$data['brushingObservation1'];
	$brushingObservation2=$data['brushingObservation2'];
	$brushingObservation3=$data['brushingObservation3'];
	$brushingObservation4=$data['brushingObservation4'];
	$brushingObservation5=$data['brushingObservation5'];
	$brushingObservation6=$data['brushingObservation6'];
	$brushingObservation7=$data['brushingObservation7'];
	$brushingObservation8=$data['brushingObservation8'];
	$brushingObservation9=$data['brushingObservation9'];
	$brushingObservation10=$data['brushingObservation10'];
	$brushingObservation11=$data['brushingObservation11'];
	$brushingObservation12=$data['brushingObservation12'];
	$brushingObservation13=$data['brushingObservation13'];
	$brushingObservation14=$data['brushingObservation14'];
	$brushingObservation15=$data['brushingObservation15'];
	$brushingObservation16=$data['brushingObservation16'];
	$brushingObservation17='10';
	$brushingObservation18='10';
	$brushingObservation19='10';
	$brushingObservation20='10';
	//****************************************************
	// ******DROC Dressing Activity Questions and Observations
	//****************************************************
	$dressingQuestion1=$data['dressingQuestion1'];
	$dressingQuestion2=$data['dressingQuestion2'];
	$dressingQuestion3=$data['dressingQuestion3'];
	$dressingQuestion4=$data['dressingQuestion4'];
	$dressingQuestion5=$data['dressingQuestion5'];
	$dressingQuestion6=$data['dressingQuestion6'];
	$dressingQuestion7=$data['dressingQuestion7'];
	$dressingQuestion8=$data['dressingQuestion8'];
	$dressingQuestion9=$data['dressingQuestion9'];
	$dressingQuestion10=$data['dressingQuestion10'];
	$dressingQuestion11=$data['dressingQuestion11'];
	$dressingQuestion12=$data['dressingQuestion12'];
	$dressingQuestion13=$data['dressingQuestion13'];
	$dressingQuestion14=$data['dressingQuestion14'];
	$dressingQuestion15='10';
	$dressingQuestion16='10';
	$dressingQuestion17='10';
	$dressingQuestion18='10';
	$dressingQuestion19='10';
	$dressingQuestion20='10';
	$dressingObservation1=$data['dressingObservation1'];
	$dressingObservation2=$data['dressingObservation2'];
	$dressingObservation3=$data['dressingObservation3'];
	$dressingObservation4=$data['dressingObservation4'];
	$dressingObservation5=$data['dressingObservation5'];
	$dressingObservation6=$data['dressingObservation6'];
	$dressingObservation7=$data['dressingObservation7'];
	$dressingObservation8=$data['dressingObservation8'];
	$dressingObservation9=$data['dressingObservation9'];
	$dressingObservation10=$data['dressingObservation10'];
	$dressingObservation11=$data['dressingObservation11'];
	$dressingObservation12=$data['dressingObservation12'];
	$dressingObservation13=$data['dressingObservation13'];
	$dressingObservation14='10';
	$dressingObservation15='10';
	$dressingObservation16='10';
	$dressingObservation17='10';
	$dressingObservation18='10';
	$dressingObservation19='10';
	$dressingObservation20='10';
        
        
           
        
        $full_register_id=0;    
            
      if($childOnlineOfflineStatus == "2")
	{
		$childStatus = 2;             //$_POST['submittedToServer'];
	        $supervisorResponse = 2;      //$_POST['supervisorResponse'];
                 $child_partial_data = array(
            'child_uid'           => $localChildId,
            'child_name'          => $childName,
            'dateofbirth'         => $childDOB,
            'gender'              => $childGender,
            'father_name'         => $fatherName,
            'mother_name'         => $motherName,
            'healthworker_id'     => $healthWorkerId,
            'contact_no'          => $mobileNumber,
            'supervisorResponse'  => $supervisorResponse,
            'fullRegistration'    => $fullRegistration,
            'date'                => $date,
            'status'              => $childStatus,
            'deviceId'            => $deviceId,
            'nextStageCompleted'  => $nextCompletedStage,
            'onlineOrOffline'     => $childOnlineOfflineStatus,
            'video'               => $video,
             'status'        =>$childStatus,
             'supervisorResponse'        =>$supervisorResponse,
                     
        );
                 $this->db->insert('child_partial_registration', $child_partial_data);
                 $tempchildid=$this->db->insert_id();
                 $screening_data = array(
            'child_id'            => $tempchildid,
            'cp'                  => $cp,
            'visual_impairment'   => $visualImpairment,
            'hearing_impairment'  => $hearingImpairment,
            'intellectual_disability' => $intellectualDisability,
            'epilepsy'            => $epilepsy,
            'ASD'                 => $ASD,
            'cp_approved'         => $cp_approved,
            'hi_approved'         => $hi_approved,
            'vi_approved'         => $vi_approved,
            'ep_approved'         => $ep_approved,
            'id_approved'         => $id_approved,
            'asd_approved'        => $asd_approved,
            'isProblem'           => $isProblem,
            'screening_date'      => $date
        );
        
         $this->db->insert('screening_result', $screening_data);
         $screeningid=$this->db->insert_id();
         
         $full_register_id=$tempchildid;
	}
	else
            {
		$childStatus = '1';                //$_POST['submittedToServer'];
	        $supervisorResponse = "1";  //$_POST['supervisorResponse'];
                
         $cpquery = "SELECT * FROM `child_partial_registration` WHERE child_uid='".$localChildId."'";
         $qrs = $this->db->query($cpquery);
         $full_register_id= $qrs->result()[0]->child_id ; 
         $tempchildid=$full_register_id;
         $cpupdate = "update child_partial_registration set nextStageCompleted='3',video='$video' where child_id='$full_register_id'";
         $q61 = $this->db->query($cpupdate);
                
                
	}
           
            
            
        
       
        
        
        
         
         $fullregisteration_data = array(
            'localChildId'              => $full_register_id,
            'deviceId'                  => $deviceId,
            'healthWorker_id'           => $healthWorkerId,
            'name'                       => $childName,
            'dob'                        => $childDOB,
            'gender'                     => $childGender,
            'birthOrder'                => $birthOrder,
            'arm_cercumference'         => $armCercumference,
            'head_cercumference'        => $headCercumference,
            'current_School_Status'     => $currentSchoolStatus,
            'class_Completed'           => $classCompleted,
            'category_School'           => $categorySchool,
            'siblings'                  => $siblings,
            'preDignosis'               => $preDignosis,
            'dignosisInfo'              => $dignosisInfo,
            'informant'                 => $informant,
            'informant_Name'            => $informantName,
            'informant_Relation'       => $informantRelation,
            'father_Name'               => $fatherName,
            'father_Age'                => $fatherAge,
            'father_Occupation'         => $fatherOccupation,
            'father_Education'          => $fatherEducation,
            'father_Relationship_Status'=> $fatherRelationshipStatus,
            'mother_Name'               => $motherName,
            'mother_Age'                => $motherAge,
            'mother_Occupation'         => $motherOccupation,
            'mother_Education'          => $motherEducation,
            'mother_Relationship_Status'=> $motherRelationshipStatus,
            'carer_Name'                => $carerName,
            'carer_Age'                 => $carerAge,
            'carer_Occupation'          => $carerOccupation,
            'carer_Education'           => $carerEducation,
            'carer_Relationship_Status' => $carerRelationshipStatus,
            'structure_Of_Family'       => $structureOfFamily,
            'ownership_Infrastructure'  => $ownershipInfrastructure,
            'water_Infrastructure'      => $waterInfrastructure,
            'toilet_Infrastructure'     => $toiletInfrastructure,
            'electricity_Infrastructure'=> $electricityInfrastructure,
            'rooms_Infrastructure'     => $roomsInfrastructure,
            'accesibility_Infrastructure'=> $accesibilityInfrastructure,
            'sleeping_Infrastructure'  => $sleepingInfrastructure,
            'mobileNumber'              => $mobileNumber,
            'houseNumber'              => $houseNumber,
            'area'                      => $area,
            'city'                      => $city,
            'state'                     => $state,
            'country'                   => $country,
            'submittedToServer'         => $submittedToServer,
            'level'                     => $level,
            'droc'                      => $droc,
            'patientType'               => $patientType,
            'date'                       => $date
        );
         
          $this->db->insert('full_registration', $fullregisteration_data);
          $fullregisterid=$this->db->insert_id();
         
          
          
          $eatingdrinkingdata = array(
            'child_id'       => $fullregisterid,
            'Question1'      => $eatingAndDrinkingQuestion1,
            'Question2'      => $eatingAndDrinkingQuestion2,
            'Question3'      => $eatingAndDrinkingQuestion3,
            'Question4'      => $eatingAndDrinkingQuestion4,
            'Question5'      => $eatingAndDrinkingQuestion5,
            'Question6'      => $eatingAndDrinkingQuestion6,
            'Question7'      => $eatingAndDrinkingQuestion7,
            'Question8'      => $eatingAndDrinkingQuestion8,
            'Question9'      => $eatingAndDrinkingQuestion9,
            'Question10'     => $eatingAndDrinkingQuestion10,
            'Question11'     => $eatingAndDrinkingQuestion11,
            'Question12'     => $eatingAndDrinkingQuestion12,
            'Question13'     => $eatingAndDrinkingQuestion13,
            'Question14'     => $eatingAndDrinkingQuestion14,
            'Question15'     => $eatingAndDrinkingQuestion15,
            'Question16'     => $eatingAndDrinkingQuestion16,
            'Question17'     => $eatingAndDrinkingQuestion17,
            'Question18'     => $eatingAndDrinkingQuestion18,
            'Question19'     => $eatingAndDrinkingQuestion19,
            'Question20'     => $eatingAndDrinkingQuestion20,
            'Observation1'   => $eatingAndDrinkingObservation1,
            'Observation2'   => $eatingAndDrinkingObservation2,
            'Observation3'   => $eatingAndDrinkingObservation3,
            'Observation4'   => $eatingAndDrinkingObservation4,
            'Observation5'   => $eatingAndDrinkingObservation5,
            'Observation6'   => $eatingAndDrinkingObservation6,
            'Observation7'   => $eatingAndDrinkingObservation7,
            'Observation8'   => $eatingAndDrinkingObservation8,
            'Observation9'   => $eatingAndDrinkingObservation9,
            'Observation10'  => $eatingAndDrinkingObservation10,
            'Observation11'  => $eatingAndDrinkingObservation11,
            'Observation12'  => $eatingAndDrinkingObservation12,
            'Observation13'  => $eatingAndDrinkingObservation13,
            'Observation14'  => $eatingAndDrinkingObservation14,
            'Observation15'  => $eatingAndDrinkingObservation15,
            'Observation16'  => $eatingAndDrinkingObservation16,
            'Observation17'  => $eatingAndDrinkingObservation17,
            'Observation18'  => $eatingAndDrinkingObservation18,
            'Observation19'  => $eatingAndDrinkingObservation19,
            'Observation20'  => $eatingAndDrinkingObservation20,
            'DROC_Activity_Name'   => '1', // Hardcoded '1' for status
            'DROC_activity_date'   => $TodayDate
        );
         
          $this->db->insert('droc_activities_questions_and_observations', $eatingdrinkingdata);
          $eatingid=$this->db->insert_id();
        
        
        
       
        
                $dressingdata = array(
            'child_id'                => $fullregisterid,
            'Question1'               => $dressingQuestion1,
            'Question2'               => $dressingQuestion2,
            'Question3'               => $dressingQuestion3,
            'Question4'               => $dressingQuestion4,
            'Question5'               => $dressingQuestion5,
            'Question6'               => $dressingQuestion6,
            'Question7'               => $dressingQuestion7,
            'Question8'               => $dressingQuestion8,
            'Question9'               => $dressingQuestion9,
            'Question10'              => $dressingQuestion10,
            'Question11'              => $dressingQuestion11,
            'Question12'              => $dressingQuestion12,
            'Question13'              => $dressingQuestion13,
            'Question14'              => $dressingQuestion14,
            'Question15'              => $dressingQuestion15,
            'Question16'              => $dressingQuestion16,
            'Question17'              => $dressingQuestion17,
            'Question18'              => $dressingQuestion18,
            'Question19'              => $dressingQuestion19,
            'Question20'              => $dressingQuestion20,
            'Observation1'            => $dressingObservation1,
            'Observation2'            => $dressingObservation2,
            'Observation3'            => $dressingObservation3,
            'Observation4'            => $dressingObservation4,
            'Observation5'            => $dressingObservation5,
            'Observation6'            => $dressingObservation6,
            'Observation7'            => $dressingObservation7,
            'Observation8'            => $dressingObservation8,
            'Observation9'            => $dressingObservation9,
            'Observation10'           => $dressingObservation10,
            'Observation11'           => $dressingObservation11,
            'Observation12'           => $dressingObservation12,
            'Observation13'           => $dressingObservation13,
            'Observation14'           => $dressingObservation14,
            'Observation15'           => $dressingObservation15,
            'Observation16'           => $dressingObservation16,
            'Observation17'           => $dressingObservation17,
            'Observation18'           => $dressingObservation18,
            'Observation19'           => $dressingObservation19,
            'Observation20'           => $dressingObservation20,
            'DROC_Activity_Name'      => '2', // Hardcoded '2' for status
            'DROC_activity_date'      => $TodayDate
        );
        
        $this->db->insert('droc_activities_questions_and_observations', $dressingdata);
        $dressingid=$this->db->insert_id();
          
         $brushingdata = array(
            'child_id'                       => $fullregisterid,
            'Question1'               => $brushingQuestion1,
            'Question2'               => $brushingQuestion2,
            'Question3'               => $brushingQuestion3,
            'Question4'               => $brushingQuestion4,
            'Question5'               => $brushingQuestion5,
            'Question6'               => $brushingQuestion6,
            'Question7'               => $brushingQuestion7,
            'Question8'               => $brushingQuestion8,
            'Question9'               => $brushingQuestion9,
            'Question10'              => $brushingQuestion10,
            'Question11'              => $brushingQuestion11,
            'Question12'              => $brushingQuestion12,
            'Question13'              => $brushingQuestion13,
            'Question14'              => $brushingQuestion14,
            'Question15'              => $brushingQuestion15,
            'Question16'              => $brushingQuestion16,
            'Question17'              => $brushingQuestion17,
            'Question18'              => $brushingQuestion18,
            'Question19'              => $brushingQuestion19,
            'Question20'              => $brushingQuestion20,
            'Observation1'            => $brushingObservation1,
            'Observation2'            => $brushingObservation2,
            'Observation3'            => $brushingObservation3,
            'Observation4'            => $brushingObservation4,
            'Observation5'            => $brushingObservation5,
            'Observation6'            => $brushingObservation6,
            'Observation7'            => $brushingObservation7,
            'Observation8'            => $brushingObservation8,
            'Observation9'            => $brushingObservation9,
            'Observation10'           => $brushingObservation10,
            'Observation11'           => $brushingObservation11,
            'Observation12'           => $brushingObservation12,
            'Observation13'           => $brushingObservation13,
            'Observation14'           => $brushingObservation14,
            'Observation15'           => $brushingObservation15,
            'Observation16'           => $brushingObservation16,
            'Observation17'           => $brushingObservation17,
            'Observation18'           => $brushingObservation18,
            'Observation19'           => $brushingObservation19,
            'Observation20'           => $brushingObservation20,
            'DROC_Activity_Name'      => '3', 
            'DROC_activity_date'      => $TodayDate
        );
        
        $this->db->insert('droc_activities_questions_and_observations', $brushingdata);
        $brushingid=$this->db->insert_id();
        return  array('status' => TRUE, 'localChildId'=>$localChildId, 'serverTempId' => $tempchildid,'serverFullId'=>$fullregisterid);

        
    }


    

    private function getData($_query = NULL) {
        if ($_query != NULL and $_query->num_rows() > 0) {
            return $_query->result_array();
        } else {
            return FALSE;
        }
    }

}

?>
