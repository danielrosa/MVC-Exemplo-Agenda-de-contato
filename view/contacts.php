<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Contato</title>
        <style type="text/css">
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
        <div><a href="index.php?op=new"><h2>+ Add novo contato</h2></a></div>
        <div><a href="index.php?op=newtype"><h2>+ Add novo tipo</h2></a></div>
        <table class="contacts" border="0" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th><a href="?orderby=name">Nome</a></th>
                    <th><a href="?orderby=phone">Data Nascimento</a></th>
                    <th><a href="?orderby=phone">Telefone</a></th>
                    <th><a href="?orderby=email">Email</a></th>
                    <th><a href="?orderby=tipo">Tipo</a></th>
                    <th><a href="?orderby=address">Endereco</a></th>
                    <th colspan="2">Operacoes</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($contacts as $contact): ?>
                <tr>
                    <td><a href="index.php?op=show&id=<?php print $contact->id; ?>"><?php print htmlentities($contact->name); ?></a></td>
                    <td><?php print htmlentities($contact->date); ?></td>
                    <td><?php print htmlentities($contact->phone); ?></td>
                    <td><?php print htmlentities($contact->email); ?></td>
                   
                    <td title="<?php print htmlentities($contact->description); ?>">
                    	<?php print htmlentities($contact->type_contact); ?>
                    </td>
                    
                    <td><?php print htmlentities($contact->address); ?></td>
                    <td><a href="index.php?op=delete&id=<?php print $contact->id; ?>">Deletar</a></td>
                    <td><a href="index.php?op=edit&id=<?php print $contact->id; ?>">Editar</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>
