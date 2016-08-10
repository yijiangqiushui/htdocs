<?php
class util {
	/**
	 * 把数组转换成 下划线分隔的字符串
	 *
	 * @param unknown $val        	
	 * @return multitype:string
	 */
	static function getparame($tid, $val,$arr) {
		if (! empty ( $val )&&count($val)>0) {
			$param = array (
					$tid => implode ( "_", $val) ,
			);
			if(!empty($arr)){
			foreach ($arr as $key=>$val){
				$param[$key]=$val;
			}}
			return $param;
		}
	}
	
	
	
	/**
	 * 把数组转换成 下划线分隔的字符串
	 *
	 * @param unknown $val
	 * @return multitype:string
	 */
	static function gettask_parame($tid, $val) {
	    if (! empty ( $val )) {
	        $param = array (
	            $tid => implode ( "_", $val )
	        );
	        return $param;
	    }
	}
	/**
	 * 获取fund_src 表格的参数
	 * 
	 * @param unknown $bgt_fund        	
	 * @param unknown $reduce_fund        	
	 * @param unknown $actual_fund        	
	 * @return multitype:string
	 */
	static function getdata($bgt_fund, $reduce_fund, $actual_fund) {
		$data = array ();
		$data ['bgt_fund'] = implode ( "_", $bgt_fund );
		$data ['reduce_fund'] = implode ( "_", $reduce_fund );
		$data ['actual_fund'] = implode ( "_", $actual_fund );
		return $data;
	}
	/**
	 * 获取project_fund_tech 表格的参数
	 * 
	 * @param unknown $teach_budget_fund        	
	 * @param unknown $teach_reduce_fund        	
	 * @param unknown $teach_adjust_fund        	
	 * @param unknown $teach_actual_fund        	
	 * @return multitype:string
	 */
	static function getdata2($teach_budget_fund, $teach_reduce_fund, $teach_adjust_fund, $teach_actual_fund) {
		$data = array ();
		$data ['budget_fund'] = implode ( "_", $teach_budget_fund );
		$data ['reduce_fund'] = implode ( "_", $teach_reduce_fund );
		$data ['adjust_fund'] = implode ( "_", $teach_adjust_fund );
		$data ['actual_fund'] = implode ( "_", $teach_actual_fund );
		return $data;
	}
	
	/**
	 * 获取project_fund_other 表格的参数
	 * 
	 * @param unknown $teach_budget_fund        	
	 * @param unknown $teach_reduce_fund        	
	 * @param unknown $teach_adjust_fund        	
	 * @param unknown $teach_actual_fund        	
	 * @return multitype:string
	 */
	static function getdata3($other_budget_fund, $other_reduce_fund, $other_adjust_fund, $other_actual_fund) {
		$data = array ();
		$data ['budget_fund'] = implode ( "_", $other_budget_fund );
		$data ['reduce_fund'] = implode ( "_", $other_reduce_fund );
		$data ['adjust_fund'] = implode ( "_", $other_adjust_fund );
		$data ['actual_fund'] = implode ( "_", $other_actual_fund );
		return $data;
	}
	/**
	 * 获取时间
	 *
	 * @param unknown $i        	
	 * @return number
	 */
	static function gettime($i) {
		return date ( "Y", time () ) + $i;
	}
	
	/**
	 * 把字符串转换成数组
	 *
	 * @param unknown $str        	
	 * @return multitype:
	 */
	static function str2arr($str) {
		if (! empty ( $str )) {
			return explode ( "_", $str );
		}
	}
}

?>