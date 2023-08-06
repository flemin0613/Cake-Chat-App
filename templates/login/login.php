<?php
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;
?>
<?= $this->Html->css('login.css') ?>


<div class="login-container">
	<h1 class="login-title">Member Login</h1>

	<?= $this->Form->create(null, ['url' => ['controller' => 'Home', 'action' => 'chat'], 'method' => 'post']); ?>

		<!-- メールアドレス -->
		<div class="input-group">
			<label for="email">E-mail</label>
			<input type="text" id="email" name="email" required>
		</div>

		<!-- パスワード -->
		<div class="input-group">
			<label for="password">Password</label>
			<input type="password" id="password" name="password" required>
		</div>

		<button type="submit" class="login-btn">Login</button>
		<input type="hidden" name="_csrfToken" autocomplete="off" value="<?= $this->request->getAttribute('csrfToken') ?>">
	<?= $this->Form->end() ?>
</div>