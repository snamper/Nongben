<?php
/**
 * Created by PhpStorm.
 * User: KU04PC
 * Date: 2015/5/21
 * Time: 17:08
 */

namespace Common\Util;


use Admin\Enum\BaseEnum;
use Think\Image;

class GlobalUtil
{

    /**
     * 根据文件的id获取文件的路径
     * @param $id
     * @return mixed
     */
    public function getFilePath($id)
    {
        $File = D('File');
        return $File->where('id = %d AND status = %d', array($id, BaseEnum::ACTIVE))->getField('path');
    }

    /**
     * 根据图片ID获取不同尺寸的缩略图路径，
     * 未生成缩略图则自动生成
     * @param $size
     * @param $id
     * @param $error
     * @return bool  缩略图路径，尺寸不正确返回原图路径
     */
    function getThumbPath($id, $size, &$error)
    {
        //缩略图尺寸
        $sizeList = array(
            'm' => array(450, 300),
            's' => array(160, 160),
            'x' => array(100, 100)
        );
        //检查是否生成了缩略图
        $info = D('File')->field('path,gmt_create')
            ->where('id = %d AND status = %d', array($id, BaseEnum::ACTIVE))
            ->find();
        $source_path = $info['path'];

        if (!file_exists('.' . $source_path)) {
            $error = '源图像不存在';
            return false;
        }

        if(is_array($size)){
            //自定义尺寸
            $sizeList['custom'] = $size;
            $size = 'custom';
        } else {
            $size = strtolower($size);
            if (!in_array($size, array_keys($sizeList))) {
                $error = '错误的缩略图尺寸';
                return $source_path;
            }
        }

        $thumbSize = 'thumb_img_' . $size;
        $thumbPath = str_replace('source_img', 'thumb_img_' . $size, $source_path);
//        print $thumbPath;
        if (file_exists('.' . $thumbPath)) {
            return $thumbPath;
        }

        // 附件上传根目录
        $rootPath = './Public/uploads/';
        foreach ($sizeList as $thumbName => $thumbSize) {
            if (!$thumbName || empty($thumbSize)) continue;

            $thumbSavePath = $rootPath . 'Admin/images/thumb_img_' . $thumbName . '/' . date('Ymd', strtotime($info['gmt_create']));
            $currentThumbPath = $thumbSavePath . '/' . basename($source_path);

            if (!is_dir($thumbSavePath)) {
                if (false === mkdir($thumbSavePath, 0777, true)) {
                    $error = '创建缩略图文件夹失败' . $thumbSavePath;
                    return false;
                }
            }
            $Image = new Image();
            $Image->open('.' . $source_path);
            $Image->thumb($thumbSize[0], $thumbSize[1])->save($currentThumbPath);
        }
        return $thumbPath;
    }
}

