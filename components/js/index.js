$(document).ready(function () {
    $('.dropdown').hover(function () {
        $('.dropdown-toggle', this).trigger('click');
    });

    $("body").tooltip({
        selector: "[data-toggle='tooltip']",
        container: "body"
    });

    const favouriteLanguage = LangDataTables;
    let fileLang;

    if (favouriteLanguage.startsWith('it')) {
        fileLang = '/components/datatables/langs/Italian.json';
    } else if (favouriteLanguage.startsWith('en')) {
        fileLang = '/components/datatables/langs/English.json';
    } else if (favouriteLanguage.startsWith('de')) {
        fileLang = '/components/datatables/langs/German.json';
    } else {
        fileLang = '/components/datatables/langs/English.json';
    }

    // Utilizza DataTable() invece di dataTable() se si sta usando DataTables 1.10 o superiore
    $('#plugini').dataTable({
        'language': {
            'url': fileLang
        }
    });

    $('#confirm-delete').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });
});

// Assicurati che la libreria Bootstrap sia inclusa correttamente
// Inizializza popover e tooltip di Bootstrap per gli elementi della pagina
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl)
})
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
