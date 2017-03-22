<?php

namespace Webmall\Logic;

class CategoryLogic extends BaseLogic{

    /**
     * @var \Academy\Data\CategoryData
     */
    protected $categoryData;

    public function _initialize(){
        $this->categoryData = D('Category', 'Data');
    }


    /**
     * 根据父级分类查找
     * @param $id
     * @return mixed
     */
    public function getByParent($id){
        return $this->categoryData->getByParent($id);
    }
    public function getById($id){
        return $this->categoryData->getById($id);
    }

    /**
     * 根据分类id获取分类下内所有数组
     * @param $category_id
     * @return mixed
     */
    public function getCategoryArr($category_id){
        return $this->categoryData->getCategoryArr($category_id);
    }

    /**
     * 根据子级分类id获取整个树枝数组
     * @param $category_id
     * @return mixed
     */
    public function getCategoryString($category_id ,$type='id'){
        do{
            $category = D('Category')->getById($category_id);
            if($type=='string'){
                $categoryArr[] = $category['name'];
            }else{
                $categoryArr[] = $category['id'];
            }

            $category_id = $category['parent'];
        }while($category['parent'] != 0);

        return array_reverse($categoryArr);
    }


    /**
     * 是否存在该分类
     * @param $where
     * @return mixed
     */
    public function checkByData($where){
        $category = D('Category');
        return $category->where($where)
                        ->find();
    }
}