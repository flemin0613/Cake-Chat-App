<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use App\Controller\Component;

class HomeController extends AppController
{
    public function initialize(): void
	{
		parent::initialize();

	}
    
    public function home()
    {
        // モジュール読み込み
        $this->loadComponent('Common');
        $session = $this->getRequest()->getSession();

        // ログインユーザーを取得
        $login_user = $this->Common->get_login_user('1',$_POST['email'],$_POST['password']);

        // 法人ID・ユーザーIDをセッション領域に格納する
        $session->write('hojin_id', $login_user->KEIYAKU_CODE);
        $session->write('user_id', $login_user->USER_ID);

        // 全ユーザー取得
        $user = $this->Common->get_user('1');

        $this->set('user', $user);
        $this->render('home');
    }
}
