$(document).ready(function() {

	var csrfToken =  $('.csrfToken').val();

	// メッセージ情報を取得する
	$('.room_info').click(function(e) {

		// クリックされた要素のroom_idを取得
		var room_id = $(this).find('.room_id').val();

		// デフォルトのイベント動作をキャンセル
		e.preventDefault();

		$.ajax({
		  url: '/ajax/ajaxAction', // Ajaxリクエストを処理するURL
		  type: 'post',
		  dataType: 'json',
		  headers: {
			'X-CSRF-Token': csrfToken
		  },
		  data : {
			room_id : room_id, 
		  },
		  success: function(response) {
		    // Ajaxリクエストが成功した場合の処理
		    // console.log(response["message"]);

			$('.chatmessage').empty();

			// メッセージループし、要素を追加する
			response["message"].forEach(function(message) {

				var newElement = `<div class='message'>
									<div class='messageinfo'>
										<h4>` + message["SEI"] + " " + message["MEI"] + `
											<span class='messagetimestamp'>` + message["SEND_DATETIME"] + `</span>
										</h4>
										<p>` + message["MESSAGE"] + `</p>
								  	</div>
								  </div>
								`;
				$('.chatmessage').append(newElement);

				console.log(message);
			});


		  },
		  error: function(xhr, status, error) {
		    // Ajaxリクエストがエラーの場合の処理
		    console.error(xhr.responseText);
		  }
		});
		
	});
	

});