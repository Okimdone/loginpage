{extends file="layout.tpl"}
{block name=title}Home{/block}
{block name=jscript}
    <script src="V/assets/js/jquery.min2.js"></script>
    <script src="V/assets/js/jhomescript.js"> </script>    
{/block}
{block name=body}

    <!-- Ajouter div un pop-up qui ajoute un element au debut du tableau
    and submits it -->
    <div class="pop-up" id="add-div" style="display:none">
        <div class="inside-popup">
            <h3> Ajouter </h3>
            <form>
                <input type="text" name = "name" id="nom" placeholder="Nom" requiered > <br/>
                <input type="text" name = "prenom" id="prenom" placeholder="Prenom" requiered >  <br/>
                <label for="note1" ><h5> Note 1:</h5></label> <input type="number" name = "note1" id="note1" requiered placeholder="12.34" min="0" max="20" step="0.001" requiered > 
                <label for="note2" ><h5> Note 2:</h5></label> <input type="number" name = "note2" id="note2" requiered placeholder="12.34" min="0" max="20" step="0.001" requiered ><br/>
                <button type="button" id="add-hide"  class="btn waves-effect waves-light"> Annuller </button>
                <button type="button" id="add-submit" name="sumbit" class="btn waves-effect waves-light"> Ajouter</button>
            </form>
        </div>
    </div>

    <!-- delete div for deleting an entery in the "etudiants" table
    and submiting it -->
    <div class="pop-up" id="delete-div" style="display:none">
        <div class="inside-popup">
            <form action="home.php" method="GET">
                <input type="hidden" name="id" id="todel-id">
                <h5> Êtes-vous sûr de bien vouloir supprimer cet étudiant </h5>
                <div class="margin-top-bot">
                    <button type="button" id="del-hide" class="btn waves-effect waves-light"> Annuller </button>
                    <button type="button"  id="del-submit" class="btn waves-effect waves-light" name="sumbit"> Supprimer </button>
                </div>
            </form> 
        </div>
    </div>
    <div id="log-out-div">
        <a href="logout.php" id="log-out"><img src="V/assets/img/logout.png" alt="Log Out" height="50" width="50"></a>
    </div>
    <div id="div-table">
    <div id="top-bottom-gradient-color">
        <button class="waves-light btn-small" id="add-show"><i class="material-icons left" >add</i> Ajouter </button>
    </div>
        <table class="striped highlight" id="home-table">
        <thead id="home-thead">
            <tr>
                <th> Id </th>
                <th> Nom </th>
                <th> Prenom </th>
                <th> Note 1 </th>
                <th> Note 2 </th>
                <th> Moyenne </th>
                <th> ** </th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$etudiants item=etudiant key=id name=name}
                <tr id="tr-{$id}">
                    <td class="td-{$id}" contenteditable='false'>{$id}</td>
                    <td class="td-{$id}" contenteditable='false'>{$etudiant->nom}</td>
                    <td class="td-{$id}" contenteditable='false'>{$etudiant->prenom}</td>
                    <td class="td-{$id}" contenteditable='false'>{$etudiant->note1}</td>
                    <td class="td-{$id}" contenteditable='false'>{$etudiant->note2}</td>
                    <td class="td-{$id}" contenteditable='false'>{$etudiant->moy}</td>
                    <td>
                        <button class="waves-light btn-small del-show" value="{$id}"><i class="material-icons"> delete </i> </button> 
                        <button class="waves-light btn-small modif-btn" value="{$id}" ><i class="material-icons"> edit</i></button>
                    </td>
                </tr>
            {/foreach}
        </tbody>
        </table>
    </div>
{/block}
