<html>
<head>
  <title>Bond Web Service Demo</title>
<style>
body {font-family:georgia;}
    .film{
    border:1px solid #E77DC2;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;  
  }
 
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }
.pic img{
max-width:100px;
  }
</style>
<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

<script type="text/javascript">

 function bondTemplate(film){
    return `<div class="film">
         <b>Film:</b> ${film.Film} <br />
         <b>Title:</b> ${film.Title}  <br />
         <b>Year:</b>${film.Year}  <br />
         <b>Director:</b> ${film.Director}  <br />
         <b>Producers:</b> ${film.Producers} <br />
         <b>Writers:</b> ${film.Writers}  <br />
         <b>Composer:</b> ${film.Composer}  <br />
         <b>Budget:</b>  ${film.Budget} <br />
         <b>BoxOffice:</b> ${film.BoxOffice}  <br />
    <div class="pic"><img src="thumbnails/${film.Image}"></div>

  </div>`;
  }
$(document).ready(function() {  

    $('.category').click(function(e){
        e.preventDefault(); //stop default action of the link
cat = $(this).attr("href");  //get category from URL

      var request = $.ajax({
        url: "api.php?cat=" + cat,
        method: "GET",
        dataType: "json"
    });
    request.done(function( data ) {
        console.log(data);
      //Place the title of the webservice of the page
     
      $("#filmtitle").html(data.title);
      $("#films").html("");

     
      $.each(data.films,function(key,value){
        let str = bondTemplate(value);
        $("<div></div>").html(str).appendTo("#films");
      });
     //  $("#output").text(JSON.stringify(data));

      let myData = JSON.stringify(data,null,4);
   myData = "<pre>" + myData + "</pre>";
      $("#output").html(myData);
    });
        request.fail(function(xhr, status, error) {
               //Ajax request failed.
               var errorMessage = xhr.status + ': ' + xhr.statusText
               alert('Error - ' + errorMessage);
           
        });
       
        });
        });

</script>
</head>
<body>
<h1>My faviorite movies</h1>
<a href="year" class="category">My faviorite movies By Year</a><br />
<a href="box" class="category">My faviorite movies By International Box Office Totals</a>
<h3 id="filmtitle"></h3>
<div id="films">
<p>Films will go here</p>
 </div>

<div id="output"></div>
</body>
</html>
