<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use App\Controller\Component;

class HomeController extends AppController
{
    public function initialize(): void
	{
		parent::initialize();

	}
    
    public function home()
    {
        // モジュール読み込み
        $this->loadComponent('Common');
        
        $user = $this->Common->get_user('1');

        $this->set('user', $user);
        $this->render('home');
    }
}
