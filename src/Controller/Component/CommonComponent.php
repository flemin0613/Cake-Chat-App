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
}