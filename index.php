<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content=""/>
        <meta name="author" content=""/>
        <link rel="icon" href="favicon.ico"/>
        <title>
            ChemRoutes
        </title>
        <link rel="stylesheet" href="bootstrap.min.css"/>
        <link href="cover.css" rel="stylesheet"/>
    </head>
    <body>
        <div class="site-wrapper">
            <div class="site-wrapper-inner">
                <div class="cover-container">
                    <div class="masthead clearfix">
                        <div class="inner">
                            <h3 class="masthead-brand">
                                ChemPredict
                            </h3>
                            <nav>
                                <ul class="nav masthead-nav">
                                    <li class="active">
                                        <a href="index.php">
                                            Home
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            Results
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="inner cover">
                        <h1 class="cover-heading">
                            ChemPredict
                        </h1>
                        <p class="lead">
                            Predict whether a reaction can happen
                        </p>
                        <p class="lead">
                            <form action="submit.php" method="post" enctype="multipart/form-data" >
                                <fieldset class="form-group">
                                    <label for="exampleSelect1">
                                        Select how many reactants/reagents.
                                    </label>
                                    <select class="form-control" id="num_reactants" name="num_reactants">
                                        <option selected>
                                            2
                                        </option>
                                        <option>
                                            3
                                        </option>
                                        <option>
                                            4
                                        </option>
                                        <option>
                                            5
                                        </option>
                                    </select>
                                </fieldset>
                                <div id="files">
                                Reactant/Reagent 1: 
                                    <label class="btn btn-success btn-sm" for="my-file-selector" style="width:150px;">
                                        <input name="file1" id="my-file-selector" type="file" style="display:none;"  />
                                        Upload
                                    </label>                                    
                                    <button type="button" class="btn btn-warning btn-sm" id="file1draw" onclick="myFunction('smiles1')"  style="width:150px;">
                                        Draw
                                    </button>
                                    <input type=hidden name="smiles1" id="smiles1" />
                                    <br/><br/> 
                                Reactant/Reagent 2: 
                                    <label class="btn btn-success btn-sm" for="my-file-selector2" style="width:150px;">
                                        <input name="file2" id="my-file-selector2" type="file" style="display:none;" />
                                        Upload
                                    </label>                                    
                                    <button type="button" class="btn btn-warning btn-sm" onclick="myFunction('smiles2')"  style="width:150px;">
                                        Draw
                                    </button>
                                    <input type=hidden name="smiles2" id="smiles2" />
                                    <br/><br/>
                                </div>

                                
                                <button type="submit" class="btn btn-primary btn-lg" style="width:200px;">
                                    Submit
                                </button>
                            </form>
                        </p>
                    </div>
                    <div class="mastfoot">
                        <div class="inner">
                            <p>
                                By Binghe Wang's lab, 2016
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="bootstrap.min.js"></script>

        <script src="marvinjs/js/lib/rainbow/rainbow-custom.min.js"></script>
        <script src="marvinjs/gui/lib/promise-1.0.0.min.js"></script>
        <script src="marvinjs/js/marvinjslauncher.js"></script>        
        
        <script src="eModal.min.js"></script>
       

        <script>
            window.addEventListener("message", function(event) {
            try {
            var externalCall = JSON.parse(event.data);
            marvin.onReady(function() {
            marvin.sketcherInstance[externalCall.method].apply(marvin.sketcherInstance, externalCall.args);
            });
            } catch (e) {
            console.log(e);
            }
            }, false);
            // called when Marvin JS loaded
            function sketchOnLoad() {
            if(marvin.Sketch.isSupported()) {
            marvin.sketcherInstance = new marvin.Sketch("sketch");
            marvin.sketcherInstance.setServices(getDefaultServices());
            } else {
            alert("Cannot initiate sketcher. Current browser may not support HTML canvas or may run in Compatibility Mode.");
            }
            }
        </script>     

		<script>
		function myFunction()
		{
			eModal.iframe("modal.htm" ,"Structures");

		}

		function hello(string){
   			var name=string
   			document.getElementById('smiles1').value=name;
  		}
		</script>


		<script>

            $("#num_reactants").change(function() {
            	console.log("sb")
	            $("#files").empty();
	            var i;
	            var fileindex;
	            for(i=1;i<=this.value;i++){
	                fileindex="file"+i;
	                $("#files").append("Reactant/Reagent "+i+": <label class='btn btn-success btn-sm' for=my-file-selector"+i+" style='width:150px;'><input name=file"+i+" id=my-file-selector"+i+" type='file' style='display:none;' />Upload</label> <button type='button' class='btn btn-warning btn-sm' onclick=\"myFunction(\'smiles"+i+"\')\"  style=\"width:150px;\">Draw</button><input type=hidden name=smiles"+i+" id=smiles"+i+" /><br/><br/>");
	                }
	               
                
             });

                         
        </script>
        <!--
            Bootstrap core JavaScript
            ==================================================
        -->
        <!-- Placed at the end of the document so the pages load faster -->

    </body>
</html>
