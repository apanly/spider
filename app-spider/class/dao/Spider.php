<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 12/31/13
 * Time: 12:15 PM
 */
require_class("DB_Factory");
class Dao_Spider {
    private $mpdo=null;
    private $_table="partTime";
    protected $_fields = array (
        'id', 'price', 'tasktitle','taskcontent','taskuri','md5hash'
    );
    public function __construct(){
        $this->mpdo=DB_Factory::get_instance()->get_pdo("master");
    }
    function getUpperFileds() {
        return strtoupper(implode(',', $this->_fields));
    }

    function getLowerFileds() {
        return strtolower(implode(',', $this->_fields));
    }
    public function insert($data){
        $fields = $params = $mode = array();
        foreach($data as $key=>$row) {
            $fields[] = $key;
            $params[] = $row;
            $mode[] = '?';
        }
        $sql = "INSERT INTO ".$this->_table." (".implode(',', $fields).") VALUES (".implode(',', $mode).")";
        $this->execute($sql, $params);
        return $this->mpdo->lastInsertId();
    }

    public function update($params,$where){
        $sql = "UPDATE ".$this->_table." SET ";
        $tmparams = array();
        foreach($params as $f=>$v){
            $sql.="$f=?,";
            $tmparams[]=$v;
        }
        $sql=substr($sql,0,-1);
        $sql.=" WHERE {$where}";
        $this->execute($sql, $tmparams);
    }

    public function getInfoByHash($md5hash){
        $sql = "SELECT ".$this->getUpperFileds()." FROM ".$this->_table;
        $sql .= " WHERE md5hash=?";
        return $this->getOne($sql,array($md5hash));
    }




    public function getCnt($type){
        $sql = "SELECT count(*) as num FROM ".$this->_table;
        $params=array();
        if($type>0){
            $sql .= " WHERE type=? ";
            $params[]=$type;
        }
        return $this->getColumn($sql, $params);
    }
    /**
     * 返回全部记录
     * @param $sql
     * @param $params
     */
    function getAll($sql, $params) {
        $sth = $this->mpdo->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll();
    }

    function getOne($sql, $params) {
        $sth = $this->mpdo->prepare($sql);
        $sth->execute($params);
        return $sth->fetch();
    }
    function getColumn($sql, $params) {
        $sth = $this->mpdo->prepare($sql);
        $sth->execute($params);
        return $sth->fetchColumn();
    }
    private function execute($sql,$params){
        $sth = $this->mpdo->prepare($sql);
        $sth->execute($params);
        return $sth->rowCount();
    }
} 