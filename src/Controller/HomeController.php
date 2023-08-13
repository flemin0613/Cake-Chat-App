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
    
    public function chat()
    {
        // モジュール読み込み
        $this->loadComponent('Common');
        $referer = $this->referer();

        if($referer="/"){
            $session = $this->getRequest()->getSession();

            // ログインユーザーを取得
            $login_user = $this->Common->get_login_user('1',$_POST['email'],$_POST['password']);
    
            // 法人ID・ユーザーIDをセッション領域に格納する
            $session->write('hojin_id', $login_user->KEIYAKU_CODE);
            $session->write('user_id', $login_user->USER_ID);
            $session->write('user_data', $login_user);
    
            // 全ユーザーに紐づくルームIDを取得
            $user = $this->Common->get_user('1',$login_user->USER_ID);
                
            $user_id = null;
            $room_id = null;
            $message_list = [];
    
            $this->set('user', $user);
            $this->set('user_id', $user_id);
            $this->set('room_id', $room_id);
            $this->set('message_list', $message_list);
            $this->render('home');

        }else{

            $session_flg = $this->Common->chk_session();
            
            if($session_flg){

                $session = $this->getRequest()->getSession();

                // ログインユーザーを取得
                $login_user = $this->Common->get_login_user('1',$_POST['email'],$_POST['password']);
        
                // 法人ID・ユーザーIDをセッション領域に格納する
                $session->write('hojin_id', $login_user->KEIYAKU_CODE);
                $session->write('user_id', $login_user->USER_ID);
        
                // 全ユーザーに紐づくルームIDを取得
                $user = $this->Common->get_user('1',$login_user->USER_ID);
                
                $user_id = null;
                $room_id = null;
                $message_list = [];
        
                $this->set('user', $user);
                $this->set('user_id', $user_id);
                $this->set('room_id', $room_id);
                $this->set('message_list', $message_list);
                $this->render('home');

            }else{

                $this->redirect(['controller' => 'Login', 'action' => 'login']);

            }

        }

    }

    // チャットルーム情報を取得
    public function rooms($user_id = null, $room_id = null)
    {
        // モジュール読み込み
        $this->loadComponent('Common');

        $session_flg = $this->Common->chk_session();

        if($session_flg){

            $session = $this->getRequest()->getSession();

            $login_hojin_id = $session->read('hojin_id');
            $login_user_id = $session->read('user_id');
    
            // 全ユーザーに紐づくルームIDを取得
            $user = $this->Common->get_user($login_hojin_id,$login_user_id);
    
            // メッセージ取得
            if($room_id != null){
                $message_list = $this->Common->get_message($login_hojin_id,$room_id);
            }else{
                $message_list = [];
            }
            
            $this->set('user', $user);
            $this->set('message_list', $message_list);
            $this->set('user_id', $user_id);
            $this->set('room_id', $room_id);
            $this->render('home');

        }else{

            $this->redirect(['controller' => 'Login', 'action' => 'login']);

        }

    }


}
