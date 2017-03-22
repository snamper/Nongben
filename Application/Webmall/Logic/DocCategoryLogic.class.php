<?php

namespace Academy\Logic;

class DocCategoryLogic extends BaseLogic{

    /**
     * @var \Academy\Data\DocCategoryData
     */
    protected $categoryData;

    public function _initialize(){
        $this->categoryData = D('DocCategory', 'Data');
    }

    /**
     * 根据父级分类查找
     * @param $id
     * @return mixed
     */
    public function getByParent($id){
        return $this->categoryData->getByParent($id);
    }

    /**
     * 根据code查找
     * @param $code
     * @return mixed
     */
    public function getIdByCode($code){
        return $this->categoryData->getIdByCode($code);
    }

    /**
     * 根据分类id获取分类下内所有数组
     * @param $category_id
     * @return mixed
     */
    /*public function getCategoryArr($category_id){
        return $this->categoryData->getCategoryArr($category_id);
    }*/

    /**
     * 根据子级分类id获取整个树枝数组
     * @param $category_id
     * @return mixed
     */
    /*public function getCategoryString($category_id ,$type='id'){
        do{
            $category = D('DocCategory')->getById($category_id);
            if($type=='string'){
                $categoryArr[] = $category['name'];
            }else{
                $categoryArr[] = $category['id'];
            }

            $category_id = $category['parent'];
        }while($category['parent'] != 0);

        return array_reverse($categoryArr);
    }*/


    /**
     * 是否存在该分类
     * @param $where
     * @return mixed
     */
    /*public function checkByData($where){
        $category = D('DocCategory');
        return $category->where($where)
            ->find();
    }*/
}