<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Tipo</title>
        
        <style type="text/css">
            li{
		list-style: none;
		color: red;
            }
			
            table.contacts {
                width: 100%;
            }
            
            table.contacts thead {
                background-color: #eee;
                text-align: left;
            }
            
            table.contacts thead th {
                border: solid 1px #fff;
                padding: 3px;
            }
            
            table.contacts tbody td {
                border: solid 1px #eee;
                padding: 3px;
            }
            
            a, a:hover, a:active, a:visited {
                color: blue;
                text-decoration: underline;
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
            <label for="type">Novo tipo:</label><br/>
            <input type="text" name="type" value="<?php print htmlentities($type) ?>"/>
            <br/>
            <label for="description">Descricao:</label><br/>
            <textarea name="description"><?php print htmlentities($description) ?></textarea>
            <br/>
            <input type="hidden" name="form-submitted" value="1" />
            <input type="submit" value="SALVAR" />
        </form>
        <br /><br />
        
        <table class="contacts" border="0" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Descricao</th>
                    <th>Operacao</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($types as $type): ?>
                <tr>
                    <td><?php print htmlentities($type->type_contact); ?></td>
                    <td><?php print htmlentities($type->description); ?></td>
                    <td><a href="index.php?op=deleteType&id=<?php print $type->id_type; ?>">Deletar</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php"><h3>Voltar</h3></a>
    </body>
</html>
