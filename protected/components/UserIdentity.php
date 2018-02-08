<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;
    
    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $model = new SysAdmin;
        $criteria = new CDbCriteria;
        $criteria->compare('user_name', $this->username);
        $user = $model->find($criteria);
        if (!isset($user->user_name))
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if ($user->user_pass !== $model->generationPassword($this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->errorCode = self::ERROR_NONE;
            $this->_id = $user->id;
            $this->setState('username', $user->user_name);
            //$this->username = $user->user_name;
            $cookieName = new CHttpCookie('name', $user->user_name);
            $cookieUid = new CHttpCookie('uid', $user->id);
            $cookieRid = new CHttpCookie('rid', $user->rid);
            Yii::app()->request->cookies['uid'] = $cookieUid;
            Yii::app()->request->cookies['rid'] = $cookieRid;
            Yii::app()->request->cookies['admin_name'] = $cookieName;
        }

        return $this->errorCode==self::ERROR_NONE;
    }

    /**
     * @return integer the ID of the user record
     */
    public function getId() {
        return $this->_id;
    }

}