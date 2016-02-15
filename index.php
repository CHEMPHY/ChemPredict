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
            Cover Template for Bootstrap
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
                                        <option>
                                            1
                                        </option>
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
                                <input type="file" name="file1" />
                                <br/>
                                <input type="file" name="file2" />
                                </div>
                                <button type="submit" class="btn btn-primary">
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
        <!--
            Bootstrap core JavaScript
            ==================================================
        -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
        </script>
        <script src="bootstrap.min.js">
        </script>
        <script>
            $( "#num_reactants" ).change(function() {
            	$("#files").empty();
            	var i;
            	var fileindex;
            	for(i=1;i<=this.value;i++){
            		fileindex="file"+i;
            		$("#files").append("<input type='file' name="+fileindex+" ><br>");
            	}
            	
            console.log(this.value)


            });
        </script>
    </script>
</body>
</html>
