$(function() {
    
    $("[name=select_all]").click(function(source) {
        checkboxes = $("[name=delete_select]");
        for(var i in checkboxes){
            checkboxes[i].checked = source.target.checked;
        }
        
        
    });
});

$(function () {
$("#btn_delete_all").click(function () {
    var selected = [];
    $("#example1 input[name=delete_select]:checked").each(function () {
        selected.push(this.value);
    });

    if (selected.length > 1) {
        $('#delete_select').modal('show')
        $('input[id="delete_select_id"]').val(selected);
    }
});
});