<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_controller
{

	function __construct()
	{
		// Call the controller constructor
		parent::__construct();
		$this->load->helper(array('form', 'url'));

		// logged in?
		if(!$this->login->is_admin() && $this->uri->segment(2) != "login")
		{
			redirect('/admin/login/ad?redir='.urlencode($_SERVER['REQUEST_URI']), 'refresh');
		}
	}

	function index()
	{
		$this->overview();
	}

	function overview()
	{
		$data['name'] = $this->login->get_info("fname");

		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/menu');
		$this->load->view('admin/overview', $data);
		$this->load->view('admin/templates/footer', $data);
	}

	function login($dowhat = '')
	{
		// load password hash library
		$this->load->library('PasswordHash',array(8, FALSE));

		// perform logout
		if($dowhat == 'logout')
			$this->login->logout();

		// perform login
		if($dowhat == 'do')
		{
			$liuid = $this->input->post('liuid');
			$password = $this->input->post('password');

			if($liuid && $password && $this->login->validate($liuid, $password))
			{
				redirect((isset($_GET['redir']) ? '/'.urldecode($_GET['redir']) : '/admin'));
			}

			echo '<!--'.$this->passwordhash->HashPassword($password).'-->';
		}

		$data = array();
		// save message for login page
		$data['msg'] = $dowhat;

		// load views
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/login', $data);
		$this->load->view('admin/templates/footer', $data);
	}

	function user($action = '', $id = '')
	{
		// make sure user is allowed where it is
		if(!($action == 'me' || $action == 'pwd') && !$this->login->has_privilege(2))
			show_404();

		// load password hash library
		$this->load->library('PasswordHash',array(8, FALSE));

		$data = array();
		$this->load->model("User_model");

		switch($action)
		{
			case 'new':
				$view = 'user_new';
			break;

			case 'new_run':
				$liuid = $this->input->post("liuid");
				$fname = $this->input->post("fname");
				$sname = $this->input->post("sname");
				$passw = $this->input->post("passw");
				$privil = $this->input->post("privil");

				$data['message'] = $this->User_model->create_user($liuid, $fname, $sname, $passw, $privil);

				$view = 'user_new';
			break;

			case 'edit':
				if($id == '' || !$this->User_model->user_exist($id))
					show_404();

				$data['user'] = $this->User_model->get_user($id);

				$view = 'user_edit';
			break;

			case 'edit_run':
				if($id == '' || !$this->User_model->user_exist($id))
					show_404();

				$liuid = $this->input->post("liuid");
				$fname = $this->input->post("fname");
				$sname = $this->input->post("sname");
				$passw = $this->input->post("passw");
				$privil = $this->input->post("privil");

				if($this->User_model->edit_user($id, $liuid, $fname, $sname, $passw, $privil))
					redirect('/admin/user/edit/'.$id.'/?msg=s');
				else
					redirect('/admin/user/edit/'.$id.'/?msg=f');

				$view = 'user_edit';
			break;

			case 'all':
				$data['users'] = $this->User_model->get_all();
				$view = 'user_all';
			break;

			case 'me':
				$view = 'user_account';
			break;

			case 'pwd':
				$pwd = trim($this->input->post('passw'));
				$confirm = trim($this->input->post('confirm'));

				$data['message'] = $this->User_model->update_password($this->login->get_id(), $pwd, $confirm);

				$view = 'user_account';
			break;

			default:
				$view = 'user_account';
			break;
		}

		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/menu');
		$this->load->view('admin/'.$view, $data);
		$this->load->view('admin/templates/footer', $data);
	}

	function page($action = '', $id = '')
	{
		// make sure user is allowed here
		if(!$this->login->has_privilege(3))
			show_404();
		// load post model for content handeling
		$this->load->model('Post_model');
		// load user model for name collecting
		$this->load->model('User_model');
		// prepare data array for view
		$data = array();
		$data['post_id'] = $id;

		switch($action)
		{
			// create new page
			case 'new':
				$view = 'page_post';
			break;
			// run the post model that creates new page or edit existing
			case 'run':
				// setup the post data
				$title = $this->input->post('post_title');
				$content = $this->input->post('post_content');
				$type = 0;
				$slug = '';
				$status = $this->input->post('post_status');

				if($id == '') // create new page
				{
					$createdid = $this->Post_model->create($title, $slug, $content, $status, $type);

					// using the fact that in php, everything !== 0 is true
					if($createdid)
					{
						redirect('/admin/page/edit/'.$createdid.'?msg=1');
						die();
					}
					$data['message'] = false;
					$data['title'] = htmlspecialchars(trim($title));
					$data['content'] = trim($content);
				}
				else // edit existing page
				{
					// attempt update
					if($this->Post_model->update($id, $title, $slug, $content, $status, $type))
					{
						redirect('/admin/page/edit/'.$id.'?msg=1');
					}
					else
					{
						// make sure the info is stored with the browser if failure
						$data['post'] = array(
								'title' => $title,
								'content' => $content,
								'slug' => $slug,
								'parentid' => $parent,
								'post_id' => $id
							);
						// message variable for error informing
						$data['message'] = false;

						// display page
						$view = 'page_post';
					}
				}
			break;
			// edit existing page
			case 'edit':
				// if id is not set, redirect to create new page
				if($id == '' || !$this->Post_model->post_exists($id))
					redirect('/admin/page/new');

				if(isset($_GET['msg']) && $_GET['msg'] == '1')
					$data['message'] = true;

				// collect post data
				$data['post'] = $this->Post_model->get_post($id);
				$data['author'] = $this->User_model->get_name($data['post']['uid']);

				// display page
				$view = 'page_post';
			break;
			case 'togglestatus': // change status of post
				// if id is not set, redirect to create new page
				if($id == '' || !$this->Post_model->post_exists($id))
					redirect('/admin/page/all?msg=dne');

				if($this->Post_model->togglestatus($id))
					redirect('admin/page/all?msg=toggles');
				else
					redirect('admin/page/all?msg=togglef');
			break;
			case 'all': // see all pages/posts
				// load all pages from model
				$data['pages'] = $this->Post_model->get_all_posts();

				// få med namnen. FULT, men det fungerar.
				foreach ($data['pages'] as $key => $value) {
					$data['pages'][$key] = array_merge(
											$data['pages'][$key],
											array('editor' => $this->User_model->get_name($data['pages'][$key]['uid']))
										);
				}

				$view = 'page_all';
			break;
			case 'remove': // remove post
				// if id is not set, redirect to create new page
				if($id == '' || !$this->Post_model->post_exists($id))
					redirect('/admin/page/all?msg=dne');

				if($this->Post_model->delete($id))
					redirect('admin/page/all?msg=removes');
				else
					redirect('admin/page/all?msg=removef');

				$view = 'page_all';
			break;
			default:
				$view = 'page_all';
			break;
		}

		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/menu');
		$this->load->view('admin/'.$view, $data);
		$this->load->view('admin/templates/footer', $data);
	}

	function post($action = '', $id = '')
	{
		// make sure user is allowed here
		if(!$this->login->has_privilege(3))
			show_404();
		// load post model for content handeling
		$this->load->model('Post_model');
		// load user model for name collecting
		$this->load->model('User_model');
		// prepare data array for view
		$data = array();
		$data['post_id'] = $id;

		switch($action)
		{
			// create new page
			case 'new':
				$view = 'post_post';
			break;
			// run the post model that creates new page or edit existing
			case 'run':
				// setup the post data
				$title = $this->input->post('post_title');
				$content = $this->input->post('post_content');
				$type = 1;
				$slug = '';
				$status = $this->input->post('post_status');

				if($id == '') // create new page
				{
					$createdid = $this->Post_model->create($title, $slug, $content, $status, $type);

					// using the fact that in php, everything !== 0 is true
					if($createdid)
					{
						redirect('/admin/post/edit/'.$createdid.'?msg=1');
						die();
					}
					$data['message'] = false;
					$data['title'] = htmlspecialchars(trim($title));
					$data['content'] = trim($content);
				}
				else // edit existing page
				{
					// attempt update
					if($this->Post_model->update($id, $title, $slug, $content, $status, $type))
					{
						redirect('/admin/post/edit/'.$id.'?msg=1');
					}
					else
					{
						// make sure the info is stored with the browser if failure
						$data['post'] = array(
								'title' => $title,
								'content' => $content,
								'slug' => $slug,
								'parentid' => $parent,
								'post_id' => $id
							);
						// message variable for error informing
						$data['message'] = false;

						// display page
						$view = 'post_post';
					}
				}
			break;
			// edit existing page
			case 'edit':
				// if id is not set, redirect to create new page
				if($id == '' || !$this->Post_model->post_exists($id))
					redirect('/admin/post/new');

				if(isset($_GET['msg']) && $_GET['msg'] == '1')
					$data['message'] = true;

				// collect post data
				$data['post'] = $this->Post_model->get_post($id);
				$data['author'] = $this->User_model->get_name($data['post']['uid']);

				// display page
				$view = 'post_post';
			break;
			case 'togglestatus': // change status of post
				// if id is not set, redirect to create new page
				if($id == '' || !$this->Post_model->post_exists($id))
					redirect('/admin/post/all?msg=dne');

				if($this->Post_model->togglestatus($id))
					redirect('admin/post/all?msg=toggles');
				else
					redirect('admin/post/all?msg=togglef');
			break;
			case 'all': // see all pages/posts
				// load all pages from model
				$data['pages'] = $this->Post_model->get_all_posts(1);

				// få med namnen. FULT, men det fungerar.
				foreach ($data['pages'] as $key => $value) {
					$data['pages'][$key] = array_merge(
											$data['pages'][$key],
											array('editor' => $this->User_model->get_name($data['pages'][$key]['uid']))
										);
				}

				$view = 'post_all';
			break;
			case 'remove': // remove post
				// if id is not set, redirect to create new page
				if($id == '' || !$this->Post_model->post_exists($id))
					redirect('/admin/post/all?msg=dne');

				if($this->Post_model->delete($id))
					redirect('admin/post/all?msg=removes');
				else
					redirect('admin/post/all?msg=removef');

				$view = 'post_all';
			break;
			default:
				$view = 'post_all';
			break;
		}

		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/menu');
		$this->load->view('admin/'.$view, $data);
		$this->load->view('admin/templates/footer', $data);
	}

	/**
	 * image handeling
	 */
	function images($action = 'page', $page = 1)
	{
		// make sure user is allowed here
		if(!$this->login->has_privilege(4))
			show_404();

		// decrease $page by one to prepare for database handeling
		$page = abs(intval($page) - 1);

		$data = array();
		// load image model for image db handeling
		$this->load->model("Image_model");
		// load user model for name, basically
		$this->load->model("User_model");

		switch ($action) {
			case 'run': // image is sent to server!
				$uploaddir = './web/uploads/';
				$filename = '('.date('ymd_H-i_').random(1,3).') '.basename($_FILES['file']['name']);

				$uploadfile = $uploaddir.$filename;

				// check file type!
				if(($_FILES['file']['type'] == 'image/jpeg' || $_FILES['file']['type'] == 'image/png') &&
					move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)
					&& $this->Image_model->add($filename))
				{
					echo "File is valid, and was successfully uploaded.\n";
					exit;
				}
				else
				{
					echo "Something went wrong!\n";
					exit;
				}
				break;
			case 'batchedit':
				if($this->input->post("batch-show"))
				{
					foreach ($this->input->post("batch_list") as $image) {
						$this->Image_model->toggle($image, 1);
					}
					redirect('/admin/images/all?msg=1');
				}
				elseif($this->input->post("batch-hide"))
				{
					foreach ($this->input->post("batch_list") as $image) {
						$this->Image_model->toggle($image, 0);
					}
					redirect('/admin/images/all?msg=1');
				}
				elseif($this->input->post("batch-delete"))
				{
					foreach ($this->input->post("batch_list") as $image) {
						$this->Image_model->remove($image);
					}
					redirect('/admin/images/all?msg=1');
				}
				break;
			case 'edit':
				if(!$this->input->post('action')) return false;

				$id = intval($this->input->post('id'));
				$currstatus = $this->Image_model->get_status($id);

				// return json
				$data = array(
							'action' => $action,
							'id'	 => $id,
							'status' => $this->Image_model->toggle($id, !$currstatus)
						);

				echo json_encode($data);

				// exit
				return false;
				break;
			default:
				$data['limit'] = 60;
				$data['images'] = $this->Image_model->get_all('*', $data['limit'], $page);
				$data['page'] = $page+1;
				$data['countall'] = $this->Image_model->count_all();
				$data['countpublic'] = $this->Image_model->count_all(1);
				$data['totalpages'] = ceil($data['countall']/$data['limit']);

				// få med namnen. FULT, men det fungerar.
				foreach ($data['images'] as $key => $value) {
					$data['images'][$key] = array_merge(
											$data['images'][$key],
											array('editor' => $this->User_model->get_name($data['images'][$key]['uid']))
										);
				}

				$view = 'images_all';
				break;
		}


		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/menu');
		$this->load->view('admin/'.$view, $data);
		$this->load->view('admin/templates/footer', $data);
	}

}
