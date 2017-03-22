<?php

namespace Webmall\Data;

class AdvertisementData extends BaseData{

    //定义表前缀
    protected $tablePrefix = 'st_academy_';


    /**
     * 多条记录查找
     * @return mixed
     */
    public function getAdvList(){

        $data = $this->table('__ADVERTISEMENT__ AS advertisement')
            ->field('advertisement.title,advertisement.url,file.path as image_path')
            ->join(C('DB_PREFIX_COMMON').'file as file on file.id = advertisement.image','LEFT')
            ->order('sort asc')
            ->select();

        return $data;
    }
}