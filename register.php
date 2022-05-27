<?php 

include 'src/script/functions.php';

if (isset($_POST['register'])) {
    
    if (register($_POST) > 0) {
        echo "<script>alert('berhasil menambahkan user')</script>";
    } else {
        echo "<script>alert('gagal menambahkan user')</script>";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./src/style/index.css">
    <link rel="stylesheet" href="./src/style/background/colors.css">
    <link rel="stylesheet" href="./src/style/responsive/side-responsive.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container">
        <div class="login-container mt-sm-6">
            <div class="sd-background-reg m-0">
            </div>
            <div class="sd-login">
                <div class="content-login my-5 mx-5">
                    <h2 class="text-center text-purple">Register Form</h2>
                    <p class="text-center text-secondary">Silahkan register untuk menambahkan akun</p>

                    <form action="" method="POST" class="form-login mb-0" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="InputEmail1" class="form-label">Email address <b style="color: red;">*</b></label>
                            <div class="input-group">
                                <input type="email" name="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" require>
                                <span class="input-group-text" id="emailHelp">@example.com</span>
                                <div id="emailHelp" class="form-text">Kami tidak akan pernah membagikan email Anda kepada orang lain</div>
                            </div>
                        </div>
                        <div class="input-grup mb-3">
                            <label for="InputName" class="form-label">Full Name <b style="color: red;">*</b></label>
                            <input type="text" name="name" class="form-control" id="InputName" aria-describedby="emailHelp" require>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="InputUsername" class="form-label">Username <b style="color: red;">*</b></label>
                                    <input type="text" name="username" class="form-control" id="InputUsername" aria-describedby="usernameHelp" require>
                                </div>
                                <div class="col">
                                    <label for="formFile" class="form-label">Foto</label>
                                    <input class="form-control" name="foto" type="file" id="formFile">
                                    <div id="emailHelp" class="form-text">size tidak boleh lebih dari 50MB</div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="InputPassword1" class="form-label">Password <b style="color: red;">*</b></label>
                            <input type="password" name="password" class="form-control" id="InputPassword1" require>
                        </div>
                        <button type="submit" name="register" class="btn btn-purple" id="register" >Register</button>
                        <button type="button" class="btn btn-outline-danger" id="clear">Clear</button>

                        <label class="form-text mt-3 text-secondary" for="Check1">Sudah memiliki akun ? silahkan <a href="login.php" style="font-size: medium;">Login</a></label>
                    </form>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</body>
</html>