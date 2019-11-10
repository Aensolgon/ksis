jQuery(function ($) {
    let dir = "/file";
    const firstDirrectory = "/file";
    let get_param = document.location.search.replace('?', '').split('=');

    routing('url.php', {'current_dir': dir, 'operation': get_param[1]}, '#out');
    routing('breadcrumbs.php', {'current_dir': dir}, 'nav ol');


    function routing(file_name, mass, out) {
        $.post(file_name, mass)
            .done(function (data) {
                $(out).html(data);
            });

    }

    setTimeout(function () {
        $('.pointer').dblclick(function () {
            if ($(this).attr('data-type') == 'folder') {
                dir = firstDirrectory + '/' + $(this).attr('data-name');
                routing('breadcrumbs.php', {'current_dir': dir}, 'nav ol');

            }
        })
    }, 500);

});
