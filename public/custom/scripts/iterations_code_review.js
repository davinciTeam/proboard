$(document).ready(function(){
    var token;
    regenerateToken(); //get a token for csrf

    setInterval(function(){ 
        regenerateToken()
    }, 7200*1000);

    function generateProjects(result) {
        var html = '';
        var today = new Date();
        var iterationStart;
        var iterationEnd;
        var codeReviewStart;
        var codeReviewEnd;


        for (var project in result['projects']) {
        
            iterationStart = (valideDate(result['projects'][project]['iteration_start'])) ? valideDate(result['projects'][project]['iteration_start']) : false;//prevents undefined result in ie
            iterationEnd = (valideDate(result['projects'][project]['iteration_end'])) ? valideDate(result['projects'][project]['iteration_end']) : false;
            codeReviewStart = (valideDate(result['projects'][project]['code_review_start'])) ? valideDate(result['projects'][project]['code_review_start']) : false;
            codeReviewEnd = (valideDate(result['projects'][project]['code_review_end'])) ? valideDate(result['projects'][project]['code_review_end']) : false;

            if (today > iterationStart || today > codeReviewStart) {
                html += '<tr class="red">'
            } else if (today.getDay() == iterationStart.getDay() || today.getDay() == codeReviewStart.getDay()) {
                html += '<tr class="orange">';
            } else {
                html += '<tr class="green">'
            }

            html += '\
                <td>'+result['projects'][project]['name']+' <span data-toggle="tooltip" title="'+result['projects'][project]['description']+'"class="glyphicon glyphicon-comment"></span></td>\
                <td>'+result['projects'][project]['teacher']+'</td>\
                <td>'+result['projects'][project]['client']+'</td>\
                <td>'
            if (result['projects'][project]['members']) {
                for (var member in result['projects'][project]['members']) {
                    html += result['projects'][project]['members'][member]['name']+" "+result['projects'][project]['members'][member]['insertion']+" "+result['projects'][project]['members'][member]['lastname']+" ";
                }
            }
            html += '\
            </td>\
            <td>\
                <div class="input-group"><span class="edit glyphicon glyphicon-edit">';

            if (result['projects'][project]['iteration_start'] !== '0000-00-00 00:00:00') {
                html += '<input data-slug="'+result['projects'][project]['slug']+'" data-type="iteration" class="hidden form-control dateRange" type="text" name="daterange" value="'+result['projects'][project]['iteration_start']+' - '+result['projects'][project]['iteration_end']+'">'+result['projects'][[project]]['iteration_start'];
            } else {
                html += '<input data-slug="'+result['projects'][project]['slug']+'" data-type="iteration" class="hidden form-control dateRange" type="text" name="daterange" value="'+result['today']+' - '+result['today']+'">Niks ingepland';
            }
                
            html += '</span></div></td>\
                <td><div class="input-group"><span class="edit glyphicon glyphicon-edit">';

            if (result['projects'][project]['code_review_start'] !== '0000-00-00 00:00:00') {
                html += '<input data-slug="'+result['projects'][project]['slug']+'" data-type="iteration" class="hidden form-control dateRange" type="text" name="daterange" value="'+result['projects'][project]['code_review_start']+' - '+result['projects'][project]['code_review_end']+'">'+result['projects'][project]['code_review_start'];
            } else {
                html += '<input data-slug="'+result['projects'][project]['slug']+'" data-type="iteration" class="hidden form-control dateRange" type="text" name="daterange" value="'+result['today']+' - '+result['today']+'">Niks ingepland';
            }
            html += '</span></div></td><td><span class="glyphicon glyphicon-comment"></span></td></tr>';
        }
        return html;
    }
    
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
                    regenerateToken();
                    location.reload();
                },
                fail :function() {
                    alert('Controlleer u internet verbiniding');
                }
            });
        }
    });

    $('#search_icon').on('click', function() {
        $.ajax({
            url: "/dashboard/index",
            data: {
                searchParamaters: $('input[name="search"]').val(),
                json: 'true',
                csrf_token: token
            },
            method: 'POST',
            success: function(result) {

                var html = generateProjects(result);

                $('#projects').empty().append(html);
                
                $( "input[name=daterange]" ).daterangepicker({
                    timePicker: true,
                    timePickerIncrement: 1,
                    timePicker24Hour: true,
                    locale: {
                        format: 'YYYY/MM/DD H:mm'
                    }
                });
                $('.edit').on('click', function() {
                    var child = $(this).children('input');
                    child[0].click();
                });
                regenerateToken();
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
                                regenerateToken();
                                location.reload();

                            },
                            fail :function() {
                                alert('Controlleer u internet verbiniding');
                            }
                        });
                    }
                });
            },
            fail :function() {
                alert('Controlleer u internet verbiniding');
            }
        });
    })

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

    function valideDate(date)
    {        
        return new Date(date);
    }
})
