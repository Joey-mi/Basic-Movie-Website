<?php include 'header.php'?>      
        <div class="page-container-center">
            <h2>Select Payment Options</h2>
            <form action="payment_made.php" method="post">
                <div class="info-container">
                    <div class="custom-col" style="align-items: center;">
                        <?php
                            $payment_amount = $_POST['pay'] ?? "";
                            $ticket_num = $_POST['this_ticket'] ?? "";

                            $m = $_POST['movie'] ?? "";
                            $p = $_POST['place'] ?? "";
                            $c = $_POST['cseat'] ?? "";
                            $h = $_POST['ahall'] ?? "";

                            echo '<p class="center-header">Choose Payment Method</p>';
                            echo '<form action="payment_made.php" method="post">';
                            echo '<label class="info-text" style="width: max-content;">Select Payment Option and Make Payment</label>';
                            echo '<input class="button-styles" style="margin-bottom: 1vh; margin-top: 1vh; width: 20vh;" type="submit" name="card" value="debit"/>';
                            echo '<input class="button-styles" style="margin-bottom: 1vh; margin-top: 1vh; width: 20vh;" type="submit" name="card" value="credit"/>';
                            echo '<input type="hidden" name="paid" value="'.$payment_amount.'"/>';
                            echo '<input type="hidden" name="ticket_get" value="'.$ticket_num.'"/>';
                            echo '<input type="hidden" name="tmovie" value="'.$m.'"/>';
                            echo '<input type="hidden" name="cin_location" value="'.$p.'"/>';
                            echo '<input type="hidden" name="taken_seat" value="'.$c.'"/>';
                            echo '<input type="hidden" name="given_hall" value="'.$h.'"/>';
                            echo '</form>';
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>