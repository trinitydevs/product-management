$(document).ready(function () {
    $(".options").on("click", function () {
        var index = $(this).index();
        var target_div;

        switch (index) {
            case 0:
                target_div = '#post';
                break;
            case 1:
                target_div = '#get';
                break;
            case 2:
                target_div = '#put';
                break;
            case 3:
                target_div = '#delete';
                break;
        }

        if (!$(target_div).is(":visible")) {
            $('#post, #get, #put, #delete').fadeOut(200);
            $(target_div).delay(200).fadeIn(200);
        }
    });
});