$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
//selecciona todos los checkbox

    $('document').ready(function(){
    $("#checkTodos").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
});


