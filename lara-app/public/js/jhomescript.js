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
//time interval for the clind side to try and sync with the server-side
let time_interval = 1000 * 2;
setInterval( sync_cli_serv_ajaxcall, time_interval);

$(document).ready(function(){
    /*
    **  In case the client logged out
    */
});


/*
**  Send the whole saved data (added modified deleted) to the server to take action
**  and receives the data (added_elements s ids)
*/
function ajax_send_data(){
    return $.post('sync', { data: data }, function(server_s_added_data) {
        modified_list.length = 0;
        added_list.length    = 0;
        deleted_list.length  = 0;
        var fully_added_rows = JSON.parse(server_s_added_data);
        //  Loop over the added arrays sent by the server and add each one of them into the table
        Object.keys(fully_added_rows).forEach(function(id){
            /*
            **  the magic that add a line as the first row of the table on "Ajouter"
            */
            $('tbody tr:first').before(
                "<tr id=\"tr-" + id +"\" >\n"
                +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   id     + "</td>"
                +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   fully_added_rows[id]['nom']     + "</td>"
                +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   fully_added_rows[id]['prenom']  + "</td>"
                +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   fully_added_rows[id]['note1']   + "</td>"
                +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   fully_added_rows[id]['note2']   + "</td>"
                +    "<td class=\"td-" + id + "\" contenteditable='false'>" +   fully_added_rows[id]['moy']     + "</td>"
                +   "<td>"
                +   "    <button class=\"waves-light btn-small del-show\" value=" + id +"><i class=\"material-icons\"> delete </i> </button>"
                +   "    <button class=\"waves-light btn-small modif-btn\" value="+ id +"><i class=\"material-icons\"> edit</i></button>"
                +   "</td>"
                +"</tr>"
            );

        });
    });
}

function sync_cli_serv_ajaxcall(){
    if(modified_list.length ||   deleted_list.length  || added_list.length ) {
        ajax_send_data();
    }
}

