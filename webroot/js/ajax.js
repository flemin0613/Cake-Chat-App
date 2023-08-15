
var csrfToken =  $('.csrfToken').val();

// メッセージ情報を取得する
// $('.room_info').click(function(e) {

// 	// クリックされた要素のroom_idを取得
// 	var room_id = $(this).find('.room_id').val();

// 	// デフォルトのイベント動作をキャンセル
// 	e.preventDefault();

// 	$.ajax({
// 		url: '/ajax/dispmessage', // Ajaxリクエストを処理するURL
// 		type: 'post',
// 		dataType: 'json',
// 		headers: {
// 		'X-CSRF-Token': csrfToken
// 		},
// 		data : {
// 		room_id : room_id, 
// 		},
// 		success: function(response) {
// 		// Ajaxリクエストが成功した場合の処理
// 		$('.chatmessage').empty();

// 		// メッセージループし、要素を追加する
// 		response["message"].forEach(function(message) {

// 			var newElement = `<div class='message'>
// 								<div class='messageinfo'>
// 									<h4>` + message["SEI"] + " " + message["MEI"] + `
// 										<span class='messagetimestamp'>` + message["SEND_DATETIME"] + `</span>
// 									</h4>
// 									<p>` + message["MESSAGE"] + `</p>
// 								</div>
// 								</div>
// 							`;
// 			$('.chatmessage').append(newElement);
// 		});
// 		},
// 		error: function(xhr, status, error) {
// 		// Ajaxリクエストがエラーの場合の処理
// 		console.error(xhr.responseText);
// 		}
// 	});
// });






// メッセージ情報を送信する
function sendMessage(e) {

	try {
		e.preventDefault();

		var inputValue = $("#input").val();
		var room_id = $("#send_room_id").val();
		var receive_user_id = $("#receive_user_id").val();

		$.ajax({
			url: '/ajax/sendmessage', // Ajaxリクエストを処理するURL
			type: 'post',
			dataType: 'json',
			headers: {
			  'X-CSRF-Token': csrfToken
			},
			data : {
			  room_id : room_id, 
			  receive_user_id: receive_user_id,
			  message : inputValue, 
			},
			success: function(response) {

				// 要素を自動生成する
				var newElement = `<div class='message'>
									<div class='messageinfo'>
										<h4>` + response["SEI"] + " " + response["MEI"] + `
											<span class='messagetimestamp'>` + response["SEND_DATETIME"] + `</span>
										</h4>
										<p>` + response["MESSAGE"] + `</p>
									</div>
									</div>
								`;
				$('.chatmessage').append(newElement);

				var scrollableDiv = document.getElementById('chatmessage');
				scrollableDiv.scrollTop = scrollableDiv.scrollHeight;

				// 入力項目をクリアする
				$('#input').val('');

			},
			error: function(xhr, status, error) {
				// Ajaxリクエストがエラーの場合の処理
				console.error(xhr.responseText);
			}
		  });


		return false;
	} catch(error){

		console.log(error);
		return false;
	}

  }