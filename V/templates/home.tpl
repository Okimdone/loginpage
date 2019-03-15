{extends file="layout.tpl"}
{block name=title}Home{/block}
{block name=body}
    <!-- modify div from modifing an entery in the "etudiants" table
    and submiting it -->
    <div>
        
    </div> 
    <a href="logout.php">Log Out!!</a>
    <table class="striped highlight">
    <thead>
       <th> Id </th>
       <th> Nom </th>
       <th> Prenom </th>
       <th> Note 1 </th>
       <th> Note 2 </th>
       <th> Moyenne </th>
       <th> ** </th>
    </thead>
    <tbody>
    {foreach from=$etudiants item=etudiant }
            <tr>
            <form action="home.php" method="post">
                <input type="hidden" name="delete" value="{$etudiant->id}">
                <td>{$etudiant->id}</td>
                <td>{$etudiant->nom}</td>
                <td>{$etudiant->prenom}</td>
                <td>{$etudiant->note1}</td>
                <td>{$etudiant->note2}</td>
                <td>{$etudiant->moy}</td>
                <td width="300px"><input type="submit" value="DELETE"> <button > Modifier </button></td>

            </form>
            </tr>

        {/foreach}
    </tbody>
    </table>
{{/block}}