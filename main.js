jQuery(function ($) {
    let dir = "/file";
    const firstDirrectory = "/file";

    routing('breadcrumbs.php', {'current_dir': dir}, 'nav ol');
    routing('url.php', {'current_dir': dir, 'operation': 'list'}, '#out');


    function routing(file_name, mass, out) {
        $.post(file_name, mass)
            .done(function (data) {
                if (data == 'success') {
                    $('#modal').modal('hide');
                    routing('url.php', {'current_dir': dir, 'operation': 'list'}, '#out');
                    $('#createFolder').modal('hide');
                    $('#nameFolder').val('');

                } else {
                    $(out).html(data);
                }
            });

    }

    $(document).on('click', function () {
        $('body').each(function () {
            if ($(this).hasClass('shine')) {
                $(this).removeClass('shine');
            }
        });
        $('body section').each(function () {
            if ($(this).hasClass('shine')) {
                $(this).removeClass('shine');
            }
        });
        $('#target').addClass('hide');
        $('.inner').each(function () {
            if ($(this).hasClass('shine')) {
                $(this).removeClass('shine');
            }
        });
        $('.pointer').each(function () {
            if ($(this).hasClass('shine')) {
                $(this).removeClass('shine');
            }
        })
    });
    document.oncontextmenu = function () {
        return false;
    };
    $(document).ready(function () {
        let nameFile = null;
        $('#out').mousedown(function (event) {

            $('*').removeClass('shine');

            if (event.which === 3) {

                var target = $(event.originalEvent);
                if (target[0].path.length === 8) {
                    $(target[0].path[1]).addClass('shine');
                    if (!!(nameFile)) {
                        nameFile = null;
                    }
                    nameFile = target[0].path[1]['firstElementChild']['dataset']['name'];
                    $('#target ol li').on('click', function () {
                        let operation = $(this).attr('data-operation');
                        switch (operation) {
                            case 'create':
                                $('#createFolder').modal('show');
                                $('#saveFolder').on('click', function (e) {
                                    let createFile = $('#ajax_form_folder').serialize();
                                    routing('url.php', {
                                        'current_dir': dir,
                                        'operation': 'create',
                                        'file': createFile
                                    });
                                });
                                break;

                            case 'delete':
                                routing('url.php', {
                                    'current_dir': dir,
                                    'operation': 'delete',
                                    'filename': nameFile
                                });
                                break;
                        }

                    });
                } else {
                    $('#target ol li').on('click', function () {
                        let operation = $(this).attr('data-operation');
                        switch (operation) {
                            case 'create':
                                $('#createFolder').modal('show');
                                $('#saveFolder').on('click', function (e) {
                                    let createFile = $('#ajax_form_folder').serialize();
                                    routing('url.php', {
                                        'current_dir': dir,
                                        'operation': 'create',
                                        'file': createFile
                                    });
                                });
                                break;
                        }
                    });
                }

                // Создаем меню:
                $('#target').removeClass('hide');
                $('#target').css({'top': event.pageY, 'left': event.pageX});
            }
        });
    });

    setTimeout(function () {
        $('#out').on('dblclick', '.pointer', function () {
            let element = $(this).attr('data-type');
            let data_name = $(this).attr('data-name');
            switch (element) {
                case 'folder':
                    openFolder(data_name);
                    break;
                case 'txt':
                    openWord(data_name);
                    break;
                case 'html':
                    openWord(data_name);
                    break;
                case 'php':
                    openWord(data_name);
                    break;
            }

        })
    }, 500);

    $('#save').on('click', function (e) {
        e.preventDefault();
        let modal_name = $('#exampleModalLabel').text();
        let content = $("#ajax_form").serialize();
        routing('url.php', {'current_dir': dir, 'operation': 'write', 'filename': modal_name, 'content': content});
    });

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

    function openFolder(name) {
        dir += '/' + name;
        routing('breadcrumbs.php', {'current_dir': dir}, 'nav ol');
        routing('url.php', {'current_dir': dir, 'operation': 'list'}, '#out');
    }

    $('#out .col-12').on('click', function () {
        $(this).toggle('.click');
    });

    function openWord(name) {
        $('.modal-title').text(name);
        $('#modal').modal('show');
        routing('url.php', {'current_dir': dir, 'operation': 'output', 'filename': name}, '#message-text');
    }


})
;

