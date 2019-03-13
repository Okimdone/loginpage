{extends file="layout.tpl"}
{block name=title}Récupérer votre compte{/block}
{block name=body}
    <div class="login-grid">
        <h1 class="text-center">Saisissez votre nom d'utilisateur</h1>
        <div class="form-div">
            <form action="recover.php" method="post">
                {if $fist_step eq TRUE}
                    <Label>
                        Nom d'utilisateur*: 
                        <input type="text" name="uname" id="uname" required>
                        {if $uname_not_exists eq TRUE}
                            <div id="error-msg">
                                Veuillez saisir un nom d'utilisateur valide.
                            </div>
                        {/if}
                    </Label>
                    <input type="hidden" name="rec-step" value="first"/>
                {elseif $second_step eq TRUE}
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
                    <input type="hidden" name="rec-step" value="second"/>
                {elseif $end_step eq TRUE}
                    Votre mot de passe est Réinitialiser
                    <input type="hidden" name="rec-step" value="end"/>
                {/if}
                <div>
                    <input type="submit" value="Suivant">
                </div>
                <input type="hidden" name="route" value="recovery"/>
            </form>
            <div class="account-opt text-center" >
            	<a class="opt-acc" id="register" href="index.php">Se connecter à un compte existant</a>
            </div>
        </div>
    </div>
{/block}