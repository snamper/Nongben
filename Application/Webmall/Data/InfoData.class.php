<?php

namespace Webmall\Data;


class InfoData extends BaseData{

    //定义表前缀
    protected $tablePrefix = 'st_common_';
    

    /**
     * 单条记录查找
     * @param $id
     * @return mixed
     */
    public function getById($id){
        $data['info'] = $this->table('__INFO__ AS info')
            ->field('info.*,file.path')
            ->join('__FILE__ AS file ON file.id=info.logo','left')
            ->where('info.id=%d',$id)
            ->find();

        $data['pre'] = $this->table('__INFO__ AS info')
            ->field('id,title')
            ->where('id < %d',$id)
            ->order('id desc')
            ->find();

        $data['next'] = $this->table('__INFO__ AS info')
            ->field('id,title')
            ->where('id > %d',$id)
            ->order('id asc')
            ->find();

        return $data;
    }

    /**
     * 多条记录查找
     * @return mixed
     */
    public function getList(){
        $data = $this->table('__INFO__ AS info')
            ->field('info.*,file.path')
            ->join('__FILE__ AS file ON file.id = info.logo')
            ->order('sort asc,gmt_create desc')
            ->where('info.is_hot != 1 and sort != 99')
            ->select();

        return $data;
    }

    public function getHotList(){
        $data = $this->table('__INFO__ AS info')
            ->field('info.*,file.path')
            ->join('__FILE__ AS file ON file.id = info.logo')
            ->order('sort asc,gmt_create desc')
            ->where('info.is_hot = 1')
            ->select();

        return $data;
    }

    public function getListLimit(){

        $data = $this->table('__INFO__ AS info')
            ->field('info.id,info.title')
            ->order('gmt_create desc')
            ->where('info.is_hot = 1')
            ->limit(8)
            ->select();

        return $data;
    }
}