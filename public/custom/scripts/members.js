$(document).ready(function(){
	$('#spinner').toggle()
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
    	$('#spinner').toggle()
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
                html += '<li rel="start" data-ci-pagination-page="'+i+'" class="active navigation-js"><a href="/members/index/">'+i+'</a></li>'
            } else {
                html += '<li data-ci-pagination-page="'+i+'" class="navigation-js"><a href="/members/index/'+i+'0">'+i+'</a></li>'
            } 
            if (i == amount) {
                html += '<li rel="next" data-ci-pagination-page="'+i+'" class="navigation-js"><a href="/members/index/'+i+'0">&gt;</a></li>'
            } 
        }
        
        $('#pagination').append(html);

        $(".navigation-js").click(function(e){

	        e.preventDefault();

	        page = ($(this).attr('data-ci-pagination-page')-1)*10;
	        var current = $('.active').attr('data-ci-pagination-page');
	        var ci_pagination_page = page/10+1;

	        if (page > amount*10 || (current-1)*10 === page || page == amount*10) return;

	        $('#spinner').toggle()

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
				$('#spinner').toggle()
				if (!nav) generateNave(result.amount)
				generateHtml(result.members);
			},
			fail :function() {
				$('#spinner').toggle()
				alert('Controlleer u internet verbiniding');
			}
		});
    }

    function generateHtml(result) {
		var html = "";
	
		for (var key in result ) {
			html += "\
			<tr>\
				<td>"+result[key].ovnumber+"</td>\
				<td>"+result[key].name+"</td>\
				<td>"+result[key].insertion+"</td>\
				<td>"+result[key].lastname+"</td>\
				<td><a href=\"/members/editMember/" + result[key].slug +'"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>';
			if (result[key].active == '1') {
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