/*
**  Global Array/Lists that stores the [ids-values] of the 
**  table rows that must be [deleted-modified-Added] on into
**  the server s database
*/
let modified_list = new Array();
let deleted_list = new Array();
let added_list = new Array();

$(document).ready(function(){
/*
**  the magic responsable for showing and hiding the pop-up
**  div-add to add an element the the table
*/
    $("#add-hide").click(function(){
        $("#add-div").hide();
    });
    $("#add-show").click(function(){
        $("#add-div").show();
    });
    $("#add-submit").click(function(){
        $("#add-div").hide();
        
        /*
        **  the magic that add a line as the first row of the table on "Ajouter"
        */


        $('#myTable tr:first').before(
            "<tr>\n"
            +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   id      + "</td>"
            +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   nom     + "</td>"
            +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   prenom  + "</td>"
            +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   note1   + "</td>"
            +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   note2   + "</td>"
            +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   moy     + "</td>"
            +    "<td width=\"300px\"> <button id=\"del-show\"> Supprimer </button> <button class=\"modif-btn\" value=\"" + id + "\" > Modifier </button></td>"
            +"</tr>"
        )
    });
    
/*
**  the magic responsable for showing and hiding the pop-up
**  div-Delete that confirms your delete-action
*/
    $("#del-hide").click(function(){
        $("#delete-div").hide();
    });
    $(".del-show").click(function(){
        $("#delete-div").show();
        $("#todel-id").val($(this).val());
    });
    $("#del-submit").click(function(){
        $("#delete-div").hide();
        deleted_list.push( $("#todel-id").val() );
        var table_row_todel= "#tr-" + $("#todel-id").val(); 
        alert(deleted_list);
        $(table_row_todel).remove();
    });

});

/*
**  Magic that takes care of Making table elements editable
**  and saving them as arrays into the  <modified_list> array
*/
$(document).on('click', '.modif-btn', function() {
    $(".td-" + $(this).val()).attr("contenteditable", "true");
    $(this).text("Appliquer");
    $(this).addClass("save-btn").removeClass("modif-btn");
});

$(document).on('click', '.save-btn', function(){
    // Make the colomns uneditable
    $(".td-" + $(this).val()).attr("contenteditable", "false");
    
    // Get the id of the modified row 
    var tr_modifier = "#tr-" + $(this).val();

    // Create and fill an array with the values in the selected row s colomns
    var td_texts = new Array(); 
    $(tr_modifier).children().each( function() {
        td_texts.push( $(this).text() );
    });

    //  Check the already modified list if the entry exists
    for(var i = 0; i < modified_list.length; ++i){
        //  If so then remove it 
        if(modified_list[i][0] == td_texts[0]) {
           modified_list.splice(i,1);
           break;
        }
    }
    // Save the new list to the global array
    modified_list.push( td_texts.slice(0,5) );

    // Change to state of the button
    $(this).text("Modifier");
    $(this).addClass("modif-btn").removeClass("save-btn");
});