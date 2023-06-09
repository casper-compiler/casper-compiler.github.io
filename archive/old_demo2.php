<html lang="en"><head>
		<meta charset="utf-8">

		<meta name="author" content="Maaz Bin Safeer Ahmad">
		<meta name="keywords" content="Casper, Maaz Bin Safeer Ahmad, Verified Lifting, Compiler, Spark, Data Processing, Big Data, Maaz Ahmad, CSE, UW, Univeristy of Washington, Alvin Cheung, Programming Languages, Databases">
		
		<title>Casper Demo</title>
		<meta name="description" content="Casper is a tool that automatically translates code fragments in Java applications to run on Big Data Processing Frameworks such as Apache Hadoop or Apache Spark.">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

 		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-27186113-4', 'auto');
		  ga('send', 'pageview');
		</script>
		
		<link rel="stylesheet" href="codemirror.css">
		<link rel="stylesheet" href="3024-night.css">
		<script src="codemirror.js"></script>
		<script src="clike.js"></script>

		<style>
			.container{
				max-width: 960px;
			}

			.content{
				float: left;
				max-width: 960px;
				width: 100%;
			}

			p{
				font-size: 16px;
				text-align: justify;
			}

			h1{
				font-size: 56px;
				margin-bottom: 0px;
				font-weight: bold;
				color: #337ab7;
			}

			.subtitle{
				font-size: 24px;
				color: #666;
				margin-bottom: 20px;
			}

			.small-heading {
				color: #286090;
				font-weight: bold;			
			}

			.footer .small-heading {
				margin-top: 3px;
				margin-bottom: 3px;			
			}

			.footer{
				margin-bottom: 25px;
			}

			.translate {
				margin-top: 20px;
				margin-bottom: 10px;
				border-radius: 0px;
				width: 200px;
			}

			hr{
				margin-top: 30px;
				margin-bottom: 10px;
				border-top: 1px solid #eee;
			}

			li a:hover{
				cursor: pointer;
			}

			.samples{
				width: 200px;
				display: inline-block;
				vertical-align: top;
			}

			.working-icon{
				width: 30px;
			    margin-top: 10px;
			    margin-left: 15px;
			}

			.console-label, .output-label{
				padding-left: 8px;
			    border-radius: 0 0 0 6px;
			    position: relative;
			    z-index: 2;
			    top: 21px;
			    font-family: monospace;
			    background: #ddd;
			    margin-top: -20px;
			}

			.console-label{
				width: 165px;
			    left: 764px;
			}

			.output-label{
			    width: 198px;
    			left: 732px;
			}

			.CodeMirror{
				border: 1px solid #eee;
			}

			.output-label, .console-label, .working-icon {
				visibility: hidden;
			}
		</style>
	</head>

	<body>
		<div class="container">
      		<div class="content">
  				<h1>Casper</h1>
  				<p class="subtitle">Run your Java applications on Big Data Frameworks</p>
				<p class="small-heading">Enter the Java program you want to translate to Apache Spark</p>

<textarea rows="20" id="java-code">import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class YelpScore {
    class Restaurant {
        public String state;
        public String city;
        public String comment;
        public int score;
        public Boolean goodForKids;
    }

    public Map<Integer,Integer> reviewCount(List<Restaurant> data, String keyState) {
        Map<Integer,Integer> result = new HashMap<Integer,Integer>();

        for (Restaurant record : data) {
            if (!result.containsKey(record.score)) {
                result.put(record.score, 0);
            }
            if (record.state.equals(keyState)) {
                result.put(record.score, result.get(record.score)+1);
            }
        }

        return result;
    }
}</textarea>
				
				<p style="display: inline-block;">
				  <button type="button" class="translate btn btn-primary btn-lg" id="translate-program">Translate</button>
				</p>

				<img class="working-icon" src="working.gif"/>

				<div class="console-label">Casper OutStream</div>

				<textarea rows="5" id="console-output"></textarea>

				</br>

				<div class="output-label">Generated Spark Code</div>

				<textarea rows="20" id="output-code">// No solution to show</textarea>

				<hr/>
				
				<div class="footer">
					<div class="samples">
						<p class="small-heading">Sample Programs</p>
						<ul class="list-unstyled">
							<li><a href="#">Word Count</a></li>
							<li><a href="#">Variance</a></li>
							<li><a href="#">Yelp</a></li>
							<li><a href="#">Grep</a></li>
							<li><a href="#">Absolute Max</a></li>
						</ul>
					</div>
					<div class="samples">
						<p class="small-heading">Learn more</p>
						<ul class="list-unstyled">
							<li><a href="#">Casper Homepage</a></li>
							<li><a href="#">Git Repository</a></li>
							<li><a href="#">Publications</a></li>
						</ul>
					</div>
					<div class="samples">
						<p class="small-heading">Contact Us</p>
						<ul class="list-unstyled">
							<li><a href="#">Mailing List</a></li>
							<li><a href="#">Maaz Ahmad</a></li>
							<li><a href="#">Alvin Cheung</a></li>
						</ul>
					</div>
					<div class="samples">
						<p class="small-heading">Affiliations</p>
						<ul class="list-unstyled">
							<li><a href="#">UWDB</a></li>
							<li><a href="#">UWPLSE</a></li>
						</ul>
					</div>
				</div>
			</div>
	    </div>
	</body>

	<script type="text/javascript">
	  var javaEditor = CodeMirror.fromTextArea(document.getElementById("java-code"), {
		lineNumbers: true,
		matchBrackets: true,
		mode: "text/x-java",
		readOnly: false,
		tabSize: 2
	  });
	  javaEditor.setSize("100%","390px");
	  
	  var consoleEditor = CodeMirror.fromTextArea(document.getElementById("console-output"), {
		lineNumbers: false,
		matchBrackets: false,
		mode: "text",
		readOnly: true
	  });
	  consoleEditor.setOption("theme","3024-night");
	  consoleEditor.setSize("100%","250px");

	  $(consoleEditor.getWrapperElement()).hide();
	
	  var outputEditor = CodeMirror.fromTextArea(document.getElementById("output-code"), {
		lineNumbers: true,
		matchBrackets: false,
		mode: "text/x-java",
		readOnly: true
	  });
	  outputEditor.setSize("100%","370px");
	  
	  $(outputEditor.getWrapperElement()).hide();

	  $("#translate-program").click(function(e){
	  	if($("#translate-program").hasClass("disabled")) return;
	  	$("#translate-program").text("Translating...").addClass("disabled");
	  	$(".working-icon").css("visibility", "visible");
	  	consoleEditor.setValue("");
	  	outputEditor.setValue("// No solution to show");
	  	$(consoleEditor.getWrapperElement()).show();
	  	$(outputEditor.getWrapperElement()).hide();
	  	$(".output-label").css("visibility", "hidden");
	  	$(".console-label").css("visibility", "visible");
	    $.ajax({
	        type: "POST",
	        url: "http://localhost/web/casper/service.php",
	        data: {"javaCode":  javaEditor.getValue()},
	        dataType: "json",
	        success: function(msg) {
	            $(outputEditor.getWrapperElement()).show();
	            $(".output-label").css("visibility", "visible");
	            $("#translate-program").text("Translate").removeClass("disabled");
			  	$(".working-icon").css("visibility", "hidden");
				consoleEditor.setValue(msg.consoleLog);
			  	outputEditor.setValue(msg.sparkCode);
	        },
	        error: function(e){
	            consoleEditor.setValue(msg.consoleLog);
	        }
	    });
	  });
	</script>
</html>
