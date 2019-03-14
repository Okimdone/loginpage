{extends file="layout.tpl"}
{block name=title}Home{/block}
{block name=body}   
    <a href="logout.php">Log Out!!</a>

    <table>
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
                    <td>  {$etudiants[row].id} </td>

                </tr>
            {/section}
        </tbody>
    </table>             

{{/block}}