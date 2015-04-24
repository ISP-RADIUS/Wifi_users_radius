<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $token
 * @property string $name
 * @property string $surname
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $auth_type
 * @property integer $active
 * @property integer $monitor
 * @property string $last_accept_time
 * @property string $last_reject_time
 * @property string $last_accept_nas
 * @property string $last_reject_nas
 * @property string $last_reject_message
 * @property integer $country_id
 * @property integer $group_id
 * @property integer $language_id
 * @property integer $parent_id
 * @property integer $lft
 * @property integer $rght
 * @property string $created
 * @property string $modified
 * @property integer $perc_time_used
 * @property integer $perc_data_used
 * @property integer $data_used
 * @property integer $data_cap
 * @property integer $time_used
 * @property integer $time_cap
 * @property string $time_cap_type
 * @property string $data_cap_type
 * @property string $realm
 * @property integer $realm_id
 * @property string $profile
 * @property integer $profile_id
 * @property string $from_date
 * @property string $to_date
 * @property integer $track_auth
 * @property integer $track_acct
 * @property string $static_ip
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'name', 'surname', 'address', 'phone', 'email', 'group_id', 'created', 'modified'], 'required'],
            [['active', 'monitor', 'country_id', 'group_id', 'language_id', 'parent_id', 'lft', 'rght', 'perc_time_used', 'perc_data_used', 'data_used', 'data_cap', 'time_used', 'time_cap', 'realm_id', 'profile_id', 'track_auth', 'track_acct'], 'integer'],
            [['last_accept_time', 'last_reject_time', 'created', 'modified', 'from_date', 'to_date'], 'safe'],
            [['time_cap_type', 'data_cap_type'], 'string'],
            [['username', 'address', 'last_reject_message'], 'string', 'max' => 255],
            [['password', 'name', 'surname', 'phone', 'realm', 'profile', 'static_ip'], 'string', 'max' => 50],
            [['token'], 'string', 'max' => 36],
            [['email'], 'string', 'max' => 100],
            [['auth_type', 'last_accept_nas', 'last_reject_nas'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'token' => 'Token',
            'name' => 'Name',
            'surname' => 'Surname',
            'address' => 'Address',
            'phone' => 'Phone',
            'email' => 'Email',
            'auth_type' => 'Auth Type',
            'active' => 'Active',
            'monitor' => 'Monitor',
            'last_accept_time' => 'Last Accept Time',
            'last_reject_time' => 'Last Reject Time',
            'last_accept_nas' => 'Last Accept Nas',
            'last_reject_nas' => 'Last Reject Nas',
            'last_reject_message' => 'Last Reject Message',
            'country_id' => 'Country ID',
            'group_id' => 'Group ID',
            'language_id' => 'Language ID',
            'parent_id' => 'Parent ID',
            'lft' => 'Lft',
            'rght' => 'Rght',
            'created' => 'Created',
            'modified' => 'Modified',
            'perc_time_used' => 'Perc Time Used',
            'perc_data_used' => 'Perc Data Used',
            'data_used' => 'Data Used',
            'data_cap' => 'Data Cap',
            'time_used' => 'Time Used',
            'time_cap' => 'Time Cap',
            'time_cap_type' => 'Time Cap Type',
            'data_cap_type' => 'Data Cap Type',
            'realm' => 'Realm',
            'realm_id' => 'Realm ID',
            'profile' => 'Profile',
            'profile_id' => 'Profile ID',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
            'track_auth' => 'Track Auth',
            'track_acct' => 'Track Acct',
            'static_ip' => 'Static Ip',
        ];
    }
}
