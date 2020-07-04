<?php 
include("config.php");
session_start();
if(isset($_SESSION['user'])){
    $user=$_SESSION['user'];
}

if(isset($_POST['total'])){
    $subtotal=$_POST['subtotal'];
    $tax=$_POST['tax'];
    $total=$_POST['total'];
    $_SESSION['total']=$_POST['total'];
    
    $sql="insert into myOrder (userID,amount,orderDate) values('$user','$total',curdate())";	
	$result = $conn->query($sql);
	// get order ID from user
	$getOrderID="select max(ID) as orderID from myorder where userID='$user'";
	$result = $conn->query($getOrderID);
	if ($result->num_rows > 0) {    
		while($row = $result->fetch_assoc()) {
            $orderID=$row['orderID'];
            $_SESSION['invoice']=$row['orderID'];
		}
    }    

    if(empty($_REQUEST['item'])) {
        // No items checked
    }
    else {
        //update cart item based order ID
        foreach($_REQUEST['item'] as $cartID) {
            //update orderID to cart
            $update_sql="update cart set orderID='$orderID' where ID='$cartID'";
            $result = $conn->query($update_sql);        
        }
    }
}

?>
        <table border="1">
            <tr>
                <td><?php echo $orderID;?></td>
                <td><?php echo $user;?></td>
                <td>Date : <?php echo date("Y/m/d");?></td>
                <td>Total Amount : RM <?php echo $total;?></td>
            </tr>
            <tr>
                <td>Product ID</td>
                <td>Product Name</td>
                <td>Quantity</td>
                <td>Subtotal</td>
            </tr>
<?php

$sql="SELECT a.*,b.*,c.title FROM myorder as a left join cart as b on a.ID=b.orderID left join product_detail as c on b.productID=c.ID where a.userID='$user' and a.ID='$orderID'";

$result=$conn->query($sql);
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
            ?>
            <tr>    
                <td><?php echo $row['productID'];?></td>
                <td><?php echo $row['title'];?></td>
                <td><?php echo $row['pQuantity'];?></td>
                <td></td>
            </tr>
            <?php
        }
    }
?>
    <tr>
        <td colspan="4"><div id="paypal-button"></div></td>
    </tr>
</table>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
			    paypal.Button.render({

			        env: 'sandbox', // Or 'production'

			        client: {
			            sandbox:    'AUT8oC5-PW6u0jD2w5WAbPQOTMIRraeZgJ3u1veQAVMU0Tqg4RI4WG2Xb6Rg3-klmTLu73EkqPS5zh_8'
			        },

			        commit: true, // Show a 'Pay Now' button
								
			        payment: function(data, actions) {
			            return actions.payment.create({
			                payment: {
			                    transactions: [
			                        {
										amount: { total: '<?php echo $_SESSION['total']; ?>', currency: 'MYR' },
										invoice_number: '<?php echo $_SESSION['invoice']; ?>'
			                        }
			                    ]
			                }
			            });
			        },

			        onAuthorize: function(data, actions) {
			            return actions.payment.execute().then(function(payment) {
			            	window.alert('Payment Complete!');
			                // The payment is complete!
			                // You can now show a confirmation message to the customer
			            });
			        }

			    }, '#paypal-button');
			</script>