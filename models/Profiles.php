<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profiles".
 *
 * @property integer $id
 * @property string $name
 * @property integer $available_to_siblings
 * @property integer $user_id
 * @property string $created
 * @property string $modified
 */
class Profiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profiles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created', 'modified'], 'required'],
            [['available_to_siblings', 'user_id'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['name'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'available_to_siblings' => 'Available To Siblings',
            'user_id' => 'User ID',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}