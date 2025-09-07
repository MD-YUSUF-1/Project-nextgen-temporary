<?php
    require_once('db.php');

    function getTransactionsById($u_id){
        $con = getConnection();
        $sql = "SELECT * from transactions where user_id=$u_id";
        $result = mysqli_query($con, $sql);
        $transactions = [];

        while($row = mysqli_fetch_assoc($result)){
            array_push($transactions, $row);
        }
        return $transactions;
    }


     function getFilteredTransactions($u_id, $filters = []) {
        $con = getConnection();
        
        $sql = "SELECT * from transactions where user_id = $u_id";
        $conditions = [];
        
        if (!empty($filters['from_date']) && !empty($filters['to_date'])) {
            $conditions[] = "date between '{$filters['from_date']}' and '{$filters['to_date']}'";
        }

        if (!empty($filters['transaction_type'])) {
            $conditions[] = "transaction_type = '{$filters['transaction_type']}'";
        }
        
        if (!empty($filters['amount_range'])) {
            if ($filters['amount_range']==='0-100') {
                    $conditions[] = "ABS(amount) between 0 and 100";
            }
            elseif ($filters['amount_range']==='101-500') {
                    $conditions[] = "ABS(amount) between 101 and 500";
            }
            elseif ($filters['amount_range']==='501-1000') {
                    $conditions[] = "ABS(amount) between 501 and 1000";
            }
            elseif ($filters['amount_range']==='1000+') {
                $conditions[] = "ABS(amount) > 1000";
            }
                
        }

        if (!empty($filters['search_text'])) {
            $search_text = mysqli_real_escape_string ($con, $filters['search_text']);
            $conditions[] = "(description like '%{$search_text}%' or status like '%{$search_text}%')";
        }
        
        if (!empty($conditions)) {
            $sql .= " and " . implode(" and ", $conditions);
        }
         
        $result = mysqli_query($con, $sql);
        $filteredTransactions = [];
        
        while($row = mysqli_fetch_assoc($result)) {
            array_push($filteredTransactions, $row);
        }
        
        return $filteredTransactions;
    }


?>