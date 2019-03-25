{extends file="layout.tpl"}
{block name=title}Login page{/block}
{block name=body}
    <div class="login-grid">
        <div class="nav-title header-login">
            <h1 class="text-center">Login</h1>
        </div>
        <div class="form-div">
            <form action="index.php" method="post">
                <div class="form-group">
                	<input class="form-control margin-bottom" name="uname" id="uname"  type="text" placeholder="Nom d'utilisateur" required > 
                	<input class="form-control" name= "passwd" id="passwd"   type="password" placeholder="Password"required>
                </div>
                {assign var='badlogin' value=$title|default:FALSE}
                {if $badlogin eq TRUE}
                    <div id="error-msg">
                        Nom d'utilisateur ou mot de passe incorrect. 
                        Réessayez ou cliquez sur "Mot de passe oublié" pour le réinitialiser.
                    </div>
                {/if}
                <div class="form-group-btns">
                	<button class="btn btn-primary" type="button" onclick="annuler();">Annuller</button>
                	<input class="btn btn-primary btn-ok" type="submit" value="Login">
                </div>
                <input type="hidden" name="route" value="login"/>
            </form>
            <div class="account-opt">
            	<a class="opt-acc readable-txt" id="forgoten" href="recover.php">Mot de passe oublié ?</a>
            	<a class="opt-acc readable-txt" id="register" href="enregistrer.php">Créer un compte</a>
            </div>
        </div>
    </div>
{/block}