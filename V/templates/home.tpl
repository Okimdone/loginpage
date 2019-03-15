{extends file="layout.tpl"}
{block name=title}Home{/block}
{block name=body}   
    <a href="logout.php">Log Out!!</a>

    <table class="striped highlight">
        <thead>
            <tr>
                <th> Id </th>
                <th> Nom </th>
                <th> Prenom</th>
                <th> Note 1 </th>
                <th> Note 2 </th>
                <th> Moyenne </th>
            </tr>
        </thead>
        <tbody>
            {section loop=$etudiants name=row}
                <tr>
                    <td><input type="text" size="4" value = "{$etudiants[row]->id}"> </td>
                    <td><input type="text" size="4" value = "{$etudiants[row]->nom}"> </td>
                    <td><input type="text" size="4" value = "{$etudiants[row]->prenom}"> </td>
                    <td><input type="text" size="4" value ="{$etudiants[row]->note1}"> </td>
                    <td><input type="text" size="4" value ="{$etudiants[row]->note2}"> </td>
                    <td><input type="text" size="4" value ="{$etudiants[row]->moy}" ></td>
                    <td><input type = "button" value = "modifier">
                        <input type = "button" value = "supprimer"></td>
                </tr>
            {/section}

        </tbody>
    </table>             

{{/block}}