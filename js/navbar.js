/**
 * Updated by cmpoon
 * Created by andrewhill on 06/07/2016.
 *
 * Contains the javascript relating to the Navbar
 * and it's contents
 *
 * use alongside navbar css
 */

//TODO: check ==

/** Auto activate **/
autoactivate = function(){
  var url = window.location.pathname;
  var filename = url.substring(url.lastIndexOf('/')+1);

    var navItems = $(".navbar-autoactivate li");

    /** Recursive activate for submenu **/
    navItems.each(function(idx, li) {
        var navbarItem = $(li);
        navbarItem.find('a').each(function() {
          if (filename == this.href ){
            navbarItem.addClass("active");
          }
        });

        /** Singular activate for single level-menu**/
        var navbarAnchor = navbarItem.children("a");
        var navhref = navbarAnchor.attr("href");

        //Check against
        if (filename == navhref || (navhref == "index.html" && filename == "")){

          navbarItem.addClass("active");
          navbarAnchor.html(navbarAnchor.html() + '<span class="sr-only"> (current)</span>');
        }
      });

    responsiveNavbar();
};


/* After page loads */
$( document ).ready(autoactivate);