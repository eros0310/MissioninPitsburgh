$(document).ready(function(){
	$('#logForm').on('submit', function(e){
		e.preventDefault();
		$.ajax({
			url: 'login.php',
			type: 'POST',
			success: function(response){
				console.log(response);
			},
			error: function(response){
				alert('有錯誤發生，請刷新后重試');
			},
			cache: false,
			data:{
				email: $('#logEmail').val(),
				pwd: $('#logPassword').val()
			}
		});
	});
	//for password retrieval
	$('#retrievePwd').on('click', function(){
		var address = prompt("請輸入你的電子郵箱地址");
		if (address != null){
			//Server script to process data
			$.ajax({
				url: 'pwdRecover.php',
				type: 'POST',
				success: function(response){
					console.log(response);
				},
				error: function(response){
					alert('有錯誤發生，請刷新頁面后重試。');
				},
				cache: false,
				data:{add:address}
			});
		}
	})
})