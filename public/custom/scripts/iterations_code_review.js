$(document).ready(function(){
    var token;
    regenerateToken(); //get a token for csrf

    setInterval(function(){ 
        regenerateToken()
    }, 7200*1000);

    $('input[name="daterange"]').daterangepicker({
        timePicker: true,
        timePickerIncrement: 1,
        timePicker24Hour: true,
        locale: {
            format: 'YYYY/MM/DD H:mm'
        }
    })

    $('.edit').on('click', function() {
        var child = $(this).children('input');
        child[0].click();
    })

    $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
        var dates = $(this).val().split(" - ");
        var slug = $(this).data('slug');
        var type = $(this).data('type');
        
        if (dates.length === 2 && slug !== null && type !== null) {
            $.ajax({
                url: "/Appointment/addAppointmentAction",
                data: {
                    iteration_or_code_review_start: dates[0],
                    iteration_or_code_review_end: dates[1],
                    type: type,
                    slug: slug,
                    csrf_token: token
                },
                method: 'POST',
                success: function(result) {
                    console.log(result);
                },
                fail :function() {
                    alert('Controlleer u internet verbiniding');
                }
            });
        }
    });

    function regenerateToken() 
    {
        $.ajax({
            url: "/users/newToken",
            method: 'POST',
            success: function(result) {
                token = result.new_token;
            },
            fail :function() {
                alert('Controlleer u internet verbiniding');
            }
        });
    }
})
