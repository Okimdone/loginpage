{extends file="layout.tpl"}
{block name=title}Home{/block}
{block name=jscript}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/jhomescript.js"> </script>    
{/block}
{block name=body}

    <!-- Ajouter div un pop-up qui ajoute un element au debut du tableau
    and submits it -->
    <div class="pop-up" id="add-div" style="display:none">
        <h3> Ajouter </h3>
        <form action="home.php" method="GET">
            <label> Nom   <input type="input" name = "name" id="nom" placeholder="Nom" > </label>
            <label> Prenom   <input type="input" name = "prenom" id="prenom" placeholder="Prenom" > </label>
            <label> Note 1  <input type="number" name = "note1" id="note1" placeholder="12.34" min="0" max="20" step="0.001" requiered > </label> 
            <label> Note 2  <input type="number" name = "note2" id="note2" placeholder="12.34" min="0" max="20" step="0.001" requiered > </label> 
            <button type="button" id="add-hide"> Annuller </button>
            <button type="button" id="add-submit" name="sumbit"> Ajouter</button>
        </form>
    </div>

    <!-- delete div for deleting an entery in the "etudiants" table
    and submiting it -->
    <div class="pop-up" id="delete-div" style="display:none">
        <form action="home.php" method="GET">
            <input type="hidden" name="id" id="todel-id">
            <h5> Êtes-vous sûr de bien vouloir supprimer cet étudiant </h5>
            <button type="button" id="del-hide"> Annuller </button>
            <button type="button"  id="del-submit" name="sumbit"> Supprimer </button>
        </form> 
    </div>

    <a href="logout.php">Log Out!!</a>
    <button id="add-show"> Ajouter </button>

    <table class="striped highlight">
    <thead>
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
                <td width="300px"><button class="del-show" value="{$id}"> Supprimer </button> <button class="modif-btn" value="{$id}" > Modifier </button></td>
            </tr>
        {/foreach}
    </tbody>
    </table>

{/block}