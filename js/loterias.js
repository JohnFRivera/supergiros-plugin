jQuery(document).ready(function ($) {
	/**
	 * Establecer el contenido en la vista
	 * @param {Object} attachment
	 * @param {string} attachment.url
	 * @param {string} attachment.filename
	 */
	function setContentView(attachment) {
		const ipLogoUrl = $('#ipLogoUrl');
		const imgLogo = $('#imgLogo');
		const btnUploadLogo = $('#btnUploadLogo');
		if (imgLogo.length) {
			imgLogo.attr('src', attachment.url);
			imgLogo.attr('alt', attachment.filename);
		} else {
			if (attachment.url) {
				btnUploadLogo.val('Actualizar logo');
				btnUploadLogo.before(`<div><img id="imgLogo" src="${attachment.url}" alt="${attachment.filename}" style="width: 107.69px;border-radius: 4px;border: 1px solid #8c8f94;"></div>`);
				btnUploadLogo.after(`<input type="button" class="button" value="Eliminar" id="btnRemoveLogo" style="color: #b32d2e;border-color: #b32d2e;margin-left: 4px;" />`);
				// Evento al hacer click en "Eliminar"
				$('#btnRemoveLogo').click(function () {
					btnUploadLogo.val('Establecer logo');
					btnUploadLogo.prev().remove();
					btnUploadLogo.next().remove();
					ipLogoUrl.val('');
				});
			}
		}
		ipLogoUrl.val(attachment.url);
	}

	// Establecer contenido si se encuentra en la página de edición de terminos
	setContentView({
		url: $('#ipLogoUrl').val(),
		filename: $('#ipLogoUrl').data('filename'),
	});

	// Evento al hacer click en "Establecer logo" o "Actualizar logo"
	$('#btnUploadLogo').click(function () {
		const mediaFrame = wp.media({
			title: 'Logo de la lotería',
			button: { text: 'Establecer logo' },
			library: { type: 'image' },
			multiple: false,
		});
		mediaFrame.on('select', function () {
			const attachment = mediaFrame.state().get('selection').first().toJSON();
			setContentView(attachment);
		});
		mediaFrame.open();
	});
});
