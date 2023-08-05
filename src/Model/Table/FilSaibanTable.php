<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FilSaiban Model
 *
 * @method \App\Model\Entity\FilSaiban newEmptyEntity()
 * @method \App\Model\Entity\FilSaiban newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\FilSaiban[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FilSaiban get($primaryKey, $options = [])
 * @method \App\Model\Entity\FilSaiban findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\FilSaiban patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FilSaiban[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\FilSaiban|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FilSaiban saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FilSaiban[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FilSaiban[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\FilSaiban[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FilSaiban[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FilSaibanTable extends Table
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

        $this->setTable('fil_saiban');
        $this->setDisplayField('SAIBAN_CODE');
        $this->setPrimaryKey('SAIBAN_CODE');
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
            ->scalar('SAIBAN_NAME')
            ->maxLength('SAIBAN_NAME', 30)
            ->allowEmptyString('SAIBAN_NAME');

        $validator
            ->decimal('SAIBAN_NO')
            ->allowEmptyString('SAIBAN_NO');

        $validator
            ->scalar('BIKO1')
            ->maxLength('BIKO1', 20)
            ->allowEmptyString('BIKO1');

        $validator
            ->scalar('BIKO2')
            ->maxLength('BIKO2', 20)
            ->allowEmptyString('BIKO2');

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
