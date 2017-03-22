<?php

namespace Webmall\Data;

class SourceData extends BaseData{

    //定义表前缀
    protected $tablePrefix = 'st_common_';

    /**
     * 多条记录查找
     * @return mixed
     */
    public function getList(){

        $data = $this->table('__SOURCE__ AS source')
            ->field('source.*,file_logo.path as logo_path,file_code.path as code_path')
            ->join('__FILE__ AS file_logo ON file_logo.id=source.logo','left')
            ->join('__FILE__ AS file_code ON file_code.id=source.code','left')
            ->order('source.sort asc,source.id asc')
            ->select();

        return $data;
    }
}