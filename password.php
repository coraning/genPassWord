<?php

class PassWord {

        private $user = null;
        private $website = null;

	public function __construct()
	{
            $this->checkArgs();
	}

	public function checkArgs() 
	{
		$shortopts  = "";
		$shortopts .= "u:";  // Required value
		$shortopts .= "d:";  // Required value
		$shortopts .= "h::"; // Optional value

		$longopts  = array(
			//	"id:",
			//	"url:",     // Required value
				"help",    //
				);
		$options = getopt($shortopts, $longopts);

		if (isset($options['h']) || isset($options['help']) || !isset($options['u']) || !isset($options['d'])) {
			$this->getUsage();
		}
		
		$this->user = $options['u'];
		$this->website = $options['d'];	
	}
	


   	public function getUsage() {
		echo "Usage: php password"."\n"
		     ."	[--u username]"."\n"
		     ."	[--d domain] \n";
		exit(1);
	
	}
 
	public function genPass() {
 		$key = $this->user.$this->website;	
		return base64_encode(substr(md5($key), strlen($this->website) + 6, 6));

 		              
	}

}

$obj = new PassWord();
echo $obj->genPass();
echo "\n";
