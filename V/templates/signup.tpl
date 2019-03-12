{extends file="layout.tpl"}
{block name=title}Créer votre compte{/block}
{block name=body}
    <div class="login-grid">
        <h1 class="text-center">Sign Up Now!</h1>
        <div class="form-div">
                
            <form action="enregistrer.php" method="post">
                <Label>
                    Nom d'utilisateur*: 
                    <input type="text" name="uname" id="uname" required>
                    {if $uname_exists eq TRUE}
                        <div id="error-msg">
                            Ce nom d'utilisateur est déjà utilisé. Essayez un autre nom.
                        </div>
                    {/if}
                </Label>
                <label>
                    Mot de passe*:
                    <input type="password" name="passwd" id = "passwd" required> 
                </label>
                <label>
                    Confirmer*:
                    <input type="password" name="confpasswd" id="confpasswd" required>
                    {if $no_conf_pass eq TRUE}
                        <div id="error-msg">
                            Confirmez votre mot de passe.
                        </div>
                    {/if}
                </label>
                <div>
                    <input type="submit" value="Suivant">
                </div>
                <input type="hidden" name="route" value="signup"/>
            </form>
            <div class="account-opt text-center" >
            	<a class="opt-acc" id="register" href="index.php">Se connecter à un compte existant</a>
            </div>
        </div>
    </div>
{/block}


