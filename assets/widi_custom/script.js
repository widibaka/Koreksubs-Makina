$(document).ready(function(){

// NAVIGASI SIDEBAR
// Membuat menu item yang sedang aktif menyala, serta tidak bisa diklik ulang caranya tambahin "#"
var x = $('#content_header').attr('marker'); // Mengambil nilai marker

	swinum = $('#content_header').attr('marker');// mencocokkan marker dengan id yang sama dengna nilai marker
	
	switch(swinum){
	//Yang di dalem settings saya bikin manual aja lah, pusing mikirinnya...
	case "profile":
		//Karena treeview, makanya di settings gua kasih active juga. 
		//Because of treeview so I put active into the settings also
		$('#li_settings').addClass('active');
		$('#li_settings').addClass('menu-open');
		$('#profile').addClass('active');
		$('#profile').attr('href', "#");
	break;

	case "privacy":
		$('#li_settings').addClass('active');
		$('#li_settings').addClass('menu-open');
		$('#privacy').addClass('active');
		$('#privacy').attr('href', "#");
	break;

	case "preferences":
		$('#li_settings').addClass('active');
		$('#li_settings').addClass('menu-open');
		$('#preferences').addClass('active');
		$('#preferences').attr('href', "#");
	break;

	case "customization":
		$('#li_settings').addClass('active');
		$('#li_settings').addClass('menu-open');
		$('#customization').addClass('active');
		$('#customization').attr('href', "#");
	break;	
	
	// Naaah, kalo yang sidebar link yang level 1 otomatis gini
	case x:
		$('#'+x).addClass('active');
		$('#'+x).attr('href', "#");
	break;
	}
// ./NAVIGASI SIDEBAR


	// Class 'active' for the navbar
    $("#top_navbar").click(function(){
        $("li.nav-item").removeClass("active");
        $(this).addClass("active");
    });
	// Class 'active' for the sidebar
    $('#sidebar').click(function(){
        $("a.nav-link").removeClass("active");
        $(this).addClass("active");
    });


	// Class 'active' for the sidebar
    $('#sidebar').click(function(){
        $("a.nav-link").removeClass("active");
        $(this).addClass("active");
    });

});