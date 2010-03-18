<?
$provincia=$_GET['prov'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>My Google AJAX Search API Application</title>
    <script src="http://www.google.com/jsapi?key=ABQIAAAAsfZ3WhPrjeePQbQ_0RWTRBS3CkSPi3aKTtiOuwmOy6_GhXJFGxSPc3miXfruwYGlbR74XB975r5dgA" type="text/javascript"></script>
	<script language="javascript" src="../codigo2.js"></script>
    <script language="Javascript" type="text/javascript">
    //<![CDATA[
    google.load("search", "1");
	
	function gotResults(sc, searcher)
	{
		var resultcontent = '';
		var resultdiv = document.getElementById('searchresults');
		
		for (i=0; i<searcher.results.length; i++)
		{
			var result = searcher.results[i];
			var tel = result.phoneNumbers[0].number;
			llamarasincrono2('up_save.php?titulo='+result.titleNoFormatting+'&street='+result.streetAddress+'&lat='+result.lat+'&lng='+result.lng+'&city='+result.city+'&tel='+tel,'load');
			resultcontent += '<p>'+result.title+'<br />'+result.titleNoFormatting+'<br />'+result.streetAddress+'<br />'+result.lat+'<br />'+result.lng+'<br />'+result.city+'<br />'+tel+'</p>';
			reResult(result.titleNoFormatting);
		}
		resultdiv.innerHTML = resultcontent;
		
	}
	
	function gotResultss(sc, searcherr)
	{
		var resultcontentt = '';
		var resultdivv = document.getElementById('searchresults2');
		
		for (i=0; i<searcherr.results.length; i++)
		{
			var resultt = searcherr.results[i];
			
			<!-- llamarasincrono2('up_save.php?titulo='+result.titleNoFormatting+'&street='+result.streetAddress+'&lat='+result.lat+'&lng='+result.lng+'&city='+result.city+'&tel='+tel,'load');-->
			resultcontentt += '<p>'+resultt.title+'<br />'+resultt.titleNoFormatting+'<br />'+resultt.url+'<br />'+resultt.content+'</p>';
			llamarasincrono2('up_save_2.php?titulo='+resultt.titleNoFormatting+'&w='+resultt.url+'&d='+resultt.content,'load2');
		}
		resultdivv.innerHTML = resultcontentt;
		
	}

    function OnLoad() {


	 // Create a search control
      var searchControl = new google.search.SearchControl();
	    searchControl.setResultSetSize(google.search.Search.LARGE_RESULTSET);
	  
	  
      // Add in local search
      var localSearch = new google.search.LocalSearch();
      var options = new google.search.SearcherOptions();
      options.setExpandMode(GSearchControl.EXPAND_MODE_OPEN);
	  searchControl.addSearcher(localSearch, options);


      // Set the Local Search center point
      localSearch.setCenterPoint("Madrid, ES");

      // Tell the searcher to draw itself and tell it where to attach
      searchControl.draw(document.getElementById("searchcontrol"));

      // Execute an inital search
      searchControl.execute("Restaurante en <? echo($provincia); ?>");

	  	 // Declare function for using results
	  searchControl.setSearchCompleteCallback(this, gotResults);
		 
    }
	
	function reResult(nn){
	  var searchControll = new google.search.SearchControl();
	  searchControll.setResultSetSize(google.search.Search.LARGE_RESULTSET);
	  var optionss = new google.search.SearcherOptions();
      optionss.setExpandMode(GSearchControl.EXPAND_MODE_OPEN);
	  searchControll.addSearcher(new google.search.WebSearch(), optionss);
	// Execute an inital search
	searchControll.draw(document.getElementById("searchcontrol"));
      searchControll.execute(nn);

	 // Declare function for using results
	  searchControll.setSearchCompleteCallback(this, gotResultss);
	}
	

    google.setOnLoadCallback(OnLoad);
    //]]>
    </script>
    <style>
    	.localexample
    	{
    		width: 40%;
    		height: 100%;
    		float: left;
    	}
    	.localexample strong
    	{
    		display: block;
    		border-bottom: 1px dotted #ccc;
    		margin-bottom: 20px;
    	}
    	#googleversion
    	{
    		margin-right: 50px;
    	}
    	#myversion
    	{
    	}
    </style>
  </head>
  <body>

	<div id="myversion" class="localexample">
		<strong>Buscando <? echo($provincia); ?></strong>
	    <div id="searchresults"></div>
		<div id="searchcontrol"></div>
		<div id="searchresults2"></div>
	</div>
	<div id='load'></div>
	<div id='load2'></div>
  </body>
</html>
