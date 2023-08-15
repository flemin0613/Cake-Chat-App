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

    // メッセージ送信
    public function sendmessage()
    {
        // モジュール読み込み
        $this->loadComponent('Common');
        $this->loadComponent('Transaction');
        $session = $this->getRequest()->getSession();

        $login_hojin_id = $session->read('hojin_id');
        $login_user_id = $session->read('user_id');
        $user_data = $session->read('user_data');

 

        // Ajaxリクエストかどうかをチェック
        if ($this->request->is('ajax')) {

            $dataFromAjax = $this->request->getData();
            $message = $dataFromAjax["message"];
            $room_id = $dataFromAjax["room_id"];
            $receive_user_id = $dataFromAjax["receive_user_id"];

            try {
                $this->Transaction->beginTransaction();





                // if($room_id==""){

                //     // チャットルーム採番データ準備
                //     $FilSaiban_chatroomid_table = TableRegistry::getTableLocator()->get('FilSaiban');
                //     $FilSaiban_chatroomid_record = $FilSaiban_chatroomid_table
                //                 ->find('all')
                //                 ->where(['SAIBAN_CODE' => '3'])->toArray()[0];

                //     $next_chatroomid_saiban = intval($FilSaiban_chatroomid_record["SAIBAN_NO"]) + 1;
                //     $chatroomid_saiban_data = [];
                //     $chatroomid_saiban_data["SAIBAN_CODE"] = "3";
                //     $chatroomid_saiban_data["SAIBAN_NO"] = $next_chatroomid_saiban;

                //     // チャットルーム採番テーブル　採番
                //     $FilSaiban_chatroomid_record = $FilSaiban_chatroomid_table->patchEntity($FilSaiban_chatroomid_record, $chatroomid_saiban_data);
                //     $FilSaiban_chatroomid_table->save($FilSaiban_chatroomid_record);

                //     // チャットルームジャーナル準備
                //     $JnlChatroom_table = TableRegistry::getTableLocator()->get('JnlChatroom');
                //     $JnlChatroom_record = $JnlChatroom_table->newEmptyEntity();
                //     $JnlChatroom_record['KEIYAKU_CODE'] = $login_hojin_id;
                //     $JnlChatroom_record['CHATROOM_ID'] = $next_chatroomid_saiban;
                //     $JnlChatroom_record['USER_ID'] = $login_user_id;
                //     $JnlChatroom_record['CHAT_KBN'] = "1";
                //     $JnlChatroom_record['SEI'] = $user_data["SEI"];
                //     $JnlChatroom_record['MEI'] = $user_data["MEI"];

                //     $JnlChatroom_table->save($JnlChatroom_record);


                //     // 受信側のユーザー取得
                //     $receive_user = $this->Common->get_specification_user($login_hojin_id, $receive_user_id);


                //     // 受信側のチャットルームレコード作成
                //     $JnlChatroom_table = TableRegistry::getTableLocator()->get('JnlChatroom');
                //     $JnlChatroom_record = $JnlChatroom_table->newEmptyEntity();
                //     $JnlChatroom_record['KEIYAKU_CODE'] = $login_hojin_id;
                //     $JnlChatroom_record['CHATROOM_ID'] = $next_chatroomid_saiban;
                //     $JnlChatroom_record['USER_ID'] = $receive_user_id;
                //     $JnlChatroom_record['CHAT_KBN'] = "1";
                //     $JnlChatroom_record['SEI'] = $receive_user["SEI"];
                //     $JnlChatroom_record['MEI'] = $receive_user["MEI"];

                //     $JnlChatroom_table->save($JnlChatroom_record);

                //     $room_id = $next_chatroomid_saiban;
                // }
    
                // -----------------------------------------------------------------------------------------------------------
                // メッセージ採番データ準備
                $FilSaiban_message_table = TableRegistry::getTableLocator()->get('FilSaiban');
                $FilSaiban_message_record = $FilSaiban_message_table
                            ->find('all')
                            ->where(['SAIBAN_CODE' => '2'])->toArray()[0];

                $next_saiban = intval($FilSaiban_message_record["SAIBAN_NO"]) + 1;
                $saiban_data = [];
                $saiban_data["SAIBAN_CODE"] = "2";
                $saiban_data["SAIBAN_NO"] = $next_saiban;

                // 採番テーブル　採番
                $FilSaiban_message_record = $FilSaiban_message_table->patchEntity($FilSaiban_message_record, $saiban_data);
                $FilSaiban_message_table->save($FilSaiban_message_record);
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

                // メッセージ登録
                $JnlMessage_table->save($JnlMessage_record);
                // -----------------------------------------------------------------------------------------------------------


                $this->Transaction->commitTransaction();


                $response = [
                    'SEI' => $user_data["SEI"],
                    'MEI' => $user_data["MEI"],
                    'MESSAGE' => $message,
                    'SEND_DATETIME' => $current_date_time,
    
                ];
    
    
                $this->set('response', $response);
                // JSON形式に変換
                $this->viewBuilder()->setOption('serialize', 'response'); // JSONレスポンスを返す



            } catch (\Exception $e) {
                dd($e);
                $this->Transaction->rollbackTransaction();
            }




        }


    }
}
