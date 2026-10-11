<?php
include "db.php";
session_start();

$id=$_SESSION["id"];
$sql=$conn->prepare("select * from books where id=?");
$sql->bind_param("i",$id);
$sql->execute();
$result=$sql->get_result();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $bname = $_POST["bname"];
    $ISBN = $_POST["ISBN"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $author = $_POST["author"];
    $sql = $conn->prepare("insert into books (bname,ISBN,category,price,author,id) values (?, ?, ?, ?,?,?)");
    $sql->bind_param("sisisi", $bname,$ISBN,$category,$price,$author,$id);
    if ($sql->execute()) {
        header("Location: home.php");

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
            <nav
                class="navbar navbar-expand-sm navbar-light bg-light"
            >
                <div class="container">
                   <h4>Hello! <?php echo $_SESSION["username"]
                    ?></h4>
                    <div class="collapse navbar-collapse" id="collapsibleNavId">
                        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                            
                            
                          
                        </ul>

                        <form class="d-flex my-4 my-lg-0" action="csv.php">
                             <button
                                class="btn btn-outline-success my-4 my-sm-0"
                                type="submit"
                            >
                                Download CSV
                            </button>
                        </form>
                        <form class="d-flex my-2 my-lg-0 ms-2" action=pdf.php>
                            <button
                                class="btn btn-outline-success my-2 my-sm-0"
                                type="submit"
                            >
                                Download pdf
                            </button>
                            <a
                                name=""
                                id=""
                                class="btn btn-primary ms-2"
                                href="logout.php"
                                role="button"
                                >Logout</a
                            >
                        </form>
                    </div>
                </div>
            </nav>
            
        </header>
        <main>
           <div class="text-center mt-4">
        <h2>Add Books...!</h2>
    </div>
        <div
            class="container col-5 p-3 border mt-4 rounded shadow"
        >
            <form action=""  method="POST">
                <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="bname"
                    id="formId1"
                    placeholder=""
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
                />
                
                <label for="formId1">ISBN</label>
            </div>
             <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="category"
                    id="formId1"
                    placeholder=""
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
                />
                <label for="formId1">Book Price</label>
            </div>
             <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="author"
                    id="formId1"
                    placeholder=""
                />
                <label for="formId1">Author</label>
            </div>
            <button
                type="submit"
                class="btn btn-success"
            >
                Submit
            </button>
            </form>
        </div>

        <div
            class="container col-6 p-3 mt-3"
        >
            <div
                class="table-responsive"
            >
                <table
                    class="table table-primary"
                >
                    <thead>
                        <tr>
                            <td>book_id</td>
                            <td>book_name</td>
                            <td>ISBN</td>
                            <td>category</td>
                            <td>price</td>
                            <td>author</td>
                            <td>edit</td>
                            <td>delete</td>
                        </tr>
                    </thead>
                        <?php
                while($row=$result->fetch_assoc()){?>
                <tr>
                <td><?php echo $row['bid']?></td>
                <td><?php echo $row['bname']?></td>
                <td><?php echo $row['ISBN']?></td>
                <td><?php echo $row['category']?></td>
                <td><?php echo $row['price']?></td>
                <td><?php echo $row['author']?></td>
                <td><a href="update.php?bid=<?php echo $row['bid']; ?>" class="btn btn-info btn-sm"> Edit</a></td>
                <td><a href="delete.php?bid=<?php echo $row['bid']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this book?');"> Delete</a></td>
                </tr>
              <?php  }?>
                </table>
            </div>
        </div>
    
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>