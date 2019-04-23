    <input type="hidden" name="id_module" id="moduleOnShow" value="{{$id_module}}">
    <!-- Ajouter div un pop-up qui ajoute un element au debut du tableau
    and submits it -->
    <div class="pop-up" id="add-div" style="display:none">
        <div class="inside-popup">
            <h3> Ajouter </h3>
            <form>
                <input type="text" name = "cne" id="cne" placeholder="cne" requiered > <br/>
                <input type="text" name = "name" id="nom" placeholder="nom" requiered > <br/>
                <input type="text" name = "prenom" id="prenom" placeholder="Prenom" requiered >  <br/>
                <label for="note" ><h5> Note :</h5></label> <input type="number" name = "note" id="note" requiered placeholder="12.34" min="0" max="20" step="0.001" requiered ><br/>
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
    <div id="div-table">
    <div id="top-bottom-gradient-color">
        <button class="waves-light btn-small" id="add-show"><i class="material-icons left" >add</i> Ajouter </button>
    </div>
        <table class="striped highlight" id="home-table">
        <thead id="home-thead">
            <tr>
                <th> CNE </th>
                <th> Nom </th>
                <th> Prenom </th>
                <th> Note </th>
                <th> ** </th>
            </tr>
        </thead>
        <tbody>
            @if($items)
                @foreach ($items as  $item)
                    <tr id="tr-{{$item->id}}">
                        <td class="td-{{$item->id}}" contenteditable='false'>{{$item->cne}}</td>
                        <td class="td-{{$item->id}}" contenteditable='false'>{{$item->nom}}</td>
                        <td class="td-{{$item->id}}" contenteditable='false'>{{$item->prenom}}</td>
                        <td class="td-{{$item->id}}" contenteditable='false'>{{$item->note}}</td>
                        <td>
                            <button class="waves-light btn-small del-show" value="{{$item->id}}"><i class="material-icons"> delete </i> </button>
                            <button class="waves-light btn-small modif-btn" value="{{$item->id}}" ><i class="material-icons"> edit</i></button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        </table>
    </div>
