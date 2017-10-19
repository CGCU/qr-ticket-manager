/**
 * Updated by cmpoon
 * Created by andrewhill on 06/07/2016.
 *
 * Contains the javascript relating to the Navbar
 * and it's contents
 *
 * use alongside navbar css
 */

//TODO: check == vs === etc here (PHP is great)

/** Auto activate **/
autoactivate = function(){
  var url = window.location.pathname;
  console.log(url);
  var filename = url.substring(url.lastIndexOf('/') + 1);
  console.log(filename);

    var navItems = $(".navbar-autoactivate li");

    /** Recursive activate for submenu **/
    navItems.each(function(idx, li) {
        var navbarItem = $(li);
        navbarItem.find('a').each(function() {
            var navbar_url = this.href.substring(this.href.lastIndexOf('/') + 1);
            console.log(navbar_url);
          if (filename == navbar_url){
            navbarItem.addClass("active");
          }
        });

        /** Singular activate for single level-menu**/
        var navbarAnchor = navbarItem.children("a");
        var navhref = navbarAnchor.attr("href");

        //Check against
        if (filename == navhref || (navhref == "index.php" && filename == "")){

          navbarItem.addClass("active");
          navbarAnchor.html(navbarAnchor.html() + '<span class="sr-only"> (current)</span>');
        }
      });

};


/* After page loads */
$( document ).ready(autoactivate);