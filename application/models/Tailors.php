<?php
class Tailors extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getUserbyId($Id) {
    	$this->db->select(
    		'UserEmail'
    		);
    	$this->db->where('UserID',$Id);
    	$q = $this->db->get('cd_admin');
    	$data = $q->result_array();
    	return @$data[0];
    }

    public function getAllBoutiques() {
		   $this->db->select('*');
       $this->db->order_by("boutique_id", "asc");
       $q = $this->db->get('b_boutique');
       $data = $q->result_array();
       return @$data;
   }

   public function getBoutique($boutique_id) {
       $this->db->select('*');
       $this->db->where("boutique_id", $boutique_id);
       $q = $this->db->get('b_boutique');
       $data = $q->result_array();
       return @$data[0];
   }

   public function getBoutiqueAdmin($boutique_id) {
       $this->db->select('*');
       $this->db->where("boutique_id", $boutique_id);
       $q = $this->db->get('b_boutique_admin');
       $data = $q->result_array();
       return @$data[0];
   }

   public function getBoutiqueTailor($boutique_id) {
       $this->db->select('*');
       $this->db->where("boutique_id", $boutique_id);
       $q = $this->db->get('b_boutique_tailor_login');
       $data = $q->result_array();
       return @$data[0];
   }
            
   public function getFilterTeams($status) {

		$this->db->select(
          'cd_team.TeamID AS TeamID,
          cd_team.TeamName AS TeamName,
          cd_team.TeamAgeCat AS TeamAgeCat,
          cd_team.TeamComInvSum AS TeamComInvSum,
          cd_team.TeamApprovedStatus AS TeamApprovedStatus,
          cd_team.TeamCreatedOn AS TeamCreatedOn,
          cd_team.TeamCity AS TeamCity');
    	$this->db->order_by("cd_team.TeamName", "asc");
      	if($status != -1) {
      		$this->db->where('cd_team.TeamApprovedStatus',$status);
      	}
      	$q = $this->db->get('cd_team');
      	$data = $q->result_array();
      	return @$data;
  	}

   public function getInactiveTeams() {
           $this->db->select(
          'cd_team.TeamID AS TeamID,
          cd_team.TeamName AS TeamName,
          cd_team.TeamAgeCat AS TeamAgeCat,
          cd_team.TeamComInvSum AS TeamComInvSum,
          cd_team.TeamApprovedStatus AS TeamApprovedStatus,
          cd_team.TeamCity AS TeamCity');
      $this->db->order_by("cd_team.TeamName", "asc");
      $this->db->where('cd_team.TeamApprovedStatus',0);
      $q = $this->db->get('cd_team');
      $data = $q->result_array();
      return @$data;
  }
   public function getRejectedTeams() {
           $this->db->select(
          'cd_team.TeamID AS TeamID,
          cd_team.TeamName AS TeamName,
          cd_team.TeamAgeCat AS TeamAgeCat,
          cd_team.TeamComInvSum AS TeamComInvSum,
          cd_team.TeamApprovedStatus AS TeamApprovedStatus,
          cd_team.TeamCity AS TeamCity');
      $this->db->order_by("cd_team.TeamName", "asc");
      $this->db->where('cd_team.TeamApprovedStatus',2);
      $q = $this->db->get('cd_team');
      $data = $q->result_array();
      return @$data;
  }
   public function getActiveTeams() {
           $this->db->select(
          'cd_team.TeamID AS TeamID,
          cd_team.TeamName AS TeamName,
          cd_team.TeamAgeCat AS TeamAgeCat,
          cd_team.TeamComInvSum AS TeamComInvSum,
          cd_team.TeamApprovedStatus AS TeamApprovedStatus,
          cd_team.TeamCity AS TeamCity');
      $this->db->order_by("cd_team.TeamName", "asc");
      $this->db->where('cd_team.TeamApprovedStatus ',1);
      $q = $this->db->get('cd_team');
      $data = $q->result_array();
      return @$data;
  }



    public function workCount($BoutiqueID) {
        $query = $this->db->get_where('b_boutique_works',array('boutique_id' => $BoutiqueID));
        return count($query->result());
    }

    

    public function getBoutiqueWorks($BoutiqueID) {
        $this->db->select('*');
        $this->db->from('b_boutique_works b');
        $this->db->join('b_boutique_tailor bt', 'b.boutique_tailor_id = bt.boutique_tailor_id');
        $this->db->join('b_boutique_customers bc', 'b.boutique_customer_id = bc.boutique_customer_id');
        $this->db->where('b.boutique_id',$BoutiqueID);
        $query = $this->db->get();
        return $query->result();
    }

    public function getBoutiqueSingleWork($workID){
        $this->db->select('*');
        $this->db->from('b_boutique_works b');
        $this->db->join('b_boutique_tailor bt', 'b.boutique_tailor_id = bt.boutique_tailor_id');
        $this->db->where('b.boutique_work_id',$workID);
        $query = $this->db->get();
        $boutique = $query->result();
        return $boutique[0];
    }

    public function isUserVoted($TeamID,$VoteUserMailID,$inHours = 24) {
        $least_dt = get_date_math('datetime', get_current_dt(), '-', $inHours, 'hours');
        $ip = $_SERVER['REMOTE_ADDR'];
        $query = $this->db->get_where('cd_vote', array('VoteIP' => $ip, 'TeamID' => $TeamID, 'VoteUserMailID' =>$VoteUserMailID, 'VoteDate >=' => $least_dt));

        //$where = "TeamID='".$TeamID."' AND VoteUserMailID= '".$VoteUserMailID."' OR status='active'";
        //$this->db->where($where);
        //$query = $this->db->get();

        $v_arr = $query->result();
        //print_r($v_arr);
        if(@$v_arr[0]){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    public function addVotes($TeamID,$VoteUserName,$VoteUserMailID) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $data = array(
            'VoteIP' => $ip,
            'TeamID' => $TeamID,
            'VoteUserName' => $VoteUserName,
            'VoteUserMailID' => $VoteUserMailID
        );
        $this->db->insert('cd_vote', $data);

        // update votes count in the team vote table
        $this->db->set('TeamVote', 'TeamVote+1', FALSE);
        $this->db->where('TeamID',$TeamID);
        $this->db->update('cd_teamvote');
    }


    public function saveboutique(){
      $CI = & get_instance();
      $qoutiqueData = array(
        'boutique_name'=>$this->input->post('boutiqueName'),
        'boutique_contact_name'=>$this->input->post('contactName'),
        'boutique_email'=>$this->input->post('email'),
        'boutique_ph'=>$this->input->post('phone'),
        'boutique_tagline'=>$this->input->post('tagline'),
        //'boutique_tagline'=>sha1($this->input->post('password') . $CI->config->item('encryption_key')),
        'boutique_desc'=>$this->input->post('description'),
        'boutique_city'=>$this->input->post('city'),
        'boutique_state'=>$this->input->post('state'),
        'boutique_address'=>$this->input->post('address')
     //  'TeamComInvSum'=>$this->input->post('summary')
      );
      $this->db->insert('b_boutique',$qoutiqueData);
      $BqID = $this->db->insert_id();

      $boutiqueAdminData = array(
        'boutique_id'=>$BqID,
        'boutique_admin_username'=>$this->input->post('adminusername'),
        'boutique_admin_pwd'=>sha1($this->input->post('adminpassword') . $CI->config->item('encryption_key'))
      );
      $this->db->insert('b_boutique_admin',$boutiqueAdminData);

      $boutiqueTailorData = array(
        'boutique_id'=>$BqID,
        'boutique_tailor_username'=>$this->input->post('tailorusername'),
        'boutique_tailor_pwd'=>sha1($this->input->post('tailorpassword') . $CI->config->item('encryption_key'))
      );
      $this->db->insert('b_boutique_tailor_login',$boutiqueTailorData);

      return $BqID;
    }


    public function updateWorkDetails(){
        $CI = & get_instance();
        $boqData = array(
        'boutique_work_status'=>$this->input->post('boutique_work_status')
      );
      $this->db->where('boutique_work_id',$this->input->post('boutique_work_id'));
      $this->db->update('b_boutique_works',$boqData);
      return TRUE;
    }

    public function addTeamImage($TeamID,$TeamImageName,$TeamImageCover){
      $teamImgData = array(
        'TeamID'=>$TeamID,
        'TeamImageName'=>$TeamImageName,
        'TeamImageCover'=>$TeamImageCover+1
      );
      $this->db->insert('cd_teamimage',$teamImgData);
    }

    public function updateTeamImage($TeamID,$TeamImageName,$TeamImageCover){

      $this->db->where('TeamID', $TeamID );
      $this->db->where('TeamImageCover',$TeamImageCover+1);
      $this->db->delete('cd_teamimage');

      $teamImgData = array(
        'TeamID'=>$TeamID,
        'TeamImageName'=>$TeamImageName,
        'TeamImageCover'=>$TeamImageCover+1
      );
      $this->db->insert('cd_teamimage',$teamImgData);
    }

    public function checkUser($old_p) {
    	$user_id = $this->session->userdata('UserID');
    	$query = $this->db->get_where('cd_admin', array('UserID' => $user_id));
    	$v_arr = $query->result();
    	  if (@$v_arr[0]->UserPwd == $old_p) {
    	      return true;
    	  } else {
    	      return false;
    	  }
    }
    // only allow loged in users to log in
    public function login($user_mail,$user_password) {

      $query = $this->db->get_where('b_boutique_tailor_login', array('boutique_tailor_username' => $user_mail));
      $v_arr = $query->result();
        if (@$v_arr[0]->boutique_tailor_pwd == $user_password) {
            $this->session->set_userdata('UserID', $v_arr[0]->boutique_tailor_id);
            $this->session->set_userdata('UserName', $v_arr[0]->boutique_tailor_username);
            $this->session->set_userdata('BoutiqueID', $v_arr[0]->boutique_id);
            return true;
        } else {
            return false;
        }
    }

    public function UpdateProfile($user_email,$new_p) {
    	$user_id = $this->session->userdata('UserID');
    	$Data = array(
    	      'UserEmail'=> $user_email,
    	      'UserPwd' => $new_p
    	);
    	$this->db->where('UserID',$user_id);
    	$this->db->update('cd_admin',$Data);
    	return TRUE;
    }

    public function sendPwdEnquiry($user_mail){
	$query = $this->db->get_where('cd_team', array('TeamEmail' => $user_mail));
        $v_arr = $query->result();
	 if (@$v_arr[0]->TeamID) {
            return true;
        } else {
            return false;
        }
    }

    public function logout() {
        $this->session->set_userdata('UserID','');
        $this->session->sess_destroy();
        return TRUE;
    }

    public function removeimage() {
        $imgid = $this->input->post('imgid');
        $query = $this->db->get_where('cd_teamimage', array('TeamImageID' => $imgid));
        $v_arr = $query->result();
        $uploaddir = $this->config->item('project_path')."uploads/";
        
        $uploadfile = $uploaddir . $v_arr[0]->TeamImageName;
        $pop_dir = 	$uploaddir.'original/'.$v_arr[0]->TeamImageName;
        $cover_dest = $uploaddir.'cover/' . $v_arr[0]->TeamImageName;
        $crophome_dest = $uploaddir.'home/' . $v_arr[0]->TeamImageName;
        $share_dest = $uploaddir.'share/' . $v_arr[0]->TeamImageName;
        $share_dest_en = $uploaddir.'share/en/' . $v_arr[0]->TeamImageName;
        $share_dest_fr = $uploaddir.'share/fr/' . $v_arr[0]->TeamImageName;
        @unlink($uploadfile);
        @unlink($pop_dir);
        @unlink($cover_dest);
        @unlink($crophome_dest);
        @unlink($share_dest);
        @unlink($share_dest_en);
        @unlink($share_dest_fr);
        $this->db->where('TeamImageID', $imgid );
        $this->db->delete('cd_teamimage');
    }

    public function changeTeamStatus($teamId,$teamStatus){
    	if($teamStatus == 1):
    		$newStatus = 2;
    	elseif($teamStatus == 2):
    		$newStatus = 0;
    	else :
    		$newStatus = 1;
    	endif;
        $teamData = array(
              'TeamApprovedStatus'=>$newStatus
        );
        $this->db->where('TeamID',$teamId);
        $this->db->update('cd_team',$teamData);
        return TRUE;
    }

   
    // update password -----------------------------------
    public function updatepassword($user_password,$adminId){
      $boqData = array(
            'boutique_admin_pwd'=>$user_password
      );
      $this->db->where('boutique_admin_id',$adminId);
      $this->db->update('b_boutique_admin',$boqData);
      return TRUE;
    }
    // update password -----------------------------------


    // update password -----------------------------------
    public function updateTailorpassword($user_password,$adminId){
      $boqData = array(
            'boutique_tailor_pwd'=>$user_password
      );
      $this->db->where('boutique_tailor_id',$adminId);
      $this->db->update('b_boutique_tailor_login',$boqData);
      return TRUE;
    }
    // update password -----------------------------------

    public function trashBoutique($delId) {
      $this->db->where('boutique_id',$delId);
      $this->db->delete('b_boutique');
      return TRUE;
    }

    // only allow loged in users to log in
    public function boutique_login($user_mail,$user_password) {

      $query = $this->db->get_where('b_boutique_admin', array('boutique_admin_username' => $user_mail));
      $v_arr = $query->result();
        if (@$v_arr[0]->boutique_admin_pwd == $user_password) {
            $this->session->set_userdata('UserID', $v_arr[0]->boutique_admin_id);
            $this->session->set_userdata('UserName', $v_arr[0]->boutique_admin_username);
            $this->session->set_userdata('BoutiqueID', $v_arr[0]->boutique_id);
            return true;
        } else {
            return false;
        }
    }
}
