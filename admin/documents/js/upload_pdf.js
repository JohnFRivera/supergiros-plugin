jQuery(document).ready(function ($) {
  let input_pdf_url = $('#_document_pdf_url');
  function valid_input_pdf_url() {
    if (input_pdf_url.val().length) {
      $('#upload-pdf-url').text(input_pdf_url.data('name'));
      input_pdf_url.before(
        '<p class="hide-if-no-js howto" id="p-desc-pdf-url">Haz clic en el nombre del documento para editarlo o actualizarlo</p>'
      );
      input_pdf_url.before(
        '<p class="hide-if-no-js plugins" id="p-remove-pdf-url"><a href="#" id="remove-pdf-url" class="delete">Eliminar documento</a></p>'
      );
      $('#remove-pdf-url').click(function (e) {
        e.preventDefault();
        input_pdf_url.val('');
        input_pdf_url.removeAttr('data-name');
        $('#upload-pdf-url').text('Subir documento');
        $('#p-desc-pdf-url').remove();
        $('#p-remove-pdf-url').remove();
      });
    }
  }
  valid_input_pdf_url();
  $('#upload-pdf-url').click(function (e) {
    e.preventDefault();
    var media_frame = wp.media({
      title: 'Selecciona un PDF',
      library: {
        type: 'application/pdf', // Filtrar para mostrar solo PDFs
      },
      multiple: false,
      button: {
        text: 'Seleccionar PDF',
      },
    });

    media_frame.on('select', function () {
      var attachment = media_frame.state().get('selection').first().toJSON();
      input_pdf_url.val(attachment.url); // Establecer la URL en el campo de texto
      input_pdf_url.data('name', attachment.filename);
      e.target.innerText = attachment.filename;
      valid_input_pdf_url();
    });

    media_frame.open();
  });
});
