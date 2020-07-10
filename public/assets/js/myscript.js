// define a new jquery function 
// (function($) {
//     $.fn.clickToggle = function(func1, func2) {
//         var funcs = [func1, func2];
//         this.data('toggleclicked', 0);
//         this.click(function() {
//             var data = $(this).data();
//             var tc = data.toggleclicked;
//             $.proxy(funcs[tc], this)();
//             data.toggleclicked = (tc + 1) % 2;
//         });
//         return this;
//     };
// }(jQuery));


// $('#changePassword').clickToggle(function() {   
//     $(this).animate({
//         left: '100px'
//     }, 1000);
//     alert('hello');
// },
// function() {
//     $(this).animate({
//         left: '0px'
//     }, 1000);
// });



// supplier upload photo function 
document.getElementById("upImgP").addEventListener("click", function() {
    document.getElementById("upImgIn").click();
});

function showPhoto() {
    var file = document.getElementById('upImgIn').files[0];
    console.log(file);
    reader = new FileReader();
    // console.log(reader);
    reader.onloadend = function() {
        document.getElementById('upImg').setAttribute("src", reader.result);
        // console.log(reader.result);
    };
    reader.readAsDataURL(file);
}

// place holder in focus and blur 
$('input[placeholder],textarea[placeholder]').on('focus blur', function() {
    if ($(this).attr('placeholder')) {
        container = $(this).attr('placeholder');
        $(this).attr('placeholder', '');

    } else {
        $(this).attr('placeholder', container);
    };
});

// change password animate
$(document).ready(function() {
    var i = 0;
    $('#changePassword').click(function() {
        if ( i % 2 == 0 ){
        $('.changePass').fadeIn(function() {
            $('#passwordInputsCont').animate({
                // left: '100px'
            });
        });
    }else{
            $('#passwordInputsCont').animate({
                // left: '0px'
            },400,function () { 
                $('.changePass').fadeOut();
             });
        
    }
    i++;
    });
    
});
// updage Basic info buttons
$('#updateInfoEdit').click(function() {
    $('#updateInfoSave,#updateInfoCancel').show();
    $('#upImgIn,#supplier_name,#shop_name,#email,#details,#close_time,#open_time').removeAttr('disabled');
});
$('#updateInfoCancel').click(function() {
    $('#updateInfoSave,#updateInfoCancel').hide();
    $('#upImgIn,#supplier_name,#shop_name,#email,#details,#close_time,#open_time').attr('disabled', 'disabled');
});

// alert('hello');