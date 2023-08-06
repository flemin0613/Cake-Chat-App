<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use App\Controller\Component;

class AjaxController extends AppController
{
    public function initialize(): void
	{
		parent::initialize();

	}
    
    public function ajaxAction()
    {
        // モジュール読み込み
        $this->loadComponent('Common');

        $session = $this->getRequest()->getSession();

        $hojin_id = $session->read('hojin_id');
        $user_id = $session->read('user_id');

        // Ajaxリクエストかどうかをチェック
        if ($this->request->is('ajax')) {

            $dataFromAjax = $this->request->getData();

            $room_id = $dataFromAjax["room_id"];

            // メッセージ取得
            $message_list = $this->Common->get_message($hojin_id,$room_id);


            $response = ['message' => $message_list];


            $this->set(compact('response'));

            // JSON形式に変換
            $this->viewBuilder()->setOption('serialize', 'response'); // JSONレスポンスを返す
        }

    }
}
