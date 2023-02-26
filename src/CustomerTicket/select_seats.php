<?php include 'header.php'?>  
        <div class="page-container">
            <h2>Select Seat</h2>
            <form action="ticket_info.php" method="post">
                <div class="custom-col">
                    <?php
                        include "../logindb_connect.php";

                        $available_halls = $_POST['the_hall'] ?? "";
                        $show_date = $_POST['the_date'] ?? "";
                        $show_time = $_POST['the_time'] ?? "";
                        $show_movie = $_POST['the_movie'] ?? "";
                        $show_cinema = $_POST['the_cinema'] ?? "";

                        $statement = $con->prepare("SELECT seat_no 
                            FROM seat s JOIN (
                                    SELECT seat_no AS taken 
                                    FROM ticket 
                                    WHERE sdate = ? AND stime = ? 
                                    AND movie_name = ? AND theatre_no =? 
                                    AND sold_flag='N'
                                ) 
                            t ON s.seat_no = t.taken  
                            WHERE theatre_no = ?;");
                        
                        $statement->bind_param("sssss", $show_date, $show_time, $show_movie, $available_halls, $available_halls);
                        $exec = $statement->execute();

                        if(!$exec) {
                            die('Error: ' . mysqli_error($con));
                        }

                        $seats = $statement->get_result();

                        if($seats->num_rows > 0) {
                            echo '<div style="display: flex; flex-direction: column;">';
                            echo '<hr />';
                            while($a_seat = $seats->fetch_array()) {
                                echo '<input style="margin-bottom: 1vh" type="submit" name="chose_seat" value="'.$a_seat['seat_no'].'"/>';
                                echo '<input type="hidden" name="the_date" value="'.$show_date.'"/>'; 
                                echo '<input type="hidden" name="the_time" value="'.$show_time.'"/>'; 
                                echo '<input type="hidden" name="the_hall" value="'.$available_halls.'"/>';
                                echo '<input type="hidden" name="the_movie" value="'.$show_movie.'"/>';    
                                echo '<input type="hidden" name="the_cinema" value="'.$show_cinema.'"/>'; 
                            }
                            echo '</div>';
                        } else {
                            echo '<div class="page-container-center">';
                            echo '<div class="info-container">';
                            echo '<p class="center-header">No more seats are available for this time slot</p>';
                            echo '<a class="button-styles link-button" style="width: max-content;" href="javascript:history.go(-1)">Return to previous page</a>';
                            echo '<a class="button-styles link-button" style="width: max-content;" link-button" href="javascript:history.go(-3)">Return to dashboard</a>';
                            echo '</div>';
                            echo '</div>';
                        }

                        mysqli_close($con);
                    ?>
                </div>
            </form>
        </div>
    </body>
</html>