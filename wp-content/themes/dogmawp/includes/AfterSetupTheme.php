<?php

class AfterSetupTheme{
	
	
	static function return_thme_option($string,$str=null){
		global $wr_wp;
		if($str!=null)
		return isset($wr_wp[''.$string.''][''.$str.'']) ? $wr_wp[''.$string.''][''.$str.''] : null;
		else
		return isset($wr_wp[''.$string.'']) ? $wr_wp[''.$string.''] : null;
	}
	
	
}
?>