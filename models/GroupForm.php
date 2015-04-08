<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "radcheck".
 *
 * @property integer $id
 * @property string $username
 * @property string $attribute
 * @property string $op
 * @property string $value
 */
class GroupForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students_groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['group', 'required'],
            ['group', 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'group' => 'Group',
        ];
    }
}
