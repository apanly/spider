<?php
require_class("Dao_Spider");
class Bll_Spider {
        public function addTask($params){
            $daotask=new Dao_Spider();
            $md5hash=md5($params['taskuri']);
            $hashinfo=$daotask->getInfoByHash($md5hash);
            if(empty($hashinfo)){
                $id=$daotask->insert(array(
                    "price"=>$params['price'],
                    "tasktitle"=>$params['tasktitle'],
                    "taskcontent"=>$params['taskcontent'],
                    'taskuri'=>$params['taskuri'],
                    "md5hash"=>$md5hash
                ));
                return $id;
            }else{
                print_r($params);
            }
        }
} 