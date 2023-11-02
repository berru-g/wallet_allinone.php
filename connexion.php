<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=wallet_allinone;charset=utf8;', 'root', 'root');
if (isset($_POST['envoie'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['mdp'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mdp = htmlspecialchars($_POST['mdp']);
        //$mdp = sha1($_POST['mdp']);

        $recupUser = $bdd->prepare('SELECT * FROM users WHERE pseudo = ? AND mdp = ?');
        $recupUser->execute(array($pseudo, $mdp));
        
        if($recupUser->rowCount() > 0){
          $_SESSION['pseudo'] = $pseudo;
          $_SESSION['mdp'] = $mdp;
          $_SESSION['id'] = $recupUser->fetch()['id'];
        }
        
        header('location: home.php');
    } else{
      echo "Veuillez vous connecter";
    }
}
?>
<html lang="en">
  <!-- I needed an all in one wallet, I'm happy with the result so I'm sharing. 
Change your money in the API and their values ​​in the script to constnomcryptoResponse.
https://github.com/berru-g/All-in-one-dashboard-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wallet all in one</title>
  <link rel="shortcut icon" href="https://github.com/berru-g/All-in-one-dashboard/blob/main/img/icons8-wallet-100.png?raw=true" />
    <meta name="description" content="Wallet all in one, tout vos portefeuille en un seul. Avoir une vision sur ses wallet.">
  <meta name="keywords" content="wallet, all in one, portefeuille crypto, binance, ledger, usdt wallet, btc wallet, all in one wallet">
  <meta name="author" content="berru-g github">
  <meta name="robots" content="index, follow">  
  <meta property="og:title" content="Outil de gestion de portefeuille wallet.">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.9.55/css/materialdesignicons.min.css">

</head>

    <?php include_once('header.php'); ?>

    <body>

<div id="message">
<h2>Login</h2>
<form id="monFormulaire" action="" method="POST" enctype="multipart/form-data" class="proceed maskable" name="login" autocomplete="off" novalidate="">
                    <div id="passwordSection" class="clearfix">
                        <div class="textInput" id="pseudodiv">
                            <div class="fieldWrapper">
                                <label for="text" class="form-label"></label>
                                <input id="text" name="pseudo" type="text" class="hasHelp  validateEmpty " required="required" aria-required="true" value="" autocomplete="off" placeholder="email">
                            </div>
                        </div>
                        <div class="textInput lastInputField" id="mdpdiv">
                            <div class="fieldWrapper"><label for="password" class="form-label"></label>
                                <input id="password" name="mdp" type="password" class="hasHelp  validateEmpty " required="required" aria-required="true" value="" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <button class="inscription" type="submit" id="envoie" name="envoie" value="Login">Connexion</button>
                </form>
</div>
<script src="script.js"></script>
</body>
<?php include_once('footer.php'); ?>

</html>