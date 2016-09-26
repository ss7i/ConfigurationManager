<?php
/**
 * Uskur
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Uskur (http://uskur.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
namespace Uskur\ConfigurationManager\Controller;

use Uskur\ConfigurationManager\Controller\AppController;
use Cake\Core\Configure;

/**
 * Configurations Controller
 *
 * @property \Uskur\ConfigurationManager\Model\Table\ConfigurationsTable $Configurations
 */
class ConfigurationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
    	if(isset($this->request->query['category']) && !empty($this->request->query['category'])){
    		$this->paginate['conditions']['category'] = $this->request->query['category'];
    	}
    	
    	if(isset($this->request->query['name']) && !empty($this->request->query['name'])){
    		$this->paginate['conditions']['name'] = $this->request->query['name'];
    	}
    	
        $configurations = $this->paginate($this->Configurations);
        $categories = array_combine(Configure::read('ConfigurationManager.categories'),Configure::read('ConfigurationManager.categories'));

        $this->set(compact('configurations','categories'));
        $this->set('_serialize', ['configurations']);
    }

    /**
     * View method
     *
     * @param string|null $id Configuration id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $configuration = $this->Configurations->get($id, [
            'contain' => []
        ]);

        $this->set('configuration', $configuration);
        $this->set('_serialize', ['configuration']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $configuration = $this->Configurations->newEntity();
        if ($this->request->is('post')) {
            $configuration = $this->Configurations->patchEntity($configuration, $this->request->data);
            if ($this->Configurations->save($configuration)) {
                $this->Flash->success(__('The configuration has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The configuration could not be saved. Please, try again.'));
            }
        }
        $categories = array_combine(Configure::read('ConfigurationManager.categories'),Configure::read('ConfigurationManager.categories'));
        $types = array_combine($this->Configurations->types, $this->Configurations->types);
        $this->set(compact('configuration','categories','types'));
        $this->set('_serialize', ['configuration']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Configuration id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $configuration = $this->Configurations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $configuration = $this->Configurations->patchEntity($configuration, $this->request->data);
            if ($this->Configurations->save($configuration)) {
                $this->Flash->success(__('The configuration has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The configuration could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('configuration'));
        $this->set('_serialize', ['configuration']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Configuration id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $configuration = $this->Configurations->get($id);
        if ($this->Configurations->delete($configuration)) {
            $this->Flash->success(__('The configuration has been deleted.'));
        } else {
            $this->Flash->error(__('The configuration could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function install()
    {
    	$this->Configurations->install();
    	$this->Flash->success(__('The default configurations have been installed.'));
    	return $this->redirect(['action'=>'index']);
    }
}
