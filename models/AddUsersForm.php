<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class AddUsersForm extends Model
{
    public $group;
    public $tarif;
    public $lastName;
    public $firstName;
    public $middleName;
    public $hidden;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['lastName', 'firstName', 'middleName', 'group', 'tarif'], 'required'],
            ['hidden', 'string']
        ];
    }

}
