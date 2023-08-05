<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * JnlMessage Model
 *
 * @method \App\Model\Entity\JnlMessage newEmptyEntity()
 * @method \App\Model\Entity\JnlMessage newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\JnlMessage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\JnlMessage get($primaryKey, $options = [])
 * @method \App\Model\Entity\JnlMessage findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\JnlMessage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\JnlMessage[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\JnlMessage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\JnlMessage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\JnlMessage[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\JnlMessage[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\JnlMessage[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\JnlMessage[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class JnlMessageTable extends Table
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

        $this->setTable('jnl_message');
        $this->setDisplayField(['KEIYAKU_CODE', 'CHATROOM_ID', 'MESSAGE_ID']);
        $this->setPrimaryKey(['KEIYAKU_CODE', 'CHATROOM_ID', 'MESSAGE_ID']);
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
            ->dateTime('SEND_DATETIME')
            ->allowEmptyDateTime('SEND_DATETIME');

        $validator
            ->scalar('MESSAGE')
            ->maxLength('MESSAGE', 10000)
            ->allowEmptyString('MESSAGE');

        $validator
            ->integer('SEND_USER_ID')
            ->allowEmptyString('SEND_USER_ID');

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
