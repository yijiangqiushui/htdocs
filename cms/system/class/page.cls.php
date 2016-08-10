<?php
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

//pageDevide.cls.php必须在db.cls.php之后
/**
* 功能：分页显示
* 参数：$pageSize 每页显示记录数，$pageTotal 总页面数，$page 当前页码，$limitStart MySQL查询起始位置，$showNum 当前页码左右两边最大显示数目，$pd_getTotalSQL 获取记录总数,$pd_otherCondition 附加给链接的条件，$rsTotal记录总数
**/
class page extends DBSQL{
	private $pageSize;
	private $pageTotal;
	private $page;
	private $limitStart;
	private $showNum;
	private $getTotalSQL;
	private $otherCondition;
	private $rsTotal;
	
	/**
	* 初始化构造函数
	*
	*/
	public function __construct($pd_page,$pd_pageSize,$pd_showNum,$pd_getTotalSQL,$pd_otherCondition){
		parent::__construct();
		$this->getTotalSQL=$pd_getTotalSQL;
		$this->rsTotal=$this->getTotalCount();
		if($this->rsTotal<1)
			$this->rsTotal=0;
		$this->pageSize=$pd_pageSize;
		$this->pageTotal=ceil($this->rsTotal/$this->pageSize);
		$this->page=$pd_page;
		if($this->page<1)
			$this->page=1;
		else if($this->page>$this->rsTotal){
			$this->page=$this->rsTotal;
		}
		$this->limitStart=($this->page-1)*$this->pageSize;
		$this->showNum=$pd_showNum;
		$this->otherCondition=$pd_otherCondition;
	}

	/**
	* 析构函数，当类不在使用的时候调用，该函数用来释放资源
	*
	*/
	public function __destruct(){
		unset($pageSize);
		unset($pageTotal);
		unset($page);
		unset($limitStart);
		unset($showNum);
		unset($getTotalSQL);
		unset($otherCondition);
		unset($rsTotal);
	}
  
  	/**
	* 功能：获取记录总数
	* 参数：$tableId 数据库表ID，$tableName 数据库表名称
	* 返回：记录总数
	*/
	public function getTotalCount(){
		$r = $this->select($this->getTotalSQL);
		return $r[0][0];
	}
	
	/**
	* 功能：显示分页-动态方式
	*
	*/
	public function phpDevide(){
		$pre=$this->page-1;
		if($pre<1)
			$pre=1;
		$next=$this->page+1;
		if($next>$this->pageTotal)
			$next=$this->pageTotal;
		if($next<1)
			$next=1;
		echo '<div id="p_pageDevide">';
		echo '<span id="p_pageTotal">共有 <span style="color:#F00">'.$this->rsTotal.'</span> &nbsp;条记录</span> ';
		echo '<a href="?page=1'.$this->otherCondition.'" id="p_first">首页</a>';
		echo '<a href="?page='.$pre.$this->otherCondition.'" id="p_pre">上一页</a>';
		for($i=$this->showNum;$i>0;$i--){
			$otherPage=$this->page-$i;
			if($otherPage>0){
				echo '<a href="?page='.$otherPage.$this->otherCondition.'">'.$otherPage.'</a> ';
			}
		}
		echo ' <span id="p_currentPage">'.$this->page.'</span> ';
		for($i=1;$i<=$this->showNum;$i++){
			$otherPage=$this->page+$i;
			if($otherPage<=$this->pageTotal)
				echo '<a href="?page='.$otherPage.$this->otherCondition.'">'.$otherPage.'</a> ';
		}
		echo '<a href="?page='.$next.$this->otherCondition.'" id="p_next">下一页</a>';
		echo '<a href="?page='.$this->pageTotal.$this->otherCondition.'" id="p_last">末页</a>';
		echo '</div>';
	}
	
