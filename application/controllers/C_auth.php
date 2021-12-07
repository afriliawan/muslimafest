<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_auth extends CI_Controller 
{
    public function index()
	{
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','trim|required');

        if ($this->form_validation->run() == false){
            $data['title'] = 'Login Page';
            $this->load->view('V_auth/templates/header', $data);
            $this->load->view('V_auth/pages/login');
            $this->load->view('V_auth/templates/footer');

        } else {
            //validasi sukses
            $this->_login(); //_login adalah method private
        }
    }

    private function _login()
    {
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');

        $user = $this->db->get_where('pic', ['email' => $email])->row_array();
        
        if($user) {
            //jika usernya aktif
            if ($user['active'] == 1){   
                //cek password
                if(password_verify($password, $user['password'])){
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] != 0 ){
                        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Berhasil login! Selamat datang.</div>');
                        redirect('profil-saya');
                    } else {
                        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Berhasil login! Selamat datang.</div>');
                        redirect('profil-saya');
                    } 
                } else {
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Password salah!</div>');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email Anda belum aktif!</div>');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email tidak terdaftar!</div>');
            redirect('login');
        }
    }

    public function registration()
	{
        $this->form_validation->set_rules('first_name', 'First name', 'required|regex_match[/[a-zA-Z]$/]'); //trim berfungsi agar spasi tidak masuk kedalam database
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[pic.email]', [ 
            'is_unique' => 'This email has been registered!'
        ]); //is_unique[user.email] agar tidak bisa mendaftarkan email yg sudah ada di dalam database
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]',[
            'matches' => 'Password dont match !',
            'min_length' => 'Password too short !'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('V_auth/templates/header', $data);
            $this->load->view('V_auth/pages/daftar-akun');
            $this->load->view('V_auth/templates/footer');
        } else {
            $first_name = $this->input->post('first_name', true);
            $last_name = $this->input->post('last_name', true);
            $email = $this->input->post('email', true);
            $data = [
                'first_name'          => htmlspecialchars($first_name),
                'last_name'          => htmlspecialchars($last_name),
                'email'         => htmlspecialchars($email),
                'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'is_active'     => 0,
                'date_created'  => time()
            ];


            //siapkan token
            $token = base64_encode(random_bytes(32));
            $user_token = [
            'email' => $email,
            'token' => $token,
            'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            //tanda " _ " artinya modifier private, harus dibuat construct terlebih dahulu
            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Congratulation! Your account has been
            created. Please activate your account.</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');

        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Berhasil logout!</div>');
        redirect('login');
    }
}