$(document).ready(function ()
{
    // Sidebar Navigation
    //
    $('#edesk-logo-e').hide();

    $('#sidebar-collapse').on('click',
        function()
        {
            $('#sidebar').toggleClass('active');

            if ($('#sidebar').hasClass('active'))
            {
                $('.search-site-div').hide();
                $('#edesk-logo').hide();
                $('#edesk-logo-e').show();
                $(this).find('i:first').removeClass('fa-chevron-circle-left');
                $(this).find('i:first').addClass('fa-chevron-circle-right');
            }
            else
            {
                $('.search-site-div').show();
                $('#edesk-logo').show();
                $('#edesk-logo-e').hide();
                $(this).find('i:first').removeClass('fa-chevron-circle-right');
                $(this).find('i:first').addClass('fa-chevron-circle-left');
            }
        }
    );

    $('#sidebar ul li a.dropdown-toggle').on('click',
        function()
        {
            $(this).toggleClass('active');

            if (! $(this).hasClass('active'))
            {
                var $submenu = $(this).find('ul.components:first');

                $submenu.addClass('collapse');
                $submenu.find('ul.components:first').removeClass('show');
            }
        }
    );

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $(function() {
        $('#modal_popup').on('show.bs.modal', function (e) {
            $('#modal_popup_label').html($(e.relatedTarget).data('title'));
            $('#modal_popup_title').html($(e.relatedTarget).data('title'));
        });
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
});
