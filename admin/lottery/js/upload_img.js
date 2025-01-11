jQuery(document).ready(function ($) {
  $('#upload_logo_btn').click(function () {
    var media_frame = wp.media({
      title: 'Selecciona un logo para la lotería',
      library: {
        type: 'image', // Filtrar para mostrar solo PDFs
      },
      multiple: false,
      button: {
        text: 'Seleccionar logo',
      },
    });

    media_frame.on('select', function () {
      var attachment = media_frame.state().get('selection').first().toJSON();
      $('#_logo_lottery').val(attachment.id);
      $('#logo_lottery_preview').html(
        `<img height="80px" src="${attachment.url}" alt="${attachment.filename}">`
      );
    });

    media_frame.open();
  });
  $('#remove_logo_btn').click(function () {
    $('#_logo_lottery').val('');
    $('#logo_lottery_preview').html('');
  });
  $('#submit').click(function () {
    $('#_logo_lottery').val('');
    $('#logo_lottery_preview').html('');
  });
});
