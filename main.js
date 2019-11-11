jQuery(function ($) {
    let dir = "/file";
    const firstDirrectory = "/file";
    let get_param = document.location.search.replace('?', '').split('=');

    routing('breadcrumbs.php', {'current_dir': dir}, 'nav ol');
    routing('url.php', {'current_dir': dir, 'operation': 'list'}, '#out');


    function routing(file_name, mass, out) {
        $.post(file_name, mass)
            .done(function (data) {
                if(data == 'success'){
                    $('#modal').modal('hide');
                }else {
                    $(out).html(data);
                }
            });

    }

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

    $('#save').on('click',function(e){
        e.preventDefault();
        let modal_name = $('#exampleModalLabel').text();
        let content = $("#ajax_form").serialize();
        routing('url.php',{'current_dir': dir, 'operation': 'write','filename': modal_name,'content': content});
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
    $('#out .col-12').on('click',function(){
       $(this).toggle('.click');
    });

    function openWord(name) {
        $('.modal-title').text(name);
        $('#modal').modal('show');
        routing('url.php', {'current_dir': dir, 'operation': 'output', 'filename': name}, '#message-text');
    }



});

