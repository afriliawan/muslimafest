<?php

function is_logged_in()
{
    $ci = get_instance(); //instansiasi
    

    if (!$ci->session->userdata('username')){
        $ci->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Please log in first! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('login');
    } else {
        $idUser = $ci->session->userdata('id');
        $curl = curl_init();
            
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cmsugc.hops.id/wp-json/wp/v2/posts?author=".$idUser."&status=%5B%5D",
        //   CURLOPT_URL => "https://cmsugc.hops.id/wp-json/wp/v2/posts?author=".$this->session->userdata('USERNAME')."",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "reassign: ",
            "Authorization: Basic YWxpOnFvRWtDMFUxOFVvQihMUVlQNg=="
        ),
        ));
        $response = curl_exec($curl);
        $hasil = json_decode($response);
        // $idBlog = $hasil->id;
        curl_close($curl);
        
        // $userAccess = $ci->get_where([
        //     'id' => $idUser, 
        //     'menu_id' => $menu_id
        // ]);

        // if ($userAccess->num_rows() < 1){
        //     redirect('auth/blocked'); //Jika ada user ingin mengakses menu superadmin, maka akan error
        // }
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result -> num_rows() > 0) {
        return "checked = 'checked'";
    }
}