<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/lumen/bootstrap.min.css" />
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/slate/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
  <link rel="stylesheet" href="../style.css" />
  <title>Library Management</title>
</head>

<?php
include_once("./db.php");
include_once("./requestHandler.php");
?>

<body>
  <header>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
      <a class="navbar-brand" href="index.php">LibManLite</a>
      <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Add book <span class="sr-only">(current)</span></a>
                    </li>

                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div> -->
    </nav>
  </header>
  <main>
    <section class="issue bg-secondary p-4">
      <div class="container">
        <!-- <h2 class="sec-title m-4 text-center">Issue Book</h2> -->
        <div class="col-md-8 m-auto">
          <form class="form-inline" action="<?php $_PHP_SELF ?>" method="POST">
            <div class="input-group m-1">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-book" aria-hidden="true"></i></span>
              </div>
              <input required type="number" class="form-control" name="book-id" placeholder="Book ID" aria-label="Book ID" />
            </div>
            <div class="input-group m-1">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
              </div>
              <input required type="email" class="form-control" name="user-email" placeholder="User Email" aria-label="User Email" />
            </div>
            <button type="submit" name="issue-book" class="btn btn-primary m-1">
              Issue Book
            </button>
          </form>
        </div>
      </div>
    </section>

    <section class="lists p-5">
      <div class="row">
        <div class="col-md-4 books-container mb-2">
          <div class="card border-light">
            <div class="card-header">
              <h3 class="title">Books</h3>
              <!-- Button trigger modal: add book -->
              <div class="btn-group">
                <button type="button" name="search" class="btn btn-primary btn-lg">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add-book-modal">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
              </div>
            </div>
            <input type="text" class="form-control search-input" name="search-books" placeholder="Search books">
            <ul class="list-group">
              <?php
              $books = $bookDB->getAll();
              if ($books) {
                // output data of each row
                foreach ($books as $book) { ?>
                  <li class="list-group-item" data-id="<?php echo $book->id; ?>">
                    <span>
                      <span class="id"><?php echo $book->id; ?></span>
                      <span class="name font-weight-bold">: <?php echo $book->name; ?> </span>
                      <span class="authors">by <?php echo $book->authors; ?></span>
                      <span class="count">(<?php echo $book->count; ?> copies)</span></span>
                    <button name="edit-book" class="btn btn-primary"><i class="fas fa-pen"></i></button>
                  </li>
              <?php }
              } else {
                echo "0 results";
              }
              ?>
            </ul>
          </div>
        </div>

        <div class="col-md-4 user-container mb-2">
          <div class="card border-light">
            <div class="card-header">
              <h3 class="title">Users</h3>
              <!-- Button trigger modal: add user -->
              <div class="btn-group">
                <button type="button" name="search" class="btn btn-primary btn-lg">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add-user-modal">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
              </div>
            </div>
            <input type="text" class="form-control search-input" name="search-users" placeholder="Search users">
            <ul class="list-group">
              <?php
              $users = $userDB->getAll();
              if ($users) {
                // output data of each row
                foreach ($users as $user) { ?>
                  <li class="list-group-item" data-id="<?php echo $user->email; ?>"><span>
                      <span class="name font-weight-bold"> <?php echo $user->name; ?> </span>
                      <span class="id">(<?php echo $user->email; ?>)</span></span>
                    <button name="edit-user" class="btn btn-primary"><i class="fas fa-pen"></i></button>
                  </li>
              <?php }
              } else {
                echo "0 results";
              }
              ?>
            </ul>
          </div>
        </div>

        <div class="col-md-4 issue-container mb-2">
          <div class="card border-light">
            <h3 class="title card-header">Issued</h3>
            <ul class="list-group">
              <?php
              $issues = $bookDB->getRegister();
              if ($issues) {
                // output data of each row
                foreach ($issues as $issue) { ?>
                  <li class="list-group-item">
                    <span class="info">
                      <span class="book">
                        <span class="id">Book: <?php echo $issue["book_name"]; ?> </span>
                        <span class="name"></span>
                      </span>
                      <span class="user">
                        <span class="id">Issued to: <?php echo $issue["username"]; ?> </span>
                        <span class="name"></span>
                      </span>
                    </span>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                      <input required hidden type="number" value="<?php echo $issue["id"]; ?>" name="issue-id">
                      <button type="submit" name="return-book" class="btn btn-primary">Return</button>
                    </form>
                  </li>
              <?php }
              } else {
                echo "0 results";
              }
              ?>
            </ul>
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer></footer>

  <section class="modals">
    <!-- Modal: add book -->
    <div class="modal fade" id="add-book-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add book</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <form action="<?php $_PHP_SELF ?>" method="POST">

                <input hidden required value="0" type="number" class="form-control" name="book-id" id="book-id" />

                <div class="form-group">
                  <label for="book-name">Book Name: </label>
                  <input required type="text" class="form-control" name="book-name" id="book-name" placeholder="e.g. ABCD Book" />
                </div>
                <div class="form-group">
                  <label for="book-authors">Author Name: </label>
                  <input required type="text" class="form-control" name="book-authors" id="book-authors" placeholder="e.g. John Doe" />
                </div>
                <div class="form-group">
                  <label for="book-count">Books Count: </label>
                  <input required type="number" class="form-control" name="book-count" id="book-count" placeholder="e.g. 5" min="1" />
                </div>
                <div class="modal-footer">
                  <button type="submit" name="delete-book" class="btn btn-danger">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </button>
                  <button type="submit" name="save-book" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal: add user -->
    <div class="modal fade" id="add-user-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <form action="<?php $_PHP_SELF ?>" method="POST">
                <input hidden type="text" name="user-update" value="false">
                <div class="form-group">
                  <label for="user-name">User Name: </label>
                  <input required type="text" class="form-control" name="user-name" id="user-name" placeholder="John Doe" />
                </div>
                <div class="form-group">
                  <label for="user-email">User Email: </label>
                  <input required type="email" class="form-control" name="user-email" id="user-email" placeholder="john@example.com" />
                </div>
                <div class="modal-footer">
                  <button type="submit" name="delete-user" class="btn btn-danger">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </button>
                  <button type="submit" name="save-user" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="../jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="./script.js"></script>
</body>

</html>