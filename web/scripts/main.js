$(function() {

	var components = [];
	components.push({
		_delete: function(url, cb){
			cb = cb || function(){};
			$.ajax({
				url: url,
				type:'POST',
				success: function(r){
					if(r && r.isValid){
						cb();
						alert('Excluído com sucesso!');
					} else{
						alert('Erro ao excluir');
					}
				}
			})
		},
		_bind: function($instance){
			var self = this;
			$instance.on('click', function(e){
				e.preventDefault();
				var url = $instance.data('delete-url');
				var confirmed = confirm('Deseja realmente excluir este item?');
				if(confirmed){
					self._delete(url, function(){
						$instance.closest('.item').remove();
					});
				}
			})
		},
		init: function() {
			var self = this;
			$('[data-delete-entity]').each(function(){
				self._bind($(this));
			})	
		}
	});

	function bindMasks() {
		$("#valorProduto").maskMoney();
	}

	function bindComponents() {

		components.forEach(function(component){
			component.init();
		});

	}

	function init() {

		bindMasks();
		bindComponents();

	}


	init();

});