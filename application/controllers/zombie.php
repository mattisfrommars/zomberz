<?php

/**
 * Created By: Matt Jewell - mattjewell.co.uk
 * Company: Maido - http://maido.com
 * Date: 22/02/2013
 * Time: 18:28
 */
class Zombie extends CI_Controller {

	public function within_ten() {
		$lat = $this->input->post('lat');
		$long = $this->input->post('lng');
		$this->load->model('Zombiemodel', '', TRUE);
		return json_encode($this->Zombiemodel->get_within_ten($lat, $long));
	}

	public function index() {
		$lat = $this->input->get('lat');
		$long = $this->input->get('long');
		$this->load->model('Zombiemodel', '', TRUE);
		echo json_encode($this->Zombiemodel->get_all_zombies($lat, $long));
	}

	public function create() {
		$zombie = array(
			'lat' => $this->input->post('lat'),
			'lng' => $this->input->post('lng'),
		);
		$this->load->model('Zombiemodel', '', TRUE);

		$this->load->library('pusher');
		$this->pusher->trigger('zombies', 'newZombie', array(
			'lat' => $zombie["lat"],
			'lng' => $zombie["lng"]
		));

		/*
		  $url = "http://api.pusherapp.com/apps/37924/channels/zombies/events?";

		  $data = array("name" => "newZombie",
		  "body_md5" => "5eb63bbbe01eeed093cb22bb8f5acdc3",
		  "auth_version" => "1.0",
		  "auth_key" => "9c295af0ff39b81a3ad1",
		  "auth_timestamp" => "1361580166",
		  "auth_signature" => "d199fec5a0eab3845c7ebd7112d9039ec9da67b2371e946a0b92b4c393f3656c",
		  "data" => "{}");
		  $ch = curl_init($url);
		  $data_string = json_encode($data);
		  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		  $result = curl_exec($ch);
		  curl_close($ch);
		 */

		return json_encode($this->Zombiemodel->insert($zombie));
	}

}