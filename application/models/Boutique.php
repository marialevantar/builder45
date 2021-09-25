<?php
class Boutique extends CI_Model {

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
       $this->db->where("boutique_user_role", 2);
       $q = $this->db->get('b_boutique_user');
       $data = $q->result_array();
       return @$data[0];
   }

   public function getBoutiqueTailor($boutique_id) {
       $this->db->select('*');
       $this->db->where("boutique_id", $boutique_id);
       $this->db->where("boutique_user_role", 3);
       $q = $this->db->get('b_boutique_user');
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

    public function getTeams($page_num = 0, $per_page = 12, $order_by = 'TeamCreatedOn', $page_0 = 12, $sort_by = FALSE,$search_by = FALSE) {
        if (!empty($per_page)) {
            $offset = (empty($page_num)) ? 0 : $page_0 + (($page_num - 1) * $per_page);
            $user_per_page = (empty($page_num)) ? $page_0 : $per_page;
            $this->db->limit($user_per_page, $offset);
        }
        if ($search_by) {
          $this->db->like('TeamName',$search_by);
        }
        $this->db->order_by($order_by . ' DESC');
        $query = $this->db->get_where('cd_team',($sort_by) ? array('TeamApprovedStatus' => 1,'TeamAgeCat' =>$sort_by) : array('TeamApprovedStatus' => 1));
        return $query->result();
    }

    public function getTeam($teamId) {
        $query = $this->db->get_where('cd_team',array('TeamID' => $teamId));
        return $query->result();
    }

    public function getTeamImages($teamId) {
        $this->db->select('TeamImageID,TeamImageName,TeamImageCover');
	$this->db->order_by('TeamImageCover','ASC');
        $query = $this->db->get_where('cd_teamimage',array('TeamID' => $teamId));
        return $query->result();
    }

    public function getTeamImagesNum($order_by = 'TeamCreatedOn', $sort_by = FALSE, $search_by = FALSE) {

        if ($search_by) {
          $this->db->like('TeamName',$search_by);
        }
        $query = $this->db->get_where('cd_team',($sort_by) ? array('TeamApprovedStatus' => 1,'TeamAgeCat' =>$sort_by) : array('TeamApprovedStatus' => 1));
        $p_arr = $query->result();
        return ceil(sizeof($p_arr) / 12);
    }

    public function getTopTeams($limit = 0, $order_by = 'TeamVote') {

        $this->db->select('t.*,tv.TeamVote');
        $this->db->from('cd_team t');
        $this->db->join('cd_teamvote tv', 't.TeamID = tv.TeamID');
        $this->db->where('t.TeamApprovedStatus',1);
        if (!empty($limit)) {
            $this->db->limit($limit);
        }
        $this->db->order_by($order_by . ' DESC');
        $query = $this->db->get();
        return $query->result();
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


    public function saveboutique($newfileName){
      $CI = & get_instance();
      $qoutiqueData = array(
        'boutique_name'=>$this->input->post('boutiqueName'),
        'boutique_contact_name'=>$this->input->post('contactName'),
        'boutique_email'=>$this->input->post('email'),
        'boutique_ph'=>$this->input->post('phone'),
        'boutique_tagline'=>$this->input->post('tagline'),
        'boutique_desc'=>$this->input->post('description'),
        'boutique_city'=>$this->input->post('city'),
        'boutique_state'=>$this->input->post('state'),
        'boutique_address'=>$this->input->post('address'),
        'boutique_logo'=>$newfileName,
        'boutique_billing_status'=>$this->input->post('boutique_billing_status'),
        'boutique_stitching_status'=>$this->input->post('boutique_stitching_status'),
        'boutique_whatsapp_msg_status'=>$this->input->post('boutique_whatsapp_msg_status'),
        'boutique_sms_msg_status'=>$this->input->post('boutique_sms_msg_status')
      );
      $this->db->insert('b_boutique',$qoutiqueData);
      $BqID = $this->db->insert_id();

      $boutiqueAdminData = array(
        'boutique_id'=>$BqID,
        'boutique_user_username'=>$this->input->post('adminusername'),
        'boutique_user_pwd'=>sha1($this->input->post('adminpassword') . $CI->config->item('encryption_key')),
        'boutique_user_role'=>2
      );
      $this->db->insert('b_boutique_user',$boutiqueAdminData);

      $boutiqueTailorData = array(
        'boutique_id'=>$BqID,
        'boutique_user_username'=>$this->input->post('tailorusername'),
        'boutique_user_pwd'=>sha1($this->input->post('tailorpassword').$CI->config->item('encryption_key')),
        'boutique_user_role'=>3
      );
      $this->db->insert('b_boutique_user',$boutiqueTailorData);

      return $BqID;
    }


    public function updateboutique($newfileName){
        $CI = & get_instance();
        $boqData = array(
        'boutique_name'=>$this->input->post('boutiqueName'),
        'boutique_contact_name'=>$this->input->post('contactName'),
        'boutique_email'=>$this->input->post('email'),
        'boutique_ph'=>$this->input->post('phone'),
        'boutique_tagline'=>$this->input->post('tagline'),
        'boutique_desc'=>$this->input->post('description'),
        'boutique_city'=>$this->input->post('city'),
        'boutique_state'=>$this->input->post('state'),
        'boutique_address'=>$this->input->post('address'),
        'boutique_logo'=>$newfileName,
        'boutique_billing_status'=>$this->input->post('boutique_billing_status'),
        'boutique_stitching_status'=>$this->input->post('boutique_stitching_status'),
        'boutique_whatsapp_msg_status'=>$this->input->post('boutique_whatsapp_msg_status'),
        'boutique_sms_msg_status'=>$this->input->post('boutique_sms_msg_status')
      );
      $this->db->where('boutique_id',$this->input->post('boutique_id'));
      $this->db->update('b_boutique',$boqData);
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

      $query = $this->db->get_where('b_boutique_user', array('boutique_user_username' => $user_mail));
      $v_arr = $query->result();
        if (@$v_arr[0]->boutique_user_pwd == $user_password) {
            $this->session->set_userdata('UserID', $v_arr[0]->boutique_user_id);
            $this->session->set_userdata('UserName', $v_arr[0]->boutique_user_username);
            $this->session->set_userdata('UserRole', $v_arr[0]->boutique_user_role);
            $this->session->set_userdata('BoutiqueID', $v_arr[0]->boutique_id);
             $queryB = $this->db->get_where('b_boutique', array('boutique_id' => $v_arr[0]->boutique_id));
             $b_arr = $queryB->result();
            $this->session->set_userdata('BoutiqueBillingStatus', @$b_arr[0]->boutique_billing_status);
            $this->session->set_userdata('BoutiqueStitchingStatus', @$b_arr[0]->boutique_stitching_status);
            $this->session->set_userdata('BoutiqueName', @$b_arr[0]->boutique_name);
            $this->session->set_userdata('BoutiqueAddr', @$b_arr[0]->boutique_address);
            $this->session->set_userdata('BoutiquePh', @$b_arr[0]->boutique_ph);
            $this->session->set_userdata('BoutiqueEmail', @$b_arr[0]->boutique_email);
            $this->session->set_userdata('BoutiqueLogo', @$b_arr[0]->boutique_logo);
            return $v_arr[0];
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
            'boutique_user_pwd'=>$user_password
      );
      $this->db->where('boutique_user_id',$adminId);
      $this->db->update('b_boutique_user',$boqData);
      return TRUE;
    }
    // update password -----------------------------------


    // update password -----------------------------------
    public function updateTailorpassword($user_password,$adminId){
      $boqData = array(
            'boutique_user_pwd'=>$user_password
      );
      $this->db->where('boutique_user_id',$adminId);
      $this->db->update('b_boutique_user',$boqData);
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
            return true;
        } else {
            return false;
        }
    }

    public function getsmsreports() {

     $this->db->select("*,COUNT(*) as total_sms");
     $this->db->from('b_boutique_messages bm');
     $this->db->join('b_boutique b', 'bm.boutique_id = b.boutique_id');

     if(@$this->input->post('date_from_report') && @$this->input->post('date_to_report')){
          $this->db->where("bm.boutique_message_date BETWEEN STR_TO_DATE('".$this->input->post('date_from_report')."', '%Y-%m-%d') AND STR_TO_DATE('".$this->input->post('date_to_report')."', '%Y-%m-%d')");
     }

     $this->db->group_by('bm.boutique_id'); 
     $q = $this->db->get();
     $data = $q->result_array();

     return @$data;

   }

}
