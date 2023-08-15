<?php
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;
?>

<?= $this->Html->css('home.css') ?>




<div class="chathome">
    <!-- サイドバー -->
    <div class="sidebar">
            <!-- サイドバートップ --> 
            <div class='sidebartop'>
                <h3>ユーザー</h3>
            </div>
            <!-- ユーザー一覧 -->
            <?php foreach($user as $obj): ?>
                <a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'rooms', $obj->USER_ID, $obj->CHATROOM_ID]) ?>">
                    <div class="user room_info">
                        <div class='serverIcon'>
                            <?= $this->Html->image('logo192.png', ['alt' => 'サンプル画像']) ?>
                        </div>

                        <?php if($obj->LOGIN_FLG == "1"){?>
                            <h3 class="name">マイページ</h3>
                        <?php }else{?>
                            <h3 class="name"><?= h($obj->SEI); ?> <?= h($obj->MEI); ?></h3>

                        <?php }?>

                        
                    </div>
                </a>
            <?php endforeach; ?>

    </div>

    <!-- メインチャット画面 -->
    <div id="chat" class='chat'>
        <!-- チャットヘッダー -->
        <!-- <div class='chatheader'>
            <div class='chatheaderleft'>
                <h3>
                    <span class='chatheaderhash'>#</span>
                    Udemy
                </h3>
		    </div>
        </div> -->


        <!-- チャットメッセージ -->
        <div id="chatmessage" class='chatmessage'>
            
            <?php foreach($message_list as $obj): ?>
                <div class='message'>
                    <div class='messageinfo'>
                        <!-- ユーザー名 -->
                        <h4>
                            <?= h($obj->SEI); ?> <?= h($obj->MEI); ?>
                            <span class='messagetimestamp'><?= h($obj->SEND_DATETIME); ?></span>
                        </h4>
                        <!-- メッセージ本文 -->
                        <p><?= h($obj->MESSAGE); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <!-- チャット入力 -->
        <!-- チャット送信はAjaxで実行 -->
        <?php if($input_chat_flg != 0){ ?>
            <div class='chatinput'>
                <form onsubmit="return sendMessage(event)">
                    <input type="text" id="input" placeholder='メッセージを送信' value=""/>
                    <button type="submit" class='chatinputbutton'>
                    送信
                    </button>
                    <?= $this->Form->hidden('user_id', ['value' => $user_id,'id' => 'receive_user_id']) ?>
                    <?= $this->Form->hidden('room_id', ['value' => $room_id,'id' => 'send_room_id']) ?>
                </form>
            </div>
        <?php }?>
    </div>
</div>
<input type="hidden" class="csrfToken" name="_csrfToken" autocomplete="off" value="<?= $this->request->getAttribute('csrfToken') ?>">

<?= $this->Html->script('ajax.js') ?>
<?= $this->Html->script('home.js') ?>



