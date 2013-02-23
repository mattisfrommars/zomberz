<?php
/**
 * Created By: Matt Jewell - mattjewell.co.uk
 * Company: Maido - http://maido.com
 * Date: 22/02/2013
 * Time: 21:11
 */

class user extends CI_Controller {
    public function create() {
        $user = array(
            'name' => @$_POST['name'],
            'phone' => @$_POST['phone'],
            'lat' => @$_POST['lat'],
            'long' => @$_POST['lng']
        );
        $this->load->model('Usermodel', '', TRUE);
        echo json_encode($this->Usermodel->create($user));
        $this->load->model('Zombiemodel', '', TRUE);
        $closeZombies = $this->Zombiemodel->get_within_ten($_POST['lat'], $_POST['lng']);
        if ($closeZombies) {
            $this->load->library('twilio');
            $message = 'WATCH OUT '. strtoupper(htmlspecialchars($user['name'])) . '!!!! YOU JUST WALKED INTO ZOMBIE COUNTRY!';

            $from = '447514509257';
            $to = $user['phone'];

            $response = $this->twilio->sms($from, $to, $message);
        }
    }
}