<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$newFileName = "$target_dir" . round(microtime(true)) . "." . pathinfo($target_file,PATHINFO_EXTENSION) ;
$uploadOk = 1;
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
        $uploadOk = 1;
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;

}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 2000000) {
    echo "Sorry, your file is too large. 2MB max.";
    $uploadOk = 0;

}
// Allow certain file formats
if($FileType != "doc" && $FileType != "docx" && $FileType != "xlsx" && $FileType != "xlsm" && $FileType != "xls") {
    echo "Sorry, only .DOCX and .DOC files are allowed.";
    $uploadOk = 0;

}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Danger, Will Robinson.";
    //header('Location: index.php');
// if everything is ok, try to upload file
} else {
      move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newFileName);

      $tempbase = basename($_FILES["fileToUpload"]["name"]) . "_orig";
      $newfile = $target_dir . $tempbase . "." . pathinfo($target_file,PATHINFO_EXTENSION) ;;
      if (!copy($newFileName, $newfile)) {
        echo "Welp, there was an error.";
        exit();
      }

      $reverse_data = strrev(file_get_contents($newFileName));
      file_put_contents($newFileName, $reverse_data);


      if(file_exists($newFileName)){
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($target_file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($newFileName));
        print readfile($newFileName);
        fclose($newFileName);
        unlink($newFileName);
        exit;

        }
        fclose($newFileName);
        unlink($newFileName);

}

?>
