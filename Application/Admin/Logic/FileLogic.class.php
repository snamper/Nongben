<?php

namespace Admin\Logic;

class FileLogic extends BaseLogic{

    /**
     * @var \Admin\Data\FileData
     */
    protected $fileData;

    public function _initialize(){
        $this->fileData = D('File', 'Data');
    }

    /**
     * 获取单条数据
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->fileData->getById($id);
    }

    /**
     * 获取多条数据
     * @param $conditions
     * @param null $pagePara
     * @return mixed
     */
    public function getList($conditions,$pagePara = null){
        return $this->fileData->getList($conditions,$pagePara);
    }

    /**
     * 添加数据
     * @param $data
     * @return bool
     */
    public function saveFile($data){

        $File = D('File');

        if($File->create($data)){
            return $File->add();
        }else{
            return false;
        }
    }

    /**
     * 修改数据
     * @param $data
     * @return bool
     */
    public function editFile($data){
        $File = D('File');

        if($File->create($data)){
            return $File->save();
        }else{
            return false;
        }
    }

    /**
     * 删除数据
     * @param $id
     * @return mixed
     */
    public function delFile($id){
        $File = D('File');

        return $File->delete($id);
    }
}