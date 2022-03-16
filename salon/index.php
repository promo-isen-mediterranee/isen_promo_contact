<?php
try {
    $bdd = new PDO("mysql:host=localhost;charset=utf8;dbname=salon","isen","isen");
} catch (PDOException $e) {
    throw new Exception($e->getCode(). ": " . $e->getMessage());
}

if (isset($_POST['submit'])) {
    if(isset($_POST['surname']) && !empty($_POST['surname']) && isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['curriculum']) && !empty($_POST['curriculum'])) {
        $surname = htmlspecialchars($_POST['surname']);
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $curriculum = htmlspecialchars($_POST['curriculum']);
        $wish = "";
        if (isset($_POST['cin']) && $_POST['cin'] == 'cin') {
            $wish .= $_POST['cin'] . ";";
        }
        if (isset($_POST['csi']) && $_POST['csi'] == 'csi') {
            $wish .= $_POST['csi'] . ";";
        }
        if (isset($_POST['biost']) && $_POST['biost'] == 'biost') {
            $wish .= $_POST['biost'] . ";";
        }
        if (isset($_POST['fise']) && $_POST['fise'] == 'fise') {
            $wish .= $_POST['fise'] . ";";
        }
        if (isset($_POST['fisa']) && $_POST['fisa'] == 'fisa') {
            $wish .= $_POST['fisa'] . ";";
        }
        if (isset($_POST['b_green']) && $_POST['b_green'] == 'b_green') {
            $wish .= $_POST['b_green'] . ";";
        }
        if (isset($_POST['b_gaming']) && $_POST['b_gaming'] == 'b_gaming') {
            $wish .= $_POST['b_gaming'] . ";";
        }
        if (isset($_POST['mastere']) && $_POST['mastere'] == 'mastere') {
            $wish .= $_POST['mastere'] . ";";
        }
        
        if (empty($wish)) {
            $error = "Tu dois choisir au moins une formation souhaitée.";
        } else if($curriculum == 0) {
            $error = "Ta formation actuelle n'a pas été renseignée.";
        }
        elseif ($curriculums_1 == 0) {
            $error = "Ta formation souhaitée n°1 n'a pas été renseignée.";
        } else {
            try {
                $sql = $bdd->prepare("INSERT INTO contacts(`nom`, `prenom`, `mail`, `telephone`, `for_act`, `for_fut`) VALUES (?,?,?,?,?,?)");
                $sql->execute(array($surname, $name, $email, $phone, $curriculum, $wish));
            } catch (PDOException $e) {
                throw new Exception($e->getCode(). ": " . $e->getMessage());
            }

            $message = "Votre contact a bien été sauvegardé.";
        }


    } else {
        $error = "As-tu bien rempli les champs nécessaire?";
    }
} ?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription Suivi</title>
    <link rel="stylesheet" href="node_modules/tailwindcss/dist/tailwind.css">
</head>
<body>
<?php
if(isset($message)) { ?>
    <div class="bg-green-600" id="banner">
      <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between flex-wrap">
          <div class="w-0 flex-1 flex items-center">
            <p class="ml-3 font-medium text-white truncate">
              <span class="text-white-75">
                Votre contact a bien été enregistré!
              </span>
            </p>
          </div>
          <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-3">
            <button type="button" class="-mr-1 flex p-2 rounded-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-white sm:-mr-2" id="dismiss">
              <span class="sr-only">Dismiss</span>
              <!-- Heroicon name: outline/x -->
              <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
<?php } if(isset($error)) { ?>
    <div class="bg-red-600" id="banner">
        <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between flex-wrap">
                <div class="w-0 flex-1 flex items-center">
                    <p class="ml-3 font-medium text-white truncate">
              <span class="text-white-75">
                <?= $error; ?>
              </span>
                    </p>
                </div>
                <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-3">
                    <button type="button" class="-mr-1 flex p-2 rounded-md hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-white sm:-mr-2" id="dismiss">
                        <span class="sr-only">Dismiss</span>
                        <!-- Heroicon name: outline/x -->
                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php }?>
