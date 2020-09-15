<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Jushoroku Model
 *
 * @method \App\Model\Entity\Jushoroku get($primaryKey, $options = [])
 * @method \App\Model\Entity\Jushoroku newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Jushoroku[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Jushoroku|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Jushoroku saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Jushoroku patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Jushoroku[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Jushoroku findOrCreate($search, callable $callback = null, $options = [])
 */
class JushorokuTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('jushoroku');
        $this->setDisplayField('name');
        $this->setPrimaryKey('ID');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('ID')
            ->allowEmptyString('ID', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('furigana')
            ->maxLength('furigana', 100)
            ->requirePresence('furigana', 'create')
            ->notEmptyString('furigana');

        $validator
            ->scalar('post')
            ->maxLength('post', 8)
            ->requirePresence('post', 'create')
            ->notEmptyString('post');

        $validator
            ->scalar('address')
            ->maxLength('address', 200)
            ->requirePresence('address', 'create')
            ->notEmptyString('address');

        return $validator;
    }
}
