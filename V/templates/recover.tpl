{extends file="layout.tpl"}
{block name=title}Récupérer votre compte{/block}
{block name=body}
    <div class="login-grid">
        <div class="nav-title header-login">
            <h1 class="font-60-centered">Saisissez <br/> votre mot de passe</h1>
        </div>
        <h1 class="text-center"></h1>
        <div class="form-div">
            <form action="recover.php" method="post">
                {if $fist_step eq TRUE}
                    <input class="form-control margin-bottom" name="uname" id="uname"  type="text" placeholder="Nom d'utilisateur" required > 
                    {if $uname_not_exists eq TRUE}
                        <div  class="error-msg-20px-mrg" id="error-msg">
                            Veuillez saisir un nom d'utilisateur valide.
                        </div>
                    {/if}
                    <input type="hidden" name="rec-step" value="first"/>
                {elseif $second_step eq TRUE}
                    <label>
                        <input type="password" name="passwd" id = "passwd" placeholder="Mot de passe" required> 
                    </label>
                    <label>
                        <input type="password" name="confpasswd" id="confpasswd" placeholder="Confirmer" required>
                        {if $no_conf_pass eq TRUE}
                            <div id="error-msg">
                                Confirmez votre mot de passe.
                            </div>
                        {/if}
                    </label>
                    <input type="hidden" name="rec-step" value="second"/>
                {elseif $end_step eq TRUE}
                    <div class="congrt-msg" >
                        <h3> Votre mot de passe est réinitialiser </h3>
                        <input type="hidden" name="rec-step" value="end"/>
                    </div>
                {/if}
                <div class="form-group-btns">
                    <input class="btn" type="submit" value="Suivant">
                </div>
                <input type="hidden" name="route" value="recovery"/>
            </form>
            <div class="account-opt text-center" >
            	<a class="opt-acc readable-txt " id="register" href="index.php">Se connecter à un compte existant</a>
            </div>
        </div>
    </div>
{/block}