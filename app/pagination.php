<?php
	/**
	* 
	*/
	class pagination
	{
		public $config;
		function __construct($config)
		{
			$this->config = array();
			foreach ($config as $key => $value) {
				$this->config[$key] = $value;
			}

			$this->config['total_page'] = ceil($this->config['total_record'] / $this->config['limit']);
			if($this->config['total_page'] <= 0)
				$this->config['total_page'] = 1;


			if($this->config['current_page'] <= 0) {
				$this->config['current_page'] = 1;
			} else 
			if($this->config['current_page'] > $this->config['total_page']) {
				$this->config['current_page'] = $this->config['total_page'];
			}
	

			if($this->config['range'] >= $this->config['total_page']) {
				$this->config['min'] = 1;
				$this->config['max'] = $this->config['total_page'];
			} else {
				$middle = ceil($this->config['range'] / 2);
				$this->config['min'] = $this->config['current_page'] - $middle;
				if($this->config['min'] < 1) {
					$this->config['min'] = 1;
				}
				$this->config['max'] = $this->config['min'] + $this->config['range'] - 1;
				if($this->config['max'] > $this->config['total_page']) {
					$this->config['max'] = $this->config['total_page'];
					$this->config['min'] = $this->config['max'] - $this->config['range'] + 1;
				}	
			}
			
			// foreach ($this->config as $key => $value) {
			// 	echo $key." => ".$value."<br>";
			// }
		}

		function html() {
			if($this->config['total_page'] == 1) return "";
			$page = $this->config['current_page'];
			$html = "<ul>";

			if($this->config['min'] > 2) {
				$html .= "<li><a href=".$this->config['link'].(1).">First</a></li>";
			}
			if($this->config['min'] > 1) {
				$html.="<li><a href='".$this->config['link'].($page-1)."'>Pre</a></li>";
			}
			
			for($i = $this->config['min']; $i <= $this->config['max']; $i++) {
				if($page == $i) {
					$html .= "<li class='this'><a>$i</a></li>";
				} else {
					$html .= "<li><a href=".$this->config['link'].$i.">$i</a></li>";
				}
			}
			if($this->config['total_page'] > $page) {
				$html .= "<li><a href=".$this->config['link'].($page+1).">Next</a></li>";
			}
			if($this->config['total_page'] > $page + 1) {
				$html .= "<li><a href=".$this->config['link'].$this->config['total_page'].">Last</a></li>";
			}
			$html .= "</ul>";
			return $html;
		}

	}


?>