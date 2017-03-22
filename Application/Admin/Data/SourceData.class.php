<?php

namespace Admin\Data;

class SourceData extends BaseData{

    //定义表前缀
    protected $tablePrefix = 'st_common_';

    /**
     * 单条记录查找
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->table('__SOURCE__ AS source')
            ->field('source.*,file_img.path as img_path,file_code.path as code_path')
            ->join(C('DB_PREFIX_COMMON').'file AS file_img ON file_img.id = source.logo')
            ->join(C('DB_PREFIX_COMMON').'file AS file_code ON file_code.id = source.code')
            ->where('source.id=%d',$id)
            ->find();

    }

    /**
     * 多条记录查找
     * @return mixed
     */
    public function getList(){

        $data = $this->table('__SOURCE__ AS source')
            ->field('source.*')
            ->order('id DESC')
            ->select();

        return $data;
    }
}