<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "/usr/local/lib/openbabel.php";

$target_dir = "uploads/";

$tmpfname1 = tempnam("uploads", date("Ymd"));
$fileinfo1 =new SplFileInfo(basename($_FILES["file1"]["name"]));
$extension=$fileinfo1->getExtension();
$target_file1 = $target_dir . $tmpfname1.".".$extension;
move_uploaded_file($_FILES["file1"]["tmp_name"], $target_file1);
echo $target_file1;



$tmpfname2 = tempnam("uploads", date("Ymd"));
$fileinfo2 =new SplFileInfo(basename($_FILES["file2"]["name"]));
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

?>
