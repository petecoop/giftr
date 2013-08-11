<?php
error_reporting(0);


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
		$rating = $post->rating;
		$intrating = 0;
		switch ($rating) {
			case 'like':
				$intrating = 1;
				break;
			case 'dislike':
				$intrating = -1;
				break;
			case 'perfect':
				$intrating = 2;
				break;
		}
		$data = array(
			'rating'		=>	$intrating,
			'product_id'	=>	$post->product_id,
			'user_id'		=>	$post->user_id
		); 
		
		$q = $this->db->insert('votes', $data);
		$return['products'] = $this->products($post->user_id);
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
		$userid = $this->db->insert_id();
		$return['user_id'] = $userid;
		$return['products'] = $this->products($userid);
		echo json_encode($return);
 	}
 	
 	public function products($userid)
 	{

		return $this->algorithm($userid);
 	}
 	
 	
 	public function get_assoc($query){
 		$q = $this->db->query($query);
 		$assoc = Array();
 		foreach($q->result_array() as $result){
 			$assoc[$result['id']] = $result;
 		}
 		return $assoc;
 	}
 	
 	public function algorithm($userid){
 		$profile_key = $userid;
 		
 		
 		$votes = $this->get_assoc('select * from votes;');
 		
 		$profile = $this->get_assoc('select * from profiles;');
 		$profile = $profile[$profile_key];
 		
 		$budget = 100;
 		if ($profile['budget'] > 0) $budget = $profile['budget'];
 		
 		$profiles = $this->get_assoc('select * from profiles where id != '. $profile['id']);
 		
 		foreach ($profiles as $i => $other){
 			$score =  1 - 2*(abs($other['age']-$profile['age'])/($other['age']+$profile['age']));
 			$score += 1 - 2*(abs($other['budget']-$profile['budget'])/($other['budget']+$profile['budget']));
 			if ($other['gender'] == $profile['gender']) $score += 1;
 			if ($other['occasion'] == $profile['occasion']) $score += 1;
 			$profiles[$i]['profile_similarity'] = $score;
 		}
 		
 		$profile_scores = Array();
 		foreach ($votes as $vote){
 			if ($vote['user_id'] == $profile['id']) $profile_scores[$vote['product_id']] = $vote['rating'];
 		}
 		
 		foreach ($votes as $vote){
 			if ($vote['user_id'] != $profile['id'] && array_key_exists($vote['product_id'], $profile_scores)){
 				$profiles[$vote['user_id']]['product_score'] += $vote['rating']*$profile_scores[$vote['product_id']];
 				$profiles[$vote['user_id']]['product_count']++;
 			}
 		}
 		
 		foreach ($profiles as $i => $other){
 			$profiles[$i]['match'] = ($profiles[$i]['profile_similarity'] + $profiles[$i]['product_score'] )/(  $profiles[$i]['product_count'] + 4);
 		}
 		
 		$ratings = Array();
 		foreach ($votes as $vote){
 			if ($vote['user_id']!=$profile['id'] && !array_key_exists($vote['product_id'], $profile_scores)){
 				$ratings[$vote['product_id']] += $vote['rating']*$profiles[$vote['user_id']]['match'];
 			}
 		}
 		
 		asort($ratings);
 		
 		$products = $this->get_assoc("select * from (select p.*, sum(v.rating) as r from products p join votes v on v.product_id=p.id group by p.id) as a where r > -10;");
 		
 		
 		while($ratings){
 			end($ratings);
 			$key=key($ratings);
 			array_pop($ratings);
 		
 			if ($products[$key]['search_price'] < $budget*1.1) $ordered[] = $products[$key];
 			if (count($ordered) >= 3) break;
 		}
 		
 		for($i = 1; $i <= 1 || $i <= 4-count($ordered); $i++){
 			$random[] = array_pop($this->get_assoc("SELECT *  FROM products AS r1 JOIN (SELECT (RAND() * (SELECT MAX(id) FROM products)) AS id) AS r2 WHERE r1.id >= r2.id and r1.search_price <= ".$budget." ORDER BY r1.id ASC LIMIT 1"));
 		}

 		
 		
 		$result = array_merge($ordered, $random);
 		if (!$result)$result=Array();
 		
 		return $result;
 	}
}