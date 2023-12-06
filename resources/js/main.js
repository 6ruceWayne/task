$(document).ready(function () {
    $( "ol > li > ol" ).css( "display", "none" );
    $( "ol" ).click(function(){
        $( "ol > li > ol" ).slideToggle('slow');
    });

    $('#search').click(function (e) {
        e.preventDefault();
        let byText = $("#byText").val();
        let byStatus = $('input:radio[name="byStatus"]:checked').val();
        let byPriority = $('input:radio[name="byPriority"]:checked').val();
        let sortByStatus = $('input:radio[name="sortByStatus"]:checked').val();
        let sortByPriority = $('input:radio[name="sortByPriority"]:checked').val();
        let sortByCreatedAt = $('input:radio[name="sortByCreatedAt"]:checked').val();
        let sortByCompletedAt = $('input:radio[name="sortByCompletedAt"]:checked').val();
        let form = {
            ...byText && {byText},
            ...byStatus && {byStatus},
            ...byPriority && {byPriority},
            ...sortByStatus && {sortByStatus},
            ...sortByPriority && {sortByPriority},
            ...sortByCreatedAt && {sortByCreatedAt},
            ...sortByCompletedAt && {sortByCompletedAt},
        };
        console.log(form);
        let recursiveEncoded = $.param(form);
        let base_url = window.location.origin;
        window.location.href = base_url + '/?' + recursiveEncoded;
    });

    $('#addnew').click(function (e) {
        e.preventDefault();
        let form = {};
        form['title'] = $("#title").val();
        form['description'] = $("#description").val();
        form['priority'] = $("#priority").val();
        let parentId = $("#parentId").val();
        if (parentId !== "") {
            form['parentId'] = parentId;
        }
        const token = window.Laravel.apiToken;
        $.ajax({
            type: "POST",
            url: "/api/tasks",
            headers: {
                Authorization: 'Bearer ' + token,
                accept: "application/json",
                contentType: "application/json",
            },
            data: form,
            success: function (result, status, xhr) {
                window.location.href = window.location.origin
            },
            error: function (xhr, status, error) {
                alert(xhr.responseJSON.message);
            }
        });
    });

    $('#edit').click(function (e) {
        e.preventDefault();

        let form = {};
        form['id'] = $("#id").val();
        form['title'] = $("#title").val();
        form['description'] = $("#description").val();
        form['priority'] = $("#priority").val();
        form['status'] = $("#status").val();
        let base_url = window.location.origin;
        console.log(base_url);

        const token = window.Laravel.apiToken;
        $.ajax({
            type: "PUT",
            url: "/api/tasks",
            headers: {
                Authorization: 'Bearer ' + token,
                accept: "application/json",
                contentType: "application/json",
            },
            data: form,
            success: function (result, status, xhr) {
                window.location.href = base_url + '/tasks/' + result.data.id
            },
            error: function (xhr, status, error) {
                alert(xhr.responseJSON.message);
            }
        });
    });

    $('.delete').click(function (e) {
        e.preventDefault();
        let form = {};
        form['id'] = e.target.dataset.id;
        const token = window.Laravel.apiToken;
        $.ajax({
            type: "DELETE",
            url: "/api/tasks",
            headers: {
                Authorization: 'Bearer ' + token,
                accept: "application/json",
                contentType: "application/json",
            },
            data: form,
            success: function (result, status, xhr) {
                window.location.href = window.location.origin
            },
            error: function (xhr, status, error) {
                alert(xhr.responseJSON.message);
            }
        });
    });

    $('.table input[type="radio"]').on('mouseup', function () {
        var radio = $(this);
        if (radio.attr('nc') == 0) {
            setTimeout(function () {
                if (radio.is(':checked')) radio.removeAttr('checked');
                radio.attr('nc', 1);
            }, 10); // to work: this needs to run only after the event completes
        } else radio.attr('nc', 0);
    });
});
