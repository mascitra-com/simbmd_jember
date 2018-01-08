var theme = (function(){
    
    $(".alert").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
    });

	function setActive(klas) {
		$('#topbar-menu > .navbar-nav '+klas).addClass('active');
	}

	return {
		setActive : setActive
	}

})();