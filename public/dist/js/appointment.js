$(document).ready(function(){
    $("i#fullscreen").click(function(){
        $("header.main-header").toggle();
        $("aside.main-sidebar").toggle();
        $(".breadcrumbs-bar").toggle();
        $(".content-wrapper").toggleClass("content-wrapper-margin");
    });
});