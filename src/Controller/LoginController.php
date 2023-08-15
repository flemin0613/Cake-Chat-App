<?php	
declare(strict_types=1);	
	
namespace App\Controller;	
use Cake\Core\Configure;	
use Cake\Http\Exception\ForbiddenException;	
use Cake\Http\Exception\NotFoundException;	
use Cake\Http\Response;	
use Cake\View\Exception\MissingTemplateException;	
	
class LoginController extends AppController	
{	
    public function login()	
    {	
        // セッション削除
        $session = $this->getRequest()->getSession();
        $session->destroy();

        $this->render('login');	
    }	
}	
