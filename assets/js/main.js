AjaxRequest.changeSpace = function(event,el,id) {

		var image = $(el).getFirst('img'),
			space = image.get('data-space'),
			minus = event.altKey;

		new Request.Contao({
			evalScripts: true,
			onRequest: AjaxRequest.displayBox(Contao.lang.loading + ' …'),
			onSuccess: function(txt) {
				var spaceVal = parseInt(txt);
				image.set('data-space',spaceVal);
				$(el).getFirst('span').innerHTML = spaceVal;

				AjaxRequest.hideBox();

				// HOOK
				window.fireEvent('ajax_change');
   			}
		}).post({
			'action':'changeSpace',
			'id':id,
			'minus':minus,
			'REQUEST_TOKEN':Contao.request_token
		});

		return false;

};


