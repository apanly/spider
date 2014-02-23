<?php
require_page("Home_Base");
class Home_DefaultView extends Home_BaseView
{
    public function get_view()
    {
        $req=Dispatcher::getInstance()->get_request();
        $datas=$req->get_attributes();
        foreach($datas as $key=>$data){
            $this->assign_data($key,$data);
        }
        return "Default";
    }

    public static function use_boundable_javascripts(){
        $path = classname_to_path(__CLASS__);
        return array_merge(
            parent::use_boundable_javascripts(),
            array($path . 'Default.js')
        );
    }

} 