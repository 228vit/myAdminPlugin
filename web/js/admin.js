jQuery(document).ready(function($){
  // animate filters
  if (typeof filtersShow === 'undefined') {
    filtersShow = 'show filters';
  }
  if (typeof filtersCaption === 'undefined') {
    filtersCaption = 'Filters';
  }
  $('.sf_admin_filter').hide();
  $('.sf_admin_filter form').attr('id', 'sf_admin_filter_form');
  $('#sf_admin_bar').prepend('<a id="showFilters" href="#sf_admin_filter_form">'+filtersShow+'</a>');
  
  $('#showFilters').button().click(function() {
//    $('.sf_admin_filter').slideDown('slow');
    $('#sf_admin_filter_form').dialog({
        width: 'auto',
        height: 'auto',
        closeOnEscape: true,
        modal: true,
        title: filtersCaption
    });
  });
  
  if ($("div#adminWrap").length > 0) {
    // create tabs and select current module
    $tabs = $("#adminWrap").tabs();
    $tabs.tabs('select', '#'+currentModule);
  } else {
//    alert('no tabs in document');
  }

  function showProcess(){
      var popupX = Math.round( ($(window).width() - $("#result_div").width()) / 2) ;
      var popupY = $(document).scrollTop() + Math.round($(window).height()/2) - Math.round($("#result_div").height()/2);
      $("#result_div").css({top: popupY+"px", left: popupX+"px"});
      $("#result_div").slideDown("slow");
  }

  function hideProcess(){
    $("#result_div").slideUp("slow");
  }

  $(".switch_status").each( function (){
    $(this).click( function () {
      var popupX = Math.round( ($(window).width() - $("#result_div").width()) / 2) ;
      var popupY = $(document).scrollTop() + Math.round($(window).height()/2) - Math.round($("#result_div").height()/2);
      $("#result_div").css({top: popupY+"px", left: popupX+"px"});
      var pic_dir = $(this).attr("pic_dir")
      var pic_id  = $(this).attr("rel")
      showProcess();

      $.ajax({
        type: "POST",
        url: $(this).attr('href'),
        data: "",
        success: function(msg){
          var pic_name = (msg == 1 ? "ok" : "cancel") + ".png"
          $("#"+pic_id).attr("src", pic_dir + "/" + pic_name)
          hideProcess();
        }
      });//ajax
      return false;
    })//click
  })//each


  $("#result_div").hide();

  $("body").after("<div id='result_div'></div>");
  $("#result_div").html("<img style='padding: 20px' src='/images/loading.gif' align='absmiddle' />  processing...");
  $("#result_div").hide();
  $("#result_div").css({
      "background-color": "#ffffcc",
      "opacity": "0.7",
      "width": "300px",
      "height": "auto",
      "font-family": "Arial Tahoma",
      "text-align": "center",
      "vertical-align": "middle",
      "border": "1px solid silver",
      "position": "absolute",
      "top": "40%",
      "left": "30%",
      "z-index": "9999"
  });

  $("#result_div").click(function (){
    hideProcess();
  });

//  window.setInterval(refreshSession, 10000);

//  function refreshSession() {
//    $.ajax({
//      type: "GET",
//      url: "/ping",
//      data: "",
//      dataType: 'json',
//      success: function(msg){
//        if (!msg.result) {
//          alert('relog!');
//        }
//      }
//    });//ajax
//  }
  
  $("a[rel=extraPics]").lightBox({
    imageLoading: '/images/lightbox/lightbox-ico-loading.gif',
    imageBtnClose: '/images/lightbox/lightbox-btn-close.gif',
    imageBtnPrev: '/images/lightbox/lightbox-btn-prev.gif',
    imageBtnNext: '/images/lightbox/lightbox-btn-next.gif'
  });
  
});