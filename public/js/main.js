$(document).ready(function() {
    if ($(window).height() > $('body').height()) {
        $('body').attr('style', 'height: 100%');
    } else {
        $('body').attr('style', 'padding-bottom: 50px');
    }

    // Переменная куда будут располагаться данные файлов
    let files;

    // Вешаем функцию на событие
    // Получим данные файлов и добавим их в переменную
    $('input[type=file]').change(function () {
        files = this.files;
    });

    let regExp = /\/post\/edit\/\d+/;

    $('.submit').click(function (e) {
        e.preventDefault();
        if (window.location.pathname === '/register' || window.location.pathname === '/login') {
            $.post($('#userForm').attr('action'), {
                login: $("#login").val(),
                password: $('#password').val()
            }, function (s) {
                if (s) {
                    $('.error').remove();
                    $('form').append("<p class='error'></p>");
                    $('.error').html(JSON.parse(s)['error']);
                } else {
                    window.location.href = '/';
                }
            });
        } else if (window.location.pathname === '/post/create') {
            let data = new FormData();
            $.each(files, function (key, value) {
                data.append(key, value);
            });
            data.append('title', $("#title").val());
            data.append('content', $('#content').val());
            data.append('status', $('#status').val());
            data.append('tags', $('#tags').val());
            // Отправляем запрос

            $.ajax({
                url: $('#userForm').attr('action'),
                type: 'POST',
                data: data,
                cache: false,
                processData: false, // Не обрабатываем файлы (Don't process the files)
                contentType: false, // Так jQuery скажет серверу что это строковой запрос
                success: function (respond, textStatus, jqXHR) {
                    if (respond) {
                        $('.error').remove();
                        $('form').append("<p class='error d-flex justify-content-center mt-2'></p>");
                        $('.error').html(JSON.parse(respond)['error']);
                    } else {
                        window.location.href = '/';
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('ОШИБКИ AJAX запроса: ' + errorThrown);
                }
            });
        } else if (regExp.test(window.location.pathname)) {
            let data = new FormData();
            $.each(files, function (key, value) {
                data.append(key, value);
            });
            data.append('id', $("div[hidden]").text());
            data.append('title', $("#title").val());
            data.append('content', $('#content').val());
            data.append('status', $('#status').val());
            data.append('tags', $('#tags').val());
            // Отправляем запрос

            $.ajax({
                url: $('#userForm').attr('action'),
                type: 'POST',
                data: data,
                cache: false,
                processData: false, // Не обрабатываем файлы (Don't process the files)
                contentType: false, // Так jQuery скажет серверу что это строковой запрос
                success: function (respond, textStatus, jqXHR) {
                    if (respond) {
                        $('.error').remove();
                        $('form').append("<p class='error d-flex justify-content-center mt-2'></p>");
                        $('.error').html(JSON.parse(respond)['error']);
                    } else {
                        window.location.href = '/';
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('ОШИБКИ AJAX запроса: ' + errorThrown);
                }
            });
        } else {
            $.post($('#commentForm').attr('action'), {
                content: $('#comment').val(),
                post_id: $('#postId').text()
            }, function (s) {
                if (s) {
                    $('.error').remove();
                    $('form').append("<p class='error d-flex justify-content-center mt-2'></p>");
                    $('.error').html(JSON.parse(s)['error']);
                } else {
                    window.location.href = window.location.pathname;
                }
            });
        }
    });
});