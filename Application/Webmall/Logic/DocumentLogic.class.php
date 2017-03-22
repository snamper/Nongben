<?php

namespace Academy\Logic;

class DocumentLogic extends BaseLogic{

    protected $documentData;

    public function _initialize(){
        $this->documentData = D('Document', 'Data');
    }

    /**
     * 根据分类获取最新文章（分页）
     * @param $conditions
     * @param null $pagePara
     * @return mixed
     */
    public function getNewDocumentByCat($conditions, $pagePara=null){
        return $this->documentData->getNewDocumentByCat($conditions, $pagePara);
    }

    /**
     * 根据分类获取热门文章（分页）
     * @param $conditions
     * @param null $pagePara
     * @return mixed
     */
    public function getHotDocumentByCat($conditions, $pagePara=null){
        return $this->documentData->getHotDocumentByCat($conditions, $pagePara);
    }

    /**
     * 获取文章数目
     * @param $conditions
     * @return mixed
     */
    public function getCount($conditions){
        return $this->documentData->getCount($conditions);
    }


    public function getDocumentDetail($id){
        $this->setInc($id,'count');
        return $this->documentData->getDocumentDetail($id);
    }

    /**
     * 某字段+1
     * @param $id
     * @param $field
     * @return bool
     */
    public function setInc($id,$field){
        $Document = D('Document');
        return $Document->where('id = %d',$id)->setInc($field,1);
    }
    
}