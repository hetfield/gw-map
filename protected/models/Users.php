<?php
/**
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $email
 * @property string $role
 */

class Users extends CActiveRecord
{
    public $login;
    public $password;
    public $email;

    public $ID;

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return array(
            array('login, password, email', 'required'),
            array('email', 'email'),
            array('login', 'unique'),
            array('email', 'unique'),
        );
    }


    public function getDataProvider()
    {
        $criteria = new CDbCriteria();

        $criteria->compare('id', $this->id);
        $criteria->compare('login', $this->login);
        $criteria->compare('email', $this->email);
        $criteria->compare('role', 'helper');

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

    public function getUsersColumns()
    {
        return array(
            'id',
            'login',
            'email',
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'htmlOptions' => array('style'=>'width: 50px; text-align: center;'),
                'buttons' => array(
                    'update' => array(
                        'visible' => 'false',
                    ),
                    'view' => array(
                        'visible' => 'false',
                    ),
                    'delete' => array(
                        'url' => 'Yii::app()->createUrl("users/delete", array("id" => $data->id))',
                    ),
                ),
            ),
        );
    }

//    public $username;
//    public $password;
//    public $rememberMe;
//
//    private $_identity;
//
//    /**
//     * Declares the validation rules.
//     * The rules state that username and password are required,
//     * and password needs to be authenticated.
//     */
//    public function rules()
//    {
//        return array(
//            // username and password are required
//            array('username, password', 'required'),
//            // rememberMe needs to be a boolean
//            array('rememberMe', 'boolean'),
//            // password needs to be authenticated
//            array('password', 'authenticate'),
//        );
//    }
//
//    /**
//     * Declares attribute labels.
//     */
//    public function attributeLabels()
//    {
//        return array(
//            'rememberMe'=>'Запомнить меня(не требует авторизации долгий период времени)',
//            'username' => 'Логин',
//            'password' => 'Пароль'
//        );
//    }
//
//    /**
//     * Authenticates the password.
//     * This is the 'authenticate' validator as declared in rules().
//     */
//    public function authenticate($attribute,$params)
//    {
//        if(!$this->hasErrors())
//        {
//            $this->_identity=new UserIdentity($this->username,$this->password);
//            if(!$this->_identity->authenticate())
//                $this->addError('password','Неверно введены логин или пароль');
//        }
//    }
//
//    /**
//     * Logs in the user using the given username and password in the model.
//     * @return boolean whether login is successful
//     */
//    public function login()
//    {
//        if($this->_identity===null)
//        {
//            $this->_identity=new UserIdentity($this->username,$this->password);
//            $this->_identity->authenticate();
//        }
//        if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
//        {
//            $duration=$this->rememberMe ? 3600*24*30 : 3600*24*2; // 30 days or 2 days
//            Yii::app()->user->login($this->_identity,$duration);
//            return true;
//        }
//        else
//            return false;
//    }



}