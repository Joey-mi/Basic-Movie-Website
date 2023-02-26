<?php include 'header.php'?>       
        <div class="page-container-center">
            <h2>Summary</h2>
            <form action="make_payment.php" method="post">
                <div class="info-container">
                <div class="custom-col">
                    <?php
                        include "../logindb_connect.php";

                        $chosen_hall = $_POST['the_hall'] ?? "";
                        $chosen_date = $_POST['the_date'] ?? "";
                        $chosen_time = $_POST['the_time'] ?? "";
                        $chosen_movie = $_POST['the_movie'] ?? "";
                        $chosen_cinema = $_POST['the_cinema'] ?? "";
                        $chosen_seat = $_POST['chose_seat'] ?? "";

                        $statement = $con->prepare("SELECT ticket_no, barcode, price 
                            FROM ticket 
                            WHERE sdate = ? AND stime = ? 
                            AND theatre_no = ? AND movie_name = ? 
                            AND seat_no = ? AND sold_flag='N' 
                            LIMIT 0,1;");
                        $statement->bind_param("sssss", $chosen_date, $chosen_time, $chosen_hall, $chosen_movie, $chosen_seat);
                        $exec = $statement->execute();

                        if(!$exec) {
                            die('Error: ' . mysqli_error($con));
                        }

                        $ticket_info = $statement->get_result();

                        mysqli_close($con);

                        if ($ticket_info->num_rows > 0) {
                            while($your_ticket = $ticket_info->fetch_array()) { 
                                echo '<p class="center-header">Ticket Number: '.$your_ticket['ticket_no'].'</p>';
                                echo '<p class="info-text">Price: $'.$your_ticket['price'].'</p>';
                                echo '<p class="info-text">Barcode: '.$your_ticket['barcode'].'</p>';
                                echo '<input class="button-styles" type="submit" name="proceed" value="Proceed to purchase" />';
                                echo '<input type="hidden" name="pay" value="'.$your_ticket['price'].'"/>';
                                echo '<input type="hidden" name="this_ticket" value="'.$your_ticket['ticket_no'].'"/>';
                                echo '<input type="hidden" name="movie" value="'.$chosen_movie.'"/>';
                                echo '<input type="hidden" name="place" value="'.$chosen_cinema.'"/>';
                                echo '<input type="hidden" name="cseat" value="'.$chosen_seat.'"/>';
                                echo '<input type="hidden" name="ahall" value="'.$chosen_hall.'"/>';
                            }
                        }
                    ?>
                </div>
                </div>
            </form>
        </div>
    </body>
</html>