<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		// is_logged_in();
	}
	public function index()
	{
		$data['data_info'] = $this->Menu_model->detail_info()->result();
		$data['data_pbl'] = $this->Menu_model->detail_pbl()->result();

		if ($this->session->userdata('email')) {
			redirect('user');
		}
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == false) {
			//validasi tidak sukses
			$data['title'] = 'master adminAPR';
			// $this->load->view('templates/auth_header', $data);
			$this->load->view('landing_view/index.php', $data);
			// $this->load->view('templates/auth_footer', $data);
		} else {
			//validasinya succes
			$this->_login();
		}
	}

	public function login()
	{
		if ($this->session->userdata('email')) {
			redirect('user');
		}
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == false) {
			//validasi tidak sukses
			$data['title'] = 'master adminAPR';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login.php');
			$this->load->view('templates/auth_footer');
		} else {
			//validasinya succes
			$data['title'] = 'master adminAPR';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login.php');
			$this->load->view('templates/auth_footer');
			$this->_login();
		}
	}


	//private class untuk login
	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		// var_dump($user); //cek data

		if ($user) {
			//user ada
			if ($user['is_active'] == 1) {
				//user aktif
				//cek password
				if (password_verify($password, $user['password'])) {
					$data = [
						'id' => $user['id'],
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);

					if ($user['role_id'] == 1) {
						//super admin
						redirect('admin');
					} else if ($user['role_id'] == 2) {
						//pembimbing lapangan
						redirect('pembimbing_lapangan');
					} else if ($user['role_id'] == 3) {
						//operator
						redirect('operator');
					} else if ($user['role_id'] == 4) {
						//pimpinan
						redirect('pimpinan');
					} else if ($user['role_id'] == 5) {
						//mahasiswa
						redirect('mahasiswa');
					}
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">wrong password!!!</div>');
					redirect(base_url('auth/index'));
				}
			} else { //user tidak aktif
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">this email is not activate</div>');
				redirect('auth');
			}
		} else {
			$this->session->sess_destroy();

			//user tidak ada
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered</div>');
			redirect('auth');
		}
	}




	public function registration()
	{

		if ($this->session->userdata('email')) {
			redirect('user');
		}
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'This email has already resgistered!'
		]);
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'password dont match',
			'min_length' => 'Password too short',
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]');


		if ($this->form_validation->run() == false) {
			$data['title'] = 'master adminAPR';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		} else {
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 1,
				'date_created' => time()
			];
			$this->db->insert('user', $data);

			// $this->_sendEmail();

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulations ! your accounts has been created. Please Login!!</div>');
			redirect('auth');
		}
	}
	// mail.mydomain.com
	private function _sendEmail()
	{
		ini_set('smtp_port', 25);
		ini_set('SMTP', 'localhost');
		$config = [
			// 'protocol'  => 'mail',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'driveapri99@gmail.com',
			'smtp_pass' => 'diponegoro',
			// 'smtp_port' => 25,
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'newline'   => "\r\n",
			'wordwrap' => true
		];

		$this->load->library('email');
		// $this->load->email($config);
		$this->email->initialize($config);

		$this->email->from('driveapri99@gmail.com', 'Apri Diponegoro Drive');
		$this->email->to('alfianapriansyah37@gmail.com');
		$this->email->subject('testing');
		$this->email->message('hello word');
		// $this->email->send();
		if ($this->email->send()) { //kirim ke email
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}

	// public function blocked()
	// {
	// 	// echo 'access blocked';
	// 	$this->load->view('auth/blocked');
	// }

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">you have been logout</div>');
		redirect('auth');
	}

	public function forgotPassword()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Forgot Password';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/forgot-password');
			$this->load->view('templates/auth_footer');
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date'  => time()
				];

				$this->db->insert('user_tokon', $user_token);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email Is Not Regitered Or Activate</div>');
				redirect('auth/forgotPassword');
			}
		}
	}
}
