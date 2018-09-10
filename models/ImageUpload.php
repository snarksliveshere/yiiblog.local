<?php
/**
 * Created by PhpStorm.
 * User: -
 * Date: 10.09.2018
 * Time: 17:11
 */

namespace app\models;


use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Class ImageUpload
 * @package app\models
 */
class ImageUpload extends Model
{
    /**
     * @var
     */
    public $image;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg,jpeg,png,gif']
        ];
    }

    /**
     * @param UploadedFile $file
     * @param $currentImage
     * @return string
     */
    public function uploadFile(UploadedFile $file, $currentImage)
    {
        $this->image = $file;

        if ($this->validate()) {

            $this->deleteCurrentImage($currentImage);

            return $this->saveImage();
        }


    }

    /**
     * @return string
     */
    private function getFolder()
    {
        return Yii::getAlias('@web') . 'uploads/';
    }

    /**
     * @return string
     */
    private function generateFilename()
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
    }

    /**
     * @param $currentImage
     */
    public function deleteCurrentImage($currentImage)
    {
        if ($this->fileExists($currentImage)) {
            unlink($this->getFolder() . $currentImage);
        }
    }

    /**
     * @param $currentImage
     * @return bool
     */
    public function fileExists($currentImage)
    {
        if (!empty($currentImage) && null !== $currentImage) {
            return file_exists($this->getFolder() . $currentImage);
        }
    }

    /**
     * @return string
     */
    public function saveImage()
    {
        $filename =$this->generateFilename();

        $this->image->saveAs($this->getFolder() . $filename);

        return $filename;
    }


}