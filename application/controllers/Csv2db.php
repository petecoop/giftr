<?php

class Csv2db extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function run()
	{
		if(file_exists('datafeed_45628.csv'))
		{
			$row = 1;
			$insert = array();
			if(($handle = fopen("datafeed_45628.csv", "r")) !== FALSE) 
			{
				while(($data = fgetcsv($handle, 1000000, ",")) !== FALSE) 
				{
					if($row < 1)
					{
						continue;
					}
					
					for($c = 0; $c < count($data); $c++) 
					{
						echo $data[$c] . "<br />\n";
					}
					$row++;
					exit;
				}
				fclose($handle);
			}		
		}
		else
		{
			die("\n\nno file found\n\n");
		}
		exit;
		
		
$data = array(
   array(
      'title' => 'My title' ,
      'name' => 'My Name' ,
      'date' => 'My date'
   ),
   array(
      'title' => 'Another title' ,
      'name' => 'Another Name' ,
      'date' => 'Another date'
   )
);

$this->db->insert_batch('mytable', $data); 

// Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date'), ('Another title', 'Another name', 'Another date')		
		
		
		
		
		
		
	}
	
}




