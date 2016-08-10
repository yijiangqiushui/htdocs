<?php

class CheckDuplicate{
	private $config=array();
	
	public function set_config($config){
		$this->config=$config;
	}
	
	public function check_duplicate($str_1,$str_2,$threshold){//threshold为两个比例（小数）的差值
		$arr_1=array_unique(explode(' ',$this->word_segmentation($str_1)));
		$arr_2=array_unique(explode(' ',$this->word_segmentation($str_2)));

		$difarr = array_diff($arr_1,$arr_2);
		$icount=0;
		echo count($arr_1).' ';
		for($i=0;$i<count($arr_1);$i++){
			echo $i.' '.$arr_1[$i].' ';
			if(in_array($arr_1[$i],$difarr)){
				$icount++;
			}
		}
		$percentage_1=(count($arr_1)-$icount)/count($arr_1);
		$difarr = array_diff($arr_2,$arr_1);
		$icount=0;
		for($i=0;$i<count($arr_2);$i++){
			if(in_array($arr_2[$i],$difarr)){
				$icount++;
			}
		}
		$percentage_2=(count($arr_2)-$icount)/count($arr_2);
		echo $percentage_1.' '.$percentage_2.'<br />';
		return (abs($percentage_1-$percentage_2)<=$threshold)>0?1:0;
	}
	
	public function word_segmentation($str){
		
		$str=$this->filter_punctuation($str);
		
		if($str != ''){
		   //初始化类
			PhpAnalysis::$loadInit = false;
			$pa = new PhpAnalysis('utf-8', 'utf-8', $this->config['pri_dict']);
			
			//载入词典
			$pa->LoadDict();
				
			//执行分词
			$pa->SetSource($str);
			$pa->differMax = $this->config['do_multi'];
			$pa->unitWord = $this->config['do_unit'];
			
			$pa->StartAnalysis( $this->config['do_fork'] );
			
			$okresult = $pa->GetFinallyResult(' ', $this->config['do_prop']);
			
			return $okresult;
		}
	}
	
	private function filter_punctuation($text){ 
		if(trim($text)==''){
			return ''; 
		}
		$text=preg_replace("/[[:punct:]\s]/",' ',$text); 
		$text=urlencode($text); 
		$text=preg_replace("/(%7E|%60|%21|%40|%23|%24|%25|%5E|%26|%27|%2A|%28|%29|%2B|%7C|%5C|%3D|\-|_|%5B|%5D|%7D|%7B|%3B|%22|%3A|%3F|%3E|%3C|%2C|\.|%2F|%A3%BF|%A1%B7|%A1%B6|%A1%A2|%A1%A3|%A3%AC|%7D|%A1%B0|%A3%BA|%A3%BB|%A1%AE|%A1%AF|%A1%B1|%A3%FC|%A3%BD|%A1%AA|%A3%A9|%A3%A8|%A1%AD|%A3%A4|%A1%A4|%A3%A1|%E3%80%82|%EF%BC%81|%EF%BC%8C|%EF%BC%9B|%EF%BC%9F|%EF%BC%9A|%E3%80%81|%E2%80%A6%E2%80%A6|%E2%80%9D|%E2%80%9C|%E2%80%98|%E2%80%99|%EF%BD%9E|%EF%BC%8E|%EF%BC%88)+/",' ',$text); 
		$text=urldecode($text); 
		return trim($text); 
	} 

}

?>