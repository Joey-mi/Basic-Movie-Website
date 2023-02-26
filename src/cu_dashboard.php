<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA_Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial scale=1">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" 
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" 
            crossorigin="anonymous"
        >
        <link rel="stylesheet" href="./styles/browse.css">
        <title>Browse_Movies</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Calgary Cinemas Ltd.</span>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="cu_dashboard.php">Movies</a>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav ms-auto"> 
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" 
                        href="#" id="navbarDropdownMenuLink" 
                        role="button"
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="manage_account.php">Manage Account</a></li>
                            <li><a class="dropdown-item" href="Customerhelp/customerhelp.php">Help</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="page-container vertical-scroller">
            <h1>Movie Selection</h1>
            <form method="post" action="CustomerTicket/select_cinema.php">
                <input type="hidden" name="action" value="submit" />
                <div class="custom-col results"> 
                </div>
            </form>
        </div>
        <!--Jquery Core, minified-->
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script type="text/javascript">
            var start = 0;
            var limit = 10;
            var reachedMax = false;
            $(document).ready(function () {
                getData();
            });

            function getData() {
                if (reachedMax)
                    return;
                
                    $.ajax({
                        url: 'get_movies.php',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            getData: 1,
                            start: start,
                            limit: limit
                        }, 
                        success: function(response) {
                            if (response == "reachedMax") {
                                reachedMax = true;
                            } else {
                                start += limit;
                                $(".results").append(response);
                            }
                        }
                    });
            }
        </script>
    </body>
</html>