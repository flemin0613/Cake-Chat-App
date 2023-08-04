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

            <div class="user">
                <div class='serverIcon'>
                    <?= $this->Html->image('logo192.png', ['alt' => 'サンプル画像']) ?>
                </div>
                <h3 class="name">名前１</h3>
            </div>

            <div class="user">
                <div class='serverIcon'>
                    <?= $this->Html->image('logo192.png', ['alt' => 'サンプル画像']) ?>
                </div>
                <h3 class="name">名前１</h3>
            </div>

            <div class="user">
                <div class='serverIcon'>
                    <?= $this->Html->image('logo192.png', ['alt' => 'サンプル画像']) ?>
                </div>
                <h3 class="name">名前１</h3>
            </div>



    </div>

    <!-- メインチャット画面 -->
    <div class='chat'>
        <!-- チャットヘッダー -->
        <div class='chatheader'>
            <div class='chatheaderleft'>
                <h3>
                    <span class='chatheaderhash'>#</span>
                    Udemy
                </h3>
		    </div>
        </div>


        <!-- チャットメッセージ -->
        <div class='chatmessage'>
            <div class='message'>
                <div class='messageinfo'>
                <h4>
                Shin Code
                <span class='messagetimestamp'>2022/12/18</span>
                </h4>

                <p>メッセージ本文</p>
                </div>
            </div>
        </div>

        <!-- チャット入力 -->
        <div class='chatinput'>
            <form>
                <input type="text" placeholder='#udemyへメッセージを送信' />
                <button type="submit" class='chatinputbutton'>
                送信
                </button>
            </form>
        </div>

    </div>
</div>





