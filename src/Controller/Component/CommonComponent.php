<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Http\Session;

class CommonComponent extends Component
{
	/**
	 * ユーザーを取得
	 *
     * @param   int     $hojin_id
	 * @return	array	全ユーザー取得
	 */
    public function get_user($hojin_id,$user_id)
    {

        // ログインユーザーが参加しているチャットルーム一覧取得
        $SubJnlChatroom = TableRegistry::getTableLocator()->get('JnlChatroom');
        $SubJnlChatroom = $SubJnlChatroom
                        ->find('all')
                        ->select([
                            'CHATROOM_ID' => 'JnlChatroom.CHATROOM_ID',
                        ])
                        ->where(['JnlChatroom.KEIYAKU_CODE' => $hojin_id])                        
                        ->where(['JnlChatroom.USER_ID' => $user_id]);


        // ログインユーザーが参加しているチャットルームの内、自身以外のチャットルームIDを取得
        $JnlChatroom = TableRegistry::getTableLocator()->get('JnlChatroom');
        $JnlChatroom = $JnlChatroom
                        ->find('all')
                        ->select([
                            'CHATROOM_ID' => 'JnlChatroom.CHATROOM_ID',
                            'USER_ID' => 'JnlChatroom.USER_ID',
                        ])
                        ->where(['JnlChatroom.CHATROOM_ID IN' => $SubJnlChatroom])
                        ->where(['JnlChatroom.USER_ID <>' => $user_id]);
                                

        // ユーザーマスタモデルを読み込む
        $MstSyozoku = TableRegistry::getTableLocator()->get('MstSyozoku');
        $user = $MstSyozoku
                ->find('all')
                ->select([
                    'USER_ID' => 'MstUser.USER_ID',
                    'SEI' => 'MstUser.SEI',
                    'MEI' => 'MstUser.MEI',
                    'CHATROOM_ID' => 'chatroom.CHATROOM_ID'
                ])
                ->leftjoin(['MstUser' => 'mst_user'],[
                    'MstSyozoku.USER_ID = MstUser.USER_ID'
                ])
                ->leftjoin(['chatroom' => $JnlChatroom],[
                    'MstSyozoku.USER_ID = chatroom.USER_ID'
                ])
                ->where(['MstSyozoku.KEIYAKU_CODE' => $hojin_id])
                ->order(['USER_ID' => 'ASC'])
                ->toArray();


        return $user;
    }


    /**
	 * ログインユーザーを取得
	 *
     * @param   int     法人ID
     * @param   string  メールアドレス
     * @param   string  PW
	 * @return	array	ログインユーザーを取得
	 */
    public function get_login_user($hojin_id,$mail,$pass)
    {
        $MstSyozoku = TableRegistry::getTableLocator()->get('MstSyozoku');
        $login_user = $MstSyozoku
                      ->find('all')
                      ->select([
                        'KEIYAKU_CODE' => 'MstSyozoku.KEIYAKU_CODE',
                        'USER_ID' => 'MstUser.USER_ID',
                        'SEI' => 'MstUser.SEI',
                        'MEI' => 'MstUser.MEI'
                    ])
                    ->leftjoin(['MstUser' => 'mst_user'],[
                        'MstSyozoku.USER_ID = MstUser.USER_ID'
                    ])
                    ->where(['MstSyozoku.KEIYAKU_CODE' => $hojin_id])
                    ->where(['MstUser.MAIL_ADDRESS' => $mail])
                    ->where(['MstUser.USER_LOGIN_PW' => $pass]);
    
        return $login_user->toArray()[0];
    }


    /**
	 * メッセージの取得
	 *
     * @param   int     法人ID
     * @param   int  　　ルームID
	 * @return	array	メッセージ配列を取得
	 */
    public function get_message($hojin_id,$room_id)
    {

        $JnlMessage = TableRegistry::getTableLocator()->get('JnlMessage');
        $JnlMessage = $JnlMessage
                      ->find('all')
                      ->select([
                        'MESSAGE_ID' => 'JnlMessage.MESSAGE_ID',
                        'SEND_DATETIME' => 'JnlMessage.SEND_DATETIME',
                        'MESSAGE' => 'JnlMessage.MESSAGE',
                        'SEND_USER_ID' => 'JnlMessage.SEND_USER_ID',
                        'SEI' => 'MstUser.SEI',
                        'MEI' => 'MstUser.MEI',
                    ])
                    ->leftjoin(['MstUser' => 'mst_user'],[
                        'JnlMessage.SEND_USER_ID = MstUser.USER_ID'
                    ])
                    ->where(['JnlMessage.KEIYAKU_CODE' => $hojin_id])  
                    ->where(['JnlMessage.CHATROOM_ID' => $room_id]);

        return $JnlMessage->toArray();
                
    }


    /**
	 * メッセージ登録
	 *
     * @param   model   採番モデル
     * @param   model   採番エンティティ
     * @param   model   採番データ
     * @param   model   メッセージモデル
     * @param   model   メッセージエンティティ
	 */
    public function regist_message($FilSaiban_table,$FilSaiban_record,$saiban_data,$JnlMessage_table,$JnlMessage_record)
    {
		//テーブル操作用変数
		$connection = ConnectionManager::get('default');
		$is_error = false;
		$errors = array();
		// トランザクション開始
		$connection->begin();

		try
		{	
            // 採番テーブル　採番
            $FilSaiban_record = $FilSaiban_table->patchEntity($FilSaiban_record, $saiban_data);
            $FilSaiban_table->save($FilSaiban_record);

            // メッセージ登録
            $JnlMessage_table->save($JnlMessage_record);

            if(!$is_error)
			{	
				$connection->commit();
			}
			else
			{
				$connection->rollback();
			}
        }
		catch(\Exception $e)
		{
			$is_error = true;
			$connection->rollback();
		}

    }


    public function chk_session()
    {
        $session = new Session();
        $chk_hojin_id = $session->check('hojin_id');

        return $chk_hojin_id;
    }











}