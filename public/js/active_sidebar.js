$(function(){ 
  $(".sidebar-menu a").click(function(e) {  
            var link = $(this);

            var item = link.parent("li");
            
            if (item.hasClass("active menu-open")) {
                item.removeClass("active").children("a").removeClass("active");
            } else {
                item.addClass("active").children("a").addClass("active");
            }

            if (item.children("ul").length > 0) {
                var href = link.attr("href");
                link.attr("href", "#");
                setTimeout(function () { 
                    link.attr("href", href);
                }, 100);
                e.preventDefault();
            }
        })
        .each(function() {
            var link = $(this);
            if (link.get(0).href === location.href) {
                link.addClass("active").parents("li").addClass("active menu-open");
                return false;
            }
        });  
});