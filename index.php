<!DOCTYPE html>
<html lang="en">
<head>
  <title>Hot Movie API - Lien-Jung, Chang</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.8/vue.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.4/vue.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/vue-resource/0.1.16/vue-resource.min.js"></script>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
  <style>
  .container{ 
  	width: 370px;
  	height: 280px;  
  	border: 1px solid lightgray; 
   }
  .container h1{
  	font-family: Roboto-Light;
    font-size: 24px;
    color: #3b3f47;
  }
  .container p{
  	font-family: Roboto-Regular;
  	font-size: 14px;
  	letter-spacing: 0.5px;
  	color: #6b6b6b;
  }
  .container #link{
  	font-family: Roboto-Light;
  	font-size: 14px;
  	letter-spacing: 0.5px;
  	text-align: right;
  	color: #276cf2;
  	padding-left: 150px;
  }
  .carousel{
   	width: 343px;
   	height:156px;
   	background-color: #f2f3f5;;
  }
 .carousel-indicators{
 	  bottom:-40px;
  }
  .carousel-indicators li {  
    background-color: gray; 
    box-shadow: inset 1px 1px 1px 1px rgba(0,0,0,0.5); 
  }
  .carousel-indicators li .active{   
    box-shadow: inset 1px 1px 1px 1px rgba(0,0,0,0.5); 
  }
  .carousel-indicators {
  	color: black;
  }
  .carousel-inner{
  	height: 500px;
  }
  .imgcontainer{
  	padding-left: 240px;
  	margin-top: -135px;
  }
  .carousel-inner > .item > .imgcontainer > img{
    width: 105px;
    height: 156px; 
  }
  .carousel-inner > .item h1, a {
    width: 238px;	
    height: 20px;
    color: black;
    font-family: Roboto-Regular;
    font-size: 16px;
    line-height: 1.2;
    letter-spacing: 0.4px;
    padding-left: 8px;
    overflow: hidden;
  }
    .carousel-inner > .item h1, a:hover {
    text-decoration: none; 
  }
  .carousel-inner > .item p{
    width: 206px;
    height: 75px;
    font-family: Roboto-Regular;
    font-size: 14px;
    line-height: 1.3;
    letter-spacing: 0.5px;
    color: #6b6b6b; 
    overflow: hidden;
    padding-left: 15px;
    }
  .carousel-inner > .item > .star{ 
    padding-left: 16px;
    margin-top: -30px;
    }

  </style>
</head>

<body>
<div id="vueApp"> 
  <div class="container" width= "500px">
    <h1>In Theaters <a id = "link" href="#viewMore">View More</a> </h1>
    <p>Top Movies This Week</p> 

    <div id="myCarousel" class="carousel slide" data-ride="carousel" >
      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">

        <div v-bind:class="{ 'item': true, 'active': index===0 }" v-for="(index,movie) in movies" >
          
        	<h1><a href="{{movie.links.alternate}}">{{movie.title}}</a></h1> 
        	<p maxlength="10">{{movie.synopsis}}</p> 
        	<div class ="imgcontainer">
        		<img src="{{ movie.posters.original }}">
        	</div> 
          <div class = "star"> 
            <img src="star.svg" v-for="n in Math.floor(movie.ratings.audience_score/20)">
          </div>
        </div>
      </div>

      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="{{index}}" v-bind:class="{'active': index===0 }" v-for="(index,movie) in movies" ></li>
      </ol>

    </div>
  </div>
</div>

<script> 

  $(function(){

  	var ItemsVue = new Vue({
  	    el: '#vueApp',
  	    data: {
  	        movies: []
  	    },
  	    ready: function () {
          var self = this;
          $.ajax({
            url: 'http://api.rottentomatoes.com/api/public/v1.0/lists/movies/box_office.json?limit=5&country=us&apikey=6czx2pst57j3g47cvq9erte5',
            method: 'GET',
            dataType: "jsonp",
            success: function (data) {
                self.movies = data.movies;
                //console.log(data.movies); 
            },
            error: function (error) {
                alert(JSON.stringify(error));
            }
          });
  	    } 
  	});

    $('a[href="#viewMore"]').on('click', function(e){
      e.preventDefault();
      location.href = $('.item.active>h1>a').attr('href');
    });

  });



 
</script>

</body>
</html>

