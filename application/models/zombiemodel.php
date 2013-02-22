<?php
/**
 * Created By: Matt Jewell - mattjewell.co.uk
 * Company: Maido - http://maido.com
 * Date: 22/02/2013
 * Time: 18:26
 */

class Zombiemodel extends CI_Model {

    public $longitude;
    public $latitude;
    public $reported_at;

    public function get_all_zombies() {
        $db = $this->db->query('SELECT * FROM zombies');
        return $db->result_array();
    }


}