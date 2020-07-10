$(document).ready(function () {
    $("#searchBox").keyup(function () {
        var query = $("#searchBox").val();

        if (query.length > 0) {
            $.ajax(
                {
                    url: 'ajax/ajaxSearch.php',
                    method: 'POST',
                    data: {
                        searchTest: 1,
                        key: query
                    },
                    success: function (data) {
                        $("#response").show().html(data);
                        console.log(data);   
                    },
                    dataType: 'text'
                }
            );
        }
    });

    $(document).on('click', '.liAjax', function () {
        var country = $(this).text();
        $("#searchBox").val(country);
        $("#submitSearch").click();
        $("#response").html("");
        
    });
    /* loader */
        $('.spinnerback').fadeOut(800);
        $(' html, body').css({overflow: 'auto'});
    /* loader */
});