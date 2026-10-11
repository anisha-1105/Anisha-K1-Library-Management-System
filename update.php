<?php
include "db.php";
if(isset($_GET["bid"])){
    $bid=$_GET["bid"];
    $sql=$conn->prepare("select*from books where bid=?");
    $sql->bind_param("i",$bid);
    $sql->execute();
    $user=$sql->get_result()->fetch_assoc();
}
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $bname=$_POST["bname"];
    $ISBN=$_POST["ISBN"];
    $category=$_POST["category"];
    $price=$_POST["price"];
    $author=$_POST["author"];
    $sql=$conn->prepare("update books set bname=?,ISBN=?,category=?,price=?,author=? where bid=?");
    $sql->bind_param( "sisisi", $bname,$ISBN, $category, $price,$author, $bid );
   
    if($sql->execute()){
        header("Location:home.php");
    }
}
?>



<!doctype html>
<html lang="en" data-bs-theme="light">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS v5.3.8 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
          
            
        </header>
        <main>
          <div
                class="container text-center mt-5"
            >
                <h2>Update Books</h2>
            </div>
            <div
                class="container col-5"
            >
            <form method="POST">
               <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="bname"
                    id="formId1"
                    placeholder=""
                    value="<?=$user['bname']?>"
                />
                <label for="formId1">Book Name</label>
               </div>
               <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="ISBN"
                    id="formId1"
                    placeholder=""
                      value="<?=$user['ISBN']?>"
                />
                <label for="formId1">ISBN Number</label>
               </div>
                <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="category"
                    id="formId1"
                    placeholder=""
                    value="<?=$user['category']?>"
                />
                <label for="formId1">Book Category</label>
               </div>
                
                <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="price"
                    id="formId1"
                    placeholder=""
                      value="<?=$user['price']?>"
                />
                <label for="formId1">Book price</label>
               </div>
               <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="author"
                    id="formId1"
                    placeholder=""
                      value="<?=$user['author']?>"
                />
                <label for="formId1">Author</label>
               </div>
               <button
                type="submit"
                class="btn btn-primary"
               >
                Update
               </button>
            </form>
             </div>
     
        </main>
        <footer>
        </footer>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
