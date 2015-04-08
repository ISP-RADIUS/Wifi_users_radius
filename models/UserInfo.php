<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_info".
 *
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $group
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['username', 'first_name', 'last_name', 'middle_name', 'group', 'tarif'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'middle_name' => 'Middle Name',
            'group' => 'Group',
            'tarif' => 'Tarif',
        ];
    }
}