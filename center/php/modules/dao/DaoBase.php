<?php

class DaoBase{
    
    public $table_name;
    
    public $db;
    
    public function __construct(){
        $this->db = new DB ();
    }
    
    public function find($condition,$order = null,$limit = null){
        
        $limit_str = "";
        
        if($limit){
            $limit_str = " limit ".implode(",",$limit);
        }
        
        $order_str = "";
        
        if($order){
            $order_str = " order by ".$order;
        }
        
        $sql = "select * from {$this->table_name}";
        
        //2015.12.29 david 修改
        if(isset($condition['join']) && is_array($condition)){
            
            $join_sql = " join {$condition['join']['table']} on({$this->table_name}.{$condition['join']['fkey']}={$condition['join']['table']}.id)";
            $sql .= $join_sql;
            unset($condition['join']);
        }
        
        $sql .= " ".$this->make_where($condition).$order_str.$limit_str;
//         echo $sql;exit;
        $ret = $this->db->Select($sql);
        
        return $ret;
        
    }
    
    function replace($data){
        $field = implode(',',array_keys($data));			//定义sql语句的字段部分
        $i = 0;
        foreach($data as $key => $val){
            $value .= "'".$val."'";
            if($i<count($data)-1)							//判断是否到数组的最后一个值
                $value .= ",";
            $i++;
        }
        $sql = "REPLACE INTO {$this->table_name} ($field) VALUES ($value)";
        //	echo $sql;
        return $this->db->insert($sql);
    }
    
    
    function update($condition,$data){
        
        $col = array();
        foreach ($data as $key => $value){
            $col[] = $key . "='" . $value . "'";
        }
        
        $sql = "update {$this->table_name} SET " . implode(',',$col)." ".$this->make_where($condition);
//         echo $sql;exit();
        $ret = $this->db->update($sql);
        
        return $ret;
        
    }
    
    function delete($condition){
        
        $sql = "delete from {$this->table_name} ".$this->make_where($condition);
        $ret = $this->db->Delete($sql);
        
        return $ret;
        
    }
    //2015.12.29修改
    function make_where($condition){
        if(is_array($condition)){
            $where_str = "";
            foreach($condition as $key=>$val){
                $val_str = $val;
                if(!is_integer($val)){
                    $val_str = "'{$val}'";
                }
                if(!empty($where_str)){
                    $where_str .= " and ";
                }
                $where_str .= "`{$key}`={$val_str}";
            }
            if($where_str != ""){
                $where_str = "where ".$where_str;   
            }
        }else{
            $where_str = "where ".$condition;
        }
        return $where_str;
    }
    
}
