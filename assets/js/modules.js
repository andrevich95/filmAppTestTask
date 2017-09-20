//Load films
var loadForm = {
		
		initialize : function () {			
			this.modules();
			this.setUpListeners();
		},
 
		modules: function () {
 
		},
 
		setUpListeners: function () {
			$('#form_photo').on('submit',loadForm.submitForm);
		},
 
		submitForm: function (e) {
			e.preventDefault();
			var form = $(this),submitBtn=form.find('button[type="submit"]');
			submitBtn.attr('disabled','disabled');
			var formData = new FormData(form[0]);
			$.ajax({
				url : 'add/add',
				enctype: 'multipart/form-data',
				type : 'POST',
				processData: false,
            	contentType: false,
            	cache: false,
				data : formData,
				success : function(data){
					$('#main_body').html(data);
				}
			})
			.always(function(){submitBtn.removeAttr('disabled');});
		}			
}


