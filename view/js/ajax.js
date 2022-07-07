$(document).ready(function(){
    
    $('#enterForm').submit(function(event){
        event.preventDefault();
        let thisForm = $(this);

        $.ajax({
            type: 'POST',
            url: '/login',
            dataType: 'json',
            data: $(this).serialize(),
        }).done(function(data){
            if (data['result'] > 0) {
                document.location.href = '/admin';
            } else if (data['result'] === 0) {
                location.reload();
            } else {
                thisForm.children('.form__error').html(data['error']).fadeIn();
            }
        })
    })

    $('#registrationForm').submit(function(event){
        event.preventDefault();
        let thisForm = $(this);

        $.ajax({
            type: 'POST',
            url: '/registration',
            dataType: 'json',
            data: $(this).serialize(),
        }).done(function(data){
            if (data['result']) {
                location.reload();
            } else {
                thisForm.children('.form__error').html(data['error']).fadeIn();
            }
        })
    })

    $('#subscribeForm').submit(function(event){
        event.preventDefault();
        thisForm = $(this);

        $.ajax({
            type: 'POST',
            url: '/subscribe',
            dataType: 'json',
            data: $(this).serialize(),
        }).done(function(data){
            if (data['result']) {
                thisForm.fadeOut();
                $('#subscribe__success').html('Вы успешно подписались на рассылку').fadeIn();
            } else {
                thisForm.children('.form__error').html(data['error']).fadeIn();
            }
        })
    })

    $('.moderationComment').click(function(event){
        event.preventDefault();
        let cell = $(this).parent().parent();
        let data = {'id': cell.parent().attr('id')};

        $.ajax({
            type: 'POST',
            url: '/admin/comments/moderation',
            dataType: 'json',
            data: data,
        }).done(function(data){
            if (data['result']) {
                cell.html('<span class="badge bg-success">Принято</span>').fadeIn();
            } else {
                cell.html('<span class="badge bg-warning">' + data['message'] + '</span>').fadeIn();
            }
        })
    })

    $('.deleteComment').click(function(event){
        event.preventDefault();
        let cell = $(this).parent().parent();
        let data = {'id': cell.parent().attr('id')};

        $.ajax({
            type: 'POST',
            url: '/admin/comments/delete',
            dataType: 'json',
            data: data,
        }).done(function(data){
            if (data['result']) {
                cell.html('<span class="badge bg-danger">Удалено</span>').fadeIn();
            } else {
                cell.html('<span class="badge bg-warning">' + data['message'] + '</span>').fadeIn();
            }
        })
    })

    $('.deletePost').click(function(event){
        event.preventDefault();
        let cell = $(this).parent().parent();
        let data = {'id': cell.parent().attr('id'), 'delete': ''};

        $.ajax({
            type: 'POST',
            url: '/admin/posts/delete',
            dataType: 'json',
            data: data,
        }).done(function(data){
            if (data['result']) {
                cell.html('<span class="badge bg-danger">Удалено</span>').fadeIn();
            } else {
                cell.html('<span class="badge bg-warning">' + data['message'] + '</span>').fadeIn();
            }
        })
    })

    $('.deletePage').click(function(event){
        event.preventDefault();
        let cell = $(this).parent().parent();
        let data = {'name': cell.parent().attr('id'), 'delete': ''};

        $.ajax({
            type: 'POST',
            url: '/admin/pages/delete',
            dataType: 'json',
            data: data,
        }).done(function(data){
            if (data['result']) {
                cell.html('<span class="badge bg-danger">Удалено</span>').fadeIn();
            } else {
                cell.html('<span class="badge bg-warning">' + data['message'] + '</span>').fadeIn();
            }
        })
    })

    $('#coutnPerPage').change(function (){
        var url = new URL(window.location.href);
        url.searchParams.set('per-page', $(this).val());
        window.location.href = url.href;
    })

    $('#sortBy').change(function (){
        var url = new URL(window.location.href);
        url.searchParams.set('sort', $(this).val());
        window.location.href = url.href;
    })
})