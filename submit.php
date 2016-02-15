
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
                                    <li>
                                        <a href="index.php">
                                            Home
                                        </a>
                                    </li>
                                    <li class="active">
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
                            Results
                        </h1>
                         <p class="lead">

						<?php
						ini_set('display_errors', 1);
						ini_set('display_startup_errors', 1);
						error_reporting(E_ALL);

						include_once "/usr/local/lib/openbabel.php";

						$target_dir = "uploads/";



						//upload file
						$tmpfname1 = tempnam("uploads", date("Ymd"));
						$fileinfo1 =new SplFileInfo(basename($_FILES["file1"]["name"]));
						$extension1=$fileinfo1->getExtension();
						$target_file1 = $tmpfname1.".".$extension1;
						move_uploaded_file($_FILES["file1"]["tmp_name"], $target_file1);


						$tmpfname2 = tempnam("uploads", date("Ymd"));
						$fileinfo2 =new SplFileInfo(basename($_FILES["file2"]["name"]));
						$extension2=$fileinfo2->getExtension();
						$target_file2 =  $tmpfname2.".".$extension2;
						move_uploaded_file($_FILES["file2"]["tmp_name"], $target_file2);
						//end of upload file

						//translate file to smiles format
						$obMol = new OBMol;
						$obConversion = new OBConversion;

						$obConversion->SetInAndOutFormats($extension1, "smi");
						$obConversion->ReadFile($obMol, $target_file1);
						$outMDL = $obConversion->WriteString($obMol);
						$smilesfilename1=$tmpfname1.".smi";
						$handle = fopen($smilesfilename1, "w");
						fwrite($handle, $outMDL);
						fclose($handle);

						$smilesfilename2=$tmpfname2.".smi";
						$obConversion->SetInAndOutFormats($extension2, "smi");
						$obConversion->ReadFile($obMol, $target_file2);
						$outMDL = $obConversion->WriteString($obMol);
						$handle = fopen($smilesfilename2, "w");
						fwrite($handle, $outMDL);
						fclose($handle);

						unlink($tmpfname1);  //delete tmpfilename
						unlink($tmpfname2);

						//end of translate file to smiles format


						//graphics
						$obConversion->SetInAndOutFormats("smi", "svg");
						$obConversion->ReadFile($obMol, $tmpfname1.".smi");
						$outMDL = $obConversion->WriteString($obMol);
						echo "Reactants: ".$outMDL;
						$obConversion->ReadFile($obMol, $tmpfname2.".smi");
						$outMDL = $obConversion->WriteString($obMol);
						echo $outMDL."<br>";
						//end of graphics


						$runpython="/home/mzhu7/chemroutes/openbabel.py ".$tmpfname1.".smi ".$tmpfname2.".smi";
						//echo $runpython;
						$command=escapeshellcmd($runpython);
						$output=shell_exec($command);
						$outputs= explode("\n",$output);

						echo "Products: ";
						for ($i=0;$i<count($outputs)-1;$i++){
							$obConversion->ReadString($obMol, $outputs[$i]);
							$outMDL = $obConversion->WriteString($obMol);
							echo $outMDL;
						}




						?>
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
    
</body>
</html>
