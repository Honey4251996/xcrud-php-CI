var sizeInMB = function(file){
	var size =  file.size/(1024*1024);
	return size.toFixed(2);
}
$(document).ready(function(){
	$(".bs-submit").on("click",function(){
		updateEditor();
		var form = $(this).closest(".bs-form");
		var data = {};
		form.find(".bs-input").each(function(){
			data[$(this).attr("name")] = $(this).val();
		});
		$.post($(this).attr('data-url'),
			{
				task:$(this).attr('data-name'),
				data:data
			},
			function(response){
				var data = JSON.parse(response);
				var msg = form.find(".bs-message");
				resetErrors(form);
				if(data.status == "success"){
					msg.addClass("success");
				}else{
					msg.addClass("fail");
					for(var i in data.report){
						setError(form,i,data.report[i]);
					}
				}
				msg.html(data.message);
				msg.slideDown();
				setTimeout(function(){msg.slideUp();},3000);
			}
		);
	});
	
	$(".bs-message").on("click",function(){
		$(this).slideUp();
	});
	
	iniImages();
	iniEditor();
	
});


function iniImages(){
	$(".bs-select-image").click(function(){
		$(this).closest(".bs-file-container").find('.bs-image').click();
	});
	$(".bs-remove-image").click(function(){
		var image = $(this).closest(".bs-file-container").find('.bs-preview-image');
		$(this).closest(".bs-file-container").find('.bs-image').val("");
		$(this).closest(".bs-file-container").find('.image-value').val("");
		image.attr("src",image.attr('data-noImage'));
	});
	$(".bs-image").on("change",function(){
		var input = $(this);
		var file = $(this)[0].files[0];
		var container = $(this).closest(".bs-file-container");
		var maxSize = parseFloat($(this).attr("data-maxsize"));
		if(sizeInMB(file) <= maxSize && (file.type =="image/jpeg" || file.type=="image/png")){
			var form = new FormData();
			form.append('image',file);
			form.append('task',"upload_image");
			var request = new XMLHttpRequest();
			$(request).on('load',function(){
				var resp  = JSON.parse(request.responseText);
				if(resp.status == "done"){
					container.find('.bs-preview-image').attr("src",input.attr("data-path")+resp.file);
					container.find('.image-value').val(resp.file);
				}else if(resp.status == "error"){
					
				}
			});
			request.open("POST", $(this).attr('data-upload'));
			request.send(form);
		}else{
			if(sizeInMB(file) > maxSize){
				console.log("File Size exceed the Limit "+maxSize+"MB");
			}
			if(file.type !="image/jpeg" && file.type!="image/png"){
				console.log("File type is not allowed");
			}	
		}
	});
}

function iniEditor(){
	var toolbar =
	[
		//{ name: 'document', items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
		{ name: 'clipboard', items : [ 'Source','Cut','Copy','Paste','PasteText','-','Undo','Redo' ] },
		{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
		//{ name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 
		//	'HiddenField' ] },
		//'/',
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','CreateDiv',
		'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] },//,'-','BidiLtr','BidiRtl' ] },
		//{ name: 'links', items : [ 'Link','Unlink']},//,'Anchor' ] },
		//{ name: 'insert', items : [ 'Image','Table','HorizontalRule','SpecialChar','PageBreak' ] },
		//'/',
		{ name: 'styles', items : [ 'Styles','Format','FontSize' ] },
		//{ name: 'styles', items : [ 'Format','FontSize' ] },
		{ name: 'colors', items : [ 'TextColor','BGColor' ] },
		{ name: 'tools', items : ['ShowBlocks']}//'-','About' ] }
	];
	$(".bs-editor").each(function(){
		var name = $(this).attr("name");
		CKEDITOR.replace(name,{
			toolbar:toolbar,
			height:100
		});
	});
}

function updateEditor(){
	if (typeof(CKEDITOR) != 'undefined') {
		for (instance in CKEDITOR.instances) {
			CKEDITOR.instances[instance].updateElement();
		}
	}
}

function resetErrors(form){
	var msg = form.find(".bs-message");
	msg.removeClass("success");
	msg.removeClass("fail");
	form.find(".bs-validation-message").removeClass('success').html("");
	form.find(".bs-validation-message").removeClass('fail').html("");
	form.find(".bs-input").removeClass('bs-error');
}

function setError(form,input,error){
	form.find(".bs-validation-message."+input).addClass('fail');
	form.find(".bs-validation-message."+input).html(error);
	var field = form.find(".bs-input[name='"+input+"']");
	if(field.hasClass("image-value")){
		field.closest('.bs-file-container').addClass("bs-error");
	}else if(field.hasClass("bs-editor")){
		field.next('.cke').addClass("bs-error");
	}else{
		field.addClass("bs-error");	
	}
}