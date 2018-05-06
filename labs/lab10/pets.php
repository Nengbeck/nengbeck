<?php

    include 'inc/header.php';
    
    include '../../dbConnection.php';
    
    function getAllPets(){
        
      $conn = getDatabaseConnection('pets');
      
      $sql = "SELECT id, name, type FROM pets ORDER BY name";
      
      $stmt = $conn->prepare($sql);  
      $stmt->execute();
      $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $records;  
    }
    
?>

<script>
    
    $(document).ready(function(){
    
            $("#adoptionsLink").addClass("active");
            
            $(".petLink").click(function(){
                
                //alert(  );
                
                $('#petModal').modal("show");
                $("#petInfo").html("<img src='img/loading.gif'>");
                      
                
                $.ajax({

                    type: "GET",
                    url: "api/getPetInfo.php",
                    dataType: "json",
                    data: { "id": $(this).attr("id")},
                    success: function(data,status) {
                       //alert(data.breed);
                       //log.console(data.pictureURL);
                       
                       $("#petModalLabel").html("<h2>" + data.name +"</h2>");
                       $("#petInfo").html("");
                       $("#petInfo").append("Age: " + data.age + " years <br>");
                       $("#petInfo").append(data.breed + "<br>");
                       $("#petInfo").append(data.description + "<br>");
                       $("#petInfo").append("<img src='img/" + data.pictureURL +"' width='150'>");
                       
                    
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                    //alert(status);
                    }
                    
                });//ajax
                
                
            });
        
        
    }); //document ready
    
    
</script>


<?php
    $petList = getAllPets();
    
    //print_r($petList);
    
    foreach ($petList as $pet) {
        
        echo "Name: <a href='#' class='petLink' id='".$pet['id']."'  > " . $pet['name'] . " </a> <br>";
        echo "Type: " . $pet['type'] . "<br><br>";
        
    }

?>


<!-- Modal -->
<div class="modal fade" id="petModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="petModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
        <div id="petInfo"></div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<?php

    include 'inc/footer.php';

?>