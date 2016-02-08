<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "/usr/local/lib/openbabel.php";

$target_dir = "uploads/";

<<<<<<< HEAD


//upload file
$tmpfname1 = tempnam("uploads", date("Ymd"));
$fileinfo1 =new SplFileInfo(basename($_FILES["file1"]["name"]));
$extension1=$fileinfo1->getExtension();
$target_file1 = $tmpfname1.".".$extension1;
move_uploaded_file($_FILES["file1"]["tmp_name"], $target_file1);
=======
$tmpfname1 = tempnam("uploads", date("Ymd"));
$fileinfo1 =new SplFileInfo(basename($_FILES["file1"]["name"]));
$extension=$fileinfo1->getExtension();
$target_file1 = $target_dir . $tmpfname1.".".$extension;
move_uploaded_file($_FILES["file1"]["tmp_name"], $target_file1);
echo $target_file1;

>>>>>>> ec557cda390cdf948ec7f2621fd6864a26b3fd9b


$tmpfname2 = tempnam("uploads", date("Ymd"));
$fileinfo2 =new SplFileInfo(basename($_FILES["file2"]["name"]));
<<<<<<< HEAD
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



=======
$extension=$fileinfo2->getExtension();
$target_file1 = $target_dir . $tmpfname2.".".$extension;
move_uploaded_file($_FILES["file2"]["tmp_name"], $target_file2);




$handle = fopen($tmpfname, "w");
fwrite($handle, "writing to tempfile");
fclose($handle);


$obMol = new OBMol;
$obConversion = new OBConversion;

//translate to smiles format
$obConversion->SetInAndOutFormats($extension, "smi");
$obConversion->ReadFile($obMol, $target_file1);
$numAtoms = $obMol->NumAtoms(); # now 5 atoms
$outMDL = $obConversion->WriteString($obMol);
echo $outMDL;
$obConversion->ReadFile($obMol, $target_file2);
$outMDL = $obConversion->WriteString($obMol);
echo $outMDL;

//graphics
$obConversion->SetInAndOutFormats($extension, "svg");
$obConversion->ReadFile($obMol, $target_file1);
$numAtoms = $obMol->NumAtoms(); # now 5 atoms
$outMDL = $obConversion->WriteString($obMol);
echo $outMDL;
$obConversion->ReadFile($obMol, $target_file2);
$outMDL = $obConversion->WriteString($obMol);
echo $outMDL;


$command=escapeshellcmd("/home/mzhu7/chemroutes/test.py");
$output=shell_exec($command);

$obConversion->ReadString($obMol, $output);
$outMDL = $obConversion->WriteString($obMol);
echo $outMDL;
>>>>>>> ec557cda390cdf948ec7f2621fd6864a26b3fd9b

?>
