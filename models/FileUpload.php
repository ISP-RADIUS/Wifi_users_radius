<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class FileUpload extends Model
{
    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['file', 'required'],
            ['file', 'file']
        ];
    }

}
