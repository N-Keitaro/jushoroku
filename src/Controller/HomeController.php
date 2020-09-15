<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

class HomeController extends AppController{

	public function initialize(){
		$this->viewBuilder()->setLayout('Home');
	}

	public function index(){

		$title = "住所録WEBアプリ";

		$maxnum = 10;

		$this->set('title', $title);
		$this->set('maxnum', $maxnum);
	}

	public function edit()
    {
		$title = "編集";

		$this->set('title', $title);
    }

	public function editCheck()
    {
		$title = "しばらくお待ちください...";

		$this->set('title', $title);
    }

	public function regist()
    {
		$title = "新規登録";

		$this->set('title', $title);
    }

	public function registCheck()
    {
		$title = "しばらくお待ちください...";

		$this->set('title', $title);
    }

	public function delete()
    {
		$title = "削除";

		$this->set('title', $title);
    }

	public function deleteCheck()
    {
		$title = "しばらくお待ちください...";

		$this->set('title', $title);
    }


}