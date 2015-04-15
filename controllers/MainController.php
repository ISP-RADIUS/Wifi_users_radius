<?php

namespace app\controllers;

use app\models\FileUpload;
use Yii;
use yii\web\Controller;
use app\models\Profiles;
use app\models\Radcheck;
use app\models\UserInfo;
use app\models\AddUsersForm;
use app\models\GroupForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\LoginForm;


/**
 * Class MainController
 * @package app\controllers
 */
class MainController extends Controller
{

    public $layout = 'index';
    public $students;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/main/list');
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('/main/list');
    }

    public function actionAdd()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->actionLogin();
        }
        $model = new AddUsersForm();
        $modelFile = new FileUpload();
        $errorLog = [];
        foreach (Profiles::find()->all() as $profile) {
            $tarifs[] = $profile->name;
        }
        foreach (GroupForm::find()->all() as $group) {
            $groups[$group->group] = $group->group;
        }
        return $this->render('index', [
            'tarifs' => $tarifs,
            'groups' => $groups,
            'model' => $model,
            'modelFile' => $modelFile,
            'students' => json_decode($model->hidden),
            'errorLog' => $errorLog
        ]);
    }

    public function actionList()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->actionLogin();
        }
        $students = UserInfo::find()->all();
        $groups = GroupForm::find()->all();
        $isDisabled = [];
        foreach ($students as $student) {
            $radcheckStudent = Radcheck::findAll(['username' => $student->username, 'attribute' => 'Rd-Account-Disabled']);
            foreach ($radcheckStudent as $singleStudent) {
                if ($singleStudent->value == '0') {
                    $value = 'Enabled';
                } else {
                    $value = 'Disabled';
                }
                $isDisabled[$student->username] = $value;
            }
        }
        return $this->render('list', [
            'students' => $students,
            'groups' => $groups,
            'isDisabled' => $isDisabled
        ]);
    }

    public function actionManualUpload()
    {
        $postData = $_POST['studentData'];
        $student = json_decode($postData, true);
        $validated = true;
        foreach ($student as $studentInfo) {
            if ($studentInfo == false) {
                $validated = false;
            }
        }
        if ($validated) {
            $student['login'] = $this->generateLogin($student);
            $student['pswrd'] = $this->generatePassword($student);
            return json_encode($student);
        } else {
            return 'error';
        }
    }

    public function actionFileUpload()
    {
        if (isset($_POST['studentData'])) {
            $postData = $_POST['studentData'];
            $errors['error'] = $this->parseUploadedFile($postData);
            if (empty($errors['error'])) {
                $students = [];
                foreach ($this->students as $key => $student) {
                    $students[$key]['lastname'] = $student[0];
                    $students[$key]['firstname'] = $student[1];
                    $students[$key]['middlename'] = $student[2];
                    $students[$key]['login'] = $this->generateLogin($students[$key]);
                    $students[$key]['pswrd'] = $this->generatePassword($students[$key]);
                }
                return json_encode($students);
            } else {
                return json_encode($errors);
            }
        } else {
            return $this->render('disabled');
        }
    }

    /**
     * Uploads data to database.
     * @var $students - data passed from ajax as array of students
     * @var $student - array 7 elements as key => value:
     * 0 => lastName; 1 => firstName; 2 => middleName; 3 => login; 4 => password; 5 => index of tarif; 6 => group
     * @return string (json encoded array of students that didn't passed validation)
     */
    public function actionUpload()
    {
        if (isset($_POST['postData'])) {

            $students = json_decode($_POST['postData']);
            $profiles = Profiles::find()->all();
            foreach ($profiles as $profile) {
                $tarifs[] = $profile->name;
            }
            $studentsWithErrors = $this->validateStudentInfo($students);
            foreach ($students as $key => $student) {
                if (!array_key_exists($key, $studentsWithErrors)) {
                    $lastName = $student[0];
                    $firstName = $student[1];
                    $middleName = $student[2];
                    $group = $student[6];
                    $login = $student[3];
                    $password = $student[4];
                    $tarif = $tarifs[$student[5]];
                    $userInfo = new UserInfo();
                    $userInfo->username = $login;
                    $userInfo->last_name = $lastName;
                    $userInfo->first_name = $firstName;
                    $userInfo->middle_name = $middleName;
                    $userInfo->group = $group;
                    $userInfo->tarif = $tarif;
                    $userInfo->save();
                    $radcheck = new Radcheck();
                    $radcheck->username = $login;
                    $radcheck->attribute = 'Cleartext-Password';
                    $radcheck->op = ':=';
                    $radcheck->value = $password;
                    $radcheck->save();
                    $radcheck = new Radcheck();
                    $radcheck->username = $login;
                    $radcheck->attribute = 'Rd-User-Type';
                    $radcheck->op = ':=';
                    $radcheck->value = 'user';
                    $radcheck->save();
                    $radcheck = new Radcheck();
                    $radcheck->username = $login;
                    $radcheck->attribute = 'Rd-Realm';
                    $radcheck->op = ':=';
                    $radcheck->value = 'pma_wifi';
                    $radcheck->save();
                    $radcheck = new Radcheck();
                    $radcheck->username = $login;
                    $radcheck->attribute = 'User-Profile';
                    $radcheck->op = ':=';
                    $radcheck->value = $tarif;
                    $radcheck->save();
                    $radcheck = new Radcheck();
                    $radcheck->username = $login;
                    $radcheck->attribute = 'Rd-Cap-Type-Data';
                    $radcheck->op = ':=';
                    $radcheck->value = 'hard';
                    $radcheck->save();
                    $radcheck = new Radcheck();
                    $radcheck->username = $login;
                    $radcheck->attribute = 'Rd-Account-Disabled';
                    $radcheck->op = ':=';
                    $radcheck->value = '0';
                    $radcheck->save();
                }
            }
            foreach ($students as $key => $student) {
                if (array_key_exists($key, $studentsWithErrors)) {
                    $students[$key][7] = $studentsWithErrors[$key];
                }
            }
            return json_encode($students);
        } else {
            return $this->render('disabled');
        }
    }

    public function actionDeleteGroup()
    {
        if (isset($_POST['postData'])) {
            GroupForm::findOne(['group' => $_POST['postData']])->delete();
        } else {
            return $this->render('disabled');
        }
    }

    public function actionAddGroup()
    {
        if (isset($_POST['postData'])) {
            $group = $_POST['postData'];
            $model = new GroupForm();
            if (GroupForm::findOne(['group' => $group])) {
                return 'Group already exists';
            } else {
                $model->group = $group;
                $model->save();
                return 'Group created';
            }
        } else {
            return $this->render('disabled');
        }
    }

    public function actionDeleteStudents()
    {
        if (isset($_POST['postData'])) {
            $studentsToDelete = json_decode($_POST['postData']);
            foreach ($studentsToDelete as $student) {
                UserInfo::findOne(['username' => $student])->delete();
                $radcheckData = Radcheck::findAll(['username' => $student]);
                foreach ($radcheckData as $student) {
                    $student->delete();
                }
            }
        } else {
            return $this->render('disabled');
        }
    }

    public function actionEnableStudents()
    {
        if (isset($_POST['postData'])) {
            $studentsToDisable = json_decode($_POST['postData']);
            foreach ($studentsToDisable as $student) {
                $radcheckStudent = Radcheck::findAll(['username' => $student, 'attribute' => 'Rd-Account-Disabled']);
                foreach ($radcheckStudent as $singleStudent) {
                    $singleStudent->value = '0';
                    $singleStudent->save();
                }
            }
        } else {
            return $this->render('disabled');
        }
    }

    public function actionDisableStudents()
    {
        if (isset($_POST['postData'])) {

            $studentsToDisable = json_decode($_POST['postData']);
            foreach ($studentsToDisable as $student) {
                $radcheckStudent = Radcheck::findAll(['username' => $student, 'attribute' => 'Rd-Account-Disabled']);
                foreach ($radcheckStudent as $singleStudent) {
                    $singleStudent->value = '1';
                    $singleStudent->save();
                }
            }
        } else {
            return $this->render('disabled');
        }
    }

    private function generateLogin($student)
    {
        $lastName = $this->transliterate($student['lastname']);
        $firstName = $this->transliterate($student['firstname']);
        $middleName = $this->transliterate($student['middlename']);
        $login = $lastName . '.' . $firstName[0] . '.' . $middleName[0];
        return strtolower($login);
    }

    private function generatePassword($student)
    {
        $lastName = $this->transliterate($student['lastname']);
        $firstName = $this->transliterate($student['firstname']);
        $middleName = $this->transliterate($student['middlename']);
        $password = $lastName[0] . $firstName[0] . $middleName[0] . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
        return strtolower($password);
    }

    private function transliterate($text)
    {
        $trans_arr = array(
            "а" => "a", "б" => "b", "в" => "v", "г" => "g", "д" => "d",
            "е" => "e", "ё" => "yo", "ж" => "j", "з" => "z", "и" => "i",
            "й" => "i", "к" => "k", "л" => "l", "м" => "m", "н" => "n",
            "о" => "o", "п" => "p", "р" => "r", "с" => "s", "т" => "t",
            "у" => "u", "ф" => "f", "х" => "h", "ц" => "c", "ч" => "ch",
            "ш" => "sh", "щ" => "sh", "ы" => "i", "э" => "e", "ю" => "yu",
            "я" => "ya",
            "А" => "A", "Б" => "B", "В" => "V", "Г" => "G", "Д" => "D",
            "Е" => "E", "Ё" => "Yo", "Ж" => "J", "З" => "Z", "И" => "I",
            "Й" => "I", "К" => "K", "Л" => "L", "М" => "M", "Н" => "N",
            "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T",
            "У" => "U", "Ф" => "F", "Х" => "H", "Ц" => "C", "Ч" => "Ch",
            "Ш" => "Sh", "Щ" => "Sh", "Ы" => "I", "Э" => "E", "Ю" => "YU",
            "Я" => "Ya",
            "ь" => "", "Ь" => "", "ъ" => "", "Ъ" => "",
            "ї" => "j", "і" => "i", "ґ" => "g", "є" => "ye",
            "Ї" => "J", "І" => "I", "Ґ" => "G", "Є" => "YE"
        );
        return strtr($text, $trans_arr);
    }

    /**
     * @param $students - array of students to validate
     * @return array (index of student, who didn't pass validation and explanation why as index => explanation)
     */
    private function validateStudentInfo($students)
    {
        $studentsWithErrors = [];
        foreach ($students as $key => $student) {
            $password = $student[4];
            $login = $student[3];
            if ($password == $login) {
                $studentsWithErrors[$key] = 'Login and Password should be different';
            }
            if (strlen($password) < 5) {
                $studentsWithErrors[$key] = 'Password should be at least 5 symbols';
            }
        }
        return $studentsWithErrors;
    }

    /**
     * Parses input string, dividing into lines and getting 3 words from each line.
     * If there are more than 3 words in line, returns error with line number.
     * Saves parsed content as array to $this->students.
     * @param $content - string to parse
     * @return array (lines with more than 3 words)
     */
    private function parseUploadedFile($content)
    {
        $line = '';
        $lineNumber = 0;
        $studentsInfo = [];
        $errorLog = [];
        for ($i = 0; $i < strlen($content); $i++) {
            if ($content[$i] != PHP_EOL) {
                $line .= $content[$i];
            } else {
                $lineNumber++;
                $studentsInfo[] = explode(' ', preg_replace('/\s+/', ' ', trim($line)));
                if (sizeof($studentsInfo[$lineNumber - 1]) != 3) {
                    $errorLog['linenumber'][] = $lineNumber;
                    $errorLog['content'][] = $studentsInfo[$lineNumber - 1];
                }
                $line = '';
            }
        }
        $this->students = $studentsInfo;
        return $errorLog;
    }
}

?>
