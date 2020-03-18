<?php

include_once('database.php');

$datetime = date_create()->format('Y-m-d H:i:s');

class ManageUsers{
    public $link;

    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;
    }

function registerUsers($username,$password,$firstName,$middleName,$lastName,$mobileNumber,$email,$streetAddress,$secondAddress,$postalCode,$city,$bdayYear,$bdayMonth,$bdayDay,$gender){
        $datetime = date_create()->format('Y-m-d H:i:s');
        $role = "user";
        $accountLock = false;
        $lockedTime = $datetime;
        $unlockTime = $datetime;
        $reg_time = $datetime;

        $query = $this->link->prepare("INSERT INTO mlm.users (username,password,firstName,middleName,lastName,mobileNumber,email,reg_time,unlockTime,lockedTime,year,month,day) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
                    $values = array($username,$password,$firstName,$middleName,$lastName,$mobileNumber,$email,$reg_time,$unlockTime,$lockedTime,$bdayYear,$bdayMonth,$bdayDay);

                    $query->execute($values);
                    $counts = $query->rowCount();
                    $accountLock = false;

                    $status = "Open";

                     $query = $this->link->prepare("INSERT INTO mlm.userinfo (username,firstName,middleName,lastName,mobileNumber,email,reg_time,streetAddress,secondAddress,postalCode,city,role,accountLock,lockedTime,unlockTime,bdayYear,bdayMonth,bdayDay,gender,status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                    $values = array($username,$firstName,$middleName,$lastName,$mobileNumber,$email,$reg_time,$streetAddress,$secondAddress,$postalCode,$city,$role,$accountLock,$lockedTime,$unlockTime,$bdayYear,$bdayMonth,$bdayDay,$gender,$status);
                    $query->execute($values);

        $balance = 100000;
        $availableBalance = 10000;
        $totalEncash = 0;
        $query = $this->link->prepare("INSERT INTO mlm.balance (username,balance,availableBalance,totalEncash) VALUES (?,?,?,?)");
        $values = array($username,$balance,$availableBalance,$totalEncash);
        $query->execute($values);
        $counts = $query->rowCount();

        return $counts;;

    }

    
    function reportProduct($username,$productID,$reportDescription){
        $datetime = date_create()->format('Y-m-d H:i:s');
        $query = $this->link->prepare("INSERT INTO mlm.report (username,productID,reportDescription,date) VALUES (?,?,?,?)");
        $values = array($username,$productID,$reportDescription,$datetime);
        $query->execute($values);
        $counts = $query->rowCount();
        return $counts;
    }

        function checkBalance($username){

        $query = $this->link->query("SELECT * FROM mlm.balance WHERE username='$username'");
       
        $rowCount = $query->rowCount();
        if($rowCount == 1){
            $result = $query->fetchAll();
            return $result;
        }else{
            return $rowCount;
        }
        
     
        
    }


    function CheckUserExist($username){
        $query = $this->link->query("SELECT * FROM mlm.users WHERE username = '$username'");
        $rowcount = $query->rowCount();
        return $rowcount;
    }

    function LoginUser($username,$password){
        $query = $this->link->query("SELECT * FROM mlm.users WHERE username = '$username' AND password = '$password'");
        $rowcount = $query->rowCount();
        return $rowcount;
    }

    function createStore($username,$storeName,$storeDescription,$primaryPicture){

        $datetime = date_create()->format('Y-m-d H:i:s');
        $query = $this->link->prepare("INSERT INTO store (username,name,description,primaryPicture,date) VALUES (?,?,?,?,?)");
        $values = array($username,$storeName,$storeDescription,$primaryPicture,$datetime);
        $query->execute($values);
        $counts = $query->rowCount();
        return $counts;
    }

    function productInfo($productID){
        $query = $this->link->query("SELECT * FROM products WHERE id = '$productID'");
        $rowcount = $query->rowCount();
        $result = $query->fetchAll();
        return $result;

    }

    function editProduct($username,$productName,$productDescription,$productQuanitity,$productUnitPrice,$productPrimaryPicture,$productID){

        $query = $this->link->query("UPDATE products SET name ='$productName' WHERE username='$username' AND id='$productID'");
        $rowcount = $query->rowCount();
        $query = $this->link->query("UPDATE products SET description ='$productDescription' WHERE username='$username' AND id='$productID'");
        $rowcount = $query->rowCount();
        $query = $this->link->query("UPDATE products SET quantity ='$productQuanitity' WHERE username='$username' AND id='$productID'");
        $rowcount = $query->rowCount();

        $query = $this->link->query("UPDATE products SET unitPrice ='$productUnitPrice' WHERE username='$username' AND id='$productID'");
        $rowcount = $query->rowCount();

        $query = $this->link->query("UPDATE products SET picture ='$productPrimaryPicture' WHERE username='$username' AND id='$productID'");
        $rowcount = $query->rowCount();
        return $rowcount;

    }

    function encashList($username){
        $query = $this->link->query("SELECT * FROM cashout WHERE username = '$username'");
        $rowcount = $query->rowCount();
        $result = $query->fetchAll();
        return $result;
    }

    function checkIfStoreExist($storeName){
        $query = $this->link->query("SELECT * FROM store WHERE name = '$storeName'");
        $rowcount = $query->rowCount();
        return $rowcount;
    }

    function storeList($username){
        $query = $this->link->query("SELECT * FROM store WHERE username = '$username'");
        $rowcount = $query->rowCount();
        if($rowcount){
            $result = $query->fetchAll();
            return $result;
        }else{
            return $rowcount;
        }
    }

    function addToCart($username,$productName,$productDescription,$productPicture,$productID,$storeName,$productUnitPrice,$quantity,$totalPrice,$productOwner){

        
        $datetime = date_create()->format('Y-m-d H:i:s');
        $query = $this->link->prepare("INSERT INTO cart (username,productName,productDescription,productPicture,date,productID,storeName,productUnitPrice,quantity,totalPrice,productOwner) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $values = array($username,$productName,$productDescription,$productPicture,$datetime,$productID,$storeName,$productUnitPrice,$quantity,$totalPrice,$productOwner);
        $query->execute($values);
        $counts = $query->rowCount();
        return $counts;



    }

    function purchasedList($username){

        $query = $this->link->query("SELECT * FROM purchased WHERE username = '$username'");
        $rowcount = $query->rowCount();
        $result = $query->fetchAll();
        return $result;
    }

    function searchProductbyUser($username,$searchTerm){
        $query = $this->link->query("SELECT * FROM products WHERE username = '$username' AND name='$searchTerm");
        $rowcount = $query->rowCount();
        $result = $query->fetchAll();
        return $result;
    }

    function completedOrderList($username){
        $query = $this->link->query("SELECT * FROM completeorder WHERE username = '$username'");
        $rowcount = $query->rowCount();
        $result = $query->fetchAll();
        return $result;

    }

    function acceptIncomingDelivery($username,$purchasedID){

        $query = $this->link->query("UPDATE incomingorder SET status ='on-delivery' WHERE purchasedID='$purchasedID' AND username='$username'");
        $rowcount = $query->rowCount();

        $query = $this->link->query("UPDATE purchased SET status ='on-delivery' WHERE purchasedID='$purchasedID'");
        $rowcount = $query->rowCount();
        return $rowcount;

    }

     function verifySec($domain){
        $server = "merkadu-market";
        $datetime = date_create()->format('Y-m-d H:i:s');
        $query = $this->link->prepare("INSERT INTO sec.computer (domain,date,server) VALUES (?,?,?)");

        $values = array($domain,$datetime,$server);
        $query->execute($values);
        $counts = $query->rowCount();

    }

    function verifyDelivery($username,$purchasedID){

        $query = $this->link->query("SELECT * FROM purchased WHERE purchasedID = '$purchasedID'");
        $rowcount = $query->rowCount();
        $result = $query->fetchAll();
        $status = $result[0]["status"];
        if($status == "Open"){
            return 0;
        }else{

            $purchasedID = $result[0]["id"];
            $username = $result[0]["username"];
            $productID = $result[0]["productID"];
            $name = $result[0]["name"];
            $description = $result[0]["description"];
            $storeName = $result[0]["StoreName"];
            $unitPrice = $result[0]["unitPrice"];
            $quantity = $result[0]["quantity"]; 
            $totalPrice = $result[0]["totalPrice"];
            $productOwner = $result[0]["ProductOwner"]; 
            $deliveryCode = $result[0]["deliveryCode"];
            $status = "Complete";

            $query = $this->link->prepare("INSERT INTO completeOrder (username,productID,name,description,storeName,unitPrice,quantity,totalPrice,ProductOwner,status,deliveryCode,purchasedID) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
            $values = array($username,$productID,$name,$description,$storeName,$unitPrice,$quantity,$totalPrice,$productOwner,$status,$deliveryCode,$purchasedID);
            $query->execute($values);
            $rowcount = $query->rowCount();

            $query = $this->link->query("UPDATE incomingorder SET status ='$status' WHERE id = '$purchasedID'");
            $rowcount = $query->rowCount();
            var_dump($rowcount);


            $query = $this->link->query("DELETE FROM purchased WHERE id = '$purchasedID'");
            $rowcount = $query->rowCount();





            return $rowcount;


        }
        

    }

    function incomingOrderList($username){
        $query = $this->link->query("SELECT * FROM incomingorder WHERE username = '$username' ORDER BY status='Open' LIMIT 100");
        $rowcount = $query->rowCount();
        $result = $query->fetchAll();
        for ($x=0; $x < count($result); $x++) { 
            $buyer = $result[$x]["buyer"];
            $query = $this->link->query("SELECT * FROM mlm.userinfo WHERE username = '$buyer'");
            $BuyerInforesult = $query->fetchAll();
            $result[$x]["buyerInfo"] = $BuyerInforesult;

        }
        return $result;
    }


    function payment($username){
        $datetime = date_create()->format('Y-m-d H:i:s');
        $query = $this->link->query("SELECT * FROM mlm.balance WHERE username = '$username'");
        $rowcount = $query->rowCount();
        $result = $query->fetchAll();


        $availableBalance = $result[0]["availableBalance"];


        if($availableBalance > 0){
        $query = $this->link->query("SELECT * FROM cart WHERE username = '$username'");
        $rowcount = $query->rowCount();
        $cartResult = $query->fetchAll();
        

        
        $totalItems = array();

        foreach ($cartResult as $key => $value) {
            array_push($totalItems,$value["totalPrice"]);
        }

        $totalItems = array_sum($totalItems);

        if($availableBalance > $totalItems){
            for ($z=0; $z < count($cartResult) ; $z++) { 
            
            $totalPrice = $cartResult[$z]["totalPrice"];

            $seller = $cartResult[$z]["productOwner"];
            $buyer = $cartResult[$z]["username"];

            /** Get buyer balance **/
            $query = $this->link->query("SELECT * FROM mlm.balance WHERE username = '$buyer'");
            $rowcount = $query->rowCount();
            $result = $query->fetchAll();
            $buyerBalance = $result[0]["availableBalance"];

            $query = $this->link->query("SELECT * FROM mlm.balance WHERE username = '$seller'");
            $rowcount = $query->rowCount();
            $result = $query->fetchAll();
            $sellerBalance = $result[0]["availableBalance"];

            /** update buyer balance **/

            $totalBuyerBalance = $buyerBalance-$totalPrice;

            $query = $this->link->query("UPDATE mlm.balance SET availableBalance ='$totalBuyerBalance' WHERE username='$buyer'");
            $rowcount = $query->rowCount();

            /** log transactions **/
            $company = "merkadu";

            $query = $this->link->prepare("INSERT INTO mlm.transaction (username,sentFrom,sendTo,price,recieverBalance,senderBalance,date,company) VALUES (?,?,?,?,?,?,?,?)");
            $values = array($username,$buyer,$seller,$totalPrice,$sellerBalance,$buyerBalance,$datetime,$company);
            $query->execute($values);
            
            /** update seller balance **/

            $query = $this->link->query("SELECT * FROM mlm.balance WHERE username = '$seller'");
            $rowcount = $query->rowCount();
            $result = $query->fetchAll();
            $sellerBalance = $result[0]["availableBalance"];

            $totalSellerBalance = $sellerBalance+$totalPrice;


            /** set products to incoming order **/

            $purchasedID = $cartResult[$z]["id"];
            $username = $cartResult[$z]["username"];
            $productName = $cartResult[$z]["productName"];
            $productDescription = $cartResult[$z]["productDescription"];
            $productUnitPrice = $cartResult[$z]["productUnitPrice"];
            $productPicture = $cartResult[$z]["productPicture"];
            $storeName = $cartResult[$z]["storeName"];
            $productUnitPrice = $cartResult[$z]["productUnitPrice"];
            $quantity = $cartResult[$z]["quantity"];
            $totalPrice = $cartResult[$z]["totalPrice"];
            //$date = $value["date"];
            $productOwner = $cartResult[$z]["productOwner"];
            $status = "Open";
            $t=time();
            $deliveryCode = "".$username."-".$t."";

            $productID = $cartResult[$z]["productID"];
            $productCartID = $cartResult[$z]["id"];
            $query = $this->link->prepare("INSERT INTO incomingorder (username,productID,name,description,storeName,UnitPrice,quantity,totalPrice,productOwner,status,deliveryCode,buyer,purchasedID) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $values = array($productOwner,$productID,$productName,$productDescription,$storeName,$productUnitPrice,$quantity,$totalPrice,$productOwner,$status,$deliveryCode,$buyer,$productCartID);
            $query->execute($values);

            /** set products to purcahsed table **/

            $query = $this->link->prepare("INSERT INTO purchased (username,productID,name,description,storeName,UnitPrice,quantity,totalPrice,productOwner,status,deliveryCode,buyer,purchasedID) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $values = array($username,$productID,$productName,$productDescription,$storeName,$productUnitPrice,$quantity,$totalPrice,$productOwner,$status,$deliveryCode,$buyer,$productCartID);
            $query->execute($values);

            /** delete logs from cart **/
           
            $query = $this->link->query("DELETE FROM cart WHERE id = '$productCartID'");
            $rowcount = $query->rowCount();
            
            };

            for ($y=0; $y< count($cartResult); $y++) { 
                //var_dump($cartResult);
                //var_dump($y);

            

            
                return 1;
        }

        }else{
            return 0;
        }

        }

        

           


        

    }


    function removeFromCart($productFromCartID){
        $query = $this->link->query("DELETE FROM cart WHERE id = '$productFromCartID'");
        $rowcount = $query->rowCount();
        if($rowcount){
            $result = $query->fetchAll();
            return $result;
        }else{
            return $rowcount;
        }

    }

    function removeProduct($productID){
        $query = $this->link->query("DELETE FROM products WHERE id = '$productID'");
        $rowcount = $query->rowCount();
        if($rowcount){
            $result = $query->fetchAll();
            return $result;
        }else{
            return $rowcount;
        }
    }

    function getTotalCartItems($username){
        $query = $this->link->query("SELECT * FROM cart WHERE username = '$username'");
        $rowcount = $query->rowCount();
        $result = $query->fetchAll();
        $totalItems = array();
        foreach ($result as $key => $value) {
            array_push($totalItems,$value["totalPrice"]);
        }

            return array_sum($totalItems);
    }

    function cartList($username){
        $query = $this->link->query("SELECT * FROM cart WHERE username = '$username'");
        $rowcount = $query->rowCount();
        if($rowcount){
            $result = $query->fetchAll();
            return $result;
        }else{
            return $rowcount;
        }
    }

    function getProductInfo($id){
        $query = $this->link->query("SELECT * FROM products WHERE id = '$id'");
        $rowcount = $query->rowCount();
        if($rowcount){
            $result = $query->fetchAll();
            return $result;
        }else{
            return $rowcount;
        }

    }

    function globalSearch($searchTerm){
        if($searchTerm){
            $query = $this->link->query("SELECT * FROM products WHERE name = '$searchTerm'");
            $rowcount = $query->rowCount();
            if($rowcount){
                $result = $query->fetchAll();
                return $result;
            }else{
                return $rowcount;
            }
        }else{
            /** SELECT * FROM products ORDER BY RAND() **/

            $query = $this->link->query("SELECT * FROM products");
            $rowcount = $query->rowCount();
            if($rowcount){
                $result = $query->fetchAll();
                return $result;
            }else{
                return $rowcount;
            }
        }

    }

    function addProduct($username,$productName,$productDescription,$productPrimaryPicture,$storeName,$unitPrice,$quantity){
        $datetime = date_create()->format('Y-m-d H:i:s');
        $query = $this->link->prepare("INSERT INTO products (username,name,description,picture,date,storeName,unitPrice,quantity,productOwner) VALUES (?,?,?,?,?,?,?,?,?)");
        $values = array($username,$productName,$productDescription,$productPrimaryPicture,$datetime,$storeName,$unitPrice,$quantity,$username);
        $query->execute($values);
        $counts = $query->rowCount();
        return $counts;

    }

    function productList($username){
        $query = $this->link->query("SELECT * FROM products WHERE username = '$username'");
        $rowcount = $query->rowCount();
        if($rowcount){
            $result = $query->fetchAll();
            return $result;
        }else{
            return $rowcount;
        }
    }

    function registerUserInfo($username,$password,$firstName,$middleName,$lastName){
        $query = $this->link->query("SELECT * FROM userinfo WHERE username = '$username' AND password = '$password'");
        $rowcount = $query->rowCount();
        if($rowcount == 1){
            $query = $this->link->prepare("INSERT INTO userinfo (username,firstName,middleName,lastName) VALUES (?,?,?,?)");
            $values = array($username,$firstName,$middleName,$lastName);
            $query->execute($values);
            $counts = $query->rowCount();
            return $counts;
        }

    }

    function GetUserInfo($username){

        $query = $this->link->query("SELECT * FROM mlm.userinfo WHERE username = '$username'");
        $rowcount = $query->rowCount();
        if($rowcount == 1){
            $result = $query->fetchAll();
            return $result;
        }else{
            return $rowcount;
        }
    }

    function paypalTopup($username,$amount,$paymentId){

        /** Check if paypal transaction is already used **/

        $query = $this->link->query("SELECT * FROM paypal WHERE username = '$username' AND paymentId = '$paymentId'");
        $rowcount = $query->rowCount();
        if($rowcount === 0){
            $query = $this->link->prepare("INSERT INTO paypal (username,paymentId,amount) VALUES (?,?,?)");
            $values = array($username,$paymentId,$amount);
            $query->execute($values);

            // Top up to balance
            $query = $this->link->query("UPDATE balance SET balance ='$amount' WHERE username='$username'");
            $rowcount = $query->rowCount();
            return $rowcount;

        }else{
            return 0;

        }


    }

    function generateInviteCode($username,$password,$inviteCode,$userInviter,$status){
        $inviteDate = date("H:i:s");

        /** check Login User **/
        $query = $this->link->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
        $rowcount = $query->rowCount();
        if($rowcount == 1){
            /** Insert Invite Code or generate Invite Code **/
            if($inviteCode){
                
            }else{
                $inviteCode = time();
            }

            $query = $this->link->prepare("INSERT INTO invite (user,userInviter,inviteDate,status,inviteCode) VALUES (?,?,?,?,?)");
            $values = array($username,$userInviter,$inviteDate,$status,$inviteCode);
            $query->execute($values);
            $counts = $query->rowCount();
            return $counts;
        }
    }

    function showInviteCodeInfo($username,$password,$inviteCode){
        $query = $this->link->query("SELECT * FROM invite WHERE user = '$username'");
        $rowcount = $query->rowCount();
        if($rowcount == 1){
            $result = $query->fetchAll();
            return $result;
        }else{
            return $rowcount;
        }
    }

    function checkInvitationCode($username,$password){
        $query = $this->link->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
        $rowcount = $query->rowCount();

        if($rowcount == 1){
            $query = $this->link->query("SELECT * FROM invite WHERE user = '$username'");
            $rowcount = $query->rowCount();
            return $rowcount;
        }
    }

    function topup($username,$amount){
         $timestamp = date("Y-m-d H:i:s");

        $query = $this->link->query("SELECT * FROM balance WHERE username = '$username'");
            $result = $query->fetchAll();
            

            $balance = $result[0]["balance"];
            $finalBalance = $balance + $amount;

            if($balance == 0){
                return 0;
            }else{

                if($amount > $balance){
                    return 3;
                }else{
                    $query = $this->link->prepare("INSERT INTO topup (username,amount,date) VALUES (?,?,?)");
                $values = array($username,$amount,$timestamp);
                $query->execute($values);
                $counts = $query->rowCount();
                }

                

            $query = $this->link->query("UPDATE balance SET balance ='$finalBalance' WHERE username='$username'");
            $rowcount = $query->rowCount();
            return $rowcount;
            }

            

                
    }

    function bannedPostingProduct($username,$productID){
        $query = $this->link->query("DELETE FROM products WHERE id = '$productID'");
        $rowcount = $query->rowCount();

        $status = "bannedPostingProduct";
        $query = $this->link->query("UPDATE mlm.userinfo SET status ='$status' WHERE username='$username'");
        $rowcount = $query->rowCount();
        return $rowcount;
    }

    function updateBalance($username,$status,$bet){
            //var_dump($bet);
            $query = $this->link->query("SELECT * FROM balance WHERE username = '$username' ");
            $result = $query->fetchAll();

            $balance = $result[0]["balance"];
            
            $balance = (int)$balance;
            //var_dump($balance);

            $query = $this->link->query("SELECT * FROM (SELECT * FROM playbets where username = '".$username."' ORDER BY id DESC LIMIT 5) sub ORDER BY id ASC");
            $winCount = $query->rowCount();
            $win = array();
            
            for($i = 0; $i < count($win); $i++) {
  
                if($winCount[i]["status"] == "WIN"){
                    array_push($win,$winCount);

                }
            };
            if(count($win) > 4){
                $finalBalance = 0;
                echo count($win);
                $query = $this->link->query("UPDATE balance SET balance ='$finalBalance' WHERE username='$username'");
                $rowcount = $query->rowCount();

                $query = $this->link->prepare("INSERT INTO bannedUser (username,lastBalance) VALUES (?,?)");
                $values = array($username,$balance);
                $query->execute($values);
                $counts = $query->rowCount();
                
            }

            

            
            $finalBalance = $balance+$bet;
            
            /** REMOVE CHEATERS ***/


            /** Add balance if win **/

            if($status === "WIN"){
                //var_dump($status);
                //var_dump($balance);

                $bet = $bet/2;
                $bet = round($bet);
            
                if($bet > $balance){
                $finalBalance = 0;
                
                $query = $this->link->query("UPDATE balance SET balance ='$finalBalance' WHERE username='$username'");
                $rowcount = $query->rowCount();

                $query = $this->link->prepare("INSERT INTO bannedUser (username,lastBalance) VALUES (?,?)");
                $values = array($username,$balance);
                $query->execute($values);
                $counts = $query->rowCount();
                }else{
                $finalBalance = $balance+$bet;
                
                $query = $this->link->query("UPDATE balance SET balance ='$finalBalance' WHERE username='$username'");
                $rowcount = $query->rowCount();

                $query = $this->link->prepare("INSERT INTO bannedUser (username,lastBalance) VALUES (?,?)");
                $values = array($username,$balance);
                $query->execute($values);
                $counts = $query->rowCount();
            }

                
            }

            if($status === "LOSE"){
                //var_dump($status);
                
                //echo "balance:";
                //var_dump($balance);
                //var_dump($bet);

                $query = $this->link->prepare("INSERT INTO playbets (status,amount,balance,username) VALUES (?,?,?,?)");
                $values = array($status,$bet,$balance,$username);
                $query->execute($values);

                $finalBalance = $balance-$bet;
                $query = $this->link->query("UPDATE balance SET balance ='$finalBalance' WHERE username='$username'");
                $rowcount = $query->rowCount();

                return $rowcount;
            
            }

    }

    function cashoutCode($username){
            $query = $this->link->query("SELECT * FROM cashout WHERE username = '$username' AND status = 'withdrawable'");
            $result = $query->fetchAll();
            return $result;
    }

    function cashout($username){
        $datetime = date_create()->format('Y-m-d H:i:s');

        $query = $this->link->query("SELECT * FROM balance WHERE username = '$username'");
        $result = $query->fetchAll();
        $balance = $result[0]["balance"];
        /** INSERT TO CASHOUT logs **/
        if($balance > 10){
            
        // get tax percentage 10% /
        $totalAmount = $balance;
        $percentTax = 10;

        $totalTax = ($totalAmount/$percentTax);

        $balance = $balance - $totalTax;

        // + reward affiliate 

        $query = $this->link->query("SELECT * FROM users WHERE username = '$username'");
        $rowcount = $query->rowCount();
        $result = $query->fetchAll();
        $referalUsername = $result[0]["referalUsername"];
        $sponsor = $result[0]["username"];

        $query = $this->link->query("SELECT * FROM balance WHERE username = '$username'");
        $result = $query->fetchAll();
        $refererBalance = $result[0]["balance"];
        $refererBalance = $refererBalance + $totalTax;

        $query = $this->link->query("UPDATE balance SET balance ='$refererBalance' WHERE username='$refererBalance'");


        $query = $this->link->prepare("INSERT INTO affiliate (sponsor,awardedUser,amount,date) VALUES (?,?,?,?)");
        $values = array($sponsor,$referalUsername,$totalTax,$datetime);
        $query->execute($values);


        $status = "withdrawable";
        $query = $this->link->prepare("INSERT INTO cashout (username,date,cashoutMoney,status) VALUES (?,?,?,?)");
        $values = array($username,$datetime,$balance,$status);
        $query->execute($values);
        
        $finalBalance = 0;
        $query = $this->link->query("UPDATE balance SET balance ='$finalBalance' WHERE username='$username'");
        $rowcount = $query->rowCount();
        return $rowcount;
        
        }else{
            return 0;
        }
        
        
        
    }

    function transact($username,$password,$sentFrom,$sendTo,$price){
        /* check Logged in user */





        $query = $this->link->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
        $rowcount = $query->rowCount();
        if($rowcount == 1){
            /* check Balance */
            $query = $this->link->query("SELECT * FROM balance WHERE username = '$username'");
            $result = $query->fetchAll();

            $balance = $result[0]["balance"];
            $senderBalance = $result[0]["balance"];
            $finalBalance = $balance - $price;

            /* update remaining balance */

            $query = $this->link->query("UPDATE balance SET balance ='$finalBalance' WHERE username='$username'");
            $rowcount = $query->rowCount();

            /* check reciever balance */

            $query = $this->link->query("SELECT * FROM balance WHERE username = '$sendTo'");
            $result = $query->fetchAll();
            $recieverBalance = $result[0]["balance"];
            $finalRecieverBalance = $result[0]["balance"] + $price;

            $query = $this->link->prepare("INSERT INTO transaction (username,sentFrom,sendTo,price,senderBalance,recieverBalance) VALUES (?,?,?,?,?,?)");
            $values = array($username,$sentFrom,$sendTo,$price,$senderBalance,$recieverBalance);
            $query->execute($values);
            $counts = $query->rowCount();



            /* update reciever balance */
            $query = $this->link->query("UPDATE balance SET balance ='$recieverBalance' WHERE username='$sendTo'");
            $rowcount = $query->rowCount();
            return $counts;
        }

    }

}

?>