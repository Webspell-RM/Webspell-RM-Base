    $(document).ready(function () {
          $('.dropdown').hover(function () {
            $('.dropdown-toggle', this).trigger('click');
          });
        });

        webshim.setOptions('basePath', 'components/webshim/js-webshim/minified/shims/');
        //request the features you need:
        webshim.setOptions("forms-ext",
        {
            replaceUI: false,
            types: "date time datetime-local"
        });
        webshim.polyfill('forms forms-ext');

        $(document).ready(function () {

            $("body").tooltip({
                selector: "[data-toggle='tooltip']",
                container: "body"
            });

        });

        $(document).ready(function () {
        $('#plugini').dataTable({
          'language': {
            'url': 'components/datatables/lang/German.lang'
          }
        });
        $('#confirm-delete').on('show.bs.modal', function (e) {
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
          $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
      });