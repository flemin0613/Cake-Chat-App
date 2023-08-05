<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * JnlChatroom Model
 *
 * @method \App\Model\Entity\JnlChatroom newEmptyEntity()
 * @method \App\Model\Entity\JnlChatroom newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\JnlChatroom[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\JnlChatroom get($primaryKey, $options = [])
 * @method \App\Model\Entity\JnlChatroom findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\JnlChatroom patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\JnlChatroom[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\JnlChatroom|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\JnlChatroom saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\JnlChatroom[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\JnlChatroom[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\JnlChatroom[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\JnlChatroom[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class JnlChatroomTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('jnl_chatroom');
        $this->setDisplayField(['KEIYAKU_CODE', 'CHATROOM_ID', 'USER_ID']);
        $this->setPrimaryKey(['KEIYAKU_CODE', 'CHATROOM_ID', 'USER_ID']);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('CHAT_KBN')
            ->maxLength('CHAT_KBN', 1)
            ->allowEmptyString('CHAT_KBN');

        $validator
            ->scalar('GROUP_NAME')
            ->maxLength('GROUP_NAME', 20)
            ->allowEmptyString('GROUP_NAME');

        $validator
            ->scalar('SEI')
            ->maxLength('SEI', 20)
            ->allowEmptyString('SEI');

        $validator
            ->scalar('MEI')
            ->maxLength('MEI', 20)
            ->allowEmptyString('MEI');

        $validator
            ->scalar('PIN_DOME_FG')
            ->maxLength('PIN_DOME_FG', 1)
            ->allowEmptyString('PIN_DOME_FG');

        $validator
            ->integer('HYOUJI_JYUN')
            ->allowEmptyString('HYOUJI_JYUN');

        $validator
            ->scalar('DEL_FG')
            ->maxLength('DEL_FG', 1)
            ->allowEmptyString('DEL_FG');

        $validator
            ->scalar('IKO_KBN')
            ->maxLength('IKO_KBN', 1)
            ->allowEmptyString('IKO_KBN');

        $validator
            ->scalar('CREATE_PC')
            ->maxLength('CREATE_PC', 20)
            ->allowEmptyString('CREATE_PC');

        $validator
            ->scalar('CREATE_PG')
            ->maxLength('CREATE_PG', 10)
            ->allowEmptyString('CREATE_PG');

        $validator
            ->dateTime('CREATE_DATETIME')
            ->allowEmptyDateTime('CREATE_DATETIME');

        $validator
            ->scalar('UPDATE_PC')
            ->maxLength('UPDATE_PC', 20)
            ->allowEmptyString('UPDATE_PC');

        $validator
            ->scalar('UPDATE_PG')
            ->maxLength('UPDATE_PG', 10)
            ->allowEmptyString('UPDATE_PG');

        $validator
            ->dateTime('UPDATE_DATETIME')
            ->allowEmptyDateTime('UPDATE_DATETIME');

        return $validator;
    }
}
