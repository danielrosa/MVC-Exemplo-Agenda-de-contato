<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
        <?php print htmlentities($title) ?>
        </title>
        
        <style>
        li{
            list-style: none;
            color: red;
	}
        </style>
    </head>
    <body>
        <?php
        if ( $errors ) {
            print '<ul class="errors">';
            foreach ( $errors as $field => $error ) {
                print '<li>'.htmlentities($error).'</li>';
            }
            print '</ul>';
        }
        ?>
        <form method="POST" action="">
            <label for="name">Nome:</label><br/>
            <input type="text" name="name" value="<?php print htmlentities($name) ?>"/>
            <br/>
            <label for="type">Tipo:</label><br/>
            
            <select name="type_contact">
            	<?php foreach($types as $type): ?>
            		<option value="<?php print htmlentities($type->id_type); ?>" > <?php print htmlentities($type->type_contact); ?> </option>
            	<?php endforeach; ?>
            </select>
            
            <br/>
            <label for="phone">Telefone:</label><br/>
            <input type="text" name="phone" value="<?php print htmlentities($phone) ?>"/>
            <br/>
            <label for="Date">Data Nascimento:</label><br/>
            <input type="date" name="date" value="<?php print htmlentities($date) ?>" />
            <br/>
            <label for="email">Email:</label><br/>
            <input type="text" name="email" value="<?php print htmlentities($email) ?>" />
            <br/>
            <label for="address">Endereco:</label><br/>
            <textarea name="address"><?php print htmlentities($address) ?></textarea>
            <br/>
            <input type="hidden" name="form-submitted" value="1" />
            <input type="submit" value="SALVAR" />
        </form>
        <br />
        <a href="index.php"><h3>Voltar</h3></a>
    </body>
</html>
