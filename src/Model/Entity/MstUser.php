<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MstUser Entity
 *
 * @property int $USER_ID
 * @property string|null $KENGEN
 * @property string|null $USER_LOGIN_PW
 * @property string|null $SEI
 * @property string|null $MEI
 * @property string|null $SEI_K
 * @property string|null $MEI_K
 * @property string|null $MAIL_ADDRESS
 * @property string|null $GENDER_CD
 * @property \Cake\I18n\FrozenDate|null $BIRTH_DAY
 * @property int|null $HYOUJI_JYUN
 * @property string|null $DEL_FG
 * @property string|null $IKO_KBN
 * @property string|null $CREATE_PC
 * @property string|null $CREATE_PG
 * @property \Cake\I18n\FrozenTime|null $CREATE_DATETIME
 * @property string|null $UPDATE_PC
 * @property string|null $UPDATE_PG
 * @property \Cake\I18n\FrozenTime|null $UPDATE_DATETIME
 */
class MstUser extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'KENGEN' => true,
        'USER_LOGIN_PW' => true,
        'SEI' => true,
        'MEI' => true,
        'SEI_K' => true,
        'MEI_K' => true,
        'MAIL_ADDRESS' => true,
        'GENDER_CD' => true,
        'BIRTH_DAY' => true,
        'HYOUJI_JYUN' => true,
        'DEL_FG' => true,
        'IKO_KBN' => true,
        'CREATE_PC' => true,
        'CREATE_PG' => true,
        'CREATE_DATETIME' => true,
        'UPDATE_PC' => true,
        'UPDATE_PG' => true,
        'UPDATE_DATETIME' => true,
    ];
}
