<?php
namespace Admin\Controller;
use Admin\Enum\BaseEnum;
use Admin\Enum\FileTypeEnum;
use Think\Image;
use Think\Upload;

class ImageController extends BaseController {

    Public function uploadImage() {
        $upload = new Upload();         // 实例化上传类
        $upload->maxSize   =     2097152 ;      // 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg', 'bmp');    // 设置附件上传类型
        $upload->rootPath  =     './Public/uploads/';   // 设置附件上传根目录
        $upload->savePath  =     'Admin/image/';     // 设置附件上传（子）目录
        $upload->subName   =     array('date','Ymd');  // 设置上传保存子目录
        $upload->saveName  =      date('YmdHis');

        // 获取上传文件的类型
        $type_str = I('get.type');
        $enumArr = FileTypeEnum::getConstants();
        $type = $enumArr[strtoupper($type_str)];

        // 上传文件
        $info   =   $upload->upload();
        if(!$info) {
            // 上传错误提示错误信息
            $this->ajaxError($upload->getError());
        }else{
            $result = array();
            foreach($info as $file){

                // 保存上传的文件信息
                $source_path = $upload->rootPath . $file['savepath'] . $file['savename'];
                $path = substr($source_path,1);
                $result = $this->saveUploadData($path,$file['name'],$type);

                // 上传成功
                $this->ajaxSuccess($result,'图片上传成功');
            }
        }
    }

    Public function uploadVideo() {
        $upload = new Upload();         // 实例化上传类
        $upload->maxSize   =     209715200 ;      // 设置附件上传大小
        $upload->exts      =     array('mp4', 'avi', 'wmv');    // 设置附件上传类型
        $upload->rootPath  =     './Public/uploads/';   // 设置附件上传根目录
        $upload->savePath  =     'Admin/video/';     // 设置附件上传（子）目录
        $upload->subName   =     array('date','Ymd');  // 设置上传保存子目录
        $upload->saveName  =      date('YmdHis');

        // 获取上传文件的类型
        $type_str = I('get.type');
        $enumArr = FileTypeEnum::getConstants();
        $type = $enumArr[strtoupper($type_str)];

        // 上传文件
        $info   =   $upload->upload();
        if(!$info) {
            // 上传错误提示错误信息
            $this->ajaxError($upload->getError());
        }else{
            $result = array();
            foreach($info as $file){

                // 保存上传的文件信息
                $source_path = $upload->rootPath . $file['savepath'] . $file['savename'];
                $path = substr($source_path,1);
                $result = $this->saveUploadData($path,$file['name'],$type);

                // 上传成功
                $this->ajaxSuccess($result,'视频上传成功');
            }
        }
    }

    public function saveUploadData($path,$name,$type){

        $res =  D('File')->add(array(
            'path' => $path,
            'original_name' => $name,
            'status' => BaseEnum::ACTIVE,
            'type' => $type,
            'gmt_create' => get_date()
        ));

        if($res){
            $img['id'] = $res;
            $img['path'] = $path;
            $img['original_name'] = $name;
        }
        return $img;
    }
}