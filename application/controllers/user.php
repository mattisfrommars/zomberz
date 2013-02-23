<?php
/**
 * Created By: Matt Jewell - mattjewell.co.uk
 * Company: Maido - http://maido.com
 * Date: 22/02/2013
 * Time: 21:11
 */

class user extends CI_Controller {

    public function create() {

        $this->load->helper('string');
        $user = array(
            'name' => $this->input->post('name'),
            'phone' => $this->input->post('phone'),
            'lat' => $this->input->post('lat'),
            'long' => $this->input->post('lng'),
        );
        echo '<pre>'; var_dump($user); die();
        $this->load->model('Usermodel', '', TRUE);
        echo json_encode($this->Usermodel->create($user));
        $this->load->model('Zombiemodel', '', TRUE);
        $closeZombies = $this->Zombiemodel->get_within_ten($_POST['lat'], $_POST['lng']);
        if ($closeZombies) {
            $this->load->library('twilio');
            $message = 'WATCH OUT '. strtoupper($user['name']) . '!!!! YOU JUST WALKED INTO ZOMBIE COUNTRY!';

            $from = '447514509257';
            $to = $user['phone'];

            $response = $this->twilio->sms($from, $to, $message);
        }
    }
}