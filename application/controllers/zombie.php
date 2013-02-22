<?php
/**
 * Created By: Matt Jewell - mattjewell.co.uk
 * Company: Maido - http://maido.com
 * Date: 22/02/2013
 * Time: 18:28
 */

class Zombie extends CI_Controller {

    public function within_ten() {
        $lat  = @$_POST['lat'];
        $long = @$_POST['lng'];
        $this->load->model('Zombiemodel', '', TRUE);
        return json_encode($this->Zombiemodel->get_within_ten($lat,$long));
    }

    public function index() {
        $lat  = @$_GET['lat'];
        $long = @$_GET['long'];
        $this->load->model('Zombiemodel', '', TRUE);
        echo json_encode($this->Zombiemodel->get_all_zombies($lat, $long));
    }

    public function create() {
        $zombie = array(
            'lat' => @$_POST['lat'],
            'lng' => @$_POST['lng']
        );
        $this->load->model('Zombiemodel', '', TRUE);
        return json_encode($this->Zombiemodel->insert($zombie));
    }

}