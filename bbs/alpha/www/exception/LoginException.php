<?php
/**
 * 登陆异常类
 * @name:       LoginException
 * @author:     Cookize
 */

require_once '../config.php';
require_once ROOT_PATH.'/exception/BasicException.php';

/**
 * Class LoginException
 * ErrorCode:
 *      1 ----------------- 用户名未注册
 *      2 ----------------- 密码错误
 *      3 ----------------- 邮箱未注册
 *      4 ----------------- 数据库故障
 */
class LoginException extends BasicException
{

}