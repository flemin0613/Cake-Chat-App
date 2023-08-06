<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class CommonComponent extends Component
{
	/**
	 * ユーザーを取得
	 *
     * @param   int     $hojin_id
	 * @return	array	全ユーザー取得
	 */
    public function get_user($hojin_id)
    {
        // ユーザーマスタモデルを読み込む
        $MstSyozoku = TableRegistry::getTableLocator()->get('MstSyozoku');
        $user = $MstSyozoku
                ->find('all')
                ->select([
                    'USER_ID' => 'MstUser.USER_ID',
                    'SEI' => 'MstUser.SEI',
                    'MEI' => 'MstUser.MEI'
                ])
                ->leftjoin(['MstUser' => 'mst_user'],[
                    'MstSyozoku.USER_ID = MstUser.USER_ID'
                ])
                ->where(['MstSyozoku.KEIYAKU_CODE' => $hojin_id])
                ->order(['USER_ID' => 'ASC'])
                ->toArray();
        // sqld($user);
        // debug($user);
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
	 * ROOMIDの取得
	 *
     * @param   int     法人ID
     * @param   int  　　ユーザーID
	 * @return	array	ROOMID配列を取得
	 */
    public function get_room_id($hojin_id,$user_id)
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
        

        return $JnlChatroom->toArray();       

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
}