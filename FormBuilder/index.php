<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="text-center">Hello, world!</h1>

    <div class="container">
        <div class="row">
            <div class="cal-8 mx-auto">
              <?php
              require_once "FormBuilder.php";
              $form = new FormBuilder("new-employee.php", "POST", ["id" => "send","class" => "border my-2 p-3"]);
              $form->input("text", "name", "", ["placeholder" => "enter ur name", "class" => "form-control my-2"])
              ->input("email", "email", "", ["placeholder" => "enter ur email", "class" => "form-control my-2"])
              ->input("password", "password", "", ["placeholder" => "enter ur password", "class" => "form-control my-2"])
              ->textarea("address", "", ["placeholder" => "enter ur address", "class" => "form-control my-2", "rows" => "3"])
              ->dropdown("role", ["admin" => "Admin", "user" => "User"], "user", ["class" => "form-control my-2"])
              ->checkbox("subscribe", "yes", false, ["class" => "form-check-input my-2"])
              ->submit("send",  ["class" => "form-control btn btn-primary"]);
              echo $form->build();
              ?>

                <!-- <form action="new-employee.php" method="POST" id="send" class="border my-2 p-3">
                    <input type="text" name="name" placeholder="enter ur name" class="form-control my-2">
                    <input type="submit" value="send" class="form-control btn btn-primary">
                </form> -->

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  </body>
</html>