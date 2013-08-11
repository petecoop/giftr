<?php

class Rest extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}


	/**
	 *	Save the profile info
	 *	@param integer $age the age 
	 *	@param string $gender The gender
	 *	@param string $occasion The Occasion
	 *	@param integer $budget The gender
	 */ 
	public function rating()
 	{
		$return = array();
		
		$string = file_get_contents("php://input");
		$post = json_decode($string);
		$data = array(
			'rating'		=>	$post->rating,
			'product_id'	=>	$post->product_id,
			'user_id'		=>	$post->user_id
		); 
		
		$q = $this->db->insert('votes', $data);
		if($q->affected_rows()) 
		{
			$return['products'] = $this->products();
		}
		echo json_encode($return);
	}
	
	/**
	 *	Save the profile info
	 *	@param integer $age the age 
	 *	@param string $gender The gender
	 *	@param string $occasion The Occasion
	 *	@param integer $budget The gender
	 */ 
	public function profile()
 	{
		$return = array();
		$string = file_get_contents("php://input");
		$post = json_decode($string);
		$data = array(
			'age'	=>	$post->age,
			'gender'=>	$post->gender,
			'occasion'=>$post->occasion,
			'budget'=>$post->budget
		); 
		
		$q = $this->db->insert('profiles', $data);
		$return['user_id'] = $this->db->insert_id();
		$return['products'] = $this->products();
		echo json_encode($return);
 	}
 	
 	public function products()
 	{
 		$return = array();
		/**
		 *	Get products with positive rating
		 */

		$sql = 'SELECT * FROM products p LEFT JOIN votes v on v.product_id = p.id WHERE rating > 0 GROUP BY p.id LIMIT 4;';
		$q = $this->db->query($sql);

		$rows = $q->num_rows();
		
		if($rows < 0)	//	we need products
		{
			$sql = 'SELECT * FROM products LIMIT 4;';
			$q = $this->db->query($sql);
		}
		$return = array();
		foreach($q->result() as $row)
		{
			$return[] = array(
				'id' => $row->id,
				'name' => $row->product_name,
				'description' => $row->description,
				'price' => $row->search_price,
				'image' => $row->aw_image_url
			);
		}
		return $return;
 	}
}