{extends file="layout.tpl"}
{block name=title}Home{/block}
{block name=body}
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
        {section name=row loop=$etudiants}
            <tr>
            <form action="smartytest.php" method="post">
                <input type="hidden" name="delete" value="{$etudiants[row].id}">
                <td>{$etudiants[row].id}</td>
                <td>{$etudiants[row].nom}</td>
                <td>{$etudiants[row].prenom}</td>
                <td>{$etudiants[row].note1}</td>
                <td>{$etudiants[row].note2}</td>
                <td>{$etudiants[row].moy}</td>
                <input type="submit" value="DELETE"></form>
            </pre>
            </tr>
        {/section}
    </tbody>
    </table>
{{/block}}