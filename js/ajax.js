
$('#add_user').click(function(e) { 
    e.preventDefault();
    
    var formDate = $('#user-form').serializeArray();
    
    $.ajax({
        url: 'user_add.php',         /* Куда отправить запрос */
        method: 'POST',            /* Метод запроса (post или get) */
        dataType: 'json',          /* Тип данных в ответе (xml, json, script, html). */
        data: formDate,     /* Данные передаваемые в массиве */
        success: function(data){   /* функция которая будет выполнена после успешного запроса.  */
            // alert(data); /* В переменной data содержится ответ от index.php. */
            console.log(data);
            if (data.member == 'Гейм мастер') {
                $('#users').append('<li>' + data.username + ' (' + data.member + ')</li>');
            } else {
                $('#users').append('<li>' + data.username + '</li>');
            };
            $('.game__center-left > p').text('Количество участников - ' + $('#users > li').length);
            $('.form-block').html(data.username + ' вы зарегистрированы как ' + data.member + ' <a href="index.php?do=exit">Отказаться от участия</a>');
        }
    });
});

$('#form-block > a').click(function(e) {
    e.preventDefault();

    $.ajax({
        url: 'user_delete.php',         /* Куда отправить запрос */
        method: 'POST',            /* Метод запроса (post или get) */
        dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
        data: {do: 'exit'},  
        success: function(data){
            alert('data')
        }
    });
});