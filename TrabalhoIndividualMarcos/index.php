<html>
    <head>
        <meta charset="UTF-8">
        <title>Página Inicial</title>
        <style>
  *{
            box-sizing: border-box;
        }
        body {
            width: 100%;
            height: 100%;
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(360deg, black, red);
        }

        form{
            width: 150px;
            margin: 150px auto;
            text-align: center;
        }
        
        div {
            background-color: rgba(0, 0, 0, 0.4);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 80px;
            border-radius: 15px;
            color:white;
        }


        input {
            display: block;
            margin: 10px auto;
            width: 250px;
            height: 30px;
        }
        </style>
    </head>
    <body>
        <h1>Digite para fazer login</h1>
        <form action="menu.php" method="POST">
            <fieldset>
                <legend>Dados de Usuário</legend>
                <table>
                    <tbody>
                        <?php if (isset($_SESSION['msg'])) { ?>
                        <tr><tr colspan="2" style="color: red;"
                            <?php echo $_SESSION['msg']; ?></tr></tr>
                            <?php
                                session_destroy();
                            } ?>                       
                        <tr>
                            <td>Usuário:</td>
                            <td><input type="text" name="usuario"/></td>
                        </tr>
                        <tr>
                            <td>Senha:</td>
                            <td><input type="password" name="senha"/></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" value="Entrar"/></td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </form>
    </body>
</html>
