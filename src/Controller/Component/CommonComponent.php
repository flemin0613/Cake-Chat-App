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





}