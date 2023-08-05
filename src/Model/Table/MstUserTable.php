<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MstUser Model
 *
 * @method \App\Model\Entity\MstUser newEmptyEntity()
 * @method \App\Model\Entity\MstUser newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\MstUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MstUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\MstUser findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\MstUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MstUser[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MstUser|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MstUser saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MstUser[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MstUser[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\MstUser[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MstUser[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class MstUserTable extends Table
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

        $this->setTable('mst_user');
        $this->setDisplayField('USER_ID');
        $this->setPrimaryKey('USER_ID');
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
            ->scalar('KENGEN')
            ->maxLength('KENGEN', 1)
            ->allowEmptyString('KENGEN');

        $validator
            ->scalar('USER_LOGIN_PW')
            ->maxLength('USER_LOGIN_PW', 100)
            ->allowEmptyString('USER_LOGIN_PW');

        $validator
            ->scalar('SEI')
            ->maxLength('SEI', 20)
            ->allowEmptyString('SEI');

        $validator
            ->scalar('MEI')
            ->maxLength('MEI', 20)
            ->allowEmptyString('MEI');

        $validator
            ->scalar('SEI_K')
            ->maxLength('SEI_K', 20)
            ->allowEmptyString('SEI_K');

        $validator
            ->scalar('MEI_K')
            ->maxLength('MEI_K', 20)
            ->allowEmptyString('MEI_K');

        $validator
            ->scalar('MAIL_ADDRESS')
            ->maxLength('MAIL_ADDRESS', 100)
            ->allowEmptyString('MAIL_ADDRESS');

        $validator
            ->scalar('GENDER_CD')
            ->maxLength('GENDER_CD', 1)
            ->allowEmptyString('GENDER_CD');

        $validator
            ->date('BIRTH_DAY')
            ->allowEmptyDate('BIRTH_DAY');

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
