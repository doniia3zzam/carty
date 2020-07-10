<?php
$output = ''; 
 
if(isset($_POST["check"])){
  
    include_once "../categories.php";
    $prod=new categories();
    $prod->setCateId($_POST["check"]);
    $result=$prod->getsub();

  while ($row = mysqli_fetch_assoc($result)) {
    

    $output.='<li class="my-1"><a id="subcheck'.$row['sub_cate_id'].'"   value="'.$row['sub_cate_id'].'"data-toggle="collapse" href="#collapseExample'. $row['sub_cate_id'].'" role="button" aria-expanded="false" aria-controls="collapseExample">'.$row['sub_cate_name'].'
    </a>
    <input type="hidden" id="in'.$row['sub_cate_id'].'" value="'.$row['sub_cate_id'].'" />

    </li>
   
        <script >
        $(document).ready(function(){   
          $("#subcheck'.$row['sub_cate_id'].'").on("click",function(){
              var subcheck =$("#in'.$row['sub_cate_id'].'").val(); 
           
                $.ajax({  
                  url:"ajax/subcategoryajax.php",  
                    method:"POST",  
                    data:{subcheck:subcheck},  
                    success:function(data){
                    $("#show").html(""); 
                    $("#show").html(data);    
                    }  
              
                      
              });  
                });

            }); 
        </script>';
 
 
}
echo  $output;
}
