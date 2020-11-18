$(function () {


    /* on click sign up hide sign in
* ------------------------------------------------------ */
    $('#signup').on('click', function () {
        $('#first').slideUp('slow', function () {
            $('#second').slideDown('slow');
        });
    });




    /* on click sign in hide sign up
   * ------------------------------------------------------ */
    $('#signin').on('click', function () {
        $('#second').slideUp('slow', function () {
            $('#first').slideDown('slow');
        });
    });







    /* Navbar add and remove shadow On Scroll
* ------------------------------------------------------ */
    var scrollWindow = function () {
        $(window).scroll(function () {
            var $w = $(this),
                st = $w.scrollTop(),
                navbar = $('nav');


            if (st > 50) {

                navbar.addClass('nav-shadow');

            }

            else if (st < 50) {

                navbar.removeClass('nav-shadow');

            }

        });
    };
    scrollWindow();
    /* Navbar add and remove shadow On Scroll End
* ------------------------------------------------------ */


    /* Show/Hide password
 * ------------------------------------------------------ */
    $(".toggle-password").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        input = $(this).parent().find("input");
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
    /* Show/Hide password end
 * ------------------------------------------------------ */













});