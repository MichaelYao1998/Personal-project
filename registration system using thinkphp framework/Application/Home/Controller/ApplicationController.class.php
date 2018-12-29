<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/27
 * Time: 9:39
 */

namespace Home\Controller;


use Think\Controller;
use Think\Exception;

class ApplicationController extends Controller
{
    public function register()
    {
        if (isset($_POST['reg_user'])) {
            $userModel = D('Account');
            $userModel->create();
            $username = $userModel->username;
            $result = $userModel->exists($username);
            $pwd = I('post.password_2');
            $password = $userModel->password;
            $email = I('post.email');
            $userName = I('post.username');
            try {
                if (empty($result)) {
                    if ($pwd == $password) {
                        $userModel->password = md5($userModel->password);
                    } else {
                        throw new Exception('Password does not match');
                    }
                    if (empty($userName)) {
                        throw new Exception('Username is needed');
                    }
                    if (empty($password)) {
                        throw new Exception("password is needed");
                    }
                    if (empty($email)) {
                        throw new Exception("Email is needed");
                    }
                    $uid = $userModel->add();
                } else {
                    throw new Exception('User already exist');
                }
                if (!empty($uid)) {
                    $this->success("redirect successful", "test");
                } else {
                    throw new Exception('redirect failure');
                }
            } catch (Exception $e) {
                $this->assign("error", $e->getMessage());
            }
        }
        $this->display();
    }

    public function login()
    {
        try {
            if (isset($_POST['login_user'])) {
                $accountModel = D("Account");
                $userAccount = I('post.userInfo');
                $pwd = I('post.password');
                $email = $accountModel->getField('email', true);
                $username = $accountModel->getField('username', true);
                $checkSQL['email'] = $userAccount;
                $checkSql['username'] = $userAccount;
                $password = $accountModel->where($checkSQL)->getField('password', true);
                $EmailPwd = implode(" ", $password);
                $pass = $accountModel->where($checkSql)->getField('password', true);
                $userPwd = implode(" ", $pass);
                $pwd = md5($pwd);
                if (in_array($userAccount, $email) || in_array($userAccount, $username)) {
                    if ($pwd == $EmailPwd || $pwd == $userPwd) {
                        $this->success("redirect successful", "test");
                    } else {
                        throw new Exception("Password does not match");
                    }
                } else {
                    throw new Exception('User does not exist');
                }
            }
        } catch (Exception $e) {
            $this->assign("errMessage", $e->getMessage());
        }
        $this->display();
    }
}