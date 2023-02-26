<?php include 'header.php'?>    
<?php header( "refresh:5;url=../cu_dashboard.php" );?>
        <div class="page-container-center">
            <h2>Payment Made</h2>
            <div class="info-container">
                <form action="payment_made.php" method="post">
                    <div class="custom-col" style="border-left-style: solid; padding-left: 1vh; color: #91919f;">                          
                            <?php
                                include "../logindb_connect.php";
                                session_start();

                                if(isset($_SESSION["user_name"])) {

                                    function validation($data)
                                    {
                                        $data = trim($data);
                                        $data = stripslashes($data);
                                        $data = htmlspecialchars($data);
                                        return $data;
                                    }

                                    $users_mail = validation($_SESSION["user_name"]);

                                    if(isset($_POST['paid']) && isset($_POST['card'])) {
                                        $d = '';
                                        $c = '';
                                        $payment_type = $_POST['card'];
                                        $payment_amount = $_POST['paid'];

                                        if ($payment_type === 'debit') {
                                            $d = 'Y';
                                            $c = 'N';
                                        } elseif ($payment_type === 'credit') {
                                            $d = 'N';
                                            $c = 'Y';
                                        }

                                        $statement = $con->prepare("INSERT INTO payment (debit, credit, amount, cemail) 
                                        VALUES (?, ?, ?, ?);");
                                        $statement->bind_param("ssss", $d, $c, $payment_amount, $users_mail);
                                        $exec = $statement->execute();
                                        
                                        if (!$exec) {
                                            die('Error: ' . mysqli_error());
                                        }

                                        $statement = $con->prepare("INSERT INTO booking_reference (booking_id, cus_email) 
                                        VALUES (NULL, ?);");
                                        $statement->bind_param("s", $users_mail);
                                        $exec = $statement->execute();
                                        
                                        if (!$exec) {
                                            die('Error: ' . mysqli_error());
                                        }

                                        $customer_ticket = $_POST['ticket_get'] ?? "";

                                        $statement = $con->prepare(
                                            "SELECT count(booking_id) FROM booking_reference");
                                            $exec = $statement->execute();
                                            $result = $statement->get_result();
                                      
                                          if (!$exec)
                                          {
                                          die('Error: ' . mysqli_error());
                                          }
                                          $book_id = mysqli_fetch_array($result)[0];

                                        $statement = $con->prepare("UPDATE ticket SET sold_flag = 'Y', bookid = ? WHERE ticket_no = ?;");
                                        $statement->bind_param("ss", $book_id, $customer_ticket);
                                        $exec = $statement->execute();
                                        if (!$exec) {
                                            die('Error: ' . mysqli_error());
                                        }

                                        $customer_movie = $_POST['tmovie'] ?? "";
                                        $movie_location = $_POST['cin_location'] ?? "";
                                        $customer_seat = $_POST['taken_seat'] ?? "";
                                        $designated_hall = $_POST['given_hall'] ?? "";

                                        mysqli_close($con);
                                        echo '<h5 class="center-header">Ticket Bought for: </h5>';
                                        echo '<h6 class="info-text" style="width: max-content">'.$customer_movie.'</h6>';
                                        echo '<p class="info-text" style="width: max-content">Location: '.$movie_location.'</p>';
                                        echo '<p class="info-text" style="width: max-content">Seat number: '.$customer_seat.'</p>';
                                        echo '<p class="info-text" style="width: max-content">At hall: '.$designated_hall.'</p>';
                                    }
                                }
                            ?>
    
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>