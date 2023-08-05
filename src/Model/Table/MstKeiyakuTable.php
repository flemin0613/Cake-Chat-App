<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MstKeiyaku Model
 *
 * @method \App\Model\Entity\MstKeiyaku newEmptyEntity()
 * @method \App\Model\Entity\MstKeiyaku newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\MstKeiyaku[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MstKeiyaku get($primaryKey, $options = [])
 * @method \App\Model\Entity\MstKeiyaku findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\MstKeiyaku patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MstKeiyaku[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MstKeiyaku|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MstKeiyaku saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MstKeiyaku[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MstKeiyaku[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\MstKeiyaku[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MstKeiyaku[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class MstKeiyakuTable extends Table
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

        $this->setTable('mst_keiyaku');
        $this->setDisplayField('KEIYAKU_CODE');
        $this->setPrimaryKey('KEIYAKU_CODE');
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
            ->scalar('KEIYAKU_NAME')
            ->maxLength('KEIYAKU_NAME', 20)
            ->allowEmptyString('KEIYAKU_NAME');

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
