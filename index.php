<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" >
    <link href="css/mystyles.css" rel="stylesheet">
    <link rel="manifest" href="manifest.json">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
  <body>
    <?php include("config.php"); ?>
    <header>
      <nav class="navbar navbar-dark bg-dark fixed-top text-white"> 
        <div class="container-fluid">
            <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar">
                <div class="navbar-toggler-icon"></div>
            </button>
            <div class="offcanvas offcanvas-start text-bg-dark" id="offcanvasDarkNavbar">
              <div class="offcanvas-header">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
              </div>
              <div class="offcanvas-body">
                  <div class="pages-menu">
                    <a class="nav-link" href="Dashboard.html">Dashboard</a>
                    <a class="nav-link active" href="index.html">Students</a>
                    <a class="nav-link" href="Tasks.html">Tasks</a>
                  </div>
                </div>
              </div>
    
            <h5 class="text-white d-none d-md-block ms-3 mt-auto">CMS</h5>
    
            <div class="d-flex align-items-center position-relative ms-auto me-2">
              <div class="dropdown">

                <a href="Messages.html" class="d-flex align-items-center text-white">
                <div class="d-flex align-items-center">
                  <div class="me-4 bell-block">
                    <i class="bi bi-bell "></i>
                    <div class="notice-circle"></div>
                  </div>
                </div>
                </a>
              
                <ul class="dropdown-menu" id="message-dropdown">
                  <li class="d-flex align-items-center ms-3 me-3 my-2">
                    <div class=" d-flex align-items-center flex-column me-4">
                      <img src="acc3_icon.jpg" class="rounded-circle">
                      <div class = "text-nowrap">Max B.</div>
                    </div>
              
                    <div class="ms-3 position-relative">
                      <div class="messageField">Hello!</div>
                      <div class="messageTriangle"></div>
                    </div>
                  </li>
                  
                  <li class="d-flex align-items-center ms-3 me-3 my-2">
                    <div class=" d-flex align-items-center flex-column me-4">
                      <img src="acc2_icon.jpg" class="rounded-circle">
                      <div class = "text-nowrap">Jura F.</div>
                    </div>
              
                    <div class="ms-3 position-relative">
                      <div class="messageField">Hello! How are you?</div>
                      <div class="messageTriangle"></div>
                    </div>
                  </li>
                  
                </ul>
              </div>

              <div class="dropdown" id = "dropdown-block">
                <div class="d-flex align-items-center">
                    <img src="acc_icon.jpg" class="rounded-circle me-2">
                    <div class="d-none d-md-block text-nowrap">James Bond</div>
                </div>
            
                <ul class="dropdown-menu" id="profile-dropdown">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Log Out</a></li>
                </ul>
            </div>
          </div>
        </div>
      </nav>
    </header>

    <main>
      <div class="container">
        <div class="row">
            <div class="col-md-2 small-block d-none d-md-block mt-4">
              <div class="pages-menu">
                <a class="nav-link" href="Dashboard.html">Dashboard</a>
                <a class="nav-link active" href="index.html">Students</a>
                <a class="nav-link" href="Tasks.html">Tasks</a>
              </div>
            </div>
    
            <div class="col-md-10 large-block mt-4 functional-part">
                <h1>Students<h1>

                <div class="d-flex align-items-center">
                  <span class="ms-auto"></span>
                  <button class="btn-icon add-edit-button" data-id = "">
                    <i class="bi bi-plus"></i>
                  </button>
                </div>
                
                <div class = "table-responsive table-container mt-4">
                  <table class="table text-center table-bordered table-black-border align-middle students-table text-nowrap"">
                      <thead>
                        <tr>
                          <th><input type="checkbox"></th>
                          <th>Group</th>
                          <th>Name</th>
                          <th>Gender</th>
                          <th>Birthday</th>
                          <th>Status</th>
                          <th>Option</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php include("data_base_reader.php"); ?>
                      </tbody>
                  </table>
                </div>

                <div class="d-flex align-items-center mt-4 justify-content-center">
                      <ul class="pagination page-navigation">
                        <li class="page-item">
                          <a class="page-link text-dark" href="#"><</a>
                        </li>
                        <li><a class="page-link text-dark" href="#">1</a></li>
                        <li><a class="page-link text-dark" href="#">2</a></li>
                        <li><a class="page-link text-dark" href="#">3</a></li>
                        <li class="page-item">
                          <a class="page-link text-dark" href="#">></a>
                        </li>
                      </ul>
                </div>

            </div>
          
        </div>
      </div>
    </main>

    <footer>
    </footer>

    <div class="modal fade" id="student-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="ModalLabel">Add student</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body d-flex justify-content-center align-items-center text-nowrap">
              <input type="hidden" id="id">
              <form id="student-form">
              <div class="row mb-3">
                <label for="group" class="col-sm-3 col-form-label">Group</label>
                <div class="col-sm-9">
                  <select class="form-select" id="group">
                    <option selected disabled value="">Choose group</option>
                    <?php foreach($arrGroup as $key => $group){ ?>
                    <option value = "<?= $key ?>"><?=$group ?></option>
                    <?php } ?>
                  </select>
                  <div class = "invalid-feedback">
                    Choose group
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="first-name" class="col-sm-3 col-form-label">First name</label>
                <div class = col-sm-9>
                  <input type="text" class="form-control" id="first-name">
                  <div class = "invalid-feedback">
                    Enter first name
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="last-name" class="col-sm-3 col-form-label">Last name</label>
                <div class = col-sm-9>
                  <input type="text" class="form-control" id="last-name">
                  <div class = "invalid-feedback">
                    Enter last name
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="gender" class="col-sm-3 col-form-label">Gender</label>
                <div class="col-sm-9">
                  <select class="form-select" id="gender">
                    <option selected disabled value="">Choose gender</option>
                    <?php foreach($arrGender as $key => $gender){ ?>
                    <option value = "<?= $key ?>"><?=$gender?></option>
                    <?php } ?>
                  </select>
                  <div class = "invalid-feedback">
                    Choose gender
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="birth" class="col-sm-3 col-form-label">Birthday</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" id="birth">
                  <div class = "invalid-feedback">
                    Enter date
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="status" class="col-sm-3 col-form-label">Status</label>
                <div class = "col-sm-9 d-flex align-items-center">
                  <input type="checkbox" class="form-check-input" id="status">
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" id = "add-edit-submit" class="btn btn-primary">Add</button>
          </div>
        </div>
        </form>
      </div>
    </div>

    <div class="modal" id="delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <input hidden id ="deleteId">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <input type="hidden" id="delete-id">
          <div class="modal-body d-flex justify-content-center align-items-center text-nowrap" id="delete-message">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" id = "delete-submit" class="btn btn-primary">Ok</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
  </body>
</html>