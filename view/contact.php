<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php print $contact->name; ?></title>
    </head>
    <body>
        <h1><?php print $contact->name; ?></h1>
        <h2 style="color: red"><?php print $msg; ?></h2>
        <div>
            <span class="label">TELEFONE:</span>
            <?php print $contact->phone; ?>
        </div> 
        <div>
            <span class="label">DATA DE NASCIMENTO:</span>
            <?php print $contact->date; ?>
        </div>
         <div>
            <span class="label">TIPO:</span>
            <?php print $contact->type_contact; ?>
        </div>
        <div>
            <span class="label">EMAIL:</span>
            <?php print $contact->email; ?>
        </div>
        <div>
            <span class="label">ENDERECO:</span>
            <?php print $contact->address; ?>
        </div>
    </body>
</html>
