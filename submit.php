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
echo $outMDL;
$obConversion->ReadFile($obMol, $tmpfname2.".smi");
$outMDL = $obConversion->WriteString($obMol);
echo $outMDL;
//end of graphics


$runpython="/home/mzhu7/chemroutes/openbabel.py ".$tmpfname1.".smi ".$tmpfname2.".smi";
//echo $runpython;
$command=escapeshellcmd($runpython);
$output=shell_exec($command);
$outputs= explode("\n",$output);


for ($i=0;$i<count($outputs)-1;$i++){
	$obConversion->ReadString($obMol, $outputs[$i]);
	$outMDL = $obConversion->WriteString($obMol);
	echo $outMDL;
}




?>
