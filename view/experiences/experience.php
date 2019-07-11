<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="view/css/style.css">
</head>
<body>

    
    <div>
        <span>Entreprise :</span>
        <?php echo $contact->nomEntreprise;?>
    </div>
    <div>
        <span>Date :</span>
        <?php echo $contact->date;?>
    </div>
    <div>
        <span>Poste :</span>
        <?php echo $contact->poste;?>
    </div>
    <div>
        <span>Ville :</span>
        <?php echo $contact->ville;?>
    </div>
    <div>
        <span>description :</span>
        <?php echo $contact->description;?>
    </div>
</body>
</html>