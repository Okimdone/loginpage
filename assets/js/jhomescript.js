/*
**  Global Array/Lists that stores the [ids-values] of the 
**  table rows that must be [deleted-modified-Added] on into
**  the server s database
*/
let modified_list = new Array();
let deleted_list = new Array();
let added_list = new Array();
let data = {}
data['modified_list']=modified_list;
data['deleted_list'] =deleted_list;
data['added_list']   =added_list;

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
        var to_add_list = []
        $("#add-div input").each(function () {  
            to_add_list.push( $(this).val() );
            $(this).val("");
        });
        added_list.push(to_add_list);

        ajax_send_data();
 
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
        var todel_id = $("#todel-id").val();
        deleted_list.push( todel_id );
        var table_row_todel= "#tr-" + todel_id; 
    
        //  Check the already modified list if the entry exists if so delete it 
        for(var i = 0; i < modified_list.length; ++i){
            //  If so then remove it 
            if(modified_list[i][0] == todel_id) {
            modified_list.splice(i,1);
            break;
            }
        }
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
        td_texts.push( $(this).text().trim() );
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

/*
**  Send the whole saved data (added modified deleted) to the server to take action
**  and receives the data (added_elements s ids)
*/
function ajax_send_data(){
    return $.post('home.php', { data: data }, function(server_s_added_data) {
        modified_list = new Array();
        added_list    = new Array();
        deleted_list  = new Array();
        
        var fully_added_rows = JSON.parse(server_s_added_data); 
       
        //  Loop over the added arrays sent by the server and add each one of them into the table
        Object.keys(fully_added_rows).forEach(function(id){

            /*
            **  the magic that add a line as the first row of the table on "Ajouter"
            */
            $('table tr:first').after(
                "<tr>\n"
                +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   id     + "</td>"
                +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   fully_added_rows[id]['nom']     + "</td>"
                +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   fully_added_rows[id]['prenom']  + "</td>"
                +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   fully_added_rows[id]['note1']   + "</td>"
                +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   fully_added_rows[id]['note2']   + "</td>"
                +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   fully_added_rows[id]['moy']     + "</td>"
                +    "<td width=\"300px\"> <button id=\"del-show\"> Supprimer </button> <button class=\"modif-btn\" value=\"" + id + "\" > Modifier </button></td>"
                +"</tr>"
            );
        
        });
    });
}