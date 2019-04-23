// laravel X-CSRF TOKEN used so that every post request to the would be accepted an handeled
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    }
});
/*
**  Global Array/Lists that stores the [ids-values] of the
**  table rows that must be [deleted-modified-Added] on into
**  the server s database
*/
let modified_list = new Array();
let deleted_list = new Array();
let added_list = new Array();
let data =  { modified_list :modified_list
        , deleted_list : deleted_list
        , added_list   : added_list
        };
//time interval for the clind side to try and sync with the server-side
let time_interval = 1000 * 10;
setInterval( sync_cli_serv_ajaxcall, time_interval);
function sync_cli_serv_ajaxcall(){
    if(modified_list.length ||   deleted_list.length  || added_list.length ) {
        ajax_send_data();
    }
}


// {"added_list" : [{"nom":  "achraf", "prenom":"bougadre", "cne":"123456", "note": 12.25, "id_module": 3 }] ,

/*
**  the magic responsable for showing and hiding the pop-up
**  div-add to add an element the the table
*/
$(document).on('click','#add-hide', function(){
    $("#add-div").hide();
});
$(document).on('click','#add-show', function(){
    $("#add-div").show();
});
$(document).on('click','#add-submit', function(){
    $("#add-div").hide();
    var to_add_list = []
    $("#add-div input").each(function () {
        to_add_list.push( $(this).val() );
        $(this).val("");
    });
    var obj = {cne: to_add_list[0], nom: to_add_list[1], prenom: to_add_list[2], note: to_add_list[3], id_module: $('#moduleOnShow').val()};
    added_list.push(obj);

    ajax_send_data();
});




//{ "deleted_list" :[ {"cne":"123456", "id_module": 3 } ]  }
/*
**  the magic responsable for showing and hiding the pop-up
**  div-Delete that confirms your delete-action
*/
$(document).on('click','#del-hide', function(){
    $("#delete-div").hide();
});
$(document).on('click','#del-submit', function(){
    $("#delete-div").hide();
    var todel_id = $("#todel-id").val();
    deleted_list.push( todel_id );
    var table_row_todel= "#tr-" + todel_id;
    var obj = {cne: $(table_row_todel+ " td:first").text() , id_module: $('#moduleOnShow').val()};

    //  Check the already modified list if the entry exists if so delete it
    for(var i = 0; i < modified_list.length; ++i){
        //  If so then remove it
        if(modified_list[i].cne == obj.cne) {
            modified_list.splice(i,1);
        break;
        }
    }
    $(table_row_todel).remove();
});
/*
**  On click show delete popup
*/
$(document).on('click', ".del-show", function(){
    $("#delete-div").show();
    $("#todel-id").val($(this).val());
});




// {"modified_list" : [{"cne":"123456", "nom":  "achraf", "prenom":"bougadre", "note": 12.25, "id_module": 3 }], "deleted_list" : [] }
/*
**  Magic that takes care of Making table elements editable
**  and saving them as arrays into the  <modified_list> array
*/
$(document).on('click', '.modif-btn', function() {
    $(".td-" + $(this).val()).attr("contenteditable", "true");
    $(this).html("<i class=\"material-icons\">save</i>");
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
    var obj = {cne: td_texts[0], nom: td_texts[1], prenom: td_texts[2], note: td_texts[3], id_module: $('#moduleOnShow').val()};
    for(var i = 0; i < modified_list.length; ++i){
        //  If so then remove it
        if(modified_list[i].cne == obj.cne) {
           modified_list.splice(i,1);
           break;
        }
    }

    // Save the new list to the global array
    modified_list.push( obj );

    // Change to state of the button
    $(this).html("<i class=\"material-icons\"> edit</i>");
    $(this).addClass("modif-btn").removeClass("save-btn");
});



/*
**  Logout actions
*/
$(document).on('click', '#log-out', function(){
    sync_cli_serv_ajaxcall();
});





function ajax_send_data(){
    $.ajaxSetup({
        headers: { 'Authorization': 'bearer ' + localStorage.getItem('token')},
    });
    $.ajax({
        url:     "sync",
        type:    "POST",
        data: {data: data},
        dataType: 'text',
        success: function(added_ids) {

            var fully_added_rows = JSON.parse(added_ids);
            //  Loop over the added arrays sent by the server and add each one of them into the table
            Object.keys(fully_added_rows).forEach(function(id){
                /*
                **  the magic that add a line as the first row of the table on "Ajouter"
                */
               $('tbody tr:first').before(
                   "<tr id=\"tr-" + id +"\" >\n"
                   +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   data.added_list[0].cne     + "</td>"
                   +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   data.added_list[0].nom     + "</td>"
                   +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   data.added_list[0].prenom  + "</td>"
                   +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   data.added_list[0].note   + "</td>"
                   +   "<td>"
                   +   "    <button class=\"waves-light btn-small del-show\" value=" + id +"><i class=\"material-icons\"> delete </i> </button>"
                   +   "    <button class=\"waves-light btn-small modif-btn\" value="+ id +"><i class=\"material-icons\"> edit</i></button>"
                   +   "</td>"
                   +"</tr>"
                   );
                modified_list.length = 0;
                added_list.length    = 0;
                deleted_list.length  = 0;

            });
        },
        // Error handling
        error:   function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
        }
    });
}












/*  By clicking on a 'module', it sends an Ajax request to the server to make and
**  send a table of student/notes for that module
*/
$(document).on('click','.modules', function() {
    $.ajax({
        url: '/getNotes',
        type: 'GET',
        data: { module: $(this).text().toLowerCase() },
        success: function(response)
        {
            $('#mainContainer').html(response);
        },
        error : function(){
            $('#mainContainer').html("<h5> Veuillez Selectionner un module! </h5>");
        }
    });
});


// taken from https://www.w3schools.com/w3css/tryit.asp?filename=tryw3css_sidebar_shift

function w3_open() {
    document.getElementById("main").style.marginLeft = "25%";
    document.getElementById("mySidebar").style.width = "25%";
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
    document.getElementById("main").style.marginLeft = "0%";
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("openNav").style.display = "inline-block";
}

