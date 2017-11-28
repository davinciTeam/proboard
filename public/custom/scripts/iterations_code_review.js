$(document).ready(function(){
    var url = window.location.href.split('/');
    var page = ($.isNumeric( url[5] )) ? url[5] : 0;
    var amount = 0;
    var token;
    var terms = "";

    regenerateToken(function() {
            search()
        }
    ); //get a token for csrf


    setInterval(function(){ 
        regenerateToken()
    }, 7200*1000);

    setEventHandelers()

    $('#search_icon').on('click', function() {
        terms = $('input[name="search"]').val();
        search()
    })

    function generateProjects(result)
    {
        console.log(result)
        var html = '';
        var today = new Date();
        var iterationStart, iterationEnd ,codeReviewStart, codeReviewEnd;

        if (result.amount_of_items != 0) {
            for (var project in result['projects']) {
            
                iterationStart = (valideDate(result['projects'][project]['iteration_start'])) ? valideDate(result['projects'][project]['iteration_start']) : false;//prevents undefined result in ie
                iterationEnd = (valideDate(result['projects'][project]['iteration_end'])) ? valideDate(result['projects'][project]['iteration_end']) : false;
                codeReviewStart = (valideDate(result['projects'][project]['code_review_start'])) ? valideDate(result['projects'][project]['code_review_start']) : false;
                codeReviewEnd = (valideDate(result['projects'][project]['code_review_end'])) ? valideDate(result['projects'][project]['code_review_end']) : false;

                if (today > iterationStart || today > codeReviewStart) {
                    html += '<tr class="red">'
                } else if (today.getDay() == iterationStart.getDay() || today.getDay() == codeReviewStart.getDay()) {
                    html += '<tr class="orange">'
                } else {
                    html += '<tr class="green">'
                }

                html += '\
                    <td>'+result['projects'][project]['name']+' <span data-toggle="tooltip" title="'+result['projects'][project]['description']+'"class="glyphicon glyphicon-comment"></span></td>\
                    <td>'+result['projects'][project]['teacher']+'</td>\
                    <td>'+result['projects'][project]['client']+'</td>\
                    <td class="white">\
                        <a href="'+result['projects'][project]['git_url']+'">git url</a><br>\
                        <a href="'+result['projects'][project]['trello_url']+'">trello url</a><br>\
                        <a href="'+result['projects'][project]['project_url']+'">project url</a><br>\
                        <a href="'+result['projects'][project]['bug_url']+'">bug url</a><br>\
                    </td><td>'
                if (result['projects'][project]['members']) {
                    for (var member in result['projects'][project]['members']) {
                        html += result['projects'][project]['members'][member]['name']+" "+result['projects'][project]['members'][member]['insertion']+" "+result['projects'][project]['members'][member]['lastname']+" ";
                    }
                }
                html += '\
                </td><td>'

                if (result['projects'][project]['tags']) {
                    for (var tag in result['projects'][project]['tags']) {
                        html += '<span data-toggle="tooltip" title="' + result['projects'][project]['tags'][tag]['description'] + '" class="label label-info">'+result['projects'][project]['tags'][tag]['name']+'</span> '
                    }
                }
                html += '</td><td>';

                if (result['admin']) html += '<div class="input-group"><span class="edit glyphicon glyphicon-edit">'

                if (result['projects'][project]['iteration_start'] !== '0000-00-00 00:00:00') {
                    if (result['admin']) html += '<input data-slug="'+result['projects'][project]['slug']+'" data-type="iteration" class="hidden form-control dateRange" type="text" name="daterange" value="'+result['projects'][project]['iteration_start']+' - '+result['projects'][project]['iteration_end']+'">'
                    html += result['projects'][[project]]['iteration_start'];
                } else {
                    if (result['admin']) html += '<input data-slug="'+result['projects'][project]['slug']+'" data-type="iteration" class="hidden form-control dateRange" type="text" name="daterange" value="'+result['today']+' - '+result['today']+'">'
                    html += 'Geen afspraak';
                }
                    
                html += '</span></div></td>\
                    <td>';

                if (result['admin']) html += '<div class="input-group"><span class="edit glyphicon glyphicon-edit">'

                if (result['projects'][project]['code_review_start'] !== '0000-00-00 00:00:00') {
                    if (result['admin']) html += '<input data-slug="'+result['projects'][project]['slug']+'" data-type="iteration" class="hidden form-control dateRange" type="text" name="daterange" value="'+result['projects'][project]['code_review_start']+' - '+result['projects'][project]['code_review_end']+'">'
                    html += result['projects'][project]['code_review_start'];
                } else {
                    if (result['admin']) html += '<input data-slug="'+result['projects'][project]['slug']+'" data-type="iteration" class="hidden form-control dateRange" type="text" name="daterange" value="'+result['today']+' - '+result['today']+'">'
                    html += 'Geen afspraak'
                }
                if (today > iterationStart || today > codeReviewStart) {
                    html += '<td><i title="Te laat" data-toggle="tooltip" class="fa fa-exclamation" aria-hidden="true"></i></td>'
                } else if (today.getDay() == iterationStart.getDay() || today.getDay() == codeReviewStart.getDay()) {
                    html += '<td><i title="Is Vandaag" data-toggle="tooltip" class="fa fa-clock-o" aria-hidden="true"></i></td>'
                } else {
                    html += '<td><i title="Moet nog komen" data-toggle="tooltip" class="fa fa-calendar" aria-hidden="true"></i></td>'
                }

                html += '</td></tr>';
            }
        } else {
            html += "<tr><td colspan='8' class='text-center'>Geen resultaten gevonden</td></tr>"
        }
        return html;
    }


    function regenerateToken(callback = null) 
    {
        $.ajax({
            url: "/dashboard/newToken",
            method: 'POST',
            success: function(result) {
                token = result.new_token;
                document.cookie = "csrf_cookie="+result.new_token+";path=/";
                if (callback) {
                    callback();
                }
            },
            fail :function() {
                alert('Controlleer u internet verbiniding');
            }
        });
    }

    function setEventHandelers() 
    {
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
                        csrf_token: token,
                        json: 'true'
                    },
                    method: 'POST',
                    success: function(result) {
                        regenerateToken(
                            function() {
                                search();
                            }
                        )
                    },
                    fail :function() {
                        $('#spinner').toggle()
                        alert('Controlleer u internet verbiniding');
                    }
                });
            }
        });

        $(".navigation-js").click(function(e){

            e.preventDefault();
            $('#spinner').toggle()

            page = ($(this).attr('data-ci-pagination-page')-1)*10;
            var current = $('.active').attr('data-ci-pagination-page');
            var ci_pagination_page = page/10+1;

            if (page > amount*10 || (current-1)*10 === page) {
                $('#spinner').toggle()
                return;
            }

            if ( $(this).attr('rel') === 'prev') {
                if (current <= 1) {
                    $('#spinner').toggle()
                    return;
                }
                $('.active').removeClass('active');
                $('li[data-ci-pagination-page="'+ci_pagination_page+'"][rel!="prev"]').addClass('active')

            } else if ( $(this).attr('rel') === 'next' ) {
                $('.active').removeClass('active');
                $('li[data-ci-pagination-page="'+ci_pagination_page+'"][rel!="next"]').addClass('active')

            } else {
                $('.active').removeClass('active');
                $(this).addClass('active');
            }

            $('a[rel=\'next\']').attr('data-ci-pagination-page', ci_pagination_page+1)
            $('a[rel=\'prev\']').attr('data-ci-pagination-page', ci_pagination_page-1)
          
            window.history.pushState({}, 'Project-beheer', 'http://project-beheer/dashboard/index/'+page)
            //http://www.proboard.dvc-icta.nl/dashboard/index
            $.ajax({
                url: "/dashboard/index/"+page,
                method: 'POST',
                data: {
                    searchParamaters: terms,
                    json: 'true',
                    csrf_token: token
                },
                success: function( result ) {
                    var html = generateProjects(result);

                    $('#projects').empty().append(html);
                    setEventHandelers();
                    regenerateToken();
                    $('#spinner').toggle()
                },
                fail :function() {
                    $('#spinner').toggle()
                    alert('Controlleer u internet verbiniding');
                }
            });
        });
    }

    function search()
    {
        $('#spinner').toggle()
        $('.active').removeClass('active');

        $.ajax({
            url: "/dashboard/index/"+page,
            data: {
                searchParamaters: terms,
                json: 'true',
                csrf_token: token
            },
            method: 'POST',
            success: function(result) {

                regenerateToken();
                var html = generateProjects(result);

                $('#projects').empty().append(html);
                setEventHandelers();
                generateNave(result)
            },
            fail :function() {
                $('#spinner').toggle()
                alert('Controlleer u internet verbiniding');
            }
        });
    }

    function valideDate(date)
    {        
        return new Date(date);
    }

    function generateNave(result)
    {
        amount = Math.ceil(result.amount_of_items/10);

        if (amount <= 1) {
            $('#spinner').toggle()
            return;
        }   
        var html = '<li class="navigation-js" data-ci-pagination-page="1" rel="prev"><a href="#">&lt;</a></li>'

        for (i = 1; i <= amount; i++)  {
            if (i === (page/10+1)) {
                html += '<li rel="start" data-ci-pagination-page="'+i+'" class="active navigation-js"><a href="http://project-beheer/dashboard/index/">'+i+'</a></li>'
            } else {
                html += '<li data-ci-pagination-page="'+i+'" class="navigation-js"><a href="http://project-beheer/dashboard/index/'+i+'0">'+i+'</a></li>'
            } 
            if (i == amount) {
                html += '<li rel="next" data-ci-pagination-page="'+i+'" class="navigation-js"><a href="http://project-beheer/dashboard/index/'+i+'0">&gt;</a></li>'
            } 
        }
        
        $('#pagination').empty().append(html);
        $('#spinner').toggle()
        setEventHandelers();
    }
})
