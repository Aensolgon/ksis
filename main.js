jQuery(function ($) {
    let dir = "/file";
    const firstDirrectory = "/file";
    let get_param = document.location.search.replace('?', '').split('=');

    routing('breadcrumbs.php', {'current_dir': dir}, 'nav ol');
    routing('url.php', {'current_dir': dir, 'operation': 'list'}, '#out');


    function routing(file_name, mass, out) {
        $.post(file_name, mass)
            .done(function (data) {
                $(out).html(data);
            });

    }

    setTimeout(function () {
        $('#out').on('dblclick', '.pointer', function () {
            if ($(this).attr('data-type') == 'folder') {
                dir += '/' + $(this).attr('data-name');
                routing('breadcrumbs.php', {'current_dir': dir}, 'nav ol');
                routing('url.php', {'current_dir': dir, 'operation': 'list'}, '#out');

            }
        })
    }, 500);

    $('.breadcrumb').on('click', '.breadcrumb-item', function () {
        dir = '';
        let number = $(this).attr('data-number');
        let name = $(this).attr('data-name');
        $('.breadcrumb li').each(function (key, value) {
            if (key < number) {
                dir += '/' + $(this).attr('data-name');
            }
        });
        routing('breadcrumbs.php', {'current_dir': dir}, 'nav ol');
        routing('url.php', {'current_dir': dir, 'operation': 'list'}, '#out');
    });


});
