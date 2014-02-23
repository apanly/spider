<?php
require_class("Httplib");
require_class("Bll_Spider");
class zbj
{
    public function run()
    {
        $this->init();
    }

    private function init()
    {
        $ruri ="http://www.zhubajie.com/c-wzkf/tt2";
        $http = new Httplib();
        $allresult = array();
        for ($i = 1; $i < 11; $i++) {
            $response = $http->get($ruri ."p{$i}.html");
            if ($response && $response['response']['code'] == 200) {
                $data = $response['body'];
                preg_match("/<table\s*class=\"list-task\">(.*?)<\/table>/is", $data, $matches);
                if ($matches && $matches[1]) {
                    $data=$matches[1];
                    $data=preg_replace("/<colgroup>(.*?)<\/colgroup>/is","",$data);
                    $list=explode("</tr>",$data);
                    foreach($list as $item){
                        if($item){
                            $allresult[]=$this->formatlist($item);
                        }
                    }
                }
            }
        }
        //echo json_encode($allresult,JSON_UNESCAPED_UNICODE);
        if($allresult){
            $blltask=new Bll_Spider();
            foreach($allresult as $item){
                $blltask->addTask($item);
            }
        }
    }

    private function formatlist($item){
            $tmp=preg_match("/<em\s*class=\"list-task-reward\">(.*?)<\/em>/is", $item, $matches);
            $price=$matches[1];
            $tmp=preg_match("/<a\s*class=\"list-task-title\"\s*href=\"(.*?)\"(.*?)>(.*?)<\/a>/is", $item, $matches);
            $taskuri=$matches[1];
            $tasktitle=$matches[3];
            $tmp=preg_match("/<p\s*class=\"list-task-ctn\">(.*?)<\/p>/is", $item, $matches);
            $taskcontent=$matches[1];
            return array(
                "price"=>str_replace("&yen;&nbsp;","",$price),
                "taskuri"=>$taskuri,
                "tasktitle"=>$tasktitle,
                "taskcontent"=>$taskcontent
            );
    }
}

$target = new zbj();
$target->run();
