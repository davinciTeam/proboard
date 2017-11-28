$(document).ready(function(){
	var nav = false;
    var url = window.location.href.split('/');
    var page = ($.isNumeric( url[5] )) ? url[5] : 0;
    var searchParamaters = 
	{
		'active' : 'name',
		'name': 'ASC',
		'insertion': 'ASC',
		'lastname': 'ASC',
		'ovnumber': 'ASC',
	};

    $(".sorting").click(function(){

    	$('#'+searchParamaters['active']).removeClass('currentSorting');
    	$(this).addClass('currentSorting').children('span').toggleClass("glyphicon-arrow-up").toggleClass("glyphicon-arrow-down")
    	
    	searchParamaters['active'] = $(this).attr('id');

    	if (searchParamaters[$(this).attr('id')] === 'ASC') {
    		searchParamaters[$(this).attr('id')] = 'DESC'
		} else {
			searchParamaters[$(this).attr('id')] = 'ASC'
		}

    	ajax()
    });

    function generateNave(result)
    {
        var amount = Math.ceil(result/10);

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
        
        $('#pagination').append(html);

        $(".navigation-js").click(function(e){

	        e.preventDefault();

	        page = ($(this).attr('data-ci-pagination-page')-1)*10;
	        var current = $('.active').attr('data-ci-pagination-page');
	        var ci_pagination_page = page/10+1;

	        if (page > amount*10 || (current-1)*10 === page || page == amount*10) return;

	        if ( $(this).attr('rel') === 'prev') {
	        	if (current <= 1) return;
	        	$('.active').removeClass('active');
	        	$('li[data-ci-pagination-page="'+ci_pagination_page+'"][rel!="prev"]').addClass('active')

	        } else if ( $(this).attr('rel') === 'next' ) {
	        	$('.active').removeClass('active');
	        	$('li[data-ci-pagination-page="'+ci_pagination_page+'"][rel!="next"]').addClass('active')
	        } else {
	        	$('.active').removeClass('active');
		        $(this).addClass('active');
	        }
	      	
	    	$('li[rel=\'prev\']').attr('data-ci-pagination-page', ci_pagination_page-1)
	    	$('li[rel=\'next\']').attr('data-ci-pagination-page', ci_pagination_page+1)

	        window.history.pushState({}, 'Project-beheer', 'http://project-beheer/members/overview/'+page)
	        //http://www.proboard.dvc-icta.nl/members/overview

	        ajax()
	    });

	    nav = true;
    }

    function ajax()
    {
    	$.ajax({
			url: "/members/overview/"+page+"/true",
			method: 'POST',
			data: {
				field: searchParamaters['active'],
				search: searchParamaters[searchParamaters['active']]
			},
			success: function( result ) {
				if (!nav) generateNave(result.amount)
				generateHtml(result.members);
			},
			fail :function() {
				alert('Controlleer u internet verbiniding');
			}
		});
    }

    function generateHtml(result) {
		var html = "";
	
		for (var i = 0; i < 10; i++) {
			if (!result[i]) break;
			html += "\
			<tr>\
				<td>"+result[i].ovnumber+"</td>\
				<td>"+result[i].name+"</td>\
				<td>"+result[i].insertion+"</td>\
				<td>"+result[i].lastname+"</td>\
				<td><a href=\"/members/editMember/" + result[i].slug +'"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>';
			if (result[i].active == '1') {
				html += "<td><i class='fa fa-circle green-text' aria-hidden='true'></i></td>"
			} else {
				html += "<td><i class='fa fa-circle red-text' aria-hidden='true'></td>"
			}
			html += "</tr>";
		}
		$('#members').empty().append(html)
	}

	ajax()
});