$(document).ready(function () {

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $(function() {
        $('#assign_contact_modal_popup').on('show.bs.modal', function (e) {
            $('#assign_contact_modal_popup_label').html($(e.relatedTarget).data('title'));
            $('#assign_contact_modal_popup_title').html($(e.relatedTarget).data('title'));
        });
    });

    $('#assign_contact_modal_save_button').on('click', function (){
        $('#assign_contact_modal_form').submit();
    });

    $('#assign_contact_modal_form').on('submit', function(e){
        alert('im submitted');
        var contact_id = $('input[name="contact_id"]').val();
        var owner_id   = $('select[name="contact_owner_id"]').val();

        if (contact_id > 0) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                url:    '/contacts/assign',
                data: {
                    contact_id :       contact_id,
                    contact_owner_id : owner_id
                }
            })
            .done(function(response) {
                location.reload();
            });
        }

        e.preventDefault();
    });

    // Hide/Show Password/Password Confirm
    //
    $('a#show-password').on('click', function() {

        if ($('input#password').attr('type') == 'text') {
            $('input#password').prop('type', 'password');
        }
        else {
            $('input#password').prop('type', 'text');
        }

        $('#show-password-icon').toggleClass('fa-eye fa-eye-slash');
    });

    $('a#show-password-confirm').on('click', function() {

        if ($('input#password-confirm').attr('type') == 'text') {
            $('input#password-confirm').prop('type', 'password');
        }
        else {
            $('input#password-confirm').prop('type', 'text');
        }

        $('#show-password-confirm-icon').toggleClass('fa-eye fa-eye-slash');
    });

    $('input.search-contacts').on('keyup', function (e) {
        e.preventDefault();

        if (e.keyCode == 13) {
            $('form#search-contacts').submit();
        }
    });

    $('input.search-users').on('keyup', function (e) {
        e.preventDefault();

        if (e.keyCode == 13) {
            $('form#search-users').submit();
        }
    });

    if ($('#notification_type_id').length) {
        $('#notification_type_id').on('change', function(){
            find_users_by_notification_type();
        });

        find_users_by_notification_type();
    }

    if ($('#copy_to_delivery').length) {
        $('#copy_to_delivery').on('click', function () {
            $('select[name="delivery_address_type"]').val($('select[name="billing_address_type"]').val());
            $('#delivery_street').val($('#billing_street').val());
            $('#delivery_suite').val($('#billing_suite').val());
            $('#delivery_city').val($('#billing_city').val());
            $('#delivery_state').val($('#billing_state').val());
            $('#delivery_zip').val($('#billing_zip').val());
        });
    }

    if ($('#copy_to_billing').length) {
        $('#copy_to_billing').on('click', function () {
            $('select[name="billing_address_type"]').val($('select[name="delivery_address_type"]').val());
            $('#billing_street').val($('#delivery_street').val());
            $('#billing_suite').val($('#delivery_suite').val());
            $('#billing_city').val($('#delivery_city').val());
            $('#billing_state').val($('#delivery_state').val());
            $('#billing_zip').val($('#delivery_zip').val());
        });
    }

    if ($('#add_contact_note').length) {
        $('#add_contact_note_form').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;

            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });

        $('#add_contact_note').on('click', function (e) {
            e.preventDefault();

            var
                contact_id = $('input[name="contact_id"]').val(),
                note       = $('input[name="note"]').val();

            add_contact_note(contact_id, note);
        });
    }
});

function add_contact_note(contact_id = 0, note = '')
{
    if (contact_id > 0) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: 'POST',
            url:    '/notes',
            data: {
                entity_type_id : 3,
                entity_id      : contact_id,
                note           : note
            }
        }).done(function(response) {
            console.log(response);
            location.reload(true);
        });
    }
}

function find_users_by_notification_type()
{
    $('#notification_user_id').empty();

    var notification_type_id = $('#notification_type_id').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: 'POST',
        url:    'find_users',
        data: { notification_type_id : notification_type_id }
    })
    .done(function( response ) {

        $.each(response, function(i, user) {
            $('#notification_user_id')
                .append($('<option></option>')
                    .attr('value', user.id)
                    .text(user.first_name + ' ' + user.last_name));
        });
    });
}

function log_contact_activity(contact_id, action)
{
    if (contact_id > 0) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: 'POST',
            url:    '/activity/contact',
            data: {
                contact_id : contact_id,
                note       : 'Contact ' + action
            }
        })
        .done();
    }
}
