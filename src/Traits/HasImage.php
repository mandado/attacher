<?php namespace Artesaos\Attacher\Traits;

use Artesaos\Attacher\AttacherModel;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait HasImage
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {
        return $this->morphOne(config('attacher.model'), 'subject');
    }

    /**
     * @param UploadedFile $image
     *
     * @return AttacherModel
     */
    public function addImage(UploadedFile $image)
    {
        $instance = $this->createImageModel();
        $instance->setupFile($image);

        $this->image()->save($instance);

        return $instance;
    }

    /**
     * @return AttacherModel
     */
    protected function createImageModel()
    {
        return $this->image()->getRelated()->newInstance();
    }
}