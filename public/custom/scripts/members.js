$(document).ready(function(){
	var searchParamaters = 
	{
		'active' : 'name',
		'name': 'ASC',
		'insertion': 'ASC',
		'lastname': 'ASC',
		'ovnumber': 'ASC',
	};

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

    $(".sorting").click(function(){

    	$('#'+searchParamaters['active']).removeClass('currentSorting');
    	$(this).addClass('currentSorting').children('span').toggleClass("glyphicon-arrow-up").toggleClass("glyphicon-arrow-down")
    	
    	searchParamaters['active'] = $(this).attr('id');

    	if (searchParamaters[$(this).attr('id')] === 'ASC') {
    		searchParamaters[$(this).attr('id')] = 'DESC'
		} else {
			searchParamaters[$(this).attr('id')] = 'ASC'
		}

    	$.ajax({
			url: "/members/overview/0/true",
			data: {
				field: $(this).attr('id'),
				search: searchParamaters[$(this).attr('id')]
			},
			method: 'POST',
			success: function(result) {
				generateHtml(result);
			},
			fail :function() {
				alert('Controlleer u internet verbiniding');
			}
		});
    });

    $(".navigation-js").click(function(e){

        e.preventDefault();

        var page = $(this).children();
        page = ($(page['0']).attr('data-ci-pagination-page')-1)*10;
        var current = $('.active').children('a').attr('data-ci-pagination-page');
        var ci_pagination_page = page/10+1;

        if ( $(this).children('a').attr('rel') === 'prev') {
        	if (current <= 1) return;
        	$('a[data-ci-pagination-page="'+ci_pagination_page+'"][rel!="prev"]').parent('li').addClass('active')
        	$('a[rel=\'prev\']').attr('data-ci-pagination-page', ci_pagination_page-1)
        	$('a[rel=\'next\']').attr('data-ci-pagination-page', ci_pagination_page+1)

        } else if ( $(this).children('a').attr('rel') === 'next' ) {
        	$('a[data-ci-pagination-page="'+ci_pagination_page+'"][rel!="next"]').parent('li').addClass('active')
        	$('a[rel=\'next\']').attr('data-ci-pagination-page', ci_pagination_page+1)
        	$('a[rel=\'prev\']').attr('data-ci-pagination-page', ci_pagination_page-1)
        } else {
	        $(this).addClass('active');
	        $('a[rel=\'prev\']').attr('data-ci-pagination-page', ci_pagination_page-1)
        	$('a[rel=\'next\']').attr('data-ci-pagination-page', ci_pagination_page+1)
        }

        $('.active').removeClass('active');
      
        window.history.pushState({}, 'Project-beheer', 'http://project-beheer/members/overview/'+page)

        $.ajax({
			url: "/members/overview/"+page+"/true",
			method: 'POST',
			data: {
				field: searchParamaters['active'],
				search: searchParamaters[searchParamaters['active']]
			},
			success: function( result ) {
				generateHtml(result);
			},
			fail :function() {
				alert('Controlleer u internet verbiniding');
			}
		});
    });
});