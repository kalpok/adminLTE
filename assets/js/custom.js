var parentMenuItem = $("ul.sidebar-menu li.active").parent();
parentMenuItem.css("display", "block");
parentMenuItem.parent().addClass("menu-open");
parentMenuItem
    .parent()
    .parent(".treeview-menu")
    .css("display", "block");
parentMenuItem
    .parent()
    .parent(".treeview-menu")
    .parent(".treeview")
    .addClass("menu-open");

$(".collapse-link").on("click", function() {
    var box = $(this).closest(".box"),
        icon = $(this).find("i"),
        content = box.find(".box-body");
    content.slideToggle(200);
    content.css("height", "auto");
    icon.toggleClass("fa-angle-up fa-angle-down");
});
