$(document).ready(function(){
	//hide all error info at the beginning
	cleanError();
	//clear error msg on re-selecting info from dropdown list
	$('body').on('click', '.require', function(){
		$(this).closest('.form-group').find('.help-block').addClass('hide');
	})
	//clear old password upon re-entering password
	$('body').on('focus', '#2, #29', function(){
		if(!($('#29').closest('.form-group').find('.help-block').hasClass('hide'))){
			$('#2, #29').val('');
			$('#29').closest('.form-group').find('.help-block').addClass('hide');
		}
	})
	//clear error msgs upon re-entering numbers
	$('body').on('focus', '#9, #10', function(){
		var errorMsg = $(this).closest('.form-group').find('.help-block');
		if(!errorMsg.hasClass('hide')){
			errorMsg.addClass('hide');
		}
	})
	//clear all error msgs
	function cleanError(){
		$('body').find('.help-block').addClass('hide');
	}
	//if pick-up and/or hosting is required show flight info panel
	$('#optionsRadios3, #optionsRadios5').on('click', function(){
		if($(this).is(':checked')){
			$("#23, #24, #25").prop('required',true);
			$("#26, #27").addClass('require');
		}
	})
	//resume default setting
	$('#optionsRadios4, #optionsRadios6').on('click', function(){
		if($('#optionsRadios4').is(':checked') && $('#optionsRadios6').is(':checked')){
			$("#23, #24, #25").prop('required',false);
			$("#26, #27").removeClass('require');
			$("#23, #24, #25").val('');
			$("#26").find('.content').text(' Number of luggages');
			$("#27").find('.content').text(' Number of companions');
		}
	})
	$('.dropdown-menu').on('click', 'a', function(){
		var content = $(this).text().trim();
		$(this).closest('.form-group').find('.content').html('<span class="selectedItem">'+content+'</span> <span class="caret"></span>');
		$(this).closest('.form-group').find('button').addClass('selected');
	})
	//auto fill in school/major/program if found
	$('.autoInput').on('click', 'a', function(){
		var content = $(this).text().trim();
		$(this).closest('.form-group').find('.inputTarget').val(content);
	})
	//submit event
	$('form').on('submit', function(e){
		e.preventDefault();
		//Need to clean all has-error classes
		cleanError();
		var flag = true;
		//Clientside Validation
		//Bootstrap handles email/time/date/Radio buttons validation		
		//Password does not match
		if($('#2').val() != $('#29').val()){
			$('#29').addClass('has-error');
			$('#29').closest('.form-group').find('.help-block').removeClass('hide');
			flag = false;
		}
		//Check dropdowns
		$('body').find('.require').not('.selected').each(function(){
			$(this).closest('.form-group').find('.help-block').removeClass('hide');
			flag = false;
		})
		//Validation for US phone number if any
		var usNum = $('#10').val().trim();
		if(usNum != ''){
			if(!(/\b\d{3}[-.]?\d{3}[-.]?\d{4,5}\b/.test(usNum))){
				$('#10').closest('.form-group').find('.help-block').removeClass('hide');
				flag = false;
			}
		}
		/*
			Additional validation that needed in the future
		*/
		//check for comments
		if($('#26').hasClass('require')&&($('#28').val()=='')){
			$('#28').closest('.form-group').find('.help-block').removeClass('hide');
			flag = false;
		}
		//final check for error msgs
		if(!flag){
			alert('Oops, something went wrong. Check your form and submit again.');
		}
		else{
			//actual submitting the form data
			//Server script to process data
			var gender = 'F';
			var pickup = 'N';
			var host = 'N';
			if($('#optionsRadios1').is(':checked')){
				gender = 'M';
			}
			if($('#optionsRadios3').is(':checked')){
				pickup = 'Y';
			}
			if($('#optionsRadios5').is(':checked')){
				host = 'Y';
			}
			$.ajax({
				url: 'register.php',
				type: 'POST',
				success: function(response){
					console.log(response);
				},
				error: function(response){
					alert('有錯誤發生，請刷新后重試');
				},
				cache: false,
				data:{
						email:$('#1').val(),
						pwd:$('#2').val(),
						lnc:$('#3').val(),
						fnc:$('#4').val(),
						lne:$('#5').val(),
						fne:$('#6').val(),
						gen:gender,
						region:$('#8').find('.content').text().trim(),
						cell:$('#10').val(),
						line:$('#11').val(),
						qq:$('#12').val(),
						wechat:$('#13').val(),
						school:$('#15').val(),
						major:$('#17').val(),
						program:$('#19').val(),
						length:$('#20').find('.content').text().trim(),
						pick:pickup,
						hosting:host,
						flight:$('#23').val(),
						date:$('#24').val(),
						time:$('#25').val(),
						lug:$('#26').find('.content').text().trim(),
						com:$('#27').find('.content').text().trim(),
						comment:$('#28').val()
					}
			});
		}
	})
})