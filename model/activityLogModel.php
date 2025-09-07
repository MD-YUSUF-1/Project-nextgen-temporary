<?php
    require_once('db.php');

    function getActivitesById($u_id){
        $con = getConnection();
        $sql = "SELECT * from activities where user_id=$u_id";
        $result = mysqli_query($con, $sql);
        $activities = [];

        while($row = mysqli_fetch_assoc($result)){
            array_push($activities, $row);
        }
        return $activities;
    }


     function getFilteredActivites($u_id, $filters = []) {
        $con = getConnection();
        
        $sql = "SELECT * from activities where user_id = $u_id";
        $conditions = [];
        
        if (!empty($filters['from_date']) && !empty($filters['to_date'])) {
            $conditions[] = "activity_date between '{$filters['from_date']}' and '{$filters['to_date']}'";
        }

        if (!empty($filters['action'])) {
            $conditions[] = "action = '{$filters['action']}'";
        }
        
        if (!empty($conditions)) {
            $sql .= " and " . implode(" and ", $conditions);
        }
         
        $result = mysqli_query($con, $sql);
        $filteredActivities = [];
        
        while($row = mysqli_fetch_assoc($result)) {
            array_push($filteredActivities, $row);
        }
        
        return $filteredActivities;
    }


?>