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
        $q = $this->db->query('SELECT * FROM zombies');
        return $q->result_array();
    }

    public function get_nearest($lat, $long) {
        $q = $this->db->query('
           SELECT latitude, longitude, SQRT(
                POW(69.1 * (latitude - '.$lat.'), 2) +
                POW(69.1 * ('.$long.' - longitude) * COS(latitude / 57.3), 2)) AS distance
            FROM zombies ORDER BY distance;
            ');
        return $q->result_array();
    }


}