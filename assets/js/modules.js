//Сортировка фильмов по критерию - тут идет отправка на обработку к экшну sort из main
var orderBy = {
		
		initialize : function () {			
			this.modules();
			this.setUpListeners();
		},
 
		modules: function () {
 
		},
 
		setUpListeners: function () {
			$('#sorting').on('change',orderBy.submitForm);
		},
 
		submitForm: function () {
			var formData = {param : $(this).val()};
			$.ajax({
				url : 'main/sort',
				type : 'POST',
				data : formData,
				success : function(data){
					$('.table-responsive tbody').html(data);
					orderBy.initialize();
					searchBy.initialize();
					actionsFilms.initialize();
					actionsActors.initialize();
				}
			});
		}			
}

//Поиск по фильму, или актеру
var searchBy = {
		
		initialize : function () {	
			this.modules();
			this.setUpListeners();
		},
 
		modules: function () {
 
		},
 
		setUpListeners: function () {
			$('#search').on('input',searchBy.showHint);
			$('#reset').on('click',function(){$('#help').html('');});
			$('.hint_a').on('click',searchBy.completeHint);
			$('#search_form').on('submit',searchBy.showResult);
		},
 		showHint: function () {
			var formData = {str : $(this).val()};
			$.ajax({
				url : 'main/hint',
				type : 'POST',
				data : formData,
				success : function(data){
					$('#help').html(data);
					orderBy.initialize();
					searchBy.initialize();
					actionsFilms.initialize();
					actionsActors.initialize();
				}
			});
		},

		completeHint: function () {
			$('#search').val($(this).text());
			$('#help').html('');
		},		

		showResult: function (e) {
			e.preventDefault();
			submitBtn=$(this).find('button[type="submit"]');
			submitBtn.attr('disabled','disabled');
			var formData = {search : $('#search').val()};
			$.ajax({
				url : 'main/search',
				type : 'POST',
				data : formData,
				success : function(data){
					$('.table-responsive tbody').html(data);
					orderBy.initialize();
					searchBy.initialize();
					actionsFilms.initialize();
					actionsActors.initialize();
				}
			}).always(function(){submitBtn.removeAttr('disabled');});
		}			
}
//Действия над фильмами: удаление и информация о фильме
var actionsFilms = {

		initialize : function () {			
			this.modules();
			this.setUpListeners();
		},
 
		modules: function () {
 
		},
 
		setUpListeners: function () {
			$('.info').on('click',actionsFilms.infoItem);
			$('.edit').on('click',actionsFilms.editItem);
			$('.remove').on('click',actionsFilms.removeItem);
		},
 
		removeItem: function () {
			var formData = {id : $(this).closest('tr').attr('id')};
			$.ajax({
				url : 'film/remove',
				type : 'POST',
				data : formData,
				success : function(data){
					$('.table-responsive tbody').html(data);
					orderBy.initialize();
					searchBy.initialize();
					actionsFilms.initialize();
					actionsActors.initialize();
				}
			});
		},

		infoItem: function () {
			var formData = {id : $(this).closest('tr').attr('id')};
			$.ajax({
				url : 'film/info',
				type : 'POST',
				data : formData,
				success : function(data){
					$('.modal-dialog').html(data);
					orderBy.initialize();
					searchBy.initialize();
					actionsFilms.initialize();
					actionsActors.initialize();
				}
			});
		}
}

//Действия над актерами
var actionsActors = {
		initialize : function () {		
			this.modules();
			this.setUpListeners();
		},
 
		modules: function () {
 
		},
 
		setUpListeners: function () {
			$('.remove_actor').on('click',actionsActors.removeItem);
		},
 
		removeItem: function () {
			var formData = {id : $(this).closest('tr').attr('id')};
			$.ajax({
				url : 'rmactors',
				type : 'POST',
				data : formData,
				success : function(data){
					$('.table-responsive tbody').html(data);
					orderBy.initialize();
					searchBy.initialize();
					actionsFilms.initialize();
					actionsActors.initialize();
				}
			});
		}
}


