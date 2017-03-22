<?php

namespace Admin\Data;


class InfoData extends BaseData{

    //定义表前缀
    protected $tablePrefix = 'st_common_';
    

    /**
     * 单条记录查找
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->table('__INFO__ AS info')
                    ->field('info.*,file.path as img_path')
                    ->join('__FILE__ AS file ON file.id=info.logo','left')
                    ->where('info.id=%d',$id)
                    ->find();
    }

    /**
     * 多条记录查找
     * @return mixed
     */
    public function getList(){

        $data = $this->table('__INFO__ AS info')
            ->field('info.*')
            ->order('gmt_create desc')
            ->select();

        return $data;
    }

}