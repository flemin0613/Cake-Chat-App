<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use App\Controller\Component;
use Cake\ORM\TableRegistry;

class AjaxController extends AppController
{
    public function initialize(): void
	{
		parent::initialize();

	}
    
    public function dispmessage()
    {
        // モジュール読み込み
        $this->loadComponent('Common');

        $session = $this->getRequest()->getSession();

        $hojin_id = $session->read('hojin_id');
        $user_id = $session->read('user_id');


        // Ajaxリクエストかどうかをチェック
        if ($this->request->is('ajax')) {

            $dataFromAjax = $this->request->getData();

            $room_id = $dataFromAjax["room_id"];

            // メッセージ取得
            $message_list = $this->Common->get_message($hojin_id,$room_id);


            $response = ['message' => $message_list];


            $this->set(compact('response'));

            // JSON形式に変換
            $this->viewBuilder()->setOption('serialize', 'response'); // JSONレスポンスを返す
        }

    }

    public function sendmessage()
    {
        // モジュール読み込み
        $this->loadComponent('Common');

        $session = $this->getRequest()->getSession();

        $login_hojin_id = $session->read('hojin_id');
        $login_user_id = $session->read('user_id');
        $user_data = $session->read('user_data');

        // Ajaxリクエストかどうかをチェック
        if ($this->request->is('ajax')) {

            $dataFromAjax = $this->request->getData();


            $message = $dataFromAjax["message"];
            $room_id = $dataFromAjax["room_id"];


            // -----------------------------------------------------------------------------------------------------------
            // 採番データ準備
            $FilSaiban_table = TableRegistry::getTableLocator()->get('FilSaiban');
            $FilSaiban_record = $FilSaiban_table
                          ->find('all')
                          ->where(['SAIBAN_CODE' => '2'])->toArray()[0];

            $next_saiban = intval($FilSaiban_record["SAIBAN_NO"]) + 1;
            $saiban_data = [];
            $saiban_data["SAIBAN_CODE"] = "2";
            $saiban_data["SAIBAN_NO"] = $next_saiban;
            // -----------------------------------------------------------------------------------------------------------



            // -----------------------------------------------------------------------------------------------------------
            // メッセージデータ準備
            $current_date_time = date('Y-m-d H:i:s');
            $JnlMessage_table = TableRegistry::getTableLocator()->get('JnlMessage');
            $JnlMessage_record = $JnlMessage_table->newEmptyEntity();

            $JnlMessage_record['KEIYAKU_CODE'] = $login_hojin_id;
            $JnlMessage_record['CHATROOM_ID'] = $room_id;
            $JnlMessage_record['MESSAGE_ID'] = $next_saiban;
            $JnlMessage_record['SEND_DATETIME'] = $current_date_time;
            $JnlMessage_record['MESSAGE'] = $message;
            $JnlMessage_record['SEND_USER_ID'] = $login_user_id;
            // -----------------------------------------------------------------------------------------------------------

            // 採番データ＆メッセージデータ登録
            $this->Common->regist_message($FilSaiban_table,$FilSaiban_record,$saiban_data,$JnlMessage_table,$JnlMessage_record);


            $response = [
                'SEI' => $user_data["SEI"],
                'MEI' => $user_data["MEI"],
                'MESSAGE' => $message,
                'SEND_DATETIME' => $current_date_time,

            ];


            $this->set('response', $response);
            // JSON形式に変換
            $this->viewBuilder()->setOption('serialize', 'response'); // JSONレスポンスを返す


        }


    }
}
