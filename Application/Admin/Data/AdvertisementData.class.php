<?php

namespace Admin\Data;

class AdvertisementData extends BaseData{

    //定义表前缀
    protected $tablePrefix = 'st_academy_';

    /**
     * 单条记录查找
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->table('__ADVERTISEMENT__ AS advertisement')
                    ->field('advertisement.*,file.path as img_path')
                    ->join(C('DB_PREFIX_COMMON').'file AS file ON file.id = advertisement.image')
                    ->where('advertisement.id=%d',$id)
                    ->find();

    }

    /**
     * 多条记录查找
     * @return mixed
     */
    public function getList(){

        $data = $this->table('__ADVERTISEMENT__ AS advertisement')
            ->field('advertisement.*')
            ->order('id DESC')
            ->select();

        return $data;
    }
}