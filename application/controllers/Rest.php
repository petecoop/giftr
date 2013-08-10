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
		$return['products'] = array();
 		
		/**
		 *	Get products with positive rating
		 */

		$sql = 'SELECT * FROM products p LEFT JOIN votes v on v.product_id = p.id WHERE rating > 0;';
		$q = $this->db->query($sql);

		$rows = $q->num_rows();
		$limit = 4;
		
		if($rows > 0)
		{
			if($rows < 4)
			{
				$limit = (4 - $rows);
			}
			else
			{
				$limit = 0;
			}
		}
		else 
		{
			$limit = 4;
		}
		#name, desc, id, price
		
		if($limit > 0)	//	we need products
		{
			$sql = 'SELECT * FROM products LIMIT 4;';
			$q = $this->db->query($sql);

			$i = 0;
			foreach($q->result() as $row)
			{
				$return['products'][$i]['id'] = $row->id;
				$return['products'][$i]['name'] = $row->product_name;
				$return['products'][$i]['description'] = $row->description;
				$return['products'][$i]['price'] = $row->search_price;
				$return['products'][$i]['image'] = $row->aw_image_url;
				$i++;
			}

		}

		echo json_encode($return);
		/*
 			id
 			price
 			desc
 			pic
 		
 		
 		*/
 		
 	}
 
 /*age
 gender,
 occasion
 budget
*/	
}