<div class="min-h-full flex items-center justify-center px-4 sm:px-4 lg:px-6">
    <div class="max-w-md w-full space-y-8">
        <div>
            <img class="mx-auto w-auto" src="src/img/logo.jpg" alt="Logo de l'ISEN">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Restons connectés!
            </h2>
        </div>
        <form action="" method="post" class="mt-8 space-y-6" id="form">
            <i>Tous les champs marqués d'une étoile sont obligatoire</i>
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white">
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom *</label>
                    <input type="text" name="surname" id="nom" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-red-500 focus:border-red-500 focus:z-10 sm:text-sm" required autocomplete="off">
                    <label for="prenom">Prénom *</label>
                    <input type="text" name="name" id="prenom" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-red-500 focus:border-red-500 focus:z-10 sm:text-sm" required autocomplete="off">
                    <label for="mail">Adresse mail *</label>
                    <input type="email" name="email" id="mail" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-red-500 focus:border-red-500 focus:z-10 sm:text-sm" required autocomplete="off">
                    <label for="telephone">Numéro de téléphone</label>
                    <input type="tel" name="phone" id="telephone" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-red-500 focus:border-red-500 focus:z-10 sm:text-sm" required autocomplete="off">
                    <label for="formation">Formation actuelle *</label>
                    <select name="curriculum" id="formation" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm" required>
                        <option value="0">Choisir votre profil actuel</option>
                        <option value="1">Bac +2: DUT / BTS / IUT</option>
                        <option value="2">Bac +1: CPGE</option>
                        <option value="3">Terminale</option>
                        <option value="4">Première</option>
                        <option value="5">Seconde</option>
                        <option value="6">Collège</option>
                    </select><br>
                    <h5>Les formations qui t'intéressent:</h5><br>
                    <div class="flex items-center mb-4">
                        <input type="radio" name="cin" id="cin" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300" value="cin">
                        <label for"cin" class="text-sm font-medium text-gray-900 ml-2 block">CIN</label>
                    </div><br>
                    <div class="flex items-center mb-4">
                        <input type="radio" name="csi" id="csi" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300" value="csi">
                        <label for"csi" class="text-sm font-medium text-gray-900 ml-2 block">MPSI / PSI</label>
                    </div><br>
                    <div class="flex items-center mb-4">
                        <input type="radio" name="biost" id="biost" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300" value="biost">
                        <label for"biost" class="text-sm font-medium text-gray-900 ml-2 block">BIOST</label>
                    </div><br>
                    <div class="flex items-center mb-4">
                        <input type="radio" name="gise" id="inge" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300" value="fise">
                        <label for"inge" class="text-sm font-medium text-gray-900 ml-2 block">Cycle Ingénieur</label>
                    </div><br>
                    <div class="flex items-center mb-4">
                        <input type="radio" name="fisa" id="fisa" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300" value="fisa">
                        <label for"fisa" class="text-sm font-medium text-gray-900 ml-2 block">Alternance</label>
                    </div><br>
                    <div class="flex items-center mb-4">
                        <input type="radio" name="b_green" id="green" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300" value="b_green">
                        <label for"green" class="text-sm font-medium text-gray-900 ml-2 block">Bachelor GreenTech</label>
                    </div><br>
                    <div class="flex items-center mb-4">
                        <input type="radio" name="b_gaming" id="gaming" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300" value="b_gaming">
                        <label for"gaming" class="text-sm font-medium text-gray-900 ml-2 block">Bachelor Gaming</label>
                    </div><br>
                    <div class="flex items-center mb-4">
                        <input type="radio" name="mastere" id="mastere" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300" value="mastere">
                        <label for"mastere" class="text-sm font-medium text-gray-900 ml-2 block">Mastère</label>
                    </div>
                    <br><br>

                    <input type="submit" value="S'inscrire" name="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <input type="reset" value="Effacer le formulaire" name="reset" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-red bg-white-600 hover:bg-white-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                </div>
            </div>
        </form>
    </div>
</div>

<script src="src/js/index.js"></script>
</body>
</html>
