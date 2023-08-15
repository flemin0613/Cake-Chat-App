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


        // ログインユーザーを取得
        $login_user = $this->Common->get_login_user('1',$_POST['email'],$_POST['password']);

        // if($referer="/"){
        $session = $this->getRequest()->getSession();

        if(empty($login_user)){

            $this->redirect(['controller' => 'Login', 'action' => 'login']);

        }else{

            // 法人ID・ユーザーIDをセッション領域に格納する
            $session->write('hojin_id', $login_user->KEIYAKU_CODE);
            $session->write('user_id', $login_user->USER_ID);
            $session->write('user_data', $login_user);

            // チャットルーム作成処理
            $this->Common->make_chat_room('1',$login_user->USER_ID);
    
            // 全ユーザーに紐づくルームIDを取得
            $user = $this->Common->get_user('1',$login_user->USER_ID);
            
            foreach ($user as $key => $value) {
                
                if($value["USER_ID"] == $login_user->USER_ID){
                    $user[$key]["LOGIN_FLG"] = "1";
                }else{
                    $user[$key]["LOGIN_FLG"] = "0";
                }

            }
                
            $user_id = null;
            $room_id = null;
            $message_list = [];
            $input_chat_flg = 0;
    
            $this->set('user', $user);
            $this->set('user_id', $user_id);
            $this->set('room_id', $room_id);
            $this->set('message_list', $message_list);
            $this->set('input_chat_flg', $input_chat_flg);
            $this->render('home');

        }
        // }
        // }else{

        //     $session_flg = $this->Common->chk_session();
            
        //     if($session_flg){

        //         $session = $this->getRequest()->getSession();

        //         // ログインユーザーを取得
        //         $login_user = $this->Common->get_login_user('1',$_POST['email'],$_POST['password']);

        //         dd($login_user);
        
        //         // 法人ID・ユーザーIDをセッション領域に格納する
        //         $session->write('hojin_id', $login_user->KEIYAKU_CODE);
        //         $session->write('user_id', $login_user->USER_ID);
        //         $session->write('user_data', $login_user);
        
        //         // 全ユーザーに紐づくルームIDを取得
        //         $user = $this->Common->get_user('1',$login_user->USER_ID);
        //         foreach ($user as $key => $value) {
                
        //             if($value["USER_ID"] == $login_user->USER_ID){
        //                 $user[$key]["LOGIN_FLG"] = "1";
        //             }else{
        //                 $user[$key]["LOGIN_FLG"] = "0";
        //             }
        //         }
        //         $user_id = null;
        //         $room_id = null;
        //         $message_list = [];
        
        //         $this->set('user', $user);
        //         $this->set('user_id', $user_id);
        //         $this->set('room_id', $room_id);
        //         $this->set('message_list', $message_list);
        //         $this->render('home');

        //     }else{

        //         $this->redirect(['controller' => 'Login', 'action' => 'login']);

        //     }

        // }

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
            foreach ($user as $key => $value) {
                
                if($value["USER_ID"] == $login_user_id ){
                    $user[$key]["LOGIN_FLG"] = "1";
                }else{
                    $user[$key]["LOGIN_FLG"] = "0";
                }
            }
            // メッセージ取得
            if($room_id != null){
                $message_list = $this->Common->get_message($login_hojin_id,$room_id);
            }else{
                $message_list = [];
            }
            
            $input_chat_flg = 1;
            $this->set('user', $user);
            $this->set('message_list', $message_list);
            $this->set('user_id', $user_id);
            $this->set('room_id', $room_id);
            $this->set('input_chat_flg', $input_chat_flg);
            $this->render('home');

        }else{

            $this->redirect(['controller' => 'Login', 'action' => 'login']);

        }

    }


}
