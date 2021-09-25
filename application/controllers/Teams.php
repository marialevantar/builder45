<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teams extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	 public function __construct() {
 			 parent::__construct();
 			 $this->load->library('session');
 			 $this->load->database();
 			 $this->load->model('Team');
 			 $this->load->library('Zebra_Image');
			 $this->load->helper(array('cookie', 'admin'));
 			 if(!$this->session->userdata('UserID')){
 						 redirect(base_url().'login/', 'refresh');
 			 }
  }

	public function index()
	{
		$data['teamDatas'] = $this->Team->getAllTeams();
		$this->session->set_userdata('filter','');
		$this->load->view('header');
		$this->load->view('teams',$data);
		$this->load->view('footer');
	}

	public function filter()
	{
		$status = -1;
		$filter_string = $this->uri->segment(3);
		if($filter_string == "new"):
			$status = 0;
			$this->session->set_userdata('filter','new');
		endif;
		if($filter_string == "active"):
			$status = 1;
			$this->session->set_userdata('filter','active');
		endif;
		if($filter_string == "rejected"):
			$status = 2;
			$this->session->set_userdata('filter','rejected');
		endif;
		$data['teamDatas'] = $this->Team->getFilterTeams($status);
		$this->load->view('header');
		$this->load->view('teams',$data);
		$this->load->view('footer');
	}

	public function changeTeamStatus() {

          $teamId = format_input($this->input->post('teamId'));
          $teamStatus = format_input($this->input->post('statusId'));
          if ($this->Team->changeTeamStatus($teamId,$teamStatus)) {
              return print_r(json_encode(array('status'=>'success','msg' => 'Team Status Updated.')));
          } else {
              return print_r(json_encode(array('status'=>'failure','msg' => 'Status Updation Failed')));
          }
       }
       
       // --------------- update pwd --------------------------------------------
	public function updatepassword() {
			$this->load->library('form_validation');
			$this->load->helper(array('cookie', 'admin'));
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[password]');

			if ($this->form_validation->run() == FALSE) {
				// $this->session->set_flashdata('notification', 'Password and Confirm Password Should Match');
				// $this->session->set_flashdata('status', 'fail');
				return print_r(json_encode(array('status'=>'failure','msg' => 'Password and Confirm Password Should Match')));
			} else {
				$user_password = crypt_password($this->input->post('password'));
				$teamId = $this->input->post('teamid');
				if ($this->Team->updatepassword($user_password,$teamId)){
					// $this->session->set_flashdata('notification', 'Password changed successfully.');
					// $this->session->set_flashdata('status', 'success');
					return print_r(json_encode(array('status'=>'success','msg' => 'Password changed successfully.')));
				} else {
					// $this->session->set_flashdata('notification', 'Password changed failed.');
					// $this->session->set_flashdata('status', 'fail');
					return print_r(json_encode(array('status'=>'failure','msg' => 'Password changed failed.')));
				}
			}
	}
      //--------------------------------------------------------------------------

	public function teamdetails(){
		$Id = $this->uri->segment(3);
		$data['teamdetails'] = $this->Team->getTeam($Id);
		$data['teamimages'] = $this->Team->getTeamImages($Id);
		$this->load->view('header');
		$this->load->view('teams-detail',$data);
		$this->load->view('footer');
	}

	public function saveregistration() {

	   //print_r($_REQUEST);
	   $this->load->library(array('form_validation'));

	   $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[cd_team.TeamEmail]');
	    if ($this->form_validation->run() == FALSE) {
	    	//return print_r(json_encode(array("status"=>"failure","msg"=>"This Mail ID Already In Use")));
	    	$this->session->set_flashdata('notification', 'This Mail ID Already In Use');
	    	$this->session->set_flashdata('status', 'fail');
	    	redirect(base_url().'teams/', 'refresh');
	    	return 0;
	    }

	   $teamId = $this->Team->saveTeam();

	   	for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
	    @$image = @basename($_FILES['file']['name'][$i]);
	    if(@$image) {
	      @$extension  = strtolower(pathinfo($image,PATHINFO_EXTENSION));
	      @$newfileName = time().rand()."." . $extension;
	      $uploaddir = $this->config->item('project_path')."uploads/";
	      $uploadfile = $uploaddir . $newfileName;
	      $pop_dir = 	$uploaddir.'original/'.$newfileName;
	      $cover_dest = $uploaddir.'cover/' . $newfileName;
	      $crophome_dest = $uploaddir.'home/' . $newfileName;
	      $share_dest = $uploaddir.'share/' . $newfileName;
	      if (@move_uploaded_file(@$_FILES['file']['tmp_name'][$i], $uploadfile)) {
	          $this->imgage_resize($uploadfile,$crophome_dest,441,335);
	          $this->imgage_resize($uploadfile,$pop_dir,1920,1080);
	          $this->imgage_resize($uploadfile,$cover_dest,1290,480);
	          $this->imgage_resize($uploadfile,$share_dest,980,428);
	          $this->share_image($share_dest,$extension,$newfileName);
	          $TeamImageCover = ($i == 0)?1:0;
	          $this->Team->addTeamImage($teamId,$newfileName,$TeamImageCover);
	      }
	    }
	  }
	  $this->session->set_flashdata('notification', 'Team created successfully');
	  $this->session->set_flashdata('status', 'success');
	  redirect(base_url().'teams/', 'refresh');
	}

	public function updateteamdetails() {
		$Id = $this->uri->segment(3);
		$this->Team->updateTeam($Id);
		$this->session->set_flashdata('notification', 'Team updated successfully');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'Teams/teamdetails/'.$Id);
	}

	public function addteamimg() {

		$teamId = $this->uri->segment(3);

		for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
		@$image = @basename($_FILES['file']['name'][$i]);
		if(@$image) {
		    @$extension  = strtolower(pathinfo($image,PATHINFO_EXTENSION));
		    @$newfileName = time().rand()."." . $extension;
		    $uploaddir = $this->config->item('project_path')."uploads/";
		    $uploadfile = $uploaddir . $newfileName;
		    $pop_dir = 	$uploaddir.'original/'.$newfileName;
		    $cover_dest = $uploaddir.'cover/' . $newfileName;
		    $crophome_dest = $uploaddir.'home/' . $newfileName;
		    $share_dest = $uploaddir.'share/' . $newfileName;
		    if (@move_uploaded_file(@$_FILES['file']['tmp_name'][$i], $uploadfile)) {
		        $this->imgage_resize($uploadfile,$crophome_dest,441,335);
		        $this->imgage_resize($uploadfile,$pop_dir,1920,1080);
		        $this->imgage_resize($uploadfile,$cover_dest,1290,480);
		        $this->imgage_resize($uploadfile,$share_dest,980,428);
		        $this->share_image($share_dest,$extension,$newfileName);
		        //$TeamImageCover = ($i == 0)?1:0;
		        $TeamImageCover = 0;
		        $this->Team->addTeamImage($teamId,$newfileName,$TeamImageCover);
		    }
		  }
		}
		$this->session->set_flashdata('notification', 'New image added successfully');
		$this->session->set_flashdata('status', 'success');
		  redirect(base_url().'Teams/teamdetails/'.$teamId);
	}

	public function removeteamimage() {
		$teamId = $this->uri->segment(3);
		$this->Team->removeimage();
		$this->session->set_flashdata('notification', 'Image removed successfully');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url().'Teams/teamdetails/'.$teamId);
	}

	public function imgage_resize($source,$dest,$width,$height){
		$image = new Zebra_Image();
		$image->source_path = $source;
		$image->target_path = $dest;
		$image->resize($width, $height, ZEBRA_IMAGE_CROP_CENTER);
	}

	public function share_image($share_dest,$extension,$newfileName) {
	  $social_bg_en = imagecreatefrompng($this->config->item('project_path').'uploads/share/social-bg-en.png');
	  $social_icon_en  = imagecreatefrompng($this->config->item('project_path').'uploads/share/social-icons-en.png');

	  if($extension =='jpg'||$extension =='jpeg'||$extension =='JPG'||$extension =='JPEG'){
	      $src = imagecreatefromjpeg($share_dest);
	  }
	  elseif ($extension =='png'||$extension =='PNG') {
	      $src = imagecreatefrompng($share_dest);
	  }
	  else {
	      $src = imagecreatefromgif($share_dest);
	  }

	  //---------------- EN Shre Image ---------------//
	  imagealphablending($social_bg_en, true);
	  imagesavealpha($social_bg_en, true);
	  imagecopy($social_bg_en, $src, 110, 100, 0, 0, 980, 428);

	  imagealphablending($social_bg_en, true);
	  imagesavealpha($social_bg_en, true);
	  imagecopy($social_bg_en, $social_icon_en, 0, 0, 0, 0, 1200, 627);

	  if($extension =='jpg'||$extension =='jpeg'||$extension =='JPG'||$extension =='JPEG'){
	      imagejpeg($social_bg_en, $this->config->item('project_path').'uploads/share/'.$newfileName);
	  }
	  elseif ($extension =='png'||$extension =='PNG') {
	      imagepng($social_bg_en, $this->config->item('project_path').'uploads/share/'.$newfileName);
	  }
	  else {
	      imagegif($social_bg_en, $this->config->item('project_path').'uploads/share/'.$newfileName);
	  }



	  imagedestroy($social_bg_en);
	  imagedestroy($social_icon_en);
	  imagedestroy($src);
	}

	public function deleteteam($delid) {
		//echo $delid;
		$this->Team->trashTeam($delid);
		$stat = $this->session->userdata('filter');
		if($stat == "rejected"):
		  $backlink = base_url()."teams/filter/rejected";
		elseif($stat == "new"):
		  $backlink = base_url()."teams/filter/new";
		elseif($stat == "active"):
		  $backlink = base_url()."teams/filter/active";
		else:
		  $backlink = base_url()."teams";
		endif;
		$this->session->set_flashdata('notification', 'Team moved to trash!');
		$this->session->set_flashdata('status', 'success');
		redirect($backlink);
		//die();
	}
}
