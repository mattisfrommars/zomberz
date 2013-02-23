<?php

class Usermodel extends CI_Model {

    public function get_all_users() {
       return $this->db->query('SELECT * FROM users')->result_array();
    }

    public function get_within_ten($lat, $long) {
        return $this->db->query('
            SELECT name, phone, latitude, longitude, SQRT(
                POW(69.1 * (latitude - '.$lat.'), 2) +
                POW(69.1 * ('.$long.' - longitude) * COS(latitude / 57.3), 2)) AS distance
            FROM users HAVING distance < 10 ORDER BY distance;
        ')->result_array();
    }

    public function create($user) {
        $user['name'] = strtoupper($user['name']);
        $this->db->query('
            DELETE FROM users WHERE phone = "'.$this->db->escape_str($user['phone']).'"
        ');
        return $this->db->query('
            INSERT INTO users (`latitude`, `longitude`, `name`, `phone`)
            VALUES ("'.$this->db->escape_str($user['lat']).'", "'.$this->db->escape_str($user['long']).'", "'.$this->db->escape_str($user['name']).'", "'.$this->db->escape_str($user['phone']).'");
        ');
    }
}