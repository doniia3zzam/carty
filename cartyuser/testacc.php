<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<style>
    body {
    margin: 0;
}

.accordions {
    font-family: arial;
    width: 50%;
    margin: 60px auto;
}

.accordion-item {
    background-color: #f9f9f9;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.accordion-item .accordion-title {
    cursor: pointer;
    padding: 20px;
    transition: all 0.4s;
    border-radius: 5px 5px 0 0;
}

.accordion-item .accordion-title.active-title {
    background-color: #ffc400;
    color: #fff;
}

.accordion-item .accordion-title h2 {
    margin: 0;
    font-size: 18px;
    display: flex;
    justify-content: space-between;
}

.accordion-item .accordion-title i.fa-chevron-down {
    transform: rotate(0);
    transition: 0.4s;
}

.accordion-item .accordion-title i.fa-chevron-down.chevron-top {
    transform: rotate(-180deg);
}

.accordion-item .accordion-content {
    display: none;
    line-height: 1.7;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 0 0 5px 5px;
}

.accordion-item .accordion-content.active {
    display: block;
}

.accordion-item .accordion-content p {
    margin: 0;
}
</style>
<body>
<div class="accordions">
  <div class="accordion-item">
    <div class="accordion-title" data-tab="item1">
      <h2>Accordion 1 <i class="fas fa-chevron-down"></i></h2>
    </div>
    <div class="accordion-content" id="item1">
      <p>
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
      </p>
    </div>
  </div>

  <div class="accordion-item">
    <div class="accordion-title" data-tab="item2">
      <h2>Accordion 2 <i class="fas fa-chevron-down"></i></h2>
    </div>
    <div class="accordion-content" id="item2">
      <p>
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
      </p>
    </div>
  </div>

  <div class="accordion-item">
    <div class="accordion-title" data-tab="item3">
      <h2>Accordion 3 <i class="fas fa-chevron-down"></i></h2>
    </div>
    <div class="accordion-content" id="item3">
      <p>
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
      </p>
    </div>
  </div>

  <div class="accordion-item">
    <div class="accordion-title" data-tab="item4">
      <h2>Accordion 4 <i class="fas fa-chevron-down"></i></h2>
    </div>
    <div class="accordion-content" id="item4">
      <p>
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
      </p>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
<script>
    $(document).ready(function(){
    $(".accordion-title").click(function(e){
        var accordionitem = $(this).attr("data-tab");
        $("#"+accordionitem).slideToggle().parent().siblings().find(".accordion-content").slideUp();

        $(this).toggleClass("active-title");
        $("#"+accordionitem).parent().siblings().find(".accordion-title").removeClass("active-title");

        $("i.fa-chevron-down",this).toggleClass("chevron-top");
        $("#"+accordionitem).parent().siblings().find(".accordion-title i.fa-chevron-down").removeClass("chevron-top");
    });

});
</script>
</body>
</html>

