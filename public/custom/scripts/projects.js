$(document).ready(function(){
    var url = window.location.href.split('/');
    var page = ($.isNumeric( url[5] )) ? url[5] : 0;
    var amount = 0;
    var token;
    var terms = "";
    var nav = false;

    regenerateToken(function() {
            search()
        }
    ); //get a token for csrf


    setInterval(function(){ 
        regenerateToken()
    }, 7200*1000);

    function generateProjects(result)
    {
        var html = '';
        var today = new Date();
        var iterationStart, iterationEnd ,codeReviewStart, codeReviewEnd;

        if (result.amount_of_items != 0) {
            for (var project in result['projects']) {

                html += '\
                <tr>\
                    <td>'+result['projects'][project]['name']+'</td>\
                    <td>'+result['projects'][project]['client']+'</td>\
                    <td>'+result['projects'][project]['teacher']+'</td>\
                    <td>\
                        <a target="_blank" href="'+result['projects'][project]['git_url']+'">git link</a><br>\
                        <a target="_blank" href="'+result['projects'][project]['trello_url']+'">trello link</a><br>\
                        <a target="_blank" href="'+result['projects'][project]['project_url']+'">project url</a><br> \
                        <a target="_blank" href="'+result['projects'][project]['bug_url']+'">bug url</a>\
                    </td><td>'

                    if (result['projects'][project]['members']) {
                        for (var member in result['projects'][project]['members']) {
                            html += result['projects'][project]['members'][member]['name']+" "+result['projects'][project]['members'][member]['insertion']+" "+result['projects'][project]['members'][member]['lastname']+" ";
                        }
                    }

                    html += '</td><td>'

                    if (result['projects'][project]['tags']) {
                        for (var tag in result['projects'][project]['tags']) {
                            html += '<span data-toggle="tooltip" title="' + result['projects'][project]['tags'][tag]['description'] + '" class="label label-info">'+result['projects'][project]['tags'][tag]['name']+'</span> '
                        }
                    }

                    html += '</td>';

                    html += '\
                    <td class="actions"><a title="Leden beheren" href="/projects/Members/'+result['projects'][project]['slug']+'"><i class="fa fa-users" aria-hidden="true"></i></a>\
                    <a title="Tags beheren" href="/projects/tags/'+result['projects'][project]['slug']+'"><i class="fa fa-tag" aria-hidden="true"></i></a>\
                    <a title="Project Bewerken" href="/projects/editProject/'+result['projects'][project]['slug']+'"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>'

                    if (result['projects'][project]['active']) {
                        html += "<td><i class='fa fa-circle green-text' aria-hidden='true'></i></td>"
                    } else {
                        html += "<td><i class='fa fa-circle red-text' aria-hidden='true'></td>"
                    }   

                html += '</tr>'
                
            }
        } else {
            html += "<tr><td colspan='8' class='text-center'>Geen resultaten gevonden</td></tr>"
        }
        $('#spinner').toggle()
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

    function search()
    {
        $('.active').removeClass('active');

        $.ajax({
            url: "/projects/overview/"+page,
            data: {
                json: 'true',
                csrf_token: token
            },
            method: 'POST',
            success: function(result) {

                regenerateToken();
                var html = generateProjects(result);

                if (!nav) generateNave(result.amount)
                $('#projects').empty().append(html); 
            },
            fail :function() {
                $('#spinner').toggle()
                alert('Controlleer u internet verbiniding');
            }
        });
    }

    function generateNave(result)
    {
        amount = Math.ceil(result/10);

        if (amount <= 1) {
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

        $(".navigation-js").click(function(e){

            e.preventDefault();

            page = ($(this).attr('data-ci-pagination-page')-1)*10;
            var current = $('.active').attr('data-ci-pagination-page');
            var ci_pagination_page = page/10+1;

            if (page > amount*10 || (current-1)*10 === page) {
                return;
            }

            if ( $(this).attr('rel') === 'prev') {
                if (current <= 1) {
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
          
            window.history.pushState({}, 'Project-beheer', 'http://project-beheer/projects/overview/'+page)
            //http://www.proboard.dvc-icta.nl/projects/overview/
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
                    regenerateToken();
                    $('#spinner').toggle()
                },
                fail :function() {
                    $('#spinner').toggle()
                    alert('Controlleer u internet verbiniding');
                }
            });
        });
        nav = true;
    }

})
