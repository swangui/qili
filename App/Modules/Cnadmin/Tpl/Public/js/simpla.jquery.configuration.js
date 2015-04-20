$(function(){	
	//Sidebar Accordion Menu:
	$("#main-nav li ul").hide(); // Hide all sub menus
	$("#main-nav li a.current").parent().find("ul").slideToggle("slow"); // Slide down the current menu item's sub menu
	
	$("#main-nav li a.nav-top-item").click( // When a top menu item is clicked...
		function () {
			$(this).parent().siblings().find("ul").hide(); // Slide up all sub menus except the one clicked
			$(this).next().slideToggle("normal"); // Slide down the clicked sub menu
			$(this).addClass('current');
			$(this).parent().siblings().find('a').removeClass('current');
		}
	); 	
	// Sidebar Accordion Menu Hover Effect:	
	$("#main-nav li .nav-top-item").hover(
		function () {
			$(this).stop().animate({ paddingLeft: "60px" }, 200);
		}, 
		function () {
			$(this).stop().animate({ paddingLeft: "40px" });
		}
	);
	$("#main-nav li ul li a").click( // When a top menu item is clicked...
		function () {
			$(this).addClass('currents');
			$(this).parent().siblings().find('a').removeClass('currents');
		}
	)
})
  
  
  