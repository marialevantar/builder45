<?php
class Team extends CI_Model {

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

    public function getAllTeams() {
		        $this->db->select(
           'cd_team.TeamID AS TeamID,
           cd_team.TeamName AS TeamName,
           cd_team.TeamAgeCat AS TeamAgeCat,
           cd_team.TeamComInvSum AS TeamComInvSum,
           cd_team.TeamApprovedStatus AS TeamApprovedStatus,
           cd_team.TeamCreatedOn AS TeamCreatedOn,
           cd_team.TeamCity AS TeamCity');
       $this->db->order_by("cd_team.TeamName", "asc");
       $this->db->where('cd_team.TeamApprovedStatus !=',3);
       $q = $this->db->get('cd_team');
       $data = $q->result_array();
       return @$data;
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

    public function saveTeam(){
      $CI = & get_instance();
      $teamData = array(
        'TeamName'=>$this->input->post('teamName'),
        'TeamContactName'=>$this->input->post('name'),
        'TeamPhone'=>$this->input->post('phone'),
        'TeamEmail'=>$this->input->post('email'),
        'TeamPwd'=>sha1($this->input->post('password') . $CI->config->item('encryption_key')),
        'TeamAgeCat'=>$this->input->post('age_cat'),
        'TeamHeadCoachName'=>$this->input->post('coachName'),
        'TeamCity'=>$this->input->post('city'),
        'TeamLevel'=>$this->input->post('level'),
        'TeamComInvSum'=>$this->input->post('summary')
      );
      $this->db->insert('cd_team',$teamData);
      $TeamID = $this->db->insert_id();

      $teamVoteData = array(
        'TeamID'=>$TeamID
      );
      $this->db->insert('cd_teamvote',$teamVoteData);
      return $TeamID;
    }

    public function updateTeam($Id){
        $CI = & get_instance();
        $query = $this->db->get_where('cd_team', array('TeamEmail' => $this->input->post('email'),'TeamID !='=>$Id));
        $v_arr = $query->result();
        if(@$v_arr[0]){
          return FALSE;
        }
        $teamData = array(
        'TeamName'=>$this->input->post('teamName'),
        'TeamContactName'=>$this->input->post('name'),
        'TeamPhone'=>$this->input->post('phone'),
        'TeamEmail'=>$this->input->post('email'),
        //'TeamPwd'=>sha1($this->input->post('password') . $CI->config->item('encryption_key')),
        'TeamAgeCat'=>$this->input->post('age_cat'),
        'TeamHeadCoachName'=>$this->input->post('coachName'),
        'TeamCity'=>$this->input->post('city'),
        'TeamLevel'=>$this->input->post('level'),
        'TeamComInvSum'=>$this->input->post('summary'),
        'TeamApprovedStatus'=>$this->input->post('status')
      );
      $this->db->where('TeamID',$Id);
      $this->db->update('cd_team',$teamData);
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
// //Test //
//       $this->session->set_userdata('UserID', 1);
//       $this->session->set_userdata('UserName', "cinco");
//       return true;
// //Test //

      $query = $this->db->get_where('cd_admin', array('UserEmail' => $user_mail));
      $v_arr = $query->result();
        if (@$v_arr[0]->UserPwd == $user_password) {
            $this->session->set_userdata('UserID', $v_arr[0]->UserID);
            $this->session->set_userdata('UserName', $v_arr[0]->UserName);
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
    public function updatepassword($user_password,$teamId){
      $teamData = array(
            'TeamPwd'=>$user_password
      );
      $this->db->where('TeamID',$teamId);
      $this->db->update('cd_team',$teamData);
      return TRUE;
    }
    // update password -----------------------------------

    public function trashTeam($delId) {
      $teamData = array(
            'TeamApprovedStatus'=> '3'
      );
      $this->db->where('TeamID',$delId);
      $this->db->update('cd_team',$teamData);
      return TRUE;
    }

}
