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

    public function get_all_zombies($lat = null, $long = null) {
        if ($lat == null || $long == null) {
            $q = $this->db->query('SELECT id, latitude as lat, longitude as lng,
                                   UNIX_TIMESTAMP(reported_at) as reported_at
                                   FROM zombies ORDER BY reported_at DESC');
            return $q->result_array();
        }

        $q = $this->db->query('
           SELECT id, latitude as lat, longitude as `lng`,
            UNIX_TIMESTAMP(reported_at) as reported_at
            , SQRT(
                POW(69.1 * (latitude - '.$lat.'), 2) +
                POW(69.1 * ('.$long.' - longitude) * COS(latitude / 57.3), 2)) AS distance
            FROM zombies ORDER BY distance;
            ');
        return $q->result_array();
    }

    public function get_nearest_zombie ($lat, $long) {
        $q = $this->db->query('
           SELECT *, SQRT(
                POW(69.1 * (latitude - '.$lat.'), 2) +
                POW(69.1 * ('.$long.' - longitude) * COS(latitude / 57.3), 2)) AS distance
            FROM zombies ORDER BY distance;
            ');
        return $q->row_array();
    }

    public function insert($zombie) {
        $lat = $zombie['lat'];
        $long = $zombie['lng'];
        $this->db->query('
        INSERT INTO `zombies` (`latitude`, `longitude`)
        VALUES ('.$lat.', '.$long.');
        ');
        $this->load->model('Usermodel', '', TRUE);
        $users = $this->Usermodel->get_within_ten($lat, $long);
        foreach ($users as $user) {
            $this->load->library('twilio');
            $message = 'HEY! '. strtoupper(htmlspecialchars($user['name'])) . ' RUN!!!! THIS IS ZOMBIE COUNTRY!';

            $from = '447514509257';
            $to = $user['phone'];

            $response = $this->twilio->sms($from, $to, $message);
            if ( $response->IsError ) {
                echo 'Error: ' . $response->ErrorMessage;
            }
            else {
                echo 'Sent message to ' . $to;
            }
        }
    }

    public function get_within_ten($lat, $long) {
        return $this->db->query('
            SELECT latitude, longitude, SQRT(
                POW(69.1 * (latitude - '.$lat.'), 2) +
                POW(69.1 * ('.$long.' - longitude) * COS(latitude / 57.3), 2)) AS distance
            FROM zombies HAVING distance < 10 ORDER BY distance;
        ')->result_array();
    }
}