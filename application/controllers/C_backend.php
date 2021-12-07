<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_backend extends CI_Controller 
{
    public function myProfile()
    {
        $data['user'] = $this->db->get_where('pic', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('v_backend/templates/header');
        $this->load->view('v_backend/pages/my-profile', $data);
        $this->load->view('v_backend/templates/footer');
    }
    
    public function myTicket()
    {
        $data['user'] = $this->db->get_where('pic', ['email' => $this->session->userdata('email')])->row_array(); 
        $myID = $data['user']['id'];
        // echo $myID;
        // die;
        // $myTicket = "select order_id,random_code,'10000'+b.id from pic a left join tiket b on a.id=b.id_pic where a.id='".$myID."'";
        $myTicket = "Select tiket.order_id,tiket.random_code,activity.kegiatan,'10000'+tiket.id from pic inner join activity on activity.id_tiket=pic.id Join tiket on tiket.id_pic = pic.id Where pic.id='".$myID."'";
      
        // var_dump($data['statusTicket']);
        // die;
        $myTicket = $this->Muslimafest->getQuery($myTicket);
						foreach($myTicket as $ticket){ 
                            $codeTicket =  $ticket['order_id'] . $ticket['random_code'] . $ticket["'10000'+tiket.id"];
                        }
        $data['statusTicket'] = $myTicket;
        // echo  $data['statusTicket'][0]['kegiatan'];
        // die;
    //    var_dump($data['statusTicket']);
    //    die;
        // var_dump($myTicket);
        // echo $codeTicket;
        // die;
                        
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
 
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = '/assets/images/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
        $image_name=$codeTicket.'.png'; //buat name dari qr code sesuai dengan nim
        $allData = $codeTicket;
        $params['data'] = $codeTicket; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $data['qrnya'] = $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        //$this->mahasiswa_model->simpan_mahasiswa($nim,$nama,$prodi,$image_name); //simpan ke database
        $this->load->view('v_backend/templates/header');
        $this->load->view('v_backend/pages/my-ticket', $data);
        $this->load->view('v_backend/templates/footer');
    }

    public function buyTicket()
    {
        $this->load->view('v_backend/templates/header');
        $this->load->view('v_backend/pages/buy-ticket');
        $this->load->view('v_backend/templates/footer');
    }

    public function editProfile()
    {
        $data['user'] = $this->db->get_where('pic', ['email' => $this->session->userdata('email')])->row_array();  
        
        // $this->form_validation->set_rules('name', 'Full name', 'required|regex_match[/[a-zA-Z]$/]');
        // $this->form_validation->set_rules('nohp', 'number phone ', 'min_length[12]', 'max_length[13]');
        // $this->form_validation->set_rules('alamat', 'Address name', 'regex_match[/[a-zA-Z]$/]');
            $this->load->view('v_backend/templates/header');
            $this->load->view('v_backend/pages/edit-profile', $data);
            $this->load->view('v_backend/templates/footer');
    }

    public function actionEditProfile()
    {
        $email = $this->input->post('email');
        $nama = $this->input->post('nama');
        $nohp = $this->input->post('nohp');

        $this->db->set('nama',$nama);
        $this->db->set('nohp',$nohp);
        $this->db->where('email',$email);
        $this->db->update('pic');

        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Profil berhasil diubah!</div>');
        redirect('profil-saya');
    }

    public function changePassword()
    {
        $data['user'] = $this->db->get_where('pic', ['email' => $this->session->userdata('email')])->row_array();

        //Function dibawah ini adalah apa saja yang dibutuhkan untuk mengganti password
        $this->form_validation->set_rules('currentPassword', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('newPassword1', 'New Password', 'required|trim|min_length[3]|matches[newPassword2]');
        $this->form_validation->set_rules('newPassword2', 'Confirm New Password', 'required|trim|min_length[3]|matches[newPassword1]');
        //min_length[3] adalah jumlah digit password minimal 3 digit.

        if ($this->form_validation->run() == false) {
            $this->load->view('v_backend/templates/header');
            $this->load->view('v_backend/pages/edit-password', $data);
            $this->load->view('v_backend/templates/footer');
        } else {
            //jika password salah
            $currentPassword = $this->input->post('currentPassword');
            $newPassword = $this->input->post('newPassword1');
            // $test = password_verify($currentPassword, $data['user']['password']);
            // echo $test;
            // die;
            if (!password_verify($currentPassword, $data['user']['password'])) {
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Password saat ini tidak benar!</div>');
                redirect('ubah-password');
            } else {
                //jika password baru sama dengan password lama, maka akan terjadi error password.
                if ($currentPassword == $newPassword) {
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Password tidak boleh sama dengan password saat ini! </div>');
                    redirect('ubah-password');
                } else {
                    //password sudah benar
                    $password_hash = password_hash($newPassword, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('pic');

                    $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Password berhasil diubah! </div>');
                    redirect('ubah-password');
                }
            }
        }
    }

    public function actionChangePassword()
    {
        $this->form_validation->set_rules('currentPassword', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('newPassword1', 'New Password', 'required|trim|min_length[3]|matches[newPassword2]');
        $this->form_validation->set_rules('newPassword2', 'Confirm New Password', 'required|trim|min_length[3]|matches[newPassword1]');

        // $currentPassword = $this->input->post('currentPassword');
        $newPassword = $this->input->post('newPassword1');
        
        // echo $newPassword;
        // die;
        if (!password_verify($currentPassword, $data['pic']['password'])) {
            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Password saat ini tidak benar!</div>');
            redirect('ubah-password');
        } else {
            //jika password baru sama dengan password lama, maka akan terjadi error password.
            if ($currentPassword == $newPassword) {
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Password tidak boleh sama dengan password saat ini! </div>');
                redirect('ubah-password');
            } else {
                //password sudah benar
                $password_hash = password_hash($newPassword, PASSWORD_DEFAULT);

                $this->db->set('password', $password_hash);
                $this->db->where('email', $this->session->userdata('email'));
                $this->db->update('pic');

                $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Password berhasil diubah! </div>');
                redirect('ubah-password');
            }
        }
    }
}