	/**
	* 功能：显示分页-生成静态页面方式
	*
	*/
	public function phpDevideStatic($phpPage){
		$pre=$this->page-1;
		if($pre<1)
			$pre=1;
		$next=$this->page+1;
		if($next>$this->pageTotal)
			$next=$this->pageTotal;
		if($next<1)
			$next=1;
		
		$content ="";
		
		$content.= '<div id="p_pageDevide">';
		$content.= '<span id="p_pageTotal">共有 <span style="color:#F00">'.$this->rsTotal.'</span> &nbsp;条记录</span> ';
		$content.= '<a href="./'.$phpPage.'?page=1'.$this->otherCondition.'" id="p_first">首页</a>';
		$content.= '<a href="./'.$phpPage.'?page='.$pre.$this->otherCondition.'" id="p_pre">上一页</a>';
		for($i=$this->showNum;$i>0;$i--){
			$otherPage=$this->page-$i;
			if($otherPage>0){
				$content.= '<a href="./'.$phpPage.'?page='.$otherPage.$this->otherCondition.'">'.$otherPage.'</a> ';
			}
		}
		$content.= ' <span id="p_currentPage">'.$this->page.'</span> ';
		for($i=1;$i<=$this->showNum;$i++){
			$otherPage=$this->page+$i;
			if($otherPage<=$this->pageTotal)
				$content.= '<a href="./'.$phpPage.'?page='.$otherPage.$this->otherCondition.'">'.$otherPage.'</a> ';
		}
		$content.= '<a href="./'.$phpPage.'?page='.$next.$this->otherCondition.'" id="p_next">下一页</a>';
		$content.= '<a href="./'.$phpPage.'?page='.$this->pageTotal.$this->otherCondition.'" id="p_last">末页</a>';
		$content.= '</div>';
		return $content;
	}
	/**
	* 功能：显示分页-动态方式
	*
	*/
	public function phpDevideNew($id){
		$pre=$this->page-1;
		if($pre<1)
			$pre=1;
		$next=$this->page+1;
		if($next>$this->pageTotal)
			$next=$this->pageTotal;
		if($next<1)
			$next=1;
		echo '<div id="p_pageDevide">';
		echo '<span id="p_pageTotal">共有 <span style="color:#F00">'.$this->rsTotal.'</span> &nbsp;条记录</span> ';
		echo '<a href="?id='.$id.'&page=1'.$this->otherCondition.'" id="p_first">首页</a>';
		echo '<a href="?id='.$id.'&page='.$pre.$this->otherCondition.'" id="p_pre">上一页</a>';
		for($i=$this->showNum;$i>0;$i--){
			$otherPage=$this->page-$i;
			if($otherPage>0){
				echo '<a href="?id='.$id.'&page='.$otherPage.$this->otherCondition.'">'.$otherPage.'</a> ';
			}
		}
		echo ' <span id="p_currentPage">'.$this->page.'</span> ';
		for($i=1;$i<=$this->showNum;$i++){
			$otherPage=$this->page+$i;
			if($otherPage<=$this->pageTotal)
				echo '<a href="?id='.$id.'&page='.$otherPage.$this->otherCondition.'">'.$otherPage.'</a> ';
		}
		echo '<a href="?id='.$id.'&page='.$next.$this->otherCondition.'" id="p_next">下一页</a>';
		echo '<a href="?id='.$id.'&page='.$this->pageTotal.$this->otherCondition.'" id="p_last">末页</a>';
		echo '</div>';
	}
	/**
	* 功能：显示分页-动态方式
	* 英文
	*/
	public function phpDevide_en(){
		$pre=$this->page-1;
		if($pre<1)
			$pre=1;
		$next=$this->page+1;
		if($next>$this->pageTotal)
			$next=$this->pageTotal;
		if($next<1)
			$next=1;
		echo '<div id="p_pageDevide">';
		echo '<span id="p_pageTotal">Total: <span style="color:#F00">'.$this->rsTotal.'</span> &nbsp;</span> ';
		echo '<a href="?page=1'.$this->otherCondition.'" id="p_first">First</a>';
		echo '<a href="?page='.$pre.$this->otherCondition.'" id="p_pre">Pre</a>';
		for($i=$this->showNum;$i>0;$i--){
			$otherPage=$this->page-$i;
			if($otherPage>0){
				echo '<a href="?page='.$otherPage.$this->otherCondition.'">'.$otherPage.'</a> ';
			}
		}
		echo ' <span id="p_currentPage">'.$this->page.'</span> ';
		for($i=1;$i<=$this->showNum;$i++){
			$otherPage=$this->page+$i;
			if($otherPage<=$this->pageTotal)
				echo '<a href="?page='.$otherPage.$this->otherCondition.'">'.$otherPage.'</a> ';
		}
		echo '<a href="?page='.$next.$this->otherCondition.'" id="p_next">Next</a>';
		echo '<a href="?page='.$this->pageTotal.$this->otherCondition.'" id="p_last">Last</a>';
		echo '</div>';
	}
	
	/**
	* 功能：显示分页-伪静方式态
	*
	*/
	public function htmlDedive($preName){
		$pre=$this->page-1;
		if($pre<1)
			$pre=1;
		$next=$this->page+1;
		if($next>$this->pageTotal)
			$next=$this->pageTotal;
		if($next<1)
			$next=1;
		echo '<div id="p_pageDevide">';
		echo '<span id="p_pageTotal">共有 <span style="color:#F00">'.$this->rsTotal.'</span> &nbsp;条记录</span> ';
		echo '<a href="'.$preName.'-pageNo-1'.$this->otherCondition.'.html" id="p_first">首页</a>';
		echo '<a href="'.$preName.'-pageNo-'.$pre.$this->otherCondition.'.html" id="p_pre">上一页</a>';
		for($i=$this->showNum;$i>0;$i--){
			$otherPage=$this->page-$i;
			if($otherPage>0){
				echo '<a href="'.$preName.'-pageNo-'.$otherPage.$this->otherCondition.'.html">'.$otherPage.'</a> ';
			}
		}
		echo ' <span id="p_currentPage">'.$this->page.'</span> ';
		for($i=1;$i<=$this->showNum;$i++){
			$otherPage=$this->page+$i;
			if($otherPage<=$this->pageTotal)
				echo '<a href="'.$preName.'-pageNo-'.$otherPage.$this->otherCondition.'.html">'.$otherPage.'</a> ';
		}
		echo '<a href="'.$preName.'-pageNo-'.$next.$this->otherCondition.'.html" id="p_next">下一页</a>';
		echo '<a href="'.$preName.'-pageNo-'.$this->pageTotal.$this->otherCondition.'.html" id="p_last">末页</a>';
		echo '</div>';
	}
	
	/**
	* 功能：返回分页要搜索的起始位置
	* 参数：$tableId 数据库表ID，$tableName 数据库表名称
	* 返回：记录总数
	*/
	public function limitStart(){
		return $this->limitStart;
	}
	
}
?>