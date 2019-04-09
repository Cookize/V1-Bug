<?php
/**
 * DAO层登陆操作
 * User: Cookize
 * Date: 2019/4/8
 * Time: 22:33
 */

require_once 'DatabaseBasicFunc.php';

class LoginDao
{
    /**
     * “使用用户名登陆”数据库操作，登陆成功后返回用户ID，失败抛出异常。
     * @param $_username
     * @param $_password
     * @return string
     * @throws LoginException   登陆失败异常
     *      ErrorCode：1----------用户名未注册
     *      ErrorCode：2----------密码错误
     */
    public static function login_by_name($_username, $_password)
    {
        $database = new DatabaseBasicFunc();

        // 检查用户名是否存在。
        $searchUser = array(
            'username'=>$_username
        );
        $fieldParam = array(
            'uid'
        );
        $database->where($searchUser);
        $database->field($fieldParam);
        $retUid = $database->select('User');
        if(1 != count($retUid))
        {
            throw new LoginException('Exception:USER NOT FOUND', 1);
        }

        // 检验密码是否正确。
        $checkPassword = array(
            'uid'=>$retUid[0],
            'password'=>$_password
        );
        $database->where($checkPassword);
        if(1 != count($database->select('User')))
        {
            throw new LoginException('Exception:WRONG PASSWORD', 2);
        }

        // 返回用户ID。
        return $retUid[0];
    }


    /**
     * “使用邮箱登陆”数据库操作，登陆成功后返回用户ID，失败抛出异常。
     * @param $_email
     * @param $_password
     * @return string
     * @throws LoginException   登陆失败异常
     *      ErrorCode：3----------邮箱未注册
     *      ErrorCode：2----------密码错误
     */
    public static function login_by_email($_email, $_password)
    {
        $database = new DatabaseBasicFunc();

        // 检查邮箱是否注册。
        $searchUser = array(
            'username'=>$_email
        );
        $fieldParam = array(
            'uid'
        );
        $database->where($searchUser);
        $database->field($fieldParam);
        $retUid = $database->select('User');
        if(1 != count($retUid))
        {
            throw new LoginException('Exception:EMAIL NOT FOUND', 3);
        }

        // 检验密码是否正确。
        $checkPassword = array(
            'uid'=>$retUid[0],
            'password'=>$_password
        );
        $database->where($checkPassword);
        if(1 != count($database->select('User')))
        {
            throw new LoginException('Exception:WRONG PASSWORD', 2);
        }

        // 返回用户ID。
        return $retUid[0];

    }
}