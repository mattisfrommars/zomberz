<?php
/**
 * Created By: Matt Jewell - mattjewell.co.uk
 * Company: Maido - http://maido.com
 * Date: 22/02/2013
 * Time: 18:28
 */

class Zombie extends CI_Controller {

    public function index() {
        $this->load->model('Zombiemodel', '', TRUE);
        echo json_encode($this->Zombiemodel->get_all_zombies());
    }

}