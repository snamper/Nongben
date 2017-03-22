<?php

namespace Admin\Logic;

class CategoryLogic extends BaseLogic{

    /**
     * @var \Admin\Data\CategoryData
     */
    protected $categoryData;

    public function _initialize(){
        $this->categoryData = D('Category', 'Data');
    }

    /**
     * 获取单条数据
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->categoryData->getById($id);
    }


    /**
     * 获取多条数据
     * @param $conditions
     * @return mixed
     */
    public function getList($conditions){
        return $this->categoryData->getList($conditions);
    }



    /**
     * 添加数据
     * @param $data
     * @return bool
     */
    public function saveCategory($data){

        $Category = D('Category');

        if($data['parent'] != 0){
            $parent = $Category->where('id = %d',$data['parent'])->find();
            $data['grade'] = $parent['grade'] + 1;
            $data['path'] = $parent['path'];
        }else{
            $data['grade'] = 1;
            $data['path'] = ',0,';
        }

        $data['code'] = pinyin($data['name'],true);
        if($Category->create($data)){
            $categoryId = $Category->add();
            $data['path'] = $data['path'] . $categoryId . ',';

            return $Category->where('id = %d',$categoryId)->save($data);
        }else{
            return false;
        }
    }

    /**
     * 修改数据
     * @param $data
     * @return bool
     */
    public function editCategory($data){
        $Category = D('Category');

        $data['code'] = pinyin($data['name'],true);
        if($Category->create($data)){
            return $Category->save();
        }else{
            return false;
        }
    }

    /**
     * 删除数据
     * @param $id
     * @return mixed
     */
    public function delCategory($id){
        $Category = D('Category');

        return $Category->delete($id);
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
     * 根据分类id获取父节点id
     * @param $catId
     * @return array
     */
    public function getCatIdArr($catId){
        $catLabel = array('catId','catId2','catId3','catId4');
        $catIdArr = array();

        do{
            $cat = $this->getById($catId);
//            print_r($city);
            $catIdArr[$catLabel[$cat['grade']-1]] = $cat['id'];

            $catId = $cat['parent'];
        }while($cat['parent'] != 0);

        return $catIdArr;
    }


    /**
     * 根据分类ID查找该分类下的属性名称及对应的属性值
     * @param $categoty_id
     */
    public function getCategoryAttrList($conditions){
        $data = array();

//        $conditions = array('category_id'=> $category_id);
        $attrs = D('GoodsAttr', 'Logic')->getList($conditions);

        if($attrs){
            $attrOptions = D('GoodsAttrOption', 'Logic');
            foreach($attrs['items'] as &$item){
                $attr_id = $item['id'];

                $item_options = $attrOptions->getList(array('attr_id'=>$attr_id));
                if($item_options){
                    $item['options'] = $item_options['items'];
                }
            }
            $data = $attrs['items'];
        }
        return $data;
    }



    /**
     * 检查是否是最后一级分类，默认检查到第二级， 最多支持检查四级
     * @param $catId 分类Id
     * @param $level 要检查的层级
     * @return bool 通过检查返回true
     */
    public function checkFullCatLevel($catId, $level=2){
        $category = $this->getById($catId);
        if(!$category){
            return false;
        }
        $data = $this->getCatIdArr($catId);

        //要检查的层级数据
        $cats = array(); //需要检查的数据
        for($i=1; $i<=$level; $i++){
            if($i == 1){
                array_push($cats,$data['catId']);
            } else {
                array_push($cats,isset($data['catId'. $i]) ? $data['catId'. $i]: 0 );
            }
        }

        $i = 0 ;
        $grade = count($cats);
        while(true){
            if($i>= $grade){
                break;
            }
            $currentCat = current($cats);
            $i++;
            $childCat = $this->hasChildCategory($currentCat);
            if(!$childCat){ //没有子级节点
                break;
            }
            if($i<$grade && !next($cats)){
                return false;
            }
        } # end while
        return true;
    }


    public function hasChildCategory($catId){
        $cate = $this->getById($catId);
        $path = $cate['path'];

        return $this->categoryData->getListByPath($path);
    }

    public function getCategoryList($conditions){
        return $this->categoryData->getCategoryList($conditions);
    }